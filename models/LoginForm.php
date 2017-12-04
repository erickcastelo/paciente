<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\httpclient\Client;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $email;
    public $senha;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'senha'], 'required'],
            // rememberMe must be a boolean value
//            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
//            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $access = $this->accessLoginApi();


            if (!isset($access['accesstoken'])) {
                $this->addError($attribute, 'Usuário ou senha incorretos');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $access = $this->accessLoginApi();

            if (isset($access['accesstoken'])) {
                $session = Yii::$app->session;
                $session->open();

                $array = $this->getPaciente($access['accesstoken']);

                $session['usuario'] = $array;

                return Yii::$app->user->login($this->getUser(),  $this->rememberMe ? 3600*24*30 : 0);
            }
        }
        return false;
    }

    private function accessLoginApi()
    {
        /** @var $cliente Client */
        $baseUrl = Yii::$app->params['baseUrl'];

        $cliente = new Client(['baseUrl' => $baseUrl .'/paciente']);

        $response = $cliente
            ->post('login')
            ->addHeaders([
                'Content-Type' => 'application/x-www-form-urlencoded'
            ])
            ->setData([
                'email' =>$this->email,
                'password' =>$this->senha,
                'tipoPessoa' => 2
            ])
            ->send();


        return $response->data;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->email);
        }

        return $this->_user;
    }

    public function getPaciente($token)
    {
        $baseUrl = Yii::$app->params['baseUrl'];

        $cliente = new Client(['baseUrl' => $baseUrl .'/paciente']);

        $response = $cliente
            ->get('paciente')
            ->addHeaders([
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => 'Bearer ' . $token
            ])
            ->send();

        return $response->data;
    }
}
