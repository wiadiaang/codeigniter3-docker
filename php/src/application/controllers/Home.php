<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index()
	{
        $data = array(
            'title' => 'Jabar Field Day 2023',
            'heading' => 'Heading',
            'message' => ' Message'
        ); 
		$this->load->view('portal/master', $data );
		
	}

}