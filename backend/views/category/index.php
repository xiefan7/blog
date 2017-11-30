<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '分类管理';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建分类', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           /* ['class' => 'yii\grid\SerialColumn'],*/
            ['attribute'=>'id',
                'contentOptions'=>['width'=>'30px'],
            ],
            'name',
            ['attribute'=>'created_at',
                'label'=>'创建时间',
                'format'=>['date','php:Y-m-d H:i:s'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view}  {delete} ',
            ],
        ],
    ]); ?>
</div>
