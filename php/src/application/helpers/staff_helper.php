<?php

function addStaff_validation()
{
  $ci = get_instance();
  $ci->form_validation->set_rules('name', 'Name', 'required|trim', [
    'required' =>  'Nama belum diisi !',
  ]);
  $ci->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tb_staff.email_staff]|trim', [
    'required' =>  'email belum diisi !',
    'valid_email'  =>  'format email tidak valid !',
    'is_unique'  =>  'email ini sudah terdaftar !'
  ]);
  $ci->form_validation->set_rules('no', 'Nomor', 'required', [
    'required' =>  'No belum diisi !',
  ]);
  $ci->form_validation->set_rules('alamat', 'alamat', 'required', [
    'required' =>  'Alamat belum diisi !',
  ]);
}
function editStaff_validation()
{
  $ci = get_instance();
  $ci->form_validation->set_rules('name', 'Name', 'required|trim', [
    'required' =>  'Nama belum diisi !',
  ]);
  $ci->form_validation->set_rules('email', 'Email', 'required|valid_email', [
    'required' =>  'email belum diisi !',
    'valid_email'  =>  'format email tidak valid !',
  ]);
  $ci->form_validation->set_rules('no', 'Nomor', 'required', [
    'required' =>  'No belum diisi !',
  ]);
  $ci->form_validation->set_rules('alamat', 'alamat', 'required', [
    'required' =>  'Alamat belum diisi !',
  ]);
}
