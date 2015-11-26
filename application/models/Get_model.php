<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class get_model extends CI_Model {

    function model_load_contents($discussion_id){

        $query = $this->db->get_where( 'forum-contents', array( 'discussion_id' => $discussion_id ) );
        return $query->result_array();
    }

    function count_thread_replies($thread_id){
        $query = $this->db->get_where( 'forum-contents', array( 'discussion_id' => $thread_id ) );
        $result = $query->row_array();
        return $result['COUNT(*)'];
    }

    function get_thread($thread_id){
        $query = $this->db->get_where( 'forum-threads', array( 'thread_id' => $thread_id ) );
        return json_encode($query->result_array());
    }

    function get_forum_thread($content_id){
        $query = $this->db->get_where( 'forum-threads', array( 'content_id' => $content_id ) );
        return json_encode($query->result_array());
    }

    function get_discussion($discussion_id){
        $discussion_array = array();

        $query = $this->db->get_where( 'forum-discussion', array( 'discussion_id' => $discussion_id ) );
        foreach ($query->result() as $row)
        {
            $discussion_array['did'] = $row->discussion_id;
            $discussion_array['dc'] = $row->date_created;
            $discussion_array['aid'] = $this->get_admin( $row->admin_id );
            $discussion_array['dn'] = $row->discussion_name;
        }

        return json_encode( $discussion_array );
    }

    function get_admin( $aid ){
        $query = $this->db->get_where( 'accounts', array( 'account_no' => $aid ) );
        foreach ($query->result() as $row)
        {
            return $row->firstname.' '.$row->lastname;
        }
    }

    function load_all_table(){
        $table_arraid = array();

        $discussion_data = $this->db->get('forum-discussion');
        if ($discussion_data->num_rows() > 0)
        {
            foreach ( $discussion_data->result() as $row )
            {
                array_push($table_arraid, '<tr><td class="dtitle" colspan="4">'.$row->discussion_name.'</td></tr>');

                $query = $this->db->get_where( 'forum-contents', array( 'discussion_id' => $row->discussion_id ) );
                foreach ($query->result() as $fc) {
                    array_push($table_arraid, '<tr><td><a href="'.base_url('main/thread?a=').$fc->content_id.'" target="_blank">'. $fc->content_title .'</a></td><td>'. $fc->last_post .'</td><td>'. $fc->threads .'</td><td>'. $fc->posts .'</td></tr>');
                }
            }
        }
        return json_encode($table_arraid);
    }

    function get_inner_thread( $thread_id ){
        $discussion_array = array();

        $query = $this->db->get_where( 'forum-threads', array( 'thread_id' => $thread_id) );
        foreach ($query->result() as $row)
        {
            $discussion_array['tid'] = $row->thread_id;
            $discussion_array['thr'] = $row->thread;
            $discussion_array['sti'] = $row->sticky;

            if( !empty($row->admin_id) ){
                $discussion_array['aid'] = $this->get_admin( $row->admin_id );
            }else{
                $discussion_array['aid'] = $this->get_admin( $row->stud_id );
            }

            $discussion_array['mes'] = $row->message;
            $discussion_array['dc'] = $row->date_created;
        }

        return json_encode( $discussion_array );
    }
}