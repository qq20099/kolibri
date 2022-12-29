<?php
use dosamigos\multiselect\MultiSelect;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use common\helpers\DataHelper;
$arr = [];
?>

<?foreach($rating as $value):

$st = '<span class="wra">';
?>
<div>
    <?for($i=0; $i<$value; $i++):?>
    <? $st .= '
<svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 22 20" aria-labelledby="star" fill="#F5A623" role="presentation" class="icon icon-star"><title id="star" lang="en">star icon</title> <path data-v-1d127dca="" d="m10.473.33 2.544 6.313 6.513.587c.451.041.635.632.292.943l-4.94 4.488 1.48 6.677c.103.464-.376.83-.764.583L10 16.38l-5.598 3.54c-.389.245-.867-.12-.764-.583l1.48-6.677L.178 8.172c-.343-.311-.16-.902.292-.943l6.513-.587L9.527.33a.504.504 0 0 1 .946 0z"></path></svg>';?>
    <?endfor?>
</div>
<?php
  $arr[$value] = $st.'</span>';

  endforeach;

  $rating = array_combine($rating, $rating);
  $field = $form->field($model, 'rating', []);
?>
<?=$field->checkboxList(
    $rating,
    [
        'item' => function ($index, $label, $name, $checked, $value) use ($model, $arr) {
            return Html::checkbox($name, $checked, [
                'value' => $value,
                'id' => 'rating-checkbox-'.$value,
                'class' => 'checkbox searchtours-rating',
                //'checked' => ((ArrayHelper::isIn($value, ArrayHelper::getColumn($model->categories0, 'id'))) ? true :false),
            ]).'<label for="rating-checkbox-'.$value.'" class="checkbox-label">'.$arr[$value].'</label>';
        }
    ], []
    )->label(false);
?>
