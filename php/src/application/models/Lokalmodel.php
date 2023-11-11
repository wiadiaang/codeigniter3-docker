<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Lokalmodel extends CI_Model
{
  public function daftar()
  {
    // MENGGAMBIL SEMUA DATA DARI TABLE TB_CLIENT
    $this->db->select('*');
    $this->db->from('tb_lokal');
    // MENGGABUNGKAN DATA DARI TABLE TB_KATEGORI_CLIENT & TB_CLIENT
    // $this->db->join('tb_kategori_client', 'tb_kategori_client.id_kategori = tb_client.jenis_client', 'left');
    $this->db->order_by('id_lokal', 'DESC');
    return $this->db->get()->result();
  }

  public function detail($id_client)
  {
    // MENGGAMBIL DATA BERDASARKAN ID_CLIENT
    $this->db->select('*');
    $this->db->from('tb_lokal');
    // MENGGABUNGKAN DATA DARI TABLE TB_KATEGORI_CLIENT & TB_CLIENT
    // $this->db->join('tb_kategori_client', 'tb_kategori_client.id_kategori = tb_client.jenis_client', 'left');
    $this->db->where('id_lokal', $id_client);
    return $this->db->get()->row();
  }

  public function tambah()
  {
    $nama = $this->input->post('name', true);
    $callsign = $this->input->post('callsign');
    $alamat = $this->input->post('alamat', true);

    $data = [
    
      'nama_lokal'   => htmlspecialchars($nama),
      'callsign'  => htmlspecialchars($callsign),
      'alamat'       => $alamat,
  
    ];

    // QUERRY INSERT DATA
    $this->db->insert('tb_lokal', $data);
    $this->session->set_flashdata('success', 'Berhasil Membuat Lokal');
    redirect('lokal');
  }

  public function edit($data)
  {
    // QUERY UPDATE
    $this->db->where('id_lokal', $data['id_lokal']);
    $this->db->update('tb_lokal', $data);
  }

  public function hapus($data)
  {
    // QUERY HAPUS
    $this->db->where('id_lokal', $data['id_lokal']);
    $this->db->delete('tb_lokal', $data); // FLASH DATA
    $this->session->set_flashdata('success', 'Berhasil menghapus data');
    redirect('lokal');
  }
}
