<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\SiteSettings $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="site-settings-form">

    <?php $form = ActiveForm::begin(); ?>

<?php
  $field = $form->field($model, 'value[in_maintenance]');
  $field->template = "
    <div class='input__inner'>\n
      {input}\n
    </div>\n";
  $field->labelOptions = ['class' => 'input__label'];
  echo $field->checkbox([
     'checked' => $model->value->in_maintenance ? true : false,
     'value' => 1,
     'label' => $model->name,
  ])->label();
?>

<?php
  /*$field = $form->field($model, 'value[in_maintenance]');
  $field->template = "
    <div class='input__inner'>\n
      {label}\n
      {input}\n
    </div>\n";
  $field->labelOptions = ['class' => 'input__label'];
  echo $field->textInput([
     'value' => $model->maintenance_message,
     'label' => $model->name,
  ])->label('Сообщение');*/
?>
    <?= $form->field($model, 'name')->hiddenInput(['label' => null])->label(false) ?>
    <?//= $form->field($model, 'value[type]')->hiddenInput(['value' => $value['type'], 'label' => null])->label(false) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
