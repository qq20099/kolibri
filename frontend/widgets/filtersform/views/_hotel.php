<?php
use dosamigos\multiselect\MultiSelect;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\Html;
?>
<div class="hotel-filter-wrapper">
<!--/*<?foreach($hotel as $ID => $value):?>
<div><?=$ID?> <?=$value?></div>
<?endforeach?>*/-->
<?php
  $field = $form->field($model, 'hotels', []);
?>
<?=$field->checkboxList(
    $hotel,
    [
        'item' => function ($index, $label, $name, $checked, $value) use ($model) {
            return Html::checkbox($name, $checked, [
                'value' => $value,
                'id' => 'hotel-checkbox-'.$value,
                'class' => 'checkbox searchtours-hotel',
                //'checked' => ((ArrayHelper::isIn($value, ArrayHelper::getColumn($model->categories0, 'id'))) ? true :false),
            ]).'<label for="hotel-checkbox-'.$value.'" class="checkbox-label"><span class="wra">'.$label.'</span></label>';
        }
    ], []
    )->label(false);
?>
</div>