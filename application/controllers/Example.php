<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Example extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->library('ilenpay');
    }

	public function index(){
		$ilen = new Ilenpay();

		// Pesanan Baru
		$tes1 = $ilen->transaksi_baru(array(
				'type'      	=> 'direct',
				'return_url'	=> 'https://domain.com/riwayat/8833',
				'operator'  	=> 'telkomsel',
				'nominal'   	=> '40000',
				'reff_id'   	=> 'wqgt9e4'
			)
		);

		// konfirmasi pembayaran (direct type)
		$tes2 = $ilen->direct_konfirmasi(array(
				'reff_id'      	=> 'wqgt94',
				'sender'		=> '081298956177'
			)
		);

		// Cek harga
		$tes2 = $ilen->cek_harga(array(
                'operator'  => 'telkomsel',
                'nominal'   => '20000'
            )
		);

		print_r($tes1);
		// print_r($tes2);
		// print_r($tes3);
	}
}
