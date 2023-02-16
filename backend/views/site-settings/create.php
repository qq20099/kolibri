<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SiteSettings $model */

$this->title = 'Create Site Settings';
$this->params['breadcrumbs'][] = ['label' => 'Site Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-settings-create">

    <!--<h1><?//= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_create_form', [
        'model' => $model,
    ]) ?>

</div>
