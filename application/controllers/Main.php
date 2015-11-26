<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller {

    public function __construct() {
        parent::__construct ();
        $this->load->model('login_model');
        $this->load->model('insert_model');
        $this->load->model('get_model');
    }

    public function index()
    {
        $data['content'] = $this->load->view('content_view', NULL, TRUE);
        $data['navigator'] = $this->load->view('nav', NULL, TRUE);
        $this->load->view('main_view', $data);
    }

    function login(){
        $this->load->model('login_model');
        $this->login_model->checklogin( $this->input->post('inp_username'), $this->input->post('inp_password') );
        $data['navigator'] = $this->load->view('nav', NULL, TRUE);
        $this->load->view('main_view', $data);
    }

    function logout(){
        $user_data = $this->session->all_userdata();

        foreach ($user_data as $key => $value) {
            $this->session->unset_userdata($key);
        }
        $this->load->view('main_view');
    }

    function thread(){
        $data_table['thread'] = $this->get_model->get_forum_thread( $this->input->get('a') );

        if( !empty($data_table['thread']) ){
            $data['content'] = $this->load->view('thread_view', $data_table, TRUE);
            $data['navigator'] = $this->load->view('nav', NULL, TRUE);
            $this->load->view('main_view', $data);
        }else{
            echo 'Failed';
        }
    }

    function gtt(){
        $data_table['thread'] = $this->get_model->get_inner_thread( $this->input->get('b') );
        if( !empty($data_table['thread']) ){
            $data['content'] = $this->load->view('thread_inner_view', $data_table, TRUE);
            $data['navigator'] = $this->load->view('nav', NULL, TRUE);
            $this->load->view('main_view', $data);
        }else{
            echo 'Failed';
        }
    }

}
