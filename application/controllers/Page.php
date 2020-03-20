<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->model('model_page','m');
    }

	public function index()
	{
        $data= array(
            'title' => 'CRUD CI AJAX'
        );
		$this->load->view('home',$data);
    }
    
    public function ambildata()
    {
        $dataBarang = $this->m->ambildata('barang')->result();
        echo json_encode($dataBarang);
    }

    public function tambahData()
    {
        $kodeBarang = $this->input->post('kode_barang');
        $namaBarang = $this->input->post('nama_barang');
        $harga = $this->input->post('harga');
        $stok = $this->input->post('stok');

        if($kodeBarang ==''){
            $result['pesan'] = 'Kode Barang Harus Diisi';
        }elseif ($namaBarang=='') {
            $result['pesan'] = 'Nama Barang Harus Diisi';
        }elseif ($harga=='') {
            $result['pesan'] = 'Harga Barang Harus Diisi';
        }elseif ($stok=='') {
            $result['pesan'] = 'Stok Barang Harus Diisi';
        }else {
           $result['pesan'] = '';

           $data=array(
            //    Nama field berdasarkan di database
               'kode_barang' =>$kodeBarang,
               'nama_barang' =>$namaBarang,
               'harga' =>$harga,
               'stok' =>$stok
           );
           $this->m->tambahdata($data,'barang');

        }
        echo json_encode($result);
    }

    public function ambilid()
    {
        $id = $this->input->post('id');
        $where['id'] = $id;
        $detailbarang=$this->m->ambilid('barang',$where)->result();
        echo json_encode($detailbarang);

    }

    public function ubahdata()
    {
        $id = $this->input->post('id');
        $kodeBarang = $this->input->post('kode_barang');
        $namaBarang = $this->input->post('nama_barang');
        $harga = $this->input->post('harga');
        $stok = $this->input->post('stok');

        if($kodeBarang ==''){
            $result['pesan'] = 'Kode Barang Harus Diisi';
        }elseif ($namaBarang=='') {
            $result['pesan'] = 'Nama Barang Harus Diisi';
        }elseif ($harga=='') {
            $result['pesan'] = 'Harga Barang Harus Diisi';
        }elseif ($stok=='') {
            $result['pesan'] = 'Stok Barang Harus Diisi';
        }else {
           $result['pesan'] = '';
            $where['id'] = $id;
           $data=array(
            //    Nama field berdasarkan di database
              
               'kode_barang' =>$kodeBarang,
               'nama_barang' =>$namaBarang,
               'harga' =>$harga,
               'stok' =>$stok
           );
           $this->m->ubahdata($where,$data,'barang');

        }
        echo json_encode($result);

    }

    public function hapusdata()
    {
        $id = $this->input->post('id');
        $where['id'] = $id;
        $this->m->hapusdata($where,'barang');
    }
}
