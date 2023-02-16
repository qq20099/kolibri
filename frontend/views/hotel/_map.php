<section id="contacts" class="contacts mt-4">
    <div class="google-map" id="google-map"></div>
</section>
<?php
$this->registerCssFile("https://unpkg.com/leaflet@1.5.1/dist/leaflet.css", [
    'integrity' => 'sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==',
    'crossorigin' => "",
]);
$this->registerJsFile("https://unpkg.com/leaflet@1.5.1/dist/leaflet.js", [
    'position' => $this::POS_END,
    'integrity' => "sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==",
    'crossorigin' => "",
]);

$z = 14;
$target = "L.marker(target).addTo(map);\n";

$this->registerJs("
    // Where you want to render the map.
    var element = document.getElementById('google-map');

    // Height has to be set. You can do this in CSS too.
    element.style = 'height:268px;';

    // Create Leaflet map on map element.
    var map = L.map(element);

    // Add OSM tile leayer to the Leaflet map.    370*416
    L.tileLayer('//{s}.tile.osm.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href=\"//osm.org/copyright\">OpenStreetMap</a> contributors'}).addTo(map);

    // Target GPS coordinates.
    var target = L.latLng('".$model->Latitude."', '".$model->Longitude."');

    // Set map center to target with zoom 14.
    map.setView(target, 14);
    ".$target."
    // Place a marker on the same location.
    //L.marker(target).addTo(map);
");
?>