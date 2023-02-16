<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use \yii\helpers\StringHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Krujki */

$path = '/uploads/tmp/';
$big_img = str_replace('thumb_', '', $value);
?>

    <div class="img-wrapper img-wrapper-<?=$value?> coraltravelhotel  my-4" data-id="<?=$value?>">
        <img src="<?=$path.$value?>" alt="" />
        <div class="overlay">
            <div>
                <button type="button" class="btn check-btn" title="Сделать основным">
                    <i class="fa fa-check" aria-hidden="true"></i>
                </button>
            </div>
            <div>
                <button type="button" class="btn delete-btn" title="Удалить">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        <span hidden>
            <input type="hidden" name="CoraltravelHotel[HotelImages][]" value="<?=$big_img?>" />
        </span>
    </div>