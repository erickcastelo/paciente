<?php

/** @var $model \app\models\Paciente */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

?>

<div class="paciente-form">

    <?php $form = ActiveForm::begin([
        'id' => $model->formName(),
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'options' => [
            'validateOnSubmit' => true,
        ],


    ]) ?>

    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'codpais')
                ->dropDownList(ArrayHelper::map($paises, 'codigo', 'nome'),
                    ['prompt' => 'Selecione...'])
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'email')
                ->textInput(['type' => 'email']) ?>
        </div>

        <div class="col-lg-3">
            <?= $form->field($model, 'senha')
                ->passwordInput() ?>
        </div>

        <div class="col-lg-3">
            <?= $form->field($model, 'confirmasenha')
                ->passwordInput() ?>
        </div>

        <div class="col-lg-3">
            <?= $form->field($model, 'nome')
                ->textInput() ?>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'cpf')
                ->textInput() ?>
        </div>

        <div class="col-lg-3">
            <?= $form->field($model, 'rg')
                ->textInput() ?>
        </div>

        <div class="col-lg-3">
            <?= $form->field($model, 'datanascimento')
                ->widget(DatePicker::className())->textInput(['class' => 'form-control']) ?>
        </div>


        <div class="col-lg-3">
            <?= $form->field($model, 'fone')
                ->textInput() ?>
        </div>
    </div>

    <div class="form-group inline">

        <?= Html::submitButton('Salvar', ['class' => 'btn btn-primary submeter', 'style' => 'width: 100%']) ?>

    </div>

    <?php ActiveForm::end(); ?>
</div>