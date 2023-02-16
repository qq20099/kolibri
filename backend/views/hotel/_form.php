<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;

/** @var yii\web\View $this */
/** @var backend\models\Pages $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pages-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
//        'enableAjaxValidation' => true,
        'validateOnChange' => false,
        'validateOnBlur' => false,
    ]); ?>
    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'Name')->textInput(['maxlength' => true]) ?>
            <?php
            echo $form->field($model, 'description')->widget(Widget::className(), [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
                'replaceDivs' => false,
                'paragraphize' => false,
                'uploadOnlyImage' => true,
                'imageUpload' => Url::to(['/pages/image-upload/']),
                'imageDelete' => Url::to(['/pages/file-delete']),
                'plugins' => [
                    'clips',
                    'fullscreen',
                    'imagemanager' => 'vova07\imperavi\bundles\ImageManagerAsset',
                ],
                'clips' => [
                    ['Lorem ipsum...', 'Lorem...'],
                    ['red', '<span class="label-red">red</span>'],
                    ['green', '<span class="label-green">green</span>'],
                    ['blue', '<span class="label-blue">blue</span>'],
                ],
            ],
            ]);
            ?>
            <?= $form->field($model, 'maplink')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <div class="mainimg--wrapper">
                <div class="mainimg-wrapper text-center<?=((isset($model->mainImg) && $model->mainImg->title) ? 'selected' : '')?>">
                    <img src="<?=((isset($model->mainImg) && $model->mainImg->title) ? $model->path_img_t.$model->mainImg->title : '/admin/images/no-image-available-icon-6.png')?>" id="main-image" alt="" data-default="/admin/images/no-image-available-icon-6.png"/>
        <div class="overlay">
            <div>
                <button type="button" class="btn uncheck-btn" title="Убрать из основнх">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
            <!--<div>
                <button type="button" class="btn delete-btn" title="Удалить">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </div>-->
        </div>
                </div>
            </div>
        </div>
        <div class="hide">
            <?= $form->field($model, 'm_img')->hiddenInput(['value' => ((isset($model->mainImg) && $model->mainImg->title) ? $model->mainImg->title : '')]) ?>
        </div>
    </div>
    <?//if(!$model->main && $model->url != 'tours'):?>
    <div class="row">
        <div class="col-md-8">

        </div>
    </div>
    <?//endif?>
    <div class="row">
        <div class="col-md-12">

        </div>
    </div>
    <div class="gallery-btn opacity0">
        <label for="add-images" class="add-images-label" >
            <input id="add-images" accept="image/jpeg,image/png" multiple type="file" hidden />
            Добавить изображения
        </label>&nbsp;
        <span class="gallery-count-wrapper">Всего в галерее:
        <span class="gallery-count"><?=(($model->images) ? count($model->images) : 0)?></span>
        </span>
        <!--<a href="javascript:;" id="show-gallery"><span class="show-notactive">Показать галерею</span><span class="show-active">Скрыть галерею</span></a>-->
    </div>
    <div class="gallery opacity0">
        <?foreach($model->images as $value):?>
        <?=$this->render('_img', compact('form', 'model', 'value'))?>
        <?endforeach?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?//= $form->field($model, 'meta_title')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?//= $form->field($model, 'meta_keywords')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?//= $form->field($model, 'meta_description')->textArea() ?>
        </div>
    </div>
    <?= $form->field($model, 'delimg')
     ->hiddenInput(['class' => 'del-image-value', 'label' => null])
     ->label(false)
    ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>