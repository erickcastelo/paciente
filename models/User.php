<?php

namespace app\models;

use Yii;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $numero;
    public $email;
    public $cpf;
    public $rg;
    public $nome;
    public $login;
    public $senha;
    public $datanascimento;
    public $datacriacao;
    public $fone;
    public $numerotipo;
    public $responsavel;
    public $authkey;
    public $accesstoken;
    public $servicolaboratorial;
    public $servicoimagem;
    public $cnpj;
    public $fantasia;
    public $bairro;
    public $endereco;
    public $foto;
    public $codpais;
    public $tipoempresa;

//    private static $users = [
//        '100' => [
//            'id' => '100',
//            'username' => 'admin',
//            'password' => 'admin',
//            'authKey' => 'test100key',
//            'accessToken' => '100-token',
//        ],
//        '101' => [
//            'id' => '101',
//            'username' => 'demo',
//            'password' => 'demo',
//            'authKey' => 'test101key',
//            'accessToken' => '101-token',
//        ],
//    ];


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $session = Yii::$app->session;
        $session->open();

        if (isset($session['usuario'])) {
            return $session['usuario']['numero'] === $id ? new static($session['usuario']) : null;
        }

        return null;

    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $session = Yii::$app->session;
        $session->open();

        if (isset($session['usuario'])) {
            return $session['usuario']['accesstoken'] === $token ? new static($session['usuario']) : null;
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($email)
    {
        $session = Yii::$app->session;
        $session->open();

        if (isset($session['usuario'])) {
            return $session['usuario']['email'] === $email ? new static($session['usuario']) : null;
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->numero;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authkey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authkey)
    {
        return $this->authkey === $authkey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->senha === $password;
    }
}
