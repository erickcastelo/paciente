<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 04/12/17
 * Time: 15:14
 */

namespace app\controllers;


use app\models\Paciente;
use yii\data\ArrayDataProvider;
use yii\data\Sort;
use yii\web\Controller;

class ConsultaController extends Controller
{

    public function actionMinhasConsultas()
    {
        $paciente = new Paciente();
        $dados = $paciente->getConsultas();
//        echo "<pre>", var_dump($dados), "</pre>"; die;

        $sort = new Sort([
            'attributes' => [
                'codigo' => [
                    'asc' => ['codigo' => SORT_ASC],
                    'desc' => ['codigo' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'Número Consulta',
                ],
                'descricao' => [
                    'asc' => ['descricao' => SORT_ASC],
                    'desc' => ['descricao' => SORT_DESC],
                    'label' => 'Descrição'
                ],
                'datacriacao' => [
                    'asc' => ['datacriacao' => SORT_ASC],
                    'desc' => ['datacriacao' => SORT_DESC],
                    'label' => 'Data Criação'
                ],
                'profissional' => [
                    'asc' => ['profissional' => SORT_ASC],
                    'desc' => ['profissional' => SORT_DESC],
                    'label' => 'Nome Profissional Saúde'
                ],
                'email' => [
                    'asc' => ['email' => SORT_ASC],
                    'desc' => ['email' => SORT_DESC],
                    'label' => 'Email'
                ],
                // or any other attribute
            ],
        ]);

//        $array = [
//            0 => [
//                'email' => 1,
//                'nome' => 'Erick',
//                'datanascimento' => '11/03/1989',
//                'fone' => '991151022'
//            ]
//        ];

        $dataProvider = new ArrayDataProvider([
            'allModels' => $dados,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => $sort
        ]);

        return $this->render('minhas-consultas', [
            'dataProvider' => $dataProvider
        ]);
    }
}