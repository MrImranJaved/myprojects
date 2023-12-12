<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://website-contacts-scraper.p.rapidapi.com/scrape-contacts?query=wsgr.com",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: website-contacts-scraper.p.rapidapi.com",
		"X-RapidAPI-Key: 1dfb8c2d02mshc8a0869fe3a689dp1f6cb1jsn56b9db88a531"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo '<pre>';
	echo $response;
	echo '</pre>';
}