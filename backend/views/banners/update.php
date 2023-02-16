<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Banners $model */

$this->title = 'Update Banners: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Banners', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="banners-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
