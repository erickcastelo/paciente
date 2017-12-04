<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = 'Minhas Consultas';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="minhas-consultas">
    <div class="table-responsive">
        <?php Pjax::begin(['enablePushState' => false]) ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'codigo',
                'descricao',

                [
                    'attribute' => 'datacriacao',
                    'format' => ['date', 'php:d/m/Y']
                ],

                [
                    'attribute' => 'profissional',
                    'value' => function($model){
                        return $model['profissional']['nome'];
                    }
                ],
                [
                    'attribute' => 'email',
                    'value' => function($model){
                        return $model['profissional']['email'];
                    }
                ],


                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{teste}',
                    'buttons' => [
                        'teste' => function($url, $model){
                            $urlModel = \yii\helpers\Url::to(['consulta/finalizar', 'id' => $model['codigo']]);
                            return Html::a('<i style="font-size: 20px;te" class="fa fa-check"></i>',
                                $urlModel, ['class' => 'center-block']);
                        }
                    ]
                ]
            ]
        ]) ?>
        <?php Pjax::end() ?>
    </div>
</div>
