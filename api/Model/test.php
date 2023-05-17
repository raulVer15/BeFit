<?php
$url = "http://nleyvarodrig.cs3680.com/api/index.php/workout/list";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
    "Accept: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$resp = curl_exec($curl);
curl_close($curl);
var_dump($resp);

?>

