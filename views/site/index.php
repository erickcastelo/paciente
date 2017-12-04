<?php

/* @var $this \yii\web\View */
/* @var $model \app\models\LoginForm */

use yii\bootstrap\Modal;
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <link href="/css/login.css" rel="stylesheet" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="site-index">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="text-center">Welcome</h1>
            </div>
            <div class="modal-body">

                <?php $form = ActiveForm::begin([
                    'id' => 'register-form',
                    'enableClientValidation' => true,
                    'enableAjaxValidation' => true,
                    'options' => [
                        'validateOnSubmit' => true,
                        'class' => 'form',
                    ]

                ]) ?>

                <?= $form->field($model, 'email')->textInput(
                    [
                        'class' => 'form-control input-lg',
                        'placeholder' => 'Email',
                        'autofocus' => true
                    ])
                    ->label(false)
                ?>

                <?= $form->field($model, 'senha')->passwordInput(
                    ['class' => 'form-control input-lg', 'placeholder' => 'Senha']
                )
                    ->label(false)
                ?>

                <?= Html::submitButton('Login', [
                    'class' => 'btn btn-block btn-lg btn-primary',
                ])  ?>

                <div class="form-group">

                    <?= Html::button('Cadastrar', [
                            'class' => 'btn btn-link pull-right cadastro-paciente',
                            'value' => Url::to('paciente/cadastro')
                    ]) ?>

                    <span><a href="#">Forgot Password</a></span>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>

<?php
Modal::begin([
    'header' => '<h2 style="text-align: center">Cadastrar Paciente</h2>',
    'class' => 'modal',
    'size' => 'modal-lg'
]);

echo "<div id='modalContent'></div>";

Modal::end();

$this->registerJsFile(
    '@web/js/open-modal.js',
    ['depends' => JqueryAsset::className()]
);
?>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>