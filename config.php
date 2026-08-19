<?php
define('API_URL', 'https://khmer-smm.com/api/v2');
define('API_KEY', '38d2a283544fd9b91ac3bf81fd649f49');

function khmer_smm_api($params) {
    $params['key'] = API_KEY;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, API_URL);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}
