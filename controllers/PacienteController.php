<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 03/12/17
 * Time: 13:29
 */

namespace app\controllers;

use app\models\Paciente;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

class PacienteController extends Controller
{

    public function actionCadastro()
    {
        $model = new Paciente();


        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }else {
            if($model->load(Yii::$app->request->post())){

                $model->numero = date('Y') . "-" . $model['cpf'] . "-PA";

                $response = $model->cadastrarPaciente($model->toArray());

                if ($response === 1) {
                    $texto = 'Seu cliente foi cadastrado com sucesso!';
                    Yii::$app->getSession()->setFlash('success', $texto);

                    return $this->render('alerta');
                } else {
//                    $texto = 'Erro ao tentar fazer o cadastro!';
//                    Yii::$app->getSession()->setFlash('erro', $texto);
                    $model->addErrors($response->data);
                }


            }
        }

        $paises = $model->paises();

        return $this->renderAjax('cadastro', [
            'model' => $model,
            'paises' => $paises
        ]);

    }

}