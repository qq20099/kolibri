<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Config */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="config-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="form-group field-config-name required has-success">

    <?= $form->field($model, 'name')->textInput(['readonly' => true]) ?>

    </div>

    <?= $form->field($model, 'name')->hiddenInput(['maxlength' => true])->label(false) ?>
    <?if(in_array($model->name, ['terms_of_use_en-US', 'terms_of_use_ru-RU', 'terms_of_use_lv-LV', 'privacy_policy_en-US', 'privacy_policy_ru-RU', 'privacy_policy_lv-LV'])):?>
    <?= $form->field($model, 'val')->widget(CKEditor::className(), [
      'editorOptions' => [
        'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
        'inline' => false, //по умолчанию false
      ],
    ]); ?>
    <?else:?>
    <?= $form->field($model, 'val')->textarea(['rows' => 6]) ?>
    <?endif?>

    <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Зберегти', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
