<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Tours $model */

$this->title = 'Update Hot Deals: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Hot Deals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hot-deals-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
