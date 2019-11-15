<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('book_model');
        $this->load->model('dep_model');
        $data = array();
        if(!$this->session->userdata('userlogin')){
            redirect('user/login');
        }
    }

    public function addbook()
    {
        $data['title'] = 'Add New Student';
        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['sidebar'] = $this->load->view('inc/sidebar', '', true);
        $data['depdata'] = $this->dep_model->getAllDepartmentData();
        $data['content'] = $this->load->view('inc/addbook', $data, true);
        $data['footer'] = $this->load->view('inc/footer', '', true);
        $this->load->view('home', $data);
    }

    public function addBookForm()
    {
        $data['bookname'] = $this->input->post('bookname');
        $data['dep'] = $this->input->post('dep');
        $data['author'] = $this->input->post('author');
        $data['total'] = $this->input->post('total');


        $bookname = $data['bookname'];
        $dep = $data['dep'];
        $author = $data['author'];
        $total = $data['total'];


        if (empty($bookname) && empty($dep) && empty($author)) {
            $data = array();
            $data['msg'] = '<span style="color:red">Field Must Not Be Empty!</span>';
            $this->session->set_flashdata($data);
            redirect("book/addbook");
        } else {
            $this->book_model->saveBook($data);
            $data = array();
            $data['msg'] = '<span style="color:green">Book Data added successfully!</span>';
            $this->session->set_flashdata($data);
            redirect("book/addbook");
        }
    }

    public function booklist()
    {
        $data['title'] = 'Book List';
        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['sidebar'] = $this->load->view('inc/sidebar', '', true);
        $data['allbook'] = $this->book_model->getAllBookData();
        $data['content'] = $this->load->view('inc/booklist', $data, true);
        $data['footer'] = $this->load->view('inc/footer', '', true);
        $this->load->view('home', $data);
    }

    public function editbook($bookid)
    {
        $data['title'] = 'Edit Book';
        $data['header'] = $this->load->view('inc/header', $data, true);
        $data['sidebar'] = $this->load->view('inc/sidebar', '', true);
        $data['departmentdata'] = $this->dep_model->getAllDepartmentData();
        $data['bookById'] = $this->book_model->bookById($bookid);
        $data['content'] = $this->load->view('inc/editbook', $data, true);
        $data['footer'] = $this->load->view('inc/footer', '', true);
        $this->load->view('home', $data);
    }

    public function updateBookForm()
    {
        $data['bookid'] = $this->input->post('bookid');
        $data['bookname'] = $this->input->post('bookname');
        $data['dep'] = $this->input->post('dep');
        $data['author'] = $this->input->post('author');
        $data['total'] = $this->input->post('total');


        $bookid = $data['bookid'];
        $bookname = $data['bookname'];
        $dep = $data['dep'];
        $author = $data['author'];
        $total = $data['total'];


        if (empty($bookname) && empty($dep) && empty($author)) {
            $data = array();
            $data['msg'] = '<span style="color:red">Field Must Not Be Empty!</span>';
            $this->session->set_flashdata($data);
            redirect("book/editbook/".$bookid);
        } else {
            $this->book_model->updateBook($data);
            $data = array();
            $data['msg'] = '<span style="color:green">Book Data updated successfully!</span>';
            $this->session->set_flashdata($data);
            redirect("book/editbook/".$bookid);
        }
    }

    public function delbook($bookid){
        $this->book_model->delbookById($bookid);
        $data = array();
        $data['msg'] = '<span style="color:green">Book Data deleted successfully!</span>';
        $this->session->set_flashdata($data);
        redirect("book/booklist");
    }
}