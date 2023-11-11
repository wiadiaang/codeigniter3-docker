<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Peserta extends CI_Model
{

    public function listLokal($id_lokal,$id_lomba) // untuk ditampilkan di lokal
    {
      $this->db->select('tb_peserta_lomba.id_peserta,tb_staff.nama_staff,tb_staff.callsign,tb_peserta_lomba.id_ikut_lomba,tb_peserta_lomba.id_lomba,tb_layanan.judul_layanan,tb_user.role_id');
      $this->db->from('tb_peserta_lomba');
      $this->db->join('tb_staff', 'tb_staff.id_staff = tb_peserta_lomba.id_peserta', 'left');
      $this->db->join('tb_lokal', 'tb_lokal.id_lokal = tb_peserta_lomba.id_lokal', 'left');
      $this->db->join('tb_user', 'tb_user.id_user = tb_peserta_lomba.id_user_daftar', 'left');
      $this->db->join('tb_layanan', 'tb_layanan.id_layanan = tb_peserta_lomba.id_lomba', 'left');
      $this->db->where('tb_peserta_lomba.id_lokal', $id_lokal);
      $this->db->where('id_lomba', $id_lomba);
      $this->db->order_by('id_lomba', 'desc');
      return $this->db->get()->result();
    }

    public function listPeserta($id_lomba) // untuk ditampilkan di admin
    {
      $this->db->select('*');
      $this->db->from('tb_peserta_lomba');
      $this->db->join('tb_staff', 'tb_staff.id_staff = tb_peserta_lomba.id_peserta', 'left');
      $this->db->join('tb_lokal', 'tb_lokal.id_lokal = tb_peserta_lomba.id_lokal', 'left');
      $this->db->join('tb_user', 'tb_user.id_user = tb_peserta_lomba.id_user_daftar', 'left');
      $this->db->join('tb_layanan', 'tb_layanan.id_layanan = tb_peserta_lomba.id_lomba', 'left');
      $this->db->where('id_lomba', $id_lomba);
      $this->db->order_by('id_lomba', 'desc');
      return $this->db->get()->result();
    }



   
}