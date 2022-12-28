<?php
$l = ['Free toiletries',
'Safety deposit box',
'Toilet',
'Bath or shower',
'Towels',
'Linen',
'Tile/marble floor',
'TV',
'Refrigerator',
'Telephone',
'Ironing facilities',
'Satellite channels',
'Tea/Coffee maker',
'Iron',
'Interconnected room(s) available',
'Microwave',
'Heating',
'Hairdryer',
'Kitchenware',
'Kitchenette',
'DVD player',
'Wake up service/Alarm clock',
'Electric kettle',
'Outdoor furniture',
'Outdoor dining area',
'Cable channels',
'Wake-up service',
'Alarm clock',
'Wardrobe or closet',
'Stovetop',
'Clothes rack',
'Drying rack for clothing',
'Toilet paper',
'Air purifiers'
];
$li = [];
$li = ($model->attributes0) ? array_chunk($model->attributes0, ceil(count($model->attributes0)/3)) : [];
?>
<div class="row">
    <?foreach($li as $data):?>
    <div class="col-md-4">
        <ul class="hprt-facilities-others">
            <?foreach($data as $value):?>
            <li>
                <span class="hprt-facilities-facility" data-name-en="Free Toiletries">
                    <span class=" other_facility_badge--default_color">
                        <svg class="bk-icon -streamline-checkmark" fill="#008009" height="14" width="14" viewBox="0 0 128 128" role="presentation" aria-hidden="true" focusable="false">
                            <path d="M56.33 100a4 4 0 0 1-2.82-1.16L20.68 66.12a4 4 0 1 1 5.64-5.65l29.57 29.46 45.42-60.33a4 4 0 1 1 6.38 4.8l-48.17 64a4 4 0 0 1-2.91 1.6z"></path>
                        </svg>
                    </span>
                    <span class="hprt-facilities-others-title"><?=$value->title?></span>
                </span>
            </li>
            <?endforeach?>
        </ul>
    </div>
    <?endforeach?>
</div>