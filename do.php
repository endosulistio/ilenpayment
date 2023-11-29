<?php

$api_key    = 'fb59f88534bd4c2dfdfad8e22f7a7301c24581e4bd10';
$api_user   = 'i7FxjAu0tDLU';
$type       = 'direct'; // Type: direct / redirect
$return_url = 'https://domain.com/riwayat/8833';
$operator   = 'telkomsel';
$nominal    = '15000';
$reff_id    = 'trx681643dd43fdgsfdg';
$sign       = md5($operator.'+'.$nominal.'+'.$reff_id.'+'.$api_user);

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_FRESH_CONNECT  => true,
    CURLOPT_URL            => 'https://api.ilenpay.co.id/v1/transaksi/baru',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER         => false,
    CURLOPT_CUSTOMREQUEST  => 'POST',
    CURLOPT_POSTFIELDS     => http_build_query(array(
        'type'      => $type,
        'return_url'=> $return_url,
        'operator'  => $operator,
        'nominal'   => $nominal,
        'reff_id'   => $reff_id,
        'sign'      => $sign
    )),

    CURLOPT_HTTPHEADER     => array(
        'Content-Type: application/x-www-form-urlencoded',
        'Authorization: ' . $api_key
    ),
    CURLOPT_FAILONERROR    => false,
    CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
]);

$response = curl_exec($curl);
$error = curl_error($curl);
curl_close($curl);
print_r(empty($error) ? $response : $error);