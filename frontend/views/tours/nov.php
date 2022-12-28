<?php

$add="http://turisty.loc/hotel/nov/?step="; // link to iFrame



foreach ($xml as $x) {
$title = $x->title;
$stars = $x->stars;
$country = $x->country;
$destination = $x->destination;
$resort = $x->resort;
$date = $x->date;
$board = $x->board;
$price = $x->price;
$oldprice = $x->oldprice;
$currency = $x->currency;
$discount = $x->discount;
$image = $x->image;
$url = $x->url;
$cut = substr($url, 38, 1000); // link to offer
?>
<table border="1" cellspacing="0" cellpadding="5" width="200px">
<tr>
<td colspan="2" style="background-color:#ffffff;color:#333;">
<a href="<?php echo $add.$cut ?>">
<img src="<?php echo $image; ?>" />
</td>
</tr> <tr>
<td colspan="2" style="background-color:#ffffff;color:#333;">
<?php echo $title . ", " . $stars; ?>
</td>
</tr><tr>
<td style="background-color:#ffffff;color:#333;">
<?php echo $country.", ".$destination.", ".$resort."</br>"; ?>
</td>
<td style="background-color:#ffffff;color:#333;">
<?php echo "Old price ".$oldprice." ".$currency; ?>
</td>
</tr><tr>
<td style="background-color:#ffffff;color:#333;">
<?php echo "Date ".$date; ?>
</td>
<td style="background-color:#ffffff;color:#333;">
<?php echo "Discount ".$discount; ?>
</td>
</tr><tr>
<td style="background-color:#ffffff;color:#333;">
<?php echo "Board: ".$board; ?>
</td>
<td style="background-color:#ffffff;color:#333;">
<?php echo "Price ".$price." ".$currency; ?>
</td>
</tr>
</table>
<?php
}
?>
