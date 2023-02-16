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

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <?if(!$model->main && $model->url != 'tours'):?>
    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <?endif?>
    <div class="row">
        <div class="col-md-12">
            <?php
            echo $form->field($model, 'content')->widget(Widget::className(), [
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
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'meta_title')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'meta_keywords')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'meta_description')->textArea() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'activity')->checkbox() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'menu')->checkbox() ?>
        </div>
        <div class="col-md-1">
            <label class="in-menu"<?if(!$model->menu):?> style="display:none"<?endif?>>Порядок</label>
        </div>
        <div class="col-md-1">
            <?= $form->field($model, 'sort')
              ->textInput([
                  'type' => 'number',
                  'label' => null,
                  'class' => 'in-menu',
                  'style' => ((!$model->menu) ? 'display:none' : ''),
              ])
              ->label(false) ?>
        </div>
        <div class="col-md-1">
            <label class="in-menu"<?if(!$model->menu):?> style="display:none"<?endif?>>Название</label>
        </div>
        <div class="col-md-5">
            <?= $form->field($model, 'menu_title')
              ->textInput([
                  'label' => null,
                  'class' => 'in-menu',
                  'style' => ((!$model->menu) ? 'display:none' : ''),
              ])
              ->label(false) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
