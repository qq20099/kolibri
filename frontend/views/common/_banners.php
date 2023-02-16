<?php
use yii\helpers\Html;
use evgeniyrru\yii2slick\Slick;
?>

<?if($page->banners && count($page->banners) > 1):?>
<section class="banners" style="opacity:0;height:0">
  <?php
    $items = [];
    foreach($page->banners as $value) {
        //$items[] = Html::img('/uploads/banners/'.$page->id.'/'.$value->img);
        //$value->link = '';
        //$items[] = Html::img('/uploads/banners/'.$page->id.'/'.$value->img);
        $t = '';
        $st = '<div class="b-w">';
        $st .= '<div class="b-w-w">';
        $img = Html::img('/uploads/banners/'.$page->id.'/'.$value->img);
        if (isset($value->link) && $value->link && !isset($value->btn_text)) {
            $st .= Html::a($img, $value->link);
        } else {
            $st .= $img;
        }
        $st .= '<div class="b-w-w-t">';
        if (isset($value->title) && $value->title) {
            $st .= '<div class="sl-attr slide-title">'.$value->title.'</div>';
        }
        if (isset($value->subtitle) && $value->subtitle) {
            $st .= '<div class="sl-attr slide-subtitle">'.$value->subtitle.'</div>';
        }
        if (isset($value->btn_text) && $value->btn_text) {
            $st .= '<div class="sl-attr slide-btn-wrapper">';
            $t = '';
            $t .= '<span class="sl-attr-btn btn slide-btn">';
            $t .= $value->btn_text;
            $t .= '</span>';

            if (isset($value->link) && $value->link)
              $st .= Html::a($t, $value->link);
            else
              $st .= $t;

            $st .= '</div>';
        }
        $st .= '</div>';
        $st .= '</div>';
        $st .= '</div>';

        $items[] = $st;
    }
  ?>
<?=Slick::widget([
        'itemContainer' => 'div',
        'containerOptions' => ['class' => 'container1'],
        // Position for inclusion js-code
        // see more here: http://www.yiiframework.com/doc-2.0/yii-web-view.html#registerJs()-detail
        //'jsPosition' => yii\web\View::POS_READY,
        // Items for carousel. Empty array not allowed, exception will be throw, if empty
        'items' => $items,

        // HTML attribute for every carousel item
        'itemOptions' => ['class' => 'cat-image'],
        // settings for js plugin
        // @see http://kenwheeler.github.io/slick/#settings
        'clientOptions' => [
            'autoplay' => true,
            'dots'     => true,
            'infinite' => true,
            'speed' => 500,
            'slidesToShow' => 1,
            'centerMode' => true,
            'centerPadding' => '270px',
            'responsive' => [
                [
                    'breakpoint' => 768,
                    'settings' => [
                        'infinite' => true,
                        'slidesToShow' => 1,
                        'slidesToScroll' => 1,
                        'centerMode' => false,
                        'dots'     => false,
                        //'centerPadding' => '100px',
                    ]
                ],
                [
                    'breakpoint' => 961,
                    'settings' => [
                        'infinite' => true,
                        'slidesToShow' => 1,
                        'slidesToScroll' => 1,
                        'centerMode' => true,
                        'centerPadding' => '100px',
                    ]
                ],
            ]
            //'fade' => true,
            //'variableWidth' => true,
            // note, that for params passing function you should use JsExpression object
            // but pay atention, In slick 1.4, callback methods have been deprecated and replaced with events.
            //'onAfterChange' => new JsExpression('function() {console.log("The cat has shown")}'),
        ],
    ]); ?>

</section>
<?elseif($page->banners && count($page->banners) == 1):?>
    <?foreach($page->banners as $value):?>
<section class="banner" style="background-image: url('/uploads/banners/<?=$page->id?>/<?=$value->img?>');"></section>
    <?endforeach?>
<?endif?>