<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('dep_model');
        $data = array();
        if(!$this->session->userdata('userlogin')){
            redirect('user/login');
        }
    }

    public function adddepartment()
    {
        $data['title'] = 'Add Department Name';
        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['sidebar'] = $this->load->view('inc/sidebar', '', true);
        $data['content'] = $this->load->view('inc/departmentadd', '', true);
        $data['footer'] = $this->load->view('inc/footer', '', true);
        $this->load->view('home', $data);
    }

    public function addDepartmentForm(){
        $data['depname'] = $this->input->post('depname');

        $depname = $data['depname'];
        if (empty($depname)) {
            $data = array();
            $data['msg'] = '<span style="color:red">Field Must Not Be Empty!</span>';
            $this->session->set_flashdata($data);
            redirect("department/adddepartment");
        } else {
            $this->dep_model->saveDepartment($data);
            $data = array();
            $data['msg'] = '<span style="color:green">Data added successfully!</span>';
            $this->session->set_flashdata($data);
            redirect("department/adddepartment");
        }
    }

    public function departmentlist(){
        $data['title'] = 'Department List';
        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['sidebar'] = $this->load->view('inc/sidebar', '', true);

        $data['depdata'] = $this->dep_model->getAllDepartmentData();
        $data['content'] = $this->load->view('inc/listdepartment', $data, true);
        $data['footer'] = $this->load->view('inc/footer', '', true);
        $this->load->view('home', $data);
    }

    public function editdepartment($depid){
        $data['title'] = 'Edit Department';
        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['sidebar'] = $this->load->view('inc/sidebar', '', true);

        $data['depById'] = $this->dep_model->getdepartmentById($depid);
        $data['content'] = $this->load->view('inc/depedit', $data, true);
        $data['footer'] = $this->load->view('inc/footer', '', true);
        $this->load->view('home', $data);
    }

    public function updateDepartment(){
        $data['depid'] = $this->input->post('depid');
        $data['depname'] = $this->input->post('depname');

        $depid = $data['depid'];
        $depname = $data['depname'];
        if (empty($depname)) {
            $data = array();
            $data['msg'] = '<span style="color:red">Field Must Not Be Empty!</span>';
            $this->session->set_flashdata($data);
            redirect("department/editdepartment/".$depid);
        } else {
            $this->dep_model->updateDepName($data);
            $data = array();
            $data['msg'] = '<span style="color:green">Data Updated successfully!</span>';
            $this->session->set_flashdata($data);
            redirect("department/editdepartment/".$depid);
        }
    }

    public function deldepartment($depid){
        $this->dep_model->deldepartmentById($depid);
        $data = array();
        $data['msg'] = '<span style="color:green">Data deleted successfully!</span>';
        $this->session->set_flashdata($data);
        redirect("department/departmentlist");
    }

}