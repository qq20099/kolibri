<!--/*<style type="text/css">*/-->
<?foreach($price as $key => $value):?>
<?$this->registerCss("
.calendar-min-price.calendar-min-price-".$key.":after {
    content: \"".$value."\";
}
");?>
<?endforeach?>
<!--</style>-->