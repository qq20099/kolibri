<?php
use dosamigos\multiselect\MultiSelect;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\Html;
use common\helpers\DataHelper;

?>
<pre>
    <?print_r($region)?>
</pre>
<?foreach($region as $value):?>
<pre>
    <?print_r($value)?>
</pre>
<?endforeach?>