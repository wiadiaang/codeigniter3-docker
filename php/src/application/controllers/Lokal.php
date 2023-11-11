<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Lokal extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    // validasi form
    $this->load->library('form_validation');
    //load model
    $this->load->model('M_kategori');
    $this->load->model('Setting');
    $this->load->model('Lokalmodel');
    //load helper
    $this->load->helper('client');
  }

  public function index()
  {
    // LOAD FUNCTION DARI MODEL
    $setting = $this->Setting->daftar();
    $title = $setting->nama_perusahaan;
    $image = $setting->image;
    $lokal  = $this->Lokalmodel->daftar();

    // MENGAMBIL DATA SESSION
    $user = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

    $data = array(
      'title'     => $title,
      'subtitle'  => 'Daftar Lokal',
      'isi'       => 'back_end/lokal/v_daftar',
      'user'      =>  $user,
      'lokal'    => $lokal,
      'image'     => $image,
    );

    $this->load->view('back_end/layout/v_wrapper', $data, false);
  }

  public function tambahlokal()
  {
    addclient_validation();
    if ($this->form_validation->run() ==  false) {
      // LOAD FUNCTION DARI MODEL
      $setting = $this->Setting->daftar();
      $title = $setting->nama_perusahaan;
      $image = $setting->image;
      $kategori  = $this->M_kategori->daftarKategoriclient();

      // MENGAMBIL DATA SESSION
      $user = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

      $data = array(
        'title'     => $title,
        'subtitle'  => 'Tambah Lokal',
        'isi'       => 'back_end/lokal/v_tambah',
        'user'      =>  $user,
        'kategori'  =>  $kategori,
        'image'     => $image,

      );

      $this->load->view('back_end/layout/v_wrapper', $data, false);
    } else {
      $this->Lokalmodel->tambah();
    }
  }

  public function edit($id_client)
  {
    // LOAD FUNCTION DARI MODEL
    $setting = $this->Setting->daftar();
    $title = $setting->nama_perusahaan;
    $image = $setting->image;
    $kategori   = $this->M_kategori->daftarKategoriclient();
    $client   = $this->Lokalmodel->detail($id_client);

    // MENGAMBIL DATA SESSION
    $user = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();


    // Validasi
    editclient_validation();

    if ($this->form_validation->run()) {

        // JIKA GAMBAR TIDAK DIGANTI
        $data = array(
          'id_lokal'     => $id_client,
          
          'nama_lokal'   => $this->input->post('name'),
        
          'alamat'        => $this->input->post('alamat'),
        
          'callsign'       => $this->input->post('callsign'),
    
        );
        // var_dump($data);
        // die;
        $this->Lokalmodel->edit($data);
        $this->session->set_flashdata('success', 'Berhasil mengedit data');
        redirect('lokal');

    }
    // End masuk database

    $data = array(
      'title'     => $title,
      'subtitle'  => 'Edit Lokal',
      'kategori'  => $kategori,
      'client'    => $client,
      'isi'       => 'back_end/lokal/v_edit',
      'user'      => $user,
      'image'     =>  $image,
    );
    $this->load->view('back_end/layout/v_wrapper', $data, FALSE);
  }

  public function hapus($id_lokal)
  {
    // $client = $this->Lokalmodel->detail($id_client);
    // MENGHAPUS FOTO
    // if ($client->gambar_client != "") {
    //   unlink('./assets/img/client/' . $client->gambar_client);
    // }
    $data = array(
      'id_lokal' => $id_lokal,
    );
    $this->Lokalmodel->hapus($data);
  }
}
