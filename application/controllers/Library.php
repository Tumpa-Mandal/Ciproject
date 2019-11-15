<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Library extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->home();
    }

    public function home(){
        $data=array();
        $data['title']='Library Management System';
        $data['header']=$this->load->view('inc/header',$data,true);
        $data['sidebar']=$this->load->view('inc/sidebar','',true);
        $data['content']=$this->load->view('inc/content','',true);
        $data['footer']=$this->load->view('inc/footer','',true);
        $this->load->view('home',$data);
    }
}
