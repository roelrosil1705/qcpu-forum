<table class="table-forum" style="margin-top: 10px">
    <thead>
        <tr>
            <th width="400">Title</th>
            <th width="100">Last Post</th>
            <th width="100">Threads</th>
            <th width="100">post</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $discussion_data = $this->db->get('forum-discussion');
            if ($discussion_data->num_rows() > 0)
            {
                foreach ( $discussion_data->result() as $row )
                {
                    echo '<tr><td class="dtitle" colspan="4">'.$row->discussion_name.'</td></tr>';

                    $query = $this->db->get_where( 'forum-contents', array( 'discussion_id' => $row->discussion_id ) );
                    foreach ($query->result() as $fc) {
                        echo '<tr><td><a href="'.base_url('main/thread?a=').$fc->content_id.'" target="_blank">'. $fc->content_title .'</a></td><td>'. $fc->last_post .'</td><td>'. $fc->threads .'</td><td>'. $fc->posts .'</td></tr>';
                    }
                }
            }
        ?>
    </tbody>
</table>