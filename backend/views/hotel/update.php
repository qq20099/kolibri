<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CoraltravelHotel $model */

$this->title = 'Update Coraltravel Hotel: ' . $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Coraltravel Hotels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'ID' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="coraltravel-hotel-update">

    <!--<h1><?//= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
