<table class="catCard__data1">
<tbody>
<tr>
    <td>
        <span class="data-name">IZLIDOŠANA:</span>
    </td>
    <td>
        <span class="data-val"><?=Yii::$app->formatter->asDate($model->HotelCheckInDate, 'php:d M Y');?></span>
    </td>
</tr>

<tr>
    <td>
        <span class="data-name">NAKŠU SKAITS:</span>
    </td>
    <td>
        <span class="data-val"><?=$model->HotelNight?></span>
    </td>
</tr>

<tr>
    <td>
        <span class="data-name">PERSONU SKAITS:</span>
    </td>
    <td>
        <span class="data-val"><?=$model->acc->Name?></span>
    </td>
</tr>

<tr>
    <td>
        <span class="data-name">ĒDINĀŠANAS TIPS:</span>
    </td>
    <td>
        <span class="data-val"><?=$model->meal->Name?></span>
    </td>
</tr>

</tbody>
</table>

<div class="catCard__data1" hidden>
                <div class="tour-card__meta-item">
                    IZLIDOŠANA:
                    <span class="capitalize"><?=Yii::$app->formatter->asDate($model->HotelCheckInDate, 'php:d M Y');?></span>
                </div>
                <div class="tour-card__meta-item">
                    NAKŠU SKAITS:
                    <span><?=$model->HotelNight?></span>
                </div>
                <div class="tour-card__meta-item">
                    PERSONU SKAITS:
                <span><?=$model->acc->Name?></span>
            </div>
            <div class="tour-card__meta-item">
                ĒDINĀŠANAS TIPS:
                <span><?=$model->meal->Name?></span>
            </div>
</div>