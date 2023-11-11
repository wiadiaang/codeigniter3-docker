<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_staff extends CI_Model
{
  public function daftar()
  {
    $this->db->select('tb_staff.id_staff,tb_staff.nama_staff,tb_staff.email_staff,tb_staff.ukuran_kaos,tb_staff.callsign,tb_staff.alamat,tb_staff.no_telepon,tb_staff.gender,tb_lokal.callsign as calllokal');
    $this->db->from('tb_staff');
    $this->db->join('tb_lokal', 'tb_lokal.id_lokal = tb_staff.id_lokal', 'left');
    $this->db->order_by('id_staff', 'DESC');
    return $this->db->get()->result();
  }

  public function daftarStafflokal($id_lokal)
  {
    // $this->db->select('*','tb_lokal.callsign as calllokal');
    $this->db->select('tb_staff.id_staff,tb_staff.nama_staff,tb_staff.email_staff,tb_staff.ukuran_kaos,tb_staff.callsign,tb_staff.alamat,tb_staff.no_telepon,tb_staff.gender,tb_lokal.callsign as calllokal');
    $this->db->from('tb_staff');
    $this->db->join('tb_lokal', 'tb_lokal.id_lokal = tb_staff.id_lokal', 'left');
    $this->db->order_by('id_staff', 'DESC');
    $this->db->where('tb_staff.id_lokal', $id_lokal);
    return $this->db->get()->result();
  }

  public function detail($id_staff)
  {
    $this->db->select('*','tb_lokal.callsign as calllokal');
    $this->db->from('tb_staff');
    $this->db->join('tb_lokal', 'tb_lokal.id_lokal = tb_staff.id_lokal', 'left');
    $this->db->where('id_staff', $id_staff);
    return $this->db->get()->row();
  }

  public function tambah()
  {

    $lokal = $this->session->userdata('local');
    $nama = $this->input->post('name', true);
    $email = $this->input->post('email', true);
    $alamat = $this->input->post('alamat', true);
    $callsign = $this->input->post('callsign');
    $no = $this->input->post('no', true);
    $ukurankaos = $this->input->post('ukurankaos', true);

    $gambarStaff  ='';
 
    // $status = $this->input->post('status', true);

    $gender = $this->input->post('gender', true);
    // CEK GAMBAR JIKA ADA GAMBAR AKAN DIUPLOAD 
    // id   // nama gambar
    $uploadImage = $_FILES['image']['name'];
    // var_dump($uploadImage);
    // die;
    if ($uploadImage) {
      // CEK FILE
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size'] = '5048';
      $config['upload_path'] = './assets/img/staff/';
      $this->upload->initialize($config);
      // UPLOAD FILE  
      if ($this->upload->do_upload('image')) {
        $gambarStaff = $this->upload->data('file_name');
      } else {
        $gambarStaff  ='';
      }
    }
    $data = [
      'id_lokal'  => $lokal,
      'nama_staff'   => htmlspecialchars($nama),
      'email_staff'  => htmlspecialchars($email),
      'alamat'       => $alamat,
      'no_telepon'   => $no,
      'gambar_staff' => $gambarStaff,
      'callsign'       => $callsign,
      'gender'       => $gender,
      'ukuran_kaos'  => $ukurankaos,
    ];

    $this->db->insert('tb_staff', $data);
    $this->session->set_flashdata('success', 'Berhasil Tambah Peserta');
    redirect('peserta');
  }

  public function edit($data)
  {
    $this->db->where('id_staff', $data['id_staff']);
    $this->db->update('tb_staff', $data);
  }

  public function hapus($data)
  {
    $this->db->where('id_staff', $data['id_staff']);
    $this->db->delete('tb_staff', $data); // FLASH DATA
    $this->session->set_flashdata('success', 'Berhasil menghapus data');
    redirect('peserta');
  }


  // FRONT END
  // Read data
  public function read($slug_berita)
  {

    $this->db->select('*');
    $this->db->from('tb_staff');
    $this->db->join('tb_user', 'tb_user.id_user = tb_staff.id_user', 'left');
    $this->db->join('tb_kategori_staff', 'tb_kategori_staff.id_kategori = tb_staff.id_kategori', 'left');
    $this->db->where('slug_berita', $slug_berita);
    return $this->db->get()->row();
  }
}
