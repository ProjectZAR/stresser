

<?php
function ip2geolocation($ip)
{
    # api url
    $apiurl = 'http://freegeoip.net/json/' . $ip;
 
    # api with curl
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiurl);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    $data = curl_exec($ch);
    curl_close($ch);
 
    # return data
    return json_decode($data);
}


$geolocation = ip2geolocation('8.8.8.8');

echo $geolocation->latitude;
echo "<br>";
echo $geolocation->longitude;

?>
