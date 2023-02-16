<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use \yii\helpers\StringHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Krujki */

$script = "
    $(document).on('change', '#upload-img', function(e){
      //$(this).closest('form').submit();
        let formData = new FormData();
        let img = $(this).closest('.img-form-wrapper').find('img');
   		formData.append('UploadFileForm[file]', $('#upload-img')[0].files[0]);

        $.ajax({
            type: 'post',
            url:'". Url::to(['upload-img'])."',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status == 'success') {
                    img.attr('src', response.file);
                    $('#upload-img').parent().hide();
                    $('#delete-img').show();
                    $('#config-val').val(response.filename);
                } else {
                    alert(response.msg);
                }

            }
        })
        e.preventDefault();

        return false;
    });

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

$path = '/uploads/';

/*if ($model->id) {
    $path = '/uploads/'.$model_name.'/';
    if ($model_name != 'gallery')
      $path .= $model->id.'/';
} else {
    $path = '/uploads/tmp/';
}*/
?>
<br>
<div class="img-form-wrapper text-center">
    <div class="img-wrapper logo mb-2">
        <img src="<?=((!$model->val) ? '/admin/images/_no-image-6.jpg': $path.$model->val)?>" alt="" />
    </div>
    <label <?if(!$model->img):?><?else:?>style="display:none"<?endif?> class="btn btn-success">
        <input id="upload-img" type="file" name="myFiles" hidden />
        Загрузить
    </label>
    <br>
    <button type="button" class="btn btn-warning" id="delete-img" <?if(!$model->img):?>style="display:none"<?endif?>>Удалить</button>
    <div hidden>
        <?= $form->field($model, 'val')->hiddenInput(['class' => 'image-value'])->label(false) ?>
        <?= $form->field($model, 'delimg')->hiddenInput(['class' => 'del-image-value'])->label(false) ?>
    </div>
</div>