<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Par mums';
/*$this->params['breadcrumbs'][] = $this->title;*/
?>
<div class="site-page">
    <div class="body-content">
        <h1><?=$this->title?></h1>
        <?=$model->content?>
    </div>
</div>
<?$this->registerJs("
var date_from = '".$model->date_from."';
", \yii\web\View::POS_HEAD);?>