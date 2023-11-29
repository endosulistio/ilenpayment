<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->library('ilenpay');
		$this->load->library('digiflazz');
        $this->secret = 'ilenpay127781'; //Ganti dengan Webhook secret anda
    }

    public function callback(){
        sleep(2);
        $post_data  = file_get_contents('php://input');
        $signature  = hash_hmac('sha1', $post_data, $this->secret);
        if($_SERVER['HTTP_X_ILEN_SIGNATURE'] == 'key=' . $signature){
            file_put_contents("log-ilenpay.txt", $post_data);
        }
    }

    public function direct_payment($id = 0){
        if($id == 0) show_404();

        $this->form_validation->set_rules('sender', 'Sender', 'trim|required|numeric|min_length[1]|max_length[20]');
        if($this->form_validation->run() == FALSE) {
            $this->load->view('direct_payment');
        }else{
            $ilen = new Ilenpay();
            $ilenpay = $ilen->direct_konfirmasi(array(
                    'reff_id'      	=> $id,
                    'sender'		=> $this->input->post('sender')
                )
            );
            $this->session->set_flashdata('error_message', $ilenpay->data->pesan);
            redirect(site_url('pesanan/direct_payment/'.$id));
        }
    }

    public function payment($type = 0){
        if($type == 0) show_404();
        $this->form_validation->set_rules('nominal', 'Produk', 'trim|required|min_length[1]|max_length[20]');
        $this->form_validation->set_rules('nominal', 'Nominal', 'trim|required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('payment', 'Payment', 'trim|required|min_length[1]|max_length[255]');

        if($this->form_validation->run() == TRUE) {
            $type = ($type == 'direct' ? 'direct' : 'redirect');
            $ilen = new Ilenpay();
            $ilenpay = $ilen->transaksi_baru(array(
                    'type'      	=> $type,
                    'return_url'	=> 'https://ilenpay.co.id/rqg',
                    'operator'  	=> $this->input->post('payment'),
                    'nominal'   	=> $this->input->post('nominal'),
                    'reff_id'   	=> $this->input->post('ref_id')
                )
            );
            if($ilenpay->data->respon == 'sukses'){
                $order_sess = array(
                    'operator' => $this->input->post('payment'),
                    'nominal'   => $this->input->post('nominal'),
                    'tutor' => $ilenpay->data->tutor
                );
                $this->session->set_userdata('order_sess', $order_sess);
            }

            if($type == 'redirect'){
                echo ($ilenpay->data->respon == 'sukses' ? redirect($ilenpay->data->url_pay) : print_r($ilenpay));
            }else{
                echo ($ilenpay->data->respon == 'sukses' ? redirect(base_url('pesanan/direct_payment/'.$ilenpay->data->reff_id)) : print_r($ilenpay));
            }

        }else{
            $this->session->set_flashdata('error_message', validation_errors());
            redirect(site_url());
        }
    }
    public function vieworder(){
        $data = array();
        $this->form_validation->set_rules('produk', 'Produk', 'trim|required|min_length[1]|max_length[20]');
        $this->form_validation->set_rules('userid', 'User ID', 'trim|required|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('payment', 'Payment', 'trim|required|min_length[1]|max_length[255]');
        if($this->form_validation->run() == TRUE) {
            $produk = array('LM86' => '24500','ML112' => '31100','ML85' => '25000');
            $ilen = new Ilenpay();
            $total_tf = $ilen->cek_harga(array(
                    'operator'  => $this->input->post('payment'),
                    'nominal'   => $produk[$this->input->post('produk')]
                )
            );
            if(empty($total_tf->data->total_tf)) exit('Tidak dapat terhubung ke ilenpay. pastinkan api_key dan api_user benar.');
            $data['refid'] = 'il'.random_string('alnum', 16);
            $data['hargadm'] = $produk[$this->input->post('produk')];
            $data['ilenpay'] = $total_tf->data;
            $this->load->view('vieworder', $data);
        }else{
            $this->session->set_flashdata('error_message', validation_errors());
            redirect(site_url());
        }
    }

    public function cek_update($id){
        $data = file_get_contents('log-ilenpay.txt');
        $data = json_decode($data);
        if(isset($data->data->ref_id) && $data->data->ref_id == $id){
            echo'<div class="alert alert-success" role="alert">Ref_id : '.$data->data->ref_id.'<br>Status : '.$data->data->status.'<br></div>';
        }else{
            echo'';
        }
    }

    public function index(){
        $this->load->view('pesanan');
    }

}