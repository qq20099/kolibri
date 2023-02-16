<?php
namespace frontend\widgets\mainmenu;

use yii\base\Widget;
use frontend\models\Pages;
use yii\helpers\ArrayHelper;
use common\helpers\DataHelper;
use yii\helpers\Url;
use Yii;

class MainMenuWidget extends Widget {

    public $index;

    public function run()
    {
        $courses = [];
        $model = Pages::find()
        ->select('title, menu_title, url')
        ->where(['menu' => 1])
        ->orderBy(['sort' => SORT_ASC])
        ->all();

    $menuItems = [
//['label' => 'Meklēt', 'url' => ['/site/index']],
//['label' => 'Lidojumi', 'url' => ['/tours/']],
/*['label' => 'Valstīm', 'url' => ['/site/index']],
['label' => 'Ēģipte', 'url' => ['/site/index']],
['label' => 'Grieķija', 'url' => ['/site/index']],
['label' => 'Turcija', 'url' => ['/site/index']],
['label' => 'Maldīvu salas', 'url' => ['/site/index']],
['label' => 'Tanzānija', 'url' => ['/site/index']],
['label' => 'UAE', 'url' => ['/site/index']],
['label' => 'Ceļo droši', 'url' => ['/site/index']],
['label' => 'Informācija', 'url' => ['/site/index']],*/
//['label' => 'Par mums', 'url' => ['site/page']],
//['label' => 'AĢENTIEM', 'url' => ['/site/index']],
    ];

        if ($model) {
            foreach ($model as $value) {
                $url = ($value['main'] || $value['url'] == 'index') ? '/' : Url::to(['/'.$value['url']]);
                $menuItems[] = [
                    'label' => ($value['menu_title']) ? $value['menu_title'] : $value['title'],
                    'url' => $url
                ];
            }
        }
        $html = $this->render('index', compact('menuItems'));
        return $html;
    }

}