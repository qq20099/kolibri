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
        'action' => Url::to(['site/add-order']),
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
       <?=$form->field($client, 'name')->textInput()?>
       <?=$form->field($model, 'email')->textInput()?>
       <?=$form->field($client, 'phone')->textInput(['placeholder' => $client->getAttributeLabel('phone')])->label(false)?>
       <?/*=$form->field($client, 'phone')->label(false)->widget(\yii\widgets\MaskedInput::className(), [
  'mask' => '+38 (099) 999-99-99',
])->textInput(['placeholder' => $client->getAttributeLabel('phone')]);*/?>
       <?=$form->field($model, 'tour_id')->hiddenInput(['label' => null])->label(false);?>
       <?=$form->field($model, 'comment')->textArea();?>
       <?=$form->field($model, 'politic')->checkbox(['value' => 1])->label('Piekrītu privātuma politikai un personas datu apstrādes principiem');?>
       <?=$form->field($model, 'link')->hiddenInput(['value' => Url::current(), 'label' => null])->label(false);?>

       <div class="row">
           <div class="col-md-9">
               <div class="form-result">
                    <span class="error" style="display:none;"><?=Yii::t('app', 'Error')?></span>
                    <span class="success" style="display:none;"><?=Yii::t('app', 'Danke')?></span>
               </div>
           </div>
           <div class="col-md-3 text-md-right">
               <?= Html::submitButton('Pasūtīt', ['class' => 'btn btn-info']) ?>
           </div>
       </div>
  <?php ActiveForm::end()?>
<?php
yii\bootstrap4\Modal::end();
?>