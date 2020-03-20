<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_page extends CI_Model {

public function ambildata($tabel)
{
    return $this->db->get($tabel);
}

public function tambahdata($data,$tabel)
{
    $this->db->insert($tabel,$data);
}

public function ambilid($tabel,$id)
{
    return $this->db->get_where($tabel,$id);
}

public function ubahdata($where,$data,$tabel)
{
     $this->db->where($where);
     $this->db->update($tabel,$data);

}

public function hapusdata($where,$tabel)
{
    $this->db->where($where);
    $this->db->delete($tabel);
}
}

