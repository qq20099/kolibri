<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
?>

<div class="news-item<?if($model->isRead()):?> is-read<?endif?>">
    <div class="row">
        <div class="col-md-9 col-lg-10">
            <div class="row">
                <div class="col-md-3">
                    <div class="news-img-wrapper">
                        <a href="<?=Url::to(['news/view', 'url' => $model->newsTranslition->url]) ?>">
                            <img src="/uploads/news/<?=$model->id?>/<?=$model->img?>" class="news-img" alt="<?= Html::encode($model->newsTranslition->title) ?>" />
                        </a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="news-title">
                        <a href="<?=Url::to(['news/view', 'url' => $model->newsTranslition->url]) ?>">
                            <?= Html::encode($model->newsTranslition->title) ?>
                        </a>
                    </div>
                    <div class="news-anons">
                        <?= Html::encode($model->newsTranslition->anons) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-lg-2">
            <div class="news-date">
                <?=Yii::$app->formatter->asDate($model->published_at, 'php:d M Y');?>
            </div>
        </div>
    </div>
    <?//= HtmlPurifier::process($model->newsTranslition->content) ?>
</div>