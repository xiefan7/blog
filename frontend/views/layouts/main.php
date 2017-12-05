<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use \common\models\Category;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<script src='/js/jquery-3.2.1/jquery-3.2.1.js'></script>
<script src="/js/layer/layer.js"></script>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap" style="border:solid 1px;">
    <?php
    NavBar::begin([
        'brandLabel' => '<image class="header-logo" src="http://localhost/blog/frontend/web/uploads/logo.png" />',
    	//'brandOptions'=> ['style'=>''],
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top navbar',
        ],
    ]);
    $menuItem=[
        ['label' => '<span class="glyphicon glyphicon-book f60" aria-hidden="true"></span>&nbsp;全部', 'url' => ['/post/index'],'encode'=>false],
        ['label' => '<span class="glyphicon glyphicon-book f60" aria-hidden="true"></span>&nbsp;PHP', 'url' => ['/post/index','category_id'=>Category::PHP],'encode'=>false,
            'items' => [
        ['label' =>  '<span class="glyphicon glyphicon-book f60" aria-hidden="true"></span>&nbsp;Yii', 'url' =>  ['/post/index','category_id'=>3],'encode'=>false],
        ],
            'dropDownOptions'=>['class'=>'nav nav-pills nav-stacked'],
        ],
        ['label' => '<span class="glyphicon glyphicon-book f60" aria-hidden="true"></span>&nbsp;Python', 'url' => ['/post/index','category_id'=>Category::PYTHON],'encode'=>false],
    ];
    $menuItems = [
        ['label' => '关于我们', 'url' => ['/site/about']],
        ['label' => '联系我们', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '注册', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => '登录', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                '退出 (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left '],
        'items' => $menuItem,
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    <!--<div class="left">
        <div class="col-md-2  " >
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> 最新回复
                </li>
                <li class="list-group-item">
                    11111111111111111111111
                </li>
            </ul>
        </div>
    </div>-->
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>

    </div>

</div>



<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; xf_blog <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
