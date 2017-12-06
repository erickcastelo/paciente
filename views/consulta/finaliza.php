<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Finaliza Consulta';
$this->params['breadcrumbs'][] = ['label' => 'Minhas Consultas', 'url' => ['minhas-consultas']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= Html::a('Voltar', Url::to(['consulta/minhas-consultas']), ['class' => 'btn btn-info', 'style' => 'width: 150px']) ?>
