<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Banners $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="banners-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-12">
            <?=$this->render('_img', compact('form', 'model'))?>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'subtitle')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <?= $form->field($model, 'btn_text')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
            <?php
                $params = [
                    'prompt' => [
                        'text' => 'Выберите из списка...',
                        'options' => [
                            'value' => 0,
                        ]
                    ]
                ];
                $field = $form->field($model, 'page_id', []);
                $field->template = "{label}\n{input}\n{error}\n";
                echo $field->dropDownList(
                      \yii\helpers\ArrayHelper::map(
                        \common\helpers\DataHelper::getPages(), 'id', 'title'
                      ), $params);
            ?>
        </div>
    </div>

    <div class="form-group text-right">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
