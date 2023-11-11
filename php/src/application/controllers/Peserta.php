<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Peserta extends CI_Controller
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
    $this->load->model('M_staff');
    //load helper
    $this->load->helper('staff');
  }

  public function index()
  {
    $lokal = $this->session->userdata('local');
    $setting = $this->Setting->daftar();
    $title = $setting->nama_perusahaan;
    $image = $setting->image;
    $user = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

    $role = $this->session->userdata('role_id');
    if($role == 1)
    {
      $staff  = $this->M_staff->daftar();
    }else{
      $staff  = $this->M_staff->daftarStafflokal($lokal);

    }
   
    $data = array(
      'title'     => $title,
      'subtitle'  => 'Daftar Peserta',
      'isi'       => 'back_end/staff/v_daftar',
      'user'      =>  $user,
      'staff'     => $staff,
      'image'     => $image,
    );

    $this->load->view('back_end/layout/v_wrapper', $data, false);
  }

  public function tambahpeserta()
  {
    $peserta = $this->db->get_where('tb_staff', array('id_lokal'=>$this->session->userdata('local')))->num_rows(); 

    if($peserta == 10 ){
      $this->session->set_flashdata('success', 'Peserta sudah mencapai batas maksimal');
      redirect('peserta');
    }else{


    addStaff_validation();
    if ($this->form_validation->run() ==  false) {
      $setting = $this->Setting->daftar();
      $title = $setting->nama_perusahaan;
      $image = $setting->image;
      $user = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
      $kategori  = $this->M_kategori->daftarKategoriStaff();
      if ($this->session->userdata('role_id') == '2') {
        // JIKA YANG MASUK ADMIN

       
      

        $data = array(
          'title'     => $title,
          'subtitle'  => 'Tambah Peserta',
          'isi'       => 'back_end/staff/v_tambah_staff',
          'user'      =>  $user,
          'kategori'  => $kategori,
          'image'     => $image,

        );
        $this->load->view('back_end/layout/v_wrapper', $data, false);
      } else {
        // JIKA YANG MASUK USER
        redirect('blocked');
      }
    } else {
      $this->M_staff->tambah();
    }
  }
  }

  public function edit($id_staff)
  {
    $setting = $this->Setting->daftar();
    $title = $setting->nama_perusahaan;
    $image = $setting->image;
    $kategori   = $this->M_kategori->daftarKategoriStaff();
    $staff   = $this->M_staff->detail($id_staff);
    $user = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
    $local =$this->session->userdata('local');
    if ($this->session->userdata('role_id') == '2') {
      // JIKA YANG MASUK ADMIN
      // Validasi
      editStaff_validation();

      if ($this->form_validation->run()) {

        if (!empty($_FILES['image']['name'])) {

          $config['upload_path']   = './assets/img/staff/';
          $config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
          $config['max_size']      = '5000'; // KB  
          $this->load->library('upload', $config);
          $this->upload->initialize($config);
          if (!$this->upload->do_upload('image')) {
            // End validasi
            $data = array(
              'title'     => $title,
              'subtitle'  => 'Edit Peserta',
              'kategori'  => $kategori,
              'staff'     => $staff,
              'error'     => $this->upload->display_errors(),
              'isi'       => 'back_end/staff/v_edit',
              'user'      => $user,
              'image'     => $image,
            );
            $this->load->view('back_end/layout/v_wrapper', $data, FALSE);
            // Masuk database
          } else {
            $upload_data = array('uploads' => $this->upload->data());
            //Hapus gambar
            if ($staff->gambar_staff != "") {
              unlink('./assets/img/staff/' . $staff->gambar_staff);
            }
            // End hapus
          
            $data = array(
              'id_staff'      => $id_staff,
              'id_lokal'   => $local,
              'nama_staff'    => $this->input->post('name'),
              'email_staff'   => $this->input->post('email'),
              'alamat'        => $this->input->post('alamat'),
              'no_telepon'    => $this->input->post('no'),
              'gambar_staff'  => $upload_data['uploads']['file_name'],
              'ukuran_kaos'       => $this->input->post('ukurankaos'),
              'gender'        => $this->input->post('gender'),
              'last_modified' => date('Y-m-d'),
            );

            $this->M_staff->edit($data);
            $this->session->set_flashdata('success', 'Berhasil mengedit data');
            redirect('peserta');
          }
        } else {
          $data = array(
            'id_staff'      => $id_staff,
            'id_lokal'   => $local,
            'nama_staff'    => $this->input->post('name'),
            'email_staff'   => $this->input->post('email'),
            'alamat'        => $this->input->post('alamat'),
            'no_telepon'    => $this->input->post('no'),
            'ukuran_kaos'       => $this->input->post('ukurankaos'),
            'gender'        => $this->input->post('gender'),
            'last_modified' => date('Y-m-d'),
          );

          // var_dump($data);
          // die;
          $this->M_staff->edit($data);
          $this->session->set_flashdata('success', 'Berhasil mengedit data');
          redirect('peserta');
        }
      }
      // End masuk database

      $data = array(
        'title'     => $title,
        'subtitle'  => 'Edit Peserta',
        'kategori'  => $kategori,
        'staff'     => $staff,
        'isi'       => 'back_end/staff/v_edit',
        'user'      => $user,
        'image'     => $image,
      );
      $this->load->view('back_end/layout/v_wrapper', $data, FALSE);
    } else {
      // JIKA YANG MASUK USER
      redirect('blocked');
    }
  }

  public function detail($id_staff)
  {
    $setting = $this->Setting->daftar();
    $title = $setting->nama_perusahaan;
    $image = $setting->image;
    $kategori   = $this->M_kategori->daftarKategoriStaff();
    $staff   = $this->M_staff->detail($id_staff);
    $user = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

    if ($this->session->userdata('role_id') == '1') {
      // JIKA YANG MASUK ADMIN
      $data = array(
        'title'     => $title,
        'subtitle'  => 'Detail staff',
        'kategori'  => $kategori,
        'staff'     => $staff,
        'isi'       => 'back_end/staff/v_detail',
        'user'      => $user,
        'image'     => $image,
      );
      $this->load->view('back_end/layout/v_wrapper', $data, FALSE);
    } else {
      // JIKA YANG MASUK USER
      redirect('blocked');
    }
  }

  public function hapus($id_staff)
  {
    if ($this->session->userdata('role_id') == '2') {
      // JIKA YANG MASUK ADMIN
      $staff = $this->M_staff->detail($id_staff);
      // MENGHAPUS FOTO
      if ($staff->gambar_staff != "") {
        unlink('./assets/img/staff/' . $staff->gambar_staff);
      }
      $data = array(
        'id_staff' => $id_staff,
      );
      $this->M_staff->hapus($data);
    } else {
      // JIKA YANG MASUK USER
      redirect('blocked');
    }
  }
}
