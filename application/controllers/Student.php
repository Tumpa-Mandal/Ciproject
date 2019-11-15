<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->model('student_model');
        $this->load->model('dep_model');
        $data = array();
        if(!$this->session->userdata('userlogin')){
            redirect('user/login');
        }
    }

    public function addstudent()
    {
        $data['title'] = 'Add New Student';
        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['sidebar'] = $this->load->view('inc/sidebar', '', true);
        $data['depdata'] = $this->dep_model->getAllDepartmentData();
        $data['content'] = $this->load->view('inc/studentadd', $data, true);
        $data['footer'] = $this->load->view('inc/footer', '', true);
        $this->load->view('home', $data);
    }

    public function addStudentForm()
    {
        $data['name'] = $this->input->post('name');
        $data['dep'] = $this->input->post('dep');
        $data['roll'] = $this->input->post('roll');
        $data['reg'] = $this->input->post('reg');
        $data['phone'] = $this->input->post('phone');

        $name = $data['name'];
        $dep = $data['dep'];
        $roll = $data['roll'];
        $reg = $data['reg'];
        $phone = $data['phone'];

        if (empty($name) && empty($dep) && empty($roll) && empty($reg)) {
            $data = array();
            $data['msg'] = '<span style="color:red">Field Must Not Be Empty!</span>';
            $this->session->set_flashdata($data);
            redirect("student/addstudent");
        } else {
            $this->student_model->saveStudent($data);
            $data = array();
            $data['msg'] = '<span style="color:green">Data added successfully!</span>';
            $this->session->set_flashdata($data);
            redirect("student/addstudent");
        }
    }

    public function studentlist()
    {
        $data['title'] = 'Student List';
        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['sidebar'] = $this->load->view('inc/sidebar', '', true);

        $data['studentdata'] = $this->student_model->getAllStudentData();
        $data['content'] = $this->load->view('inc/liststudent', $data, true);
        $data['footer'] = $this->load->view('inc/footer', '', true);
        $this->load->view('home', $data);
    }

    public function editstudent($sid)
    {
        $data['title'] = 'Edit Student';
        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['sidebar'] = $this->load->view('inc/sidebar', '', true);
        $data['departmentdata'] = $this->dep_model->getAllDepartmentData();
        $data['stuById'] = $this->student_model->getstudentById($sid);
        $data['content'] = $this->load->view('inc/studentedit', $data, true);
        $data['footer'] = $this->load->view('inc/footer', '', true);
        $this->load->view('home', $data);
    }

    public function UpdateStudent()
    {
        $data['sid'] = $this->input->post('sid');
        $data['name'] = $this->input->post('name');
        $data['dep'] = $this->input->post('dep');
        $data['roll'] = $this->input->post('roll');
        $data['reg'] = $this->input->post('reg');
        $data['phone'] = $this->input->post('phone');

        $sid = $data['sid'];
        $name = $data['name'];
        $dep = $data['dep'];
        $roll = $data['roll'];
        $reg = $data['reg'];

        if (empty($name) && empty($dep) && empty($roll) && empty($reg)) {
            $data = array();
            $data['msg'] = '<span style="color:red">Field Must Not Be Empty!</span>';
            $this->session->set_flashdata($data);
            redirect("student/editstudent/" . $sid);
        } else {
            $this->student_model->updateStudentData($data);
            $data = array();
            $data['msg'] = '<span style="color:green">Data updated successfully!</span>';
            $this->session->set_flashdata($data);
            redirect("student/editstudent/" . $sid);
        }

    }

    public function delstudent($sid){
        $this->student_model->delstudentById($sid);
        $data = array();
        $data['msg'] = '<span style="color:green">Data deleted successfully!</span>';
        $this->session->set_flashdata($data);
        redirect("student/studentlist");
    }

}
