<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\helpers\Url;
use frontend\widgets\orderform\OrderFormWidget;
use frontend\widgets\mainmenu\MainMenuWidget;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100 index-page page">
<?php $this->beginBody() ?>
<div class="app">
<div class="app__inner">
<header>
    <div class="container">
    <div class="header__menu-controls">
    <div class="row">
        <div class="col-md-2">
            <?=Html::a(Html::img('/uploads/'.Yii::$app->config->logo, ['class' => 'logo']), Url::to(['/']))?>
        </div>
        <div class="col-md-8 align-self-flex-end">
            <div class="header__menu-controls-contacts">
                <ul class="header-contacts">
                    <li class="header-contacts__item">
                        <a href="tel:<?=preg_replace('/[a-zA-Z \(\)]/', '', Yii::$app->config->phone)?>" class="header-contacts__link">
                        <!--<a href="tel:<?//=str_replace([' ', '-', '.'], [''], Yii::$app->config->phone)?>" class="header-contacts__link"> -->
                            <div class="header-contacts__item-img"><svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 19 19" aria-labelledby="phone" fill="rgb(46, 58, 89)" role="presentation" class="icon icon-phone"><title id="phone" lang="en">phone icon</title> <path  d="m13.2982159 10.2932501-1.5939989 1.5939998c-.7390001-.22-2.11800061-.7199998-2.99200062-1.5939998-.87400002-.87400003-1.37399987-2.25300057-1.59399987-2.9920006l1.59399987-1.59399986c.391-.391.391-1.02299955 0-1.41399956l-4-4.00000008c-.39100001-.39100001-1.02299956-.39100001-1.41399956 0l-2.71200007 2.71200022c-.38.37999999-.59400021.90199971-.58600021 1.4349997.023 1.42400002.40000028 6.37000008 4.29800028 10.26800008s8.84400008 4.2740004 10.26900008 4.2980004h.0279999c.5279999 0 1.0270006-.2080005 1.4050006-.5860005l2.7119999-2.7119999c.391-.391.391-1.0229995 0-1.4139995l-4-4.0010004c-.391-.39100002-1.0230014-.39100002-1.4140014 0zm-7.58599952 3c-3.36599994-3.36599995-3.6919999-7.65100004-3.7119999-8.87400009l2.00500012-2.00499987 2.58600044 2.58599972-1.29300022 1.29300022c-.23899999.23800001-.34100031.58199969-.27200031.91199971.024.115.61099994 2.84199991 2.27099991 4.50199981 1.65999996 1.66 4.38699988 2.2469999 4.50199988 2.2709999.333.0710001.6740006-.0319999.9120006-.2709999l1.2939997-1.2930002 2.5860004 2.5860005-2.0060005 2.0049991c-1.248-.021-5.5180001-.355999-8.87300012-3.7119989z" fill-rule="evenodd"></path></svg></div> <span>&nbsp; <?=Yii::$app->config->phone?> </span></a></li> <li class="header-contacts__item"><a href="mailto:<?=Yii::$app->config->email?>" target="_blank" class="header-contacts__link"><div class="header-contacts__item-img"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 20 16" aria-labelledby="email" fill="#2E3A59" role="presentation" class="icon icon-email"><title id="email" lang="en">email icon</title> <path d="m0 2c0-1.10456943.89543057-2 2-2h16c1.1045704 0 2 .89543057 2 2v12c0 1.1045694-.8954296 2-2 2h-16c-1.10456896 0-2-.8954306-2-2v-12c0-.73637962 0-.73637962 0 0zm18 1.86850476v10.13149524h-16v-10.13149261l8 5.33333206zm-.8027954-1.86850476h-14.39441444l7.19720984 4.79813814z" fill-rule="evenodd"></path></svg></div>&nbsp;<span> <?=Yii::$app->config->email?></span></a></li></ul></div>
        </div>
        <div class="col-md-2">&nbsp;</div>
    </div>
    </div>
    </div>
    <?=MainMenuWidget::widget()?>
</header>

<main role="main" class="main flex-shrink-0">
    <?if(isset($this->blocks['banner'])):?>
    <?=$this->blocks['banner']?>
    <?else:?>
    <section class="banner"></section>
    <?endif?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; <?= Html::encode('Kolibri Travel') ?> <?= date('Y') ?></p>
        <p class="float-right"></p>
    </div>
</footer>
</div>
</div>
<div class="search-btn-form-mobile">
<button type="submit" class="search-form__search-btn btn-1">
        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 25 25" aria-labelledby="search" fill="#ffffff" role="presentation" class="icon icon-search" data-v-631c8bed=""><title id="search" lang="en" data-v-631c8bed="">search icon</title> <path clip-rule="evenodd" d="m15.9139 14.5294c2.4134-3.3864 2.101-8.11815-.9371-11.15631-3.3864-3.3863301-8.8767-3.3863298-12.26304 0-3.386332 3.38634-3.386332 8.87671 0 12.26301 3.03816 3.0381 7.76994 3.3505 11.15634.9371l8.2601 8.2601 2.0438-2.0438-8.2601-8.2601c1.6089-2.2576 1.6089-2.2576 0 0zm-2.981-9.11247c2.2576 2.25755 2.2576 5.91777 0 8.17537-2.2575 2.2575-5.91775 2.2575-8.1753 0-2.25756-2.2576-2.25756-5.91782 0-8.17537 2.25755-2.25756 5.9178-2.25756 8.1753 0 1.5051 1.50503 1.5051 1.50503 0 0z" fill-rule="evenodd"></path></svg>
        <!--<span class="search-form__search-btn-text">
            Meklēt
        </span>-->
    </button>
</div>
<?
$js = <<<SCRIPT
/* To initialize BS3 tooltips set this below */
$(function () {
    $("[data-toggle='tooltip']").tooltip({
        html: true,
       //placement: 'auto',
    });
});;
/* To initialize BS3 popovers set this below */
$(function () {
    $("[data-toggle='popover']").popover();
});
SCRIPT;
// Register tooltip/popover initialization javascript
$this->registerJs($js);
?>
<?php $this->endBody() ?>
<?=OrderFormWidget::widget()?>
</body>
</html>
<?php $this->endPage();
