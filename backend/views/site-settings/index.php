<?php

use common\models\SiteSettings;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\SearchSiteSettings $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Site Settings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-settings-index">

    <!--<p>
        <?//= Html::a('Create Site Settings', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
