<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Config */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="config-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'name')->hiddenInput(['label' => null])->label(false) ?>
    <div class="row">
        <div class="col-md-12">
            <?=$this->render('_img', compact('model', 'form'))?>
        </div>
    </div>


    <?//= $form->field($model, 'name')->hiddenInput(['maxlength' => true])->label(false) ?>
    <?//if(in_array($model->name, ['terms_of_use_en-US', 'terms_of_use_ru-RU', 'terms_of_use_lv-LV', 'privacy_policy_en-US', 'privacy_policy_ru-RU', 'privacy_policy_lv-LV'])):?>

    <?//= $form->field($model, 'val')->textarea(['rows' => 6]) ?>


    <?//= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
