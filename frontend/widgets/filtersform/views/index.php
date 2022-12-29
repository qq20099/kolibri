<?php
//$this->registerJs("var date_from = '".date('Y-m-d', $model->date_from)."';", \yii\web\View::POS_HEAD);
?>
<?=$this->render('_form', compact('model'))?>
<!--<pre>
    <?//print_r($model)?>
</pre>-->