<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 04/12/17
 * Time: 15:14
 */

namespace app\controllers;


use app\models\Paciente;
use Yii;
use yii\data\ArrayDataProvider;
use yii\data\Sort;
use yii\web\Controller;

class ConsultaController extends Controller
{

    public function actionPendente()
    {
        $paciente = new Paciente();
        $dados = $paciente->getConsultas('p');

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

        $dataProvider = new ArrayDataProvider([
            'allModels' => $dados,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => $sort
        ]);

        return $this->render('pendente', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionFinalizada()
    {
        $paciente = new Paciente();
        $dados = $paciente->getConsultas('f');

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

        $dataProvider = new ArrayDataProvider([
            'allModels' => $dados,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => $sort
        ]);

        return $this->render('finalizada', [
            'dataProvider' => $dataProvider
        ]);
    }


    public function actionFinalizar()
    {
        $request  = Yii::$app->request;
        $codigo = $request->get('id');

        $model = new Paciente();

        $texto = null;
        $class = null;

        if ($model->finalizaConsulta($codigo)) {
            $texto = 'Sua consulta foi finalizada com sucesso!';
            $class = 'success';
        }else {
            $texto = 'Consulta não encontrada!';
            $class = 'danger';
        }

        Yii::$app->getSession()->setFlash($class, $texto);

        return $this->render('finaliza');
    }
}