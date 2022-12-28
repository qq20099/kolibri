<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Tours $model */

$this->title = 'Create Hot Deals';
$this->params['breadcrumbs'][] = ['label' => 'Hot Deals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hot-deals-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
