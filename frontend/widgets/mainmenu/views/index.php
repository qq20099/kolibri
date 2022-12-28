<?php
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
?>

    <?php
    NavBar::begin([
        'brandLabel' => false,// Html::img('https://joinup.lv/_nuxt/img/joinup.ed36062.svg'), //Yii::$app->name,
        //'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-light bg-light fixed-top1',
        ],
    ]);

    if (Yii::$app->user->isGuest) {
        //$menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        //$menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        /*$menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';*/
    }
?>
<?php
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-0'],
        'items' => $menuItems,
    ]);
    NavBar::end();
?>