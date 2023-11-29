<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ilenpay {

    private $api_key    = "";
    private $api_user   = "";
    private $api_url    = 'https://api.ilenpay.co.id/v1';

    public function transaksi_baru($data = array()){
        $data['sign'] = md5($data['operator'].'+'.$data['nominal'].'+'.$data['reff_id'].'+'.$this->api_user);
        return $this->Curl('/transaksi/baru', $data, 'POST');
    }

    public function direct_konfirmasi($data){
        return $this->Curl('/konfirmasi/pembayaran', $data, 'POST');
    }

    public function cek_harga($data){
        return $this->Curl('/info/harga', $data);
    }

    public function cek_server($data){
        return $this->Curl('/info/server', $data);
    }

    private function Curl($url = 0, $data = array(), $method = 'GET'){

        $curl = curl_init();
        $gawe_url = $method == 'POST' ? $this->api_url.$url : $this->api_url.$url.'?'.http_build_query($data);
        $curl_ = [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => $gawe_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_CUSTOMREQUEST  => $method,
            CURLOPT_HTTPHEADER     => ['Authorization: '.$this->api_key],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4,
        ];
        if($method == 'POST') { $curl_['10015'] = http_build_query($data); }
        curl_setopt_array($curl, $curl_);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
        return json_decode($response);
    }

}
