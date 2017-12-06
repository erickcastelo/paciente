<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 03/12/17
 * Time: 13:30
 */

namespace app\models;


use Yii;
use yii\base\Model;
use yii\helpers\Json;
use yii\httpclient\Client;

class Paciente extends Model
{

    public $numero;
    public $email;
    public $cpf;
    public $rg;
    public $nome;
    public $senha;
    public $confirmasenha;
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

    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'senha', 'fone'], 'required'],
            [['datacriacao', 'datanascimento'], 'safe'],
            [['codpais'], 'integer'],
            [['numero', 'nome', 'rg', 'cpf', 'email', 'senha', 'confirmasenha', 'foto', 'endereco', 'bairro', 'fantasia', 'cnpj', 'servicoimagem', 'servicolaboratorial', 'accesstoken', 'authkey', 'responsavel', 'numerotipo', 'fone'], 'string'],
            ['confirmasenha', 'confirmationPassword']
        ];
    }

    public function confirmationPassword($attribute, $params)
    {
        $password = $this->senha;
        $confirmPassword = $this->confirmasenha;

        if ($password !== $confirmPassword){
            $this->addError($attribute, 'Senhas não conferem');
        }
    }

    public function attributeLabels()
    {
        return [
            'cpf' => 'CPF',
            'codpais' => 'País',
            'confirmasenha' => 'Confimar Senha',
            'fone' => 'Telefone',
            'rg' => 'RG',
            'datanascimento' => 'Data Nascimento'
        ];
    }

    public function paises()
    {
        $baseUrl = Yii::$app->params['baseUrl'];

        $cliente = new Client(['baseUrl' => $baseUrl .'/pais']);

        $response = $cliente
            ->get('paises')
            ->addHeaders([
                'Content-Type' => 'application/x-www-form-urlencoded'
            ])
            ->send();

        return Json::decode($response->content);
    }

    public function cadastrarPaciente($model)
    {
        $baseUrl = Yii::$app->params['baseUrl'];

        $client = new Client(['baseUrl' => $baseUrl .'/paciente',
            'requestConfig' => [
                'format' => Client::FORMAT_JSON
            ],
            'responseConfig' => [
                'format' => Client::FORMAT_JSON
            ],
        ]);

        $response = $client
            ->post('inserir')
            ->addHeaders([
                'Content-Type' => 'application/x-www-form-urlencoded'
            ])
            ->setData([
                  $model
            ])
            ->send();

        return $response->data;
    }

    public function getConsultas()
    {
        $baseUrl = Yii::$app->params['baseUrl'];

        $cliente = new Client(['baseUrl' => $baseUrl .'/paciente']);

        $response = $cliente
            ->get('minhas-consultas')
            ->addHeaders([
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => 'Bearer ' . Yii::$app->user->identity->getAuthKey()
            ])
            ->send();

        return Json::decode($response->content);
    }

    public function getPaciente()
    {
        $baseUrl = Yii::$app->params['baseUrl'];

        $cliente = new Client(['baseUrl' => $baseUrl .'/paciente']);

        $response = $cliente
            ->get('paciente')
            ->addHeaders([
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => 'Bearer ' . Yii::$app->user->identity->getAuthKey()
            ])
            ->send();

        return new static($response->data);
    }
}