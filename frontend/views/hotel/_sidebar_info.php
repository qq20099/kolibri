<table class="catCard__data1">
    <tbody>
        <tr>
            <td>
                <span class="data-name">IZLIDOŠANA:</span>
            </td>
            <td>
                <span class="data-val">
                    <?=Yii::$app->formatter->asDate($related[0]->FlightDate, 'php:d M Y');?>
                </span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="data-name">NAKŠU SKAITS:</span>
            </td>
            <td>
                <span class="data-val"><?=$related[0]->HotelNight?></span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="data-name">PERSONU SKAITS:</span>
            </td>
            <td>
                <span class="data-val"><?=$related[0]->acc->Name?></span>
            </td>
        </tr>
    </tbody>
</table>