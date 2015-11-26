<?php
//print_r($this->session->userdata());
//echo $adname;
?>

<div class="column large-12 medium-11 small-10">
    <ul class="accordion" data-accordion role="tablist">
        <li class="accordion-navigation">
            <a href="#panel1d" role="tab" id="panel1d-heading" aria-controls="panel1d">Discussion</a>
            <div id="panel1d" class="content active" role="tabpanel" aria-labelledby="panel1d-heading">

                <a href="#" class="button small right" data-reveal-id="discussionModal"><i class="fi-plus small"></i> Add</a> <!--discussion add button-->
                <div id="discussionModal" class="reveal-modal small" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
                    <h2 id="modalTitle">Add a discussion</h2>

                    <div id="special-character-discussion" data-alert class="alert-box alert radius hide-normal">
                        Special characters are not allowed
                        <a href="#" class="close">&times;</a>
                    </div>

                    <form id="form_discussion" action="" method="post">
                        <input type="text" id="inp_discussion" name="inp_discussion" placeholder="Discussion Name">
                        <button id="btn_add" type="submit" class="button small right"><i class="fi-plus small"></i> Add</button>
                    </form>

                    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
                </div>


                <table id="table-discussion" class="table-discussion">
                    <thead>
                        <tr>
                            <th width="50">ID</th>
                            <th width="100">Date Created</th>
                            <th width="100">Created by</th>
                            <th width="300">Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if ($discussion_data->num_rows() > 0)
                            {
                                foreach ($discussion_data->result_array() as $dd)
                                {
                                    $query = $this->db->get_where( 'accounts', array( 'account_no' => $dd['admin_id'] ) );
                                    $row = $query->row();
                                    echo '
                                        <tr>
                                            <td>'.$dd['discussion_id'].'</td>
                                            <td>'.$dd['date_created'].'</td>
                                            <td>'.$row->firstname.' '.$row->lastname.'</td>
                                            <td>'.$dd['discussion_name'].'</td>
                                        </tr>
                                    ';
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>



        </li>
        <li class="accordion-navigation">
            <a href="#panel2d"  role="tab" id="panel2d-heading" aria-controls="panel2d">Forum</a>
            <div id="panel2d" class="content" role="tabpanel" aria-labelledby="panel2d-heading">
                <a href="#" class="button small right" data-reveal-id="forumModal"><i class="fi-plus small"></i> Add</a> <!--discussion add button-->
                <div id="forumModal" class="reveal-modal small" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
                    <h2 id="modalTitle">Add a Forum</h2>

                    <div id="special-character" data-alert class="alert-box alert radius hide-normal">
                        Special characters are not allowed
                        <a href="#" class="close">&times;</a>
                    </div>

                    <form id="form_forum" action="" method="post">
                        <select id="sel_forum_discussion" name="sel_forums_discussion" >
                            <?php
                                if ($discussion_data->num_rows() > 0)
                                {
                                    foreach ($discussion_data->result_array() as $dd)
                                    {
                                        echo '<option value="'.$dd['discussion_id'].'">'.$dd['discussion_name'].'</option>';
                                    }
                                }
                            ?>
                        </select>
                        <input type="text" id="inp_forum" name="inp_forum" placeholder="Forum Name">
                        <button id="btn_add_forum" type="submit" class="button small right"><i class="fi-plus small"></i> Add</button>
                    </form>

                    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
                </div>

                <table id="table-forum" class="table-forum">
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
                            if ($discussion_data->num_rows() > 0)
                            {
                                foreach ($discussion_data->result_array() as $dd)
                                {
                                    echo '
                                        <tr>
                                            <td class="dtitle" colspan="4">'.$dd['discussion_name'].'</td>
                                        </tr>
                                    ';

                                    $query = $this->db->get_where( 'forum-contents', array( 'discussion_id' => $dd['discussion_id'] ) );
                                    foreach ($query->result_array() as $fc) {
                                        echo '
                                            <tr>
                                                <td><a href="'.base_url('main/thread?a=').$fc['content_id'].'" target="_blank">'. $fc['content_title'] .'</a></td>
                                                <td>'. $fc['last_post'] .'</td>
                                                <td>'. $fc['threads'] .'</td>
                                                <td>'. $fc['posts'] .'</td>
                                            </tr>
                                        ';
                                    }
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </li>
        <li class="accordion-navigation">
            <a href="#panel3d" role="tab" id="panel3d-heading" aria-controls="panel3d">New Threads</a>
            <div id="panel3d" class="content" role="tabpanel" aria-labelledby="panel3d-heading">
                <a href="#" class="button small right" data-reveal-id="threadModal" ><i class="fi-plus small"></i> Add</a> <!--discussion add button-->
                <div id="threadModal" class="reveal-modal small" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
                    <h2 id="modalTitle">Add a Forum</h2>

                    <div id="special-character-threads" data-alert class="alert-box alert radius hide-normal">
                        Special characters are not allowed
                        <a href="#" class="close">&times;</a>
                    </div>

                    <form id="form_threads" action="" method="post">
                        <select id="sel_threads_discussion" name="sel_threads_discussion">
                            <option value="0">Select a discussion...</option>
                            <?php
                            if ($discussion_data->num_rows() > 0)
                            {
                                foreach ($discussion_data->result_array() as $dd)
                                {
                                    echo '<option value="'.$dd['discussion_id'].'">'.$dd['discussion_name'].'</option>';
                                }
                            }
                            ?>
                        </select>
                        <select id="sel_threads_forum" name="sel_threads_forum" style="display: none;"></select>
                        <select id="sel_sticky" name="sel_sticky" >
                            <option value="1">Not a Sticky</option>
                            <option value="2">Sticky</option>
                        </select>
                        <input type="text" id="inp_thread" name="inp_thread" placeholder="Title">
                        <textarea type="text" id="ta_thread" name="ta_thread" cols="30" rows="10" placeholder="Message"></textarea>

                        <button id="btn_add_threads" type="submit" class="button small right"><i class="fi-plus small"></i> Add</button>
                    </form>

                    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
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
                    if ($new_threads->num_rows() > 0)
                    {
                        foreach ($new_threads->result_array() as $dd)
                        {
                            echo '
                                <tr>
                                    <td>'.$dd['thread'].'</td>
                                    <td>'.$dd['last_post'].'</td>
                                    <td>0</td>
                                    <td>'.$dd['views'].'</td>
                                </tr>
                            ';
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </li>
    </ul>
</div>