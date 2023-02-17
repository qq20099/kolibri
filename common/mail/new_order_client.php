<?php
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
?>
<html>
    <head>
        <title>Новый заказ</title>
    </head>
    <body>
        <table style="width: 100%;max-width: 800px;">
            <tr>
                <td><?=$data->name?></td>
            </tr>
            <tr>
                <td><?=$data->phone?></td>
            </tr>
            <tr>
                <td><?=$data->email?></td>
            </tr>
            <tr>
                <td><?=$order->comment?></td>
            </tr>
        </table>
        <br>
        <h4>Jūsu pieprasījums:</h4>
        <table style="width: 100%;max-width: 900px;">
            <tr>
                <td><?=$order->tour->getAttributeLabel('FlightDate')?>:</td>
                <td><?=date('d.m.Y', $order->tour->FlightDate)?></td>
            </tr>
            <tr>
                <td><?=$order->tour->getAttributeLabel('HotelCheckInDate')?>:</td>
                <td><?=date('d.m.Y', $order->tour->HotelCheckInDate)?></td>
            </tr>

            <tr>
                <td><?=$order->tour->getAttributeLabel('hotel.place.area.region.country.Name')?>:</td>
                <td><?=$order->tour->hotel->place->area->region->country->Name?></td>
            </tr>
            <tr>
                <td><?=$order->tour->getAttributeLabel('hotel.place.area.Name')?>:</td>
                <td><?=$order->tour->hotel->place->area->Name?></td>
            </tr>
            <tr>
                <td><?=$order->tour->getAttributeLabel('hotel.place.area.region.Name')?>:</td>
                <td><?=$order->tour->hotel->place->area->region->Name?></td>
            </tr>
            <tr>
                <td><?=$order->tour->getAttributeLabel('hotel.place.Name')?>:</td>
                <td><?=$order->tour->hotel->place->Name?></td>
            </tr>

            <tr>
                <td><?=$order->tour->getAttributeLabel('hotel.Name')?>:</td>
                <td><?=$order->tour->hotel->Name?></td>
            </tr>
            <tr>
                <td><?=$order->tour->getAttributeLabel('hotel.category.Name')?>:</td>
                <td><?=$order->tour->hotel->category->Name?></td>
            </tr>
            <tr>
                <td><?=$order->tour->getAttributeLabel('seatClass.Name')?>:</td>
                <td><?=$order->tour->seatClass->Name?></td>
            </tr>
            <tr>
                <td><?=$order->tour->getAttributeLabel('room.Name')?>:</td>
                <td><?=$order->tour->room->Name?></td>
            </tr>
            <tr>
                <td><?=$order->tour->getAttributeLabel('meal.Name')?>:</td>
                <td><?=$order->tour->meal->Name?></td>
            </tr>
            <tr>
                <td><?=$order->tour->getAttributeLabel('PackagePrice')?>:</td>
                <td><?=$order->tour->PackagePrice?>&nbsp;€</td>
            </tr>
            <tr>
                <td><?=$order->tour->getAttributeLabel('Adult')?>:</td>
                <td><?=$order->tour->Adult?></td>
            </tr>
            <?if($order->tour->Child):?>
            <tr>
                <td><?=$order->tour->getAttributeLabel('Child')?>:</td>
                <td><?=$order->tour->Child?></td>
            </tr>
            <tr>
                <td><?=$order->tour->getAttributeLabel('ChildAges')?>:</td>
                <td><?=$order->ages?></td>
            </tr>
            <?endif?>
        </table>
        <br>
    </body>
</html>