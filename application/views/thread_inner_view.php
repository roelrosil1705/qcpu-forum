<div class="column large-12 medium-10 small-8">
    <?php
        $thread_arr = json_decode($thread);

        echo '<h1 class="row text-center">'.$thread_arr->thr.'</h1>';
        echo '<div class="row">'.$thread_arr->aid.' <font style="font-size:10px;"> date posted '.$thread_arr->dc.'</font></div>';
        echo '<div class="row">'.$thread_arr->dc.'</div>';
        echo '<div class="row">'.$thread_arr->mes.'</div>';
    ?>
</div>

<?php
    if( $this->session->userdata('status') == 1 ){
        echo '
            <div class="row">
                <div class="column large-12 medium-10 small-8">

                    <form id="reply_form" method="post" action="">

                        <div id="reply_alert" data-alert class="alert-box alert radius hide-normal">
                            Please fill the textarea.
                            <a href="#" class="close">&times;</a>
                        </div>

                        <input type="hidden" name="thd" value="' . $thread_arr->tid . '">
                        <textarea name="ta_reply" id="ta_reply" cols="30" rows="5"></textarea>
                        <button id="btn_reply" class="right button small" >Reply</button>
                    </form>
                </div>
            </div>
        ';
    }
?>

<h4>Replies</h4>



<table id="table-replies" class="table-forum">
    <thead>
    <tr>
        <th width="100">Name</th>
        <th width="450">Reply</th>
        <th width="50">Date Replied</th>
    </tr>
    </thead>
    <tbody>
    <?php
        $ename = '';

        $this->db->order_by('date_created','DESC');
        $query = $this->db->get_where('forum-replies', array('thread_id' => $thread_arr->tid));
        foreach ($query->result() as $row)
        {
            $query_name = $this->db->get_where('accounts', array('account_no' => $row->account_no));
            foreach($query_name->result() as $row_name){
                $ename = $row_name->firstname.' '.$row_name->lastname;
            }

            echo '
                <tr>
                    <td>'. $ename .'</td>
                    <td>'. $row->message .'</td>
                    <td>'. $row->date_created .'</td>
                </tr>
            ';
        }
    ?>

    </tbody>
</table>


