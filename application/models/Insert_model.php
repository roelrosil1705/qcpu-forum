<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class insert_model extends CI_Model {


    public function __construct() {
        parent::__construct ();
        $this->load->library("pagination");
    }

    function add_model_discussion($discussion_name){
        $insid = '0';

        $data = array(
            'date_created'      => date("m-d-Y  H:i:s"),
            'admin_id'          => $this->session->userdata('session_id_no'),
            'discussion_name'   => $discussion_name
        );

        $this->db->insert('forum-discussion', $data);

        return $insid = $this->db->insert_id();

//        return ($this->db->affected_rows() != 1) ? false : $insid;
    }

    function add_model_forum($inp_forum, $sel_forum_discussion){
        $data = array(
            'discussion_id'     => $sel_forum_discussion,
            'admin_id'          => $this->session->userdata('session_id_no'),
            'content_title'     => $inp_forum,
            'last_post'         => '',
            'threads'           => '0',
            'posts'             => '0',
            'date_created'      => date("m-d-Y H:i:s")
        );

        $this->db->insert('forum-contents', $data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function add_threads_forum($sel_threads_discussion,$sel_threads_forum,$sel_sticky,$inp_thread,$ta_thread){
        $insid = 0;

        $data = array(
            'content_id'        => $sel_threads_forum,
            'stud_id'           => 0,
            'admin_id'          => $this->session->userdata('session_id_no'), //admin_name
            'sticky'            => $sel_sticky,
            'thread'            => $inp_thread,
            'message'           => $ta_thread,
            'last_post'         => date("m-d-Y  H:i:s").' by '.$this->session->userdata('session_firstname').' '.$this->session->userdata('session_lastname'),
            'views'             => '1',
            'date_created'      => date("m-d-Y H:i:s")
        );

        $this->db->insert('forum-threads', $data);

        $insid = $this->db->insert_id();

        if( $this->db->affected_rows() > 0 ){

            $query = $this->db->get_where('forum-threads', array( 'content_id' => $sel_threads_forum ));
            $num = $query->num_rows();

            $data_update = array(
                'threads'   => $num,
                'last_post' => date("m-d-Y  H:i:s").' by '.$this->session->userdata('session_firstname').' '.$this->session->userdata('session_lastname')
            );
            $this->db->where( 'content_id', $sel_threads_forum );
            $this->db->update( 'forum-contents', $data_update );

        }

        return $insid;
    }

    function add_threads_forum_v($inp_content,$sel_sticky,$inp_thread,$ta_thread){
        $insid = 0;

        if( $this->session->userdata('account_type') == 'admin' ){
            $aid = $this->session->userdata('account_no');
            $studid = 0;
        }else{
            $aid = 0;
            $studid = $this->session->userdata('account_no');
        }

        $data = array(
            'content_id'        => $inp_content,
            'stud_id'           => $studid,
            'admin_id'          => $aid,
            'sticky'            => 1,
            'thread'            => $inp_thread,
            'message'           => $ta_thread,
            'last_post'         => date("m-d-Y  H:i:s").' by '.$this->session->userdata('firstname').' '.$this->session->userdata('lastname'),
            'views'             => '1',
            'date_created'      => date("m-d-Y H:i:s")
        );

        $this->db->insert('forum-threads', $data);

        $insid = $this->db->insert_id();

        if( $this->db->affected_rows() > 0 ){

            $query = $this->db->get_where('forum-threads', array( 'content_id' => $inp_content ));
            $num = $query->num_rows();

            $data_update = array(
                'threads'   => $num,
                'last_post' => date("m-d-Y  H:i:s").' by '.$this->session->userdata('firstname').' '.$this->session->userdata('lastname')
            );
            $this->db->where( 'content_id', $inp_content );
            $this->db->update( 'forum-contents', $data_update );

        }

        return $insid;
    }

    function insert_replies($a){
        $rep = 0;
        $content_id = 0;
        $tot = 0;
        $insid = 0;

        $data = array(
            'thread_id'         => $a['thd'],
            'account_no'        => $this->session->userdata('account_no'),
            'message'           => $a['ta_reply'],
            'date_created'      => date("m-d-Y H:i:s")
        );

        $this->db->insert('forum-replies', $data);

        $insid = $this->db->insert_id();

        if( $this->db->affected_rows() > 0 ){

            $query = $this->db->get_where('forum-threads', array( 'thread_id' => $a['thd'] ));
            $row = $query->row();
            if (isset($row))
            {
                $content_id = $row->content_id;
                $rep = $row->no_of_replies + 1;
            }

            $data_update = array(
                'no_of_replies'   => $rep
            );
            $this->db->where( 'thread_id', $a['thd'] );
            $this->db->update( 'forum-threads', $data_update );

            $this->db->select_sum('no_of_replies');
            $query = $this->db->get_where('forum-threads', array( 'content_id' => $content_id ));
            $row = $query->row();
            if (isset($row))
            {
                $tot = $row->no_of_replies;
            }

            $data_update = array(
                'posts'   => $tot
            );
            $this->db->where( 'content_id', $content_id );
            $this->db->update( 'forum-contents', $data_update );
        }

        return $insid;
    }

    function update_account( $arr ){
        $data_update = array(
            'account_type'   => $arr['al']
        );
        $this->db->where( 'account_no', $arr['hd'] );
        $this->db->update( 'accounts', $data_update );

        if( $this->db->affected_rows() > 0 ){
            echo 'Update Success';
        }else{
            echo 'Update Fail';
        }
    }
}