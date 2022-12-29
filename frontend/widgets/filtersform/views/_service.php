<?php
use yii\helpers\Url;
use yii\bootstrap4\Html;

  $field = $form->field($model, 'service', []);
?>
<?=$field->checkboxList(
    $service,
    [
        'item' => function ($index, $label, $name, $checked, $value) use ($model) {
            return Html::checkbox($name, $checked, [
                'value' => $value,
                'id' => 'service-checkbox-'.$value,
                'class' => 'checkbox searchtours-service',
                //'checked' => ((ArrayHelper::isIn($value, ArrayHelper::getColumn($model->categories0, 'id'))) ? true :false),
            ]).'<label for="service-checkbox-'.$value.'" class="checkbox-label"><span class="wra">'.$label.'</span></label>';
        }
    ], []
    )->label(false);
?>