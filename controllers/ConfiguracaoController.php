<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 04/12/17
 * Time: 19:45
 */

namespace app\controllers;


use app\models\Paciente;
use yii\web\Controller;

class ConfiguracaoController extends Controller
{

    public function actionEdit()
    {
        $model = new Paciente();

//        var_dump($model->getPaciente());

        return $this->render('editar', [
            'model' => $model->getPaciente(),
            'paises' => $model->paises()
        ]);
    }

    public function actionEditFoto()
    {

    }

    public function actionSearchEmpresa()
    {

    }
}