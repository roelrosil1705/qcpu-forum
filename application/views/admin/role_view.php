<ul class="accordion" data-accordion>
    <li class="accordion-navigation">
        <a href="#panel2a">Admin List</a>
        <div id="panel2a" class="content active">
            <table style="width: 100%;">
                <thead>
                <tr>
                    <td>Account No.</td>
                    <td>Account Type</td>
                    <td>Full name</td>
                    <td>Birth Date</td>
                    <td>Phone Number</td>
                    <td>Date Registered</td>
                    <td>Status</td>
                </tr>
                </thead>
                <tbody>
                <?php
                if( !empty( $admin_list ) ){
                    foreach ($admin_list->result() as $row)
                    {
                        echo '
                            <tr>
                                <td>' .$row->account_no. '</td>
                                <td>
                                    <a class="btn_account" href="#" value="'.$row->account_no.'">' .$row->account_type. '</a>
                                </td>
                                <td>' .$row->lastname.', '.$row->firstname.' '.$row->middlename .'</td>
                                <td>' .$row->birthdate. '</td>
                                <td>' .$row->phone_number. '</td>
                                <td>' .$row->date_registered. '</td>
                                <td>' .$row->account_status. '</td>
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
        <a href="#panel3a">Faculty List</a>
        <div id="panel3a" class="content">
            <table style="width: 100%;">
                <thead>
                <tr>
                    <td>Account No.</td>
                    <td>Account Type</td>
                    <td>Full name</td>
                    <td>Birth Date</td>
                    <td>Phone Number</td>
                    <td>Date Registered</td>
                    <td>Status</td>
                </tr>
                </thead>
                <tbody>
                <?php
                    if( !empty( $faculty_list ) ){
                        foreach ($faculty_list->result() as $row)
                        {
                            echo '
                                <tr>
                                    <td>' .$row->account_no. '</td>
                                    <td>
                                        <a class="btn_account" href="#" value="'.$row->account_no.'">' .$row->account_type. '</a>
                                    </td>
                                    <td>' .$row->lastname.', '.$row->firstname.' '.$row->middlename .'</td>
                                    <td>' .$row->birthdate. '</td>
                                    <td>' .$row->phone_number. '</td>
                                    <td>' .$row->date_registered. '</td>
                                    <td>' .$row->account_status. '</td>
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
        <a href="#panel1a">Student List</a>
        <div id="panel1a" class="content">
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <td>Account No.</td>
                        <td>Account Type</td>
                        <td>Full name</td>
                        <td>Birth Date</td>
                        <td>Phone Number</td>
                        <td>Date Registered</td>
                        <td>Status</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if( !empty( $student_list ) ){
                            foreach ($student_list->result() as $row)
                            {
                                echo '
                                    <tr>
                                        <td>' .$row->account_no. '</td>
                                        <td>
                                            <a class="btn_account" href="#" value="'.$row->account_no.'">' .$row->account_type. '</a>
                                        </td>
                                        <td>' .$row->lastname.', '.$row->firstname.' '.$row->middlename .'</td>
                                        <td>' .$row->birthdate. '</td>
                                        <td>' .$row->phone_number. '</td>
                                        <td>' .$row->date_registered. '</td>
                                        <td>' .$row->account_status. '</td>
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

<div id="change-role-modal" class="reveal-modal small" data-reveal aria-labelledby="ChangeRole" aria-hidden="true" role="dialog">
    <h2 id="ChangeRole">Change account type.</h2>
    <p class="lead">"<span id="account_alias"></span>" account type is "<span id="account_type"></span>"</p>
    <p>Change to</p>
    <select name="account_list" id="account_list">
        <option value="admin">Admin</option>
        <option value="accounting">Accounting</option>
        <option value="registrar">Registrar</option>
        <option value="accounting">Accounting</option>
        <option value="student">Student</option>
    </select>
    <input type="hidden" id="hid_id" >

    <div id="alert-fail" data-alert class="alert-box alert radius hide-normal">
        Fail to update.
        <a href="#" class="close">&times;</a>
    </div>
    <div id="alert-success" data-alert class="alert-box success radius hide-normal">
        Update Success.
        <a href="#" class="close">&times;</a>
    </div>

    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>
