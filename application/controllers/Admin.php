<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct ();
        $this->load->model('login_model');
        $this->load->model('insert_model');
        $this->load->model('get_model');
    }

    function validatelogin(){
        if($this->session->userdata('session_id_no') && ( $this->session->userdata('session_account_type') == 'admin' )){
            $data['adname'] = $this->session->userdata('session_firstname');
            $data['discussion_data'] = $this->login_model->load_discussion();
            $data['new_threads'] = $this->login_model->load_new_threads();
            $data['loaded_contents'] = $this->login_model->load_contents();
            $data['navigator'] = $this->load->view('admin/nav', NULL, TRUE);
            $data['dashboard'] = $this->load->view('admin/dashboard', $data, TRUE);
            $this->load->view ('admin/admin_view', $data);
        }elseif( $this->session->userdata('session_account_type') == 'student' ){
            redirect(base_url());
        }else{
            $data['dashboard'] = $this->load->view('admin/login', NULL, TRUE);
            $this->load->view('admin/admin_view', $data);
        }
    }

    public function index()
    {
        $this->validatelogin();
    }

    function login(){

        $this->login_model->adminlogin( $this->input->post('username'), $this->input->post('password') );
        $this->validatelogin();
    }

    function ajaxcontent(){
        echo json_encode( $this->get_model->model_load_contents($this->input->post('id')) );
        return false;
    }

    function logout(){
        $user_data = $this->session->all_userdata();

        foreach ($user_data as $key => $value) {
            $this->session->unset_userdata($key);
        }

        $this->index();
    }

    function add_discussion(){
        $insid = $this->insert_model->add_model_discussion( $this->input->post('inp_discussion'));;
        $json_e_query_result = $this->get_model->get_discussion($insid);

        if( !empty($json_e_query_result) ){
            echo $json_e_query_result;
        }else{
            echo 'Failed';
        }
    }

    function add_forum(){
        $table_arraid = array();

        if( $this->insert_model->add_model_forum( $this->input->post('inp_forum'), $this->input->post('sel_forums_discussion') ) == true ){
//            echo 'Save';
            $discussion_data = $this->db->get('forum-discussion');
            if ($discussion_data->num_rows() > 0)
            {
                foreach ($discussion_data->result_array() as $dd)
                {
                    array_push($table_arraid, '<tr><td class="dtitle" colspan="4">'.$dd['discussion_name'].'</td></tr>');

                    $query = $this->db->get_where( 'forum-contents', array( 'discussion_id' => $dd['discussion_id'] ) );
                    foreach ($query->result_array() as $fc) {
                        array_push($table_arraid, '<tr><td><a href="'.base_url('main/thread?a=').$fc['content_id'].'" target="_blank">'. $fc['content_title'] .'</a></td><td>'. $fc['last_post'] .'</td><td>'. $fc['threads'] .'</td><td>'. $fc['posts'] .'</td></tr>');
                    }
                }
            }
            echo json_encode($table_arraid);
        }else{
            echo 'Failed';
        }
    }

    function add_threads(){

        $insid = $this->insert_model->add_threads_forum( $this->input->post('sel_threads_discussion'), $this->input->post('sel_threads_forum'), $this->input->post('sel_sticky'), $this->input->post('inp_thread'), $this->input->post('ta_thread') );
        $json_e_query_result = $this->get_model->get_thread($insid);

        if( !empty($json_e_query_result) ){
            echo $json_e_query_result;
        }else{
            echo 'Failed';
        }

    }

    function roles(){
        $data['student_list'] = $this->get_model->load_account( 'student' );
        $data['admin_list'] = $this->get_model->load_account( 'admin' );
        $data['faculty_list'] = $this->get_model->load_account( 'faculty' );
        $data['navigator'] = $this->load->view('admin/nav', NULL, TRUE);
        $data['dashboard'] = $this->load->view('admin/role_view', $data, TRUE);
        $this->load->view ('admin/admin_view', $data);
    }

    function for_edit_account_type(){
        echo $this->get_model->get_account_by_id( $this->input->post('id') );
    }

    function update_account(){
        echo $this->insert_model->update_account( $this->input->post() );
    }
}