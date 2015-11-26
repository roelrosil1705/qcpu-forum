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
            $query = $this->db->get_where('forum-replies', array( 'thread_id' => $row->thread ));
            echo '
                <tr>
                    <td><a href="'.base_url('main/gtt?b=').$row->thread_id.'">'.$row->thread.'</a></td>
                    <td>'.$row->last_post.'</td>
                    <td>'.$query->num_rows().'</td>
                    <td>'.$row->views.'</td>
                </tr>
            ';
        }
    ?>
    </tbody>
</table>