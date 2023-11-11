<?php

function addClient_validation()
{
  $ci = get_instance();
  $ci->form_validation->set_rules('name', 'Name', 'required|trim', [
    'required' =>  'Nama belum diisi !',
  ]);
  // $ci->form_validation->set_rules('callsign', 'Callsign', 'required|is_unique[tb_lokal.callsign]|trim', [
  //   'required' =>  'callsign belum diisi !',
  //   'valid_email'  =>  'format email tidak valid !',
  //   'is_unique'  =>  'callsign ini sudah terdaftar !'
  // ]);
  // $ci->form_validation->set_rules('no', 'Nomor', 'required', [
  //   'required' =>  'No belum diisi !',
  // ]);
  $ci->form_validation->set_rules('callsign', 'callsign', 'required', [
    'required' =>  'callsign belum diisi !',
  ]);
  // $ci->form_validation->set_rules('alamat', 'alamat', 'required', [
  //   'required' =>  'Alamat belum diisi !',
  // ]);
}
function editClient_validation()
{
  $ci = get_instance();
  $ci->form_validation->set_rules('name', 'Name', 'required|trim', [
    'required' =>  'Nama belum diisi !',
  ]);
  $ci->form_validation->set_rules('callsign', 'callsign', 'required', [
    'required' =>  'callsign belum diisi !',
  ]);
  // $ci->form_validation->set_rules('email', 'Email', 'required|valid_email', [
  //   'required' =>  'email belum diisi !',
  //   'valid_email'  =>  'format email tidak valid !',
  // ]);
  // $ci->form_validation->set_rules('no', 'Nomor', 'required', [
  //   'required' =>  'No belum diisi !',
  // ]);
  // $ci->form_validation->set_rules('website', 'website', 'required', [
  //   'required' =>  'website belum diisi !',
  // ]);
  // $ci->form_validation->set_rules('alamat', 'alamat', 'required', [
  //   'required' =>  'Alamat belum diisi !',
  // ]);
}
