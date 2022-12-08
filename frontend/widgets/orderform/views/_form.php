<?php
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\Html;
use common\helpers\DataHelper;
?>

<?php
yii\bootstrap4\Modal::begin([
    'headerOptions' => [
        'id' => 'modalHeader',
    ],
    'id' => 'modal-order',
    'size' => 'modal-md',
    'title' => Yii::t('app', 'Order form'),
    'closeButton' => [
        'id'=>'close-button',
        'class'=>'close',
        'data-dismiss' =>'modal',
    ],
    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or X to close
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => true]
]);
?>
      <?php $form = ActiveForm::begin([
        'action' => Url::to(['add-order']),
        'enableClientValidation' => true,
//        'enableAjaxValidation' => true,
        'validateOnChange' => false,
        'validateOnBlur' => false,
//        'validationUrl' => Url::to(['/request-loans-validate-form']),
        'options' => [
          //'class' => 'modal-content',
        ]
      ]);
   ?>
       <?=$form->field($model, 'name')->textInput()?>
       <?//=$form->field($model, 'phone')->textInput()?>
       <?/*=$form->field($model, 'phone')->label(false)->widget(\yii\widgets\MaskedInput::className(), [
  'mask' => '+38 (099) 999-99-99',
])->textInput(['placeholder' => $model->getAttributeLabel('phone')]);*/?>



     <span id="course-id" hidden></span>
        <div class="row">
            <div class="col-md-8">
                <div class="form-result">
                    <span class="error" style="display:none;"><?=Yii::t('app', 'Error')?></span>
                    <span class="success" style="display:none;"><?=Yii::t('app', 'Danke')?></span>
                </div>
            </div>
            <div class="col-md-4 text-md-right">
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-info']) ?>
                </div>
           </div>
       </div>

  <?php ActiveForm::end()?>
<?php
yii\bootstrap4\Modal::end();
?>