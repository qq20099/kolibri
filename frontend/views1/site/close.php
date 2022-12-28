<div class="closes">

</div>
<?php
$this->registerCss("
  header,
  .banner,
  footer {display:none}
  .closes {
    width: 100%;
    height: 100vh;
    /* height: 100%; */
    position: absolute;
    top: 0;
    left: 0;
    background: url(/images/close.jpg) center no-repeat;
    padding: 0;
    margin: 0;
    background-size: cover;
    }

");?>