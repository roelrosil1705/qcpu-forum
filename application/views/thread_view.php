<div class="column large-12 medium-10 small-8 text-center">
    <h3>
        Threads in Forum :
        <?php
        $query = $this->db->get_where('forum-contents', array( 'content_id' => $this->input->get('a') ) );
        $row = $query->row();
        if (isset($row))
        {
            echo $row->content_title;
        }
        ?>
    </h3>
</div>

<?php
    if( $this->session->userdata('account_no') ){
        echo '
            <a class="button right" data-reveal-id="threadModal" ><i class="fi-plus small"></i>Add Thread</a>

            <div id="threadModal" class="reveal-modal small" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
                <h2 id="modalTitle">Add a Forum</h2>

                <div id="special-character-threads-v" data-alert class="alert-box alert radius hide-normal">
                    Special characters are not allowed
                    <a href="#" class="close">&times;</a>
                </div>

                <form id="form_threads_v" action="" method="post">
                    <input type="hidden" name="inp_content" value="'.$thr_id.'">
                    <input type="text" id="inp_thread" name="inp_thread" placeholder="Title">
                    <textarea type="text" id="ta_thread" name="ta_thread" cols="30" rows="10" placeholder="Message"></textarea>

                    <button id="btn_add_threads" type="submit" class="button small right"><i class="fi-plus small"></i> Add</button>
                </form>

                <a class="close-reveal-modal" aria-label="Close">&#215;</a>
            </div>
        ';
    }
?>

<table id="table-threads" class="table-forum">
    <thead>
    <tr>
        <th width="400">Title</th>
        <th width="100">Last Post</th>
        <th width="100">Replies</th>
        <th width="100">View</th>
    </tr>
    </thead>
    <tbody>

    <?php
        foreach( json_decode($thread) as $row ){
//            $query = $this->db->get_where('forum-replies', array( 'thread_id' => $row->thread ));
            echo '
                <tr>
                    <td><a href="'.base_url('main/gtt?b=').$row->thread_id.'">'.$row->thread.'</a></td>
                    <td>'.$row->last_post.'</td>
                    <td>'.$row->no_of_replies.'</td>
                    <td>'.$row->views.'</td>
                </tr>
            ';
        }
    ?>
    </tbody>
</table>