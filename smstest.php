<?php
function SendSms()
{
 
$service_url = 'http://priority.thesmsworld.com/api/mt/SendSMS?user=PCAREP&password=123456&senderid=PCAREP&channel=Trans&DCS=0&flashsms=0&number=9876677009&text=hii_this_is_Api_test&route=2';
 
$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additioanl info: ' . var_export($info));
}
curl_close($curl);
$decoded = json_decode($curl_response);
if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    die('error occured: ' . $decoded->response->errormessage);
}
echo 'response ok!';
//var_export($decoded->response);
 // echo $decoded;
  echo $curl_response;  
}
 SendSms();
?>

