<?php
//  $postString='http://smslowprice.com/sendingsms.aspx?userid=vickysingla&pass=welcome@123&phone=9501516800&msg=ThanksforRegistrationyourOTPforeasyRentis ';
//  $ch = curl_init(); 
//  curl_setopt($ch, CURLOPT_URL, $postString); 
//  curl_exec($ch);
//  curl_close($ch);

$url = 'http://smslowprice.com/SendingSms.aspx';
$fields = array('userid'=>urlencode('vickysingla'),
'pass'=>urlencode('welcome@123'),
'phone'=>urlencode('9501516800'),
'msg'=>urlencode('Thanks for Registration your OTP for easyRent is'));
$fields_string='';
foreach($fields as $key=>$value)
{ $fields_string .=$key.'='.$value.'&';}
rtrim($fields_string,'&');
$url_final=$url.'?'.$fields_string;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url_final);
$result = curl_exec($ch);
curl_close($ch);

?>

