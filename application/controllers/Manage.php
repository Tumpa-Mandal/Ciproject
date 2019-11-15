<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('book_model');
        $this->load->model('dep_model');
        $this->load->model('manage_model');
        $data = array();
        if(!$this->session->userdata('userlogin')){
            redirect('user/login');
        }
    }

    public function issuebook()
    {
        $data['title'] = 'Issue Book';
        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['sidebar'] = $this->load->view('inc/sidebar', '', true);
        $data['depdata'] = $this->dep_model->getAllDepartmentData();
        $data['content'] = $this->load->view('inc/issuebook', $data, true);
        $data['footer'] = $this->load->view('inc/footer', '', true);
        $this->load->view('home', $data);
    }

    public function getBookByDepId($dep){
        $getAllBook = $this->manage_model->getBookByDep($dep);
        $output = null;
        $output.='<option value="0">Select One</option>';
        foreach ($getAllBook as $book){
            $output.='<option value="'.$book->bookid.'">'.$book->bookname.'</option>';
        }
        echo $output;
    }

    public function addIssueForm()
    {
        $data['studentname'] = $this->input->post('studentname');
        $data['reg'] = $this->input->post('reg');
        $data['dep'] = $this->input->post('dep');
        $data['book'] = $this->input->post('book');
        $data['return_date'] = $this->input->post('return_date');


        $studentname = $data['studentname'];
        $reg = $data['reg'];
        $dep = $data['dep'];
        $book = $data['book'];


        if (empty($studentname) && empty($dep) && empty($book) && empty($reg)) {
            $data = array();
            $data['msg'] = '<span style="color:red">Field Must Not Be Empty!</span>';
            $this->session->set_flashdata($data);
            redirect("manage/issuebook");
        } else {
            $this->manage_model->saveIssueData($data);
            $data = array();
            $data['msg'] = '<span style="color:green">Data added successfully!</span>';
            $this->session->set_flashdata($data);
            redirect("manage/issuebook");
        }
    }

    public function issuelist()
    {
        $data['title'] = 'Issue List';
        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['sidebar'] = $this->load->view('inc/sidebar', '', true);
        $data['issueData'] = $this->manage_model->getAllIssueData();
        $data['content'] = $this->load->view('inc/issuelist', $data, true);
        $data['footer'] = $this->load->view('inc/footer', '', true);
        $this->load->view('home', $data);
    }

    public function dellist($id){
        $this->manage_model->dellistById($id);
        $data = array();
        $data['msg'] = '<span style="color:green">Data deleted successfully!</span>';
        $this->session->set_flashdata($data);
        redirect("manage/issuelist");
    }

    public function viewStudent($reg)
    {
        $data['title'] = 'Student Details';
        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['sidebar'] = $this->load->view('inc/sidebar', '', true);
        $data['studentdata'] = $this->manage_model->getStudentByReg($reg);
        $data['content'] = $this->load->view('inc/viewstudent', $data, true);
        $data['footer'] = $this->load->view('inc/footer', '', true);
        $this->load->view('home', $data);
    }

}