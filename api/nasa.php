<?php
include_once "./php_config/constatns.php";

function apiCallCuriosityRoverImage($data)
{

    $serviceUrl = NASA_API_URL . '/mars-photos/api/v1/rovers/curiosity/photos?earth_date='.$data['earth_date'].'&api_key='.NASA_API_KEY;
    $method = 'GET';
    $response = callWebService($serviceUrl, null, $method);
    return $response;
}


function callWebService($serviceUrl, $finalInput = null, $method = 'GET')
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $serviceUrl);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $finalInput);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_HTTPHEADER, []);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
    $result = curl_exec($ch);
    curl_close($ch);

    return parseResponse($result);
}


function parseResponse($response)
{

    $result = array();
    $resultArray = explode("\r\n\r\n", $response);
    $body = $resultArray[count($resultArray) - 1];
    $header = $resultArray[count($resultArray) - 2];

    foreach (explode("\r\n", $header) as $i => $line) {
        if ($i === 0) {
            $result['Http_code'] = $line;
            $httpStatusCode = explode(' ', $result['Http_code'], 3);
            $result['Http_status'] = $httpStatusCode[1];
        } else {
            list ($key, $value) = explode(': ', $line);
            $result[$key] = $value;
        }
    }

    $result['response'] = $body;
    return $result;

}
?>



