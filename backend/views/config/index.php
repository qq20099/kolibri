<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ConfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Налаштування';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- <p>
        <?//= Html::a(Yii::t('app\service', 'Create Config'), ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'id',
                'headerOptions' => ['width' => '40'],
            ],

            [
                'attribute'=>'label',
                'value' => 'label',
                'headerOptions' => ['width' => '200'],
            ],

            [
                'attribute'=>'name',
                'value' => 'name',
                'headerOptions' => ['width' => '60'],
            ],
            [
                'attribute'=>'val',
                'value' => function($data){
                  return '<div class="field-val">'.$data->val.'</div>';
                },
                'format' => 'html',
                'headerOptions' => ['width' => '600'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                //'header' => '',
                'headerOptions' => ['width' => '40'],
                'template' => '{update}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
