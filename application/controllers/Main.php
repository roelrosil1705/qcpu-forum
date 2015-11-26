<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller {

    public function __construct() {
        parent::__construct ();
        $this->load->model('login_model');
        $this->load->model('insert_model');
        $this->load->model('get_model');
        $this->load->model('update_model');
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
        $data['content'] = $this->load->view('content_view', NULL, TRUE);
        $data['navigator'] = $this->load->view('nav', NULL, TRUE);
        $this->load->view('main_view', $data);
    }

    function logout(){
        $user_data = $this->session->all_userdata();

        foreach ($user_data as $key => $value) {
            $this->session->unset_userdata($key);
        }
        $data['content'] = $this->load->view('content_view', NULL, TRUE);
        $data['navigator'] = $this->load->view('nav', NULL, TRUE);
        $this->load->view('main_view', $data);
    }

    function thread(){
        $data_table['thread'] = $this->get_model->get_forum_thread( $this->input->get('a') );

        if( !empty($data_table['thread']) ){
            $data_table['thr_id'] = $this->input->get('a');
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

    function add_threads(){

        $insid = $this->insert_model->add_threads_forum_v( $this->input->post('inp_content'), $this->input->post('sel_sticky'), $this->input->post('inp_thread'), $this->input->post('ta_thread'));
        $json_e_query_result = $this->get_model->get_thread($insid);
        if( !empty($json_e_query_result) ){
            echo $json_e_query_result;
        }else{
            echo 'Failed';
        }

    }

    function add_reply(){
        $insid = $this->insert_model->insert_replies( $this->input->post() );
        $json_e_query_result = $this->get_model->thread_replies( $insid );
        if( !empty($json_e_query_result) ){
            echo $json_e_query_result;
        }else{
            echo 'Failed';
        }
    }

}
