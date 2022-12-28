<?php

namespace console\controllers;

use Yii;

use frontend\models\CoraltravelHotelCategory;
use frontend\models\CoraltravelHotel;

use Dejurin\GoogleTranslateForFree;

use yii\helpers\ArrayHelper;

class ParserController extends \yii\console\Controller
{
    private $source = 'en';
    private $target = 'lv';
    private $attempts = 5;
    private $operator = 'coraltravel';

    public function actionGetTours1()
    {
        $client = new Client();
        // отправляем запрос к странице Яндекса
        $res = $client->request('GET', 'http://www.yandex.ru');
        // получаем данные между открывающим и закрывающим тегами body
        $body = $res->getBody();
        // вывод страницы Яндекса в представление
        return $this->render('coraltravel', ['body' => $body]);
    }

}
