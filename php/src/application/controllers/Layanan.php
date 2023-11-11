<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Layanan extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    // validasi form
    $this->load->library('form_validation');
    //load model
    $this->load->model('M_layanan');
    $this->load->model('Setting');
    $this->load->model('Peserta');
    $this->load->model('M_staff');
    //load helper
    $this->load->helper('layanan');

    
  }

  public function index()
  {
    $setting = $this->Setting->daftar();
    $title = $setting->nama_perusahaan;
    $image = $setting->image;
    $user = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
    $layanan  = $this->M_layanan->daftar();

    $data = array(
      'title'     => $title,
      'subtitle'  => 'Daftar Lomba',
      'isi'       => 'back_end/layanan/v_daftar',
      'user'      =>  $user,
      'image'     =>  $image,
      'layanan'   => $layanan
    );

    $this->load->view('back_end/layout/v_wrapper', $data, false);
  }

  public function tambah()
  { // RULES 
    tambah_validation();
    if ($this->form_validation->run() ==  false) {
      $setting = $this->Setting->daftar();
      $title = $setting->nama_perusahaan;
      $image = $setting->image;
      $user = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

      $data = array(
        'title'     => $title,
        'subtitle'  => 'Tambah Lomba',
        'isi'       => 'back_end/layanan/v_tambah',
        'user'      =>  $user,
        'image'     =>  $image,
      );

      $this->load->view('back_end/layout/v_wrapper', $data, false);
    } else {
      $this->M_layanan->tambah();
    }
  }

  public function edit($id_layanan)
  {

    $layanan   = $this->M_layanan->detail($id_layanan);
    $user = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

    $setting = $this->Setting->daftar();
    $title = $setting->nama_perusahaan;
    $image = $setting->image;

    // Validasi
    tambah_validation();

    if ($this->form_validation->run()) {

      if (!empty($_FILES['image']['name'])) {

        $config['upload_path']   = './assets/img/layanan/';
        $config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
        $config['max_size']      = '5000'; // KB  
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('image')) {
          // End validasi
          $data = array(
            'title'     => $title,
            'subtitle'  => 'Edit Lomba',
            'layanan'   => $layanan,
            'error'     => $this->upload->display_errors(),
            'isi'       => 'back_end/layanan/v_edit',
            'user'      => $user,
            'image'     =>  $image,
          );
          $this->load->view('back_end/layout/v_wrapper', $data, FALSE);
          // Masuk database
        } else {
          $upload_data            = array('uploads' => $this->upload->data());
          //Hapus gambar
          if ($layanan->gambar_layanan != "") {
            unlink('./assets/img/layanan/' . $layanan->gambar_layanan);
          }
          // End hapus

          $slug   = url_title($this->input->post('judul'), 'dash', TRUE);

          $data = array(
            'id_layanan'    => $id_layanan,
            'slug_layanan'  => $slug,
            'judul_layanan'  => $this->input->post('judul'),
            'isi_layanan'      => $this->input->post('isi'),
            'status_layanan'  => $this->input->post('status'),
            'gambar_layanan'    => $upload_data['uploads']['file_name'],
            'last_modified' => date('Y-m-d'),
          );
          $this->M_layanan->edit($data);
          $this->session->set_flashdata('success', 'Berhasil mengedit data');
          redirect('layanan');
        }
      } else {
        $slug   = url_title($this->input->post('judul'), 'dash', TRUE);

        $data = array(
          'id_layanan'    => $id_layanan,
          'slug_layanan'  => $slug,
          'judul_layanan'  => $this->input->post('judul'),
          'isi_layanan'      => $this->input->post('isi'),
          'status_layanan'  => $this->input->post('status'),
          'last_modified' => date('Y-m-d'),
        );
        $this->M_layanan->edit($data);
        $this->session->set_flashdata('success', 'Berhasil mengedit data');
        redirect('layanan');
      }
    }
    // End masuk database
    $data = array(
      'title'     => $title,
      'subtitle'  => 'Edit Layanan ',
      'layanan'   => $layanan,
      'isi'       => 'back_end/layanan/v_edit',
      'user'      => $user,
      'image'     =>  $image,
    );
    $this->load->view('back_end/layout/v_wrapper', $data, FALSE);
  }

  public function hapus($id_layanan)
  {
    $layanan = $this->M_layanan->detail($id_layanan);
    // MENGHAPUS FOTO
    if ($layanan->gambar_layanan != "") {
      unlink('./assets/img/layanan/' . $layanan->gambar_layanan);
    }
    $data = array(
      'id_layanan' => $id_layanan,
    );
    $this->M_layanan->hapus($data);
  }

  // Detail layanan

  public function detail($id_layanan)
  {
    $setting = $this->Setting->daftar();
    $title = $setting->nama_perusahaan;
    $image = $setting->image;
   
    $lokal = $this->session->userdata('local');
    $user = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

   

    $lomba = $this->db->get_where('tb_layanan', ['id_layanan' => $id_layanan])->row('judul_layanan');
    $layanan = $this->Peserta->listLokal($lokal,$id_layanan);
    $peserta_lokal = $this->M_staff->daftarStafflokal($lokal);  // get peserta dari user lomba 
      // var_dump($peserta_lokal);die();

    if ($this->session->userdata('role_id') == '2') {
      // JIKA YANG MASUK ADMIN
      $data = array(
        'title'     => $title, 
        'subtitle'  => 'View Lomba' . ' ' . $lomba,
     
        'layanan'  => $layanan,
        'id_layanan'  => $id_layanan,
        'isi'       => 'back_end/layanan/v_detail',
        'user'     => $user,
        'image'     => $image,
        'peserta_lokal' => $peserta_lokal,

      );
      $this->load->view('back_end/layout/v_wrapper', $data, FALSE);
    } else {
      // JIKA YANG MASUK USER
      redirect('blocked');
    }
  }

  public function addPeserta()
  {
    // CEK YANG ROLE YANG MASUK
    if ($this->session->userdata('role_id') == '2') {
      // JIKA YANG MASUK ADMIN
      $peserta = $this->input->post('peserta', true);
      $id_lomba = trim($this->input->post('id_layanan', true));
      $lokal = $this->session->userdata('local');
      $user_daftar = $this->session->userdata('id_user');

    
     
        $data = [
          'id_peserta' => $peserta,
          'id_lokal' => $lokal,
          'id_user_daftar' => $user_daftar,
          'id_lomba' => $id_lomba,
          'date_created' => time()
        ];
        // var_dump($data);die();
        $this->db->insert('tb_peserta_lomba', $data);
        $this->session->set_flashdata('success', 'Berhasil Tambah Peserta');
        redirect('layanan/detail/'. $id_lomba);

        // $setting = $this->Setting->daftar();
        // $title = $setting->nama_perusahaan;
        // $image = $setting->image;
       
        // $lokal = $this->session->userdata('local');
        // $user = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
    
       
    
        // $lomba = $this->db->get_where('tb_layanan', ['id_layanan' => $id_lomba])->row('judul_layanan');
        // $layanan = $this->Peserta->listLokal($lokal,$id_lomba);
        // $peserta_lokal = $this->M_staff->daftarStafflokal($lokal);  // get peserta dari user lomba 
        //   // var_dump($peserta_lokal);die();
    
       
        //   // JIKA YANG MASUK ADMIN
        //   $data = array(
        //     'title'     => $title, 
        //     'subtitle'  => 'View Lomba' . ' ' . $lomba,
         
        //     'layanan'  => $layanan,
        //     'id_layanan'  => $id_lomba,
        //     'isi'       => 'back_end/layanan/v_detail',
        //     'user'     => $user,
        //     'image'     => $image,
        //     'peserta_lokal' => $peserta_lokal,
    
        //   );
        //   $this->load->view('back_end/layout/v_wrapper', $data, FALSE);

    } else {
      // JIKA YANG MASUK USER
      redirect('blocked');
    }
  }

  public function hapus_peserta($id_ikut_lomba,$id_lomba)
  {
    if ($this->session->userdata('role_id') == '2') {
      // JIKA YANG MASUK ADMIN
    
      $data = array(
        'id_ikut_lomba' => $id_ikut_lomba,
      );
   
      $this->db->delete('tb_peserta_lomba', $data); // FLASH DATA
    
      $this->session->set_flashdata('success', 'Berhasil Hapus');
      redirect('layanan/detail/'. $id_lomba);
    } else {
      // JIKA YANG MASUK USER
      redirect('blocked');
    }
  }

}
