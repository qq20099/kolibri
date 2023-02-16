<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\SiteSettings $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="site-settings-form">

    <?if($model->value):?>
    <?php $form = ActiveForm::begin(); ?>
    <?//foreach($model->value as $key => $value):?>
    <?if($model->value['type'] == 'checkbox'):?>
<?php
  $field = $form->field($model, 'value[value]');
  $field->template = "
    <div class='input__inner'>\n
      {input}\n
    </div>\n";
  $field->labelOptions = ['class' => 'input__label'];
  echo $field->checkbox([
     'checked' => $model->value['value'] ? true : false,
     'value' => 1,
     'label' => $model->name,
  ])->label($model->value['name']);
?>

    <?else:?>
    <?= $form->field($model, 'value[value]')->hiddenInput(['value' => $value['value']])->label($model->name) ?>
    <?endif?>
    <?//endforeach?>
    <?= $form->field($model, 'value[name]')->hiddenInput(['value' => $value['name'], 'label' => null])->label(false) ?>
    <?= $form->field($model, 'value[type]')->hiddenInput(['value' => $value['type'], 'label' => null])->label(false) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?endif?>
</div>
