<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login_model extends CI_Model {
    function checklogin($uname, $password){
        $query = $this->db->get_where('accounts', array('account_no' => $uname, 'password' => md5($password)));
        if ($query->num_rows() > 0)
        {

            foreach ($query->result_array() as $user)
            {

                $this->session->set_userdata(array(
                    'stud_id'       => $user['stud_id'],
                    'account_no'    => $user['account_no'],
                    'lastname'      => $user['lastname'],
                    'firstname'     => $user['firstname'],
                    'middlename'    => $user['middlename'],
                    'account_type'  => $user['account_type'],
                    'status'        => TRUE
                ));

            }

            return 'registered';
        }else{
            return 'unregistered';
        }
    }

    function adminlogin($uname, $password){

        $query = $this->db->get_where('accounts', array('account_no' => $uname, 'password' => md5($password)));
        if ($query->num_rows() > 0)
        {

            foreach ($query->result_array() as $admin)
            {

                $this->session->set_userdata(array(
                    'session_id_no'         => $admin['account_no'],
                    'session_lastname'      => $admin['lastname'],
                    'session_firstname'     => $admin['firstname'],
                    'session_middlename'    => $admin['middlename'],
                    'session_account_type'  => $admin['account_type'],
                    'status'                => TRUE
                ));

            }

            return 'registered';
        }else{
            return 'unregistered';
        }

    }

    function load_discussion(){

        return $query = $this->db->get('forum-discussion');

    }

    function fetch_admin($uname,$password){
        $query = $this->db->get_where('forum-admin', array('user' => $uname, 'pass' => md5($password)));
        if ($query->num_rows() > 0)
        {

            foreach ($query->result_array() as $admin)
            {

                $this->session->set_userdata(array(
                    'admin_id'      => $admin['admin_id'],
                    'user'          => $admin['user'],
                    'pass'          => $admin['pass'],
                    'account_type'  => $admin['account_type'],
                    'admin_name'    => $admin['admin_name'],
                    'status'        => TRUE
                ));

            }

            return 'registered';
        }else{
            return 'unregistered';
        }
    }

    function load_new_threads(){
        $this->db->order_by('date_created','DESC');
        $query = $this->db->get('forum-threads', 10, 0);
        return $query;
    }

    function load_contents(){
        return $this->db->get('forum-contents');
    }

    function fetch_(){

    }
}