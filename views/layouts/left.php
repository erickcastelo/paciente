<?php

$session = Yii::$app->session;
$session->open();

$imagemPadrao = Yii::$app->params['urlImagemPadrao'];

$foto = $session['usuario']['foto'] === null ? $imagemPadrao : $session['usuario']['foto'];
?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $foto ?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= $session['usuario']['nome'] ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Minhas Consultas', 'icon' => 'file-code-o', 'url' => ['consulta/minhas-consultas']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Configurações',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Editar Dados', 'icon' => 'file-code-o', 'url' => ['configuracao/edit'],],
                            ['label' => 'Mudar Foto', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Pesquisar Empresas', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    ['label' => 'Sair', 'icon' => 'sign-out', 'url' => ['/logout'], 'template' => '<a href="{url}" data-method="post">{icon}{label}</a>']
                ],
            ]
        ) ?>

    </section>

</aside>
