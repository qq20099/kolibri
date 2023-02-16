<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\SiteSettings $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="site-settings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'settings[name]')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'settings[value]')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'settings[type]')->dropDownList(['input' => 'Строка', 'checkbox' => 'Флажок']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
