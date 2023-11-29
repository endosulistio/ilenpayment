<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Digiflazz {

    // private $api_key = "";
    // private $api_user = "";

	// public function transaksi($data) {
    //     $data['username']   = $this->api_user;
    //     $data['sign']       = md5($this->api_user.$this->api_key.$data['ref_id']);
	// 	return $this->Curl('https://api.digiflazz.com/v1/transaction', $data);
	// }

	// public function daftar_harga($data) {
    //     $data['username']   = $this->api_user;
    //     $data['sign']       = md5($this->api_user.$this->api_key.'pricelist');
	// 	return $this->Curl('https://api.digiflazz.com/v1/price-list', $data);
	// }

	// private function Curl($end_point, $post) {
	// 	$data = json_encode($post);
	// 	$ch = curl_init();
	// 	curl_setopt($ch, CURLOPT_URL, $end_point);
	// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	// 	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	// 	curl_setopt($ch, CURLOPT_TIMEOUT, 2);
	// 	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',));
	// 	curl_setopt($ch, CURLOPT_POST, 1);
	// 	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	// 	$result = curl_exec($ch);
	// 	return $result;
	// }

}
