<table class="catCard__data1">
<tbody>
<tr>
    <td>
        <span class="data-name">IZLIDOŠANA:</span>
    </td>
    <td>
        <span class="data-val"><?=Yii::$app->formatter->asDate($related[0]->FlightDate, 'php:d M Y');?></span>
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

<!--<tr>
    <td>
        <span class="data-name">ĒDINĀŠANAS TIPS:</span>
    </td>
    <td>
        <span class="data-val"><?//=$related[0]->meal->Name?></span>
    </td>
</tr>-->

</tbody>
</table>

<div class="catCard__data1" hidden>
                <div class="tour-card__meta-item">
                    IZLIDOŠANA:
                    <span class="capitalize"><?=Yii::$app->formatter->asDate($related[0]->FlightDate, 'php:d M Y');?></span>
                </div>
                <div class="tour-card__meta-item">
                    NAKŠU SKAITS:
                    <span><?=$related[0]->HotelNight?></span>
                </div>
                <div class="tour-card__meta-item">
                    PERSONU SKAITS:
                <span><?=$related[0]->acc->Name?></span>
            </div>
            <div class="tour-card__meta-item">
                ĒDINĀŠANAS TIPS:
                <span><?=$related[0]->meal->Name?></span>
            </div>
</div>