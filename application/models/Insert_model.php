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

}