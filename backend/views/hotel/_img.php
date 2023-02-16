<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use \yii\helpers\StringHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Krujki */

$script = "


  /*  $('form').submit(function(e){
        var formData = new FormData($(this)[0]);
        $.ajax({
            type: 'post',
            url:'". Url::to(['upload-img'])."',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {

            }
        })
        e.preventDefault();

        return false;
    });     */
";
$this->registerJs($script);

$model_name = strtolower(StringHelper::basename(get_class($model)));

if ($model->ID) {
    $path = $model->path_img_t;//str_replace('{ID}', $model->ID, $model->path_img);
} else {
    $path = '/uploads/tmp/';
}
?>

    <div class="img-wrapper img-wrapper-<?=$value->id?> <?=$model_name?> my-4<?if($value->main):?> main--img <?endif?>" data-id="<?=$value->id?>">
        <img src="<?=((!$value->title) ? '../images/no-img.jpg': $path.$value->title)?>" alt="" />
        <div class="overlay">
            <div>
                <button type="button" class="btn check-btn"<?if(!$value->main):?> title="Сделать основным"<?endif?><?if($value->main):?> disabled <?endif?>>
                    <i class="fa fa-check" aria-hidden="true"></i>
                </button>
            </div>
            <div>
                <button type="button" class="btn delete-btn" title="Удалить">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>