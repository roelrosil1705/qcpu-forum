$(document).ready(function(){
    //$('table').DataTable();
});

$('#form_discussion').ajaxForm({
    type: 'POST',
    url: MyNameSpace.config.base_url+'admin/add_discussion',
    beforeSubmit: function(arr, jform, option){
        $('#btn_add').prop('disabled', true);
        var form = jform[0];
        if (validateinput(form.inp_discussion.value.trim()) ==  false){
            $('#special-character-discussion').text();
            $('#special-character-discussion').text("Special characters are not allowed.");
            $('#special-character-discussion').show();
            $('#btn_add').prop('disabled', false);
            return false;
        }else if( form.inp_discussion.value.trim() == '' ){
            $('#special-character-discussion').text();
            $('#special-character-discussion').text("Please input a discussion.");
            $('#special-character-discussion').show();
            $('#btn_add').prop('disabled', false);
            return false;
        }else{
            $('#special-character-discussion').hide();
        }
    },
    success:  function(html){
        var json = $.parseJSON(html);
        $('#table-discussion tr:last').after("<tr><td>" + json.did + "</td><td>" + json.dc + "</td><td>" + json.aid + "</td><td>" + json.dn + "</td></tr>");
        $('#inp_discussion').val('');
        $('#btn_add').prop('disabled', false);
    }
});

$('#form_forum').ajaxForm({
    type: 'POST',
    url: MyNameSpace.config.base_url+'admin/add_forum',
    beforeSubmit: function(arr, jform, option){
        $('#btn_add_forum').prop('disabled', true);
        var form = jform[0];
        if (validateinput(form.inp_forum.value.trim()) ==  false){
            $('#special-character').text();
            $('#special-character').text("Special characters are not allowed.");
            $('#special-character').show();
            $('#btn_add_threads').prop('disabled', false);
            return false;
        }else if( form.inp_forum.value.trim() == '' ){
            $('#special-character').text();
            $('#special-character').text("Please input a forum name.");
            $('#special-character').show();
            $('#btn_add').prop('disabled', false);
            return false;
        }else{
            $('#special-character').hide();
        }
    },
    success:  function(response){
        var json = $.parseJSON(response);
        $('#table-forum tbody').empty();
        $.each( json, function( key, value ) {
            $('#table-forum tbody').append(value);
        })
        $('#inp_forum').val('');
        $('#btn_add_forum').prop('disabled', false);
    }
});

$('#form_threads').ajaxForm({
    type: 'POST',
    url: MyNameSpace.config.base_url+'admin/add_threads',
    beforeSubmit: function(arr, jform, option){
        $('#btn_add_threads').prop('disabled', true);
        //alert($('#sel_threads_discussion').val());

        if($('#sel_threads_discussion').val() == 0){
            $('#special-character-threads').text();
            $('#special-character-threads').text("You haven't selected a discussion!.");
            $('#special-character-threads').show();
            $('#btn_add_threads').prop('disabled', false);
            return false;
        }else if( $("#inp_thread").val() == '' || $("#ta_thread").val() == '' ){
            $('#special-character-threads').text();
            $('#special-character-threads').text("You haven't inputted a message!.");
            $('#special-character-threads').show();
            $('#btn_add_threads').prop('disabled', false);
            return false;
        }else{
            $('#special-character-threads').hide();
        }
    },
    success:  function(response){
        var rep1 = response.replace("[","");
        var rep2 = rep1.replace("]","");
        var json = $.parseJSON(rep2);
        $('#inp_thread').val('');
        $('#sel_threads_forum').hide();
        $('#btn_add_threads').prop('disabled', false);
        reload_thread_selector();
        $("<tr><td>" + json.thread + "</td><td>" + json.last_post + "</td><td>0</td><td>" + json.views + "</td></tr>").prependTo("#table-threads > tbody"); //update replies
    }
});

$('#form_threads_v').ajaxForm({
    type: 'POST',
    url: MyNameSpace.config.base_url+'main/add_threads',
    beforeSubmit: function(arr, jform, option){
        $('#btn_add_threads-v').prop('disabled', true);
        //alert($('#sel_threads_discussion').val());

        if($('#sel_threads_discussion').val() == 0){
            $('#special-character-threads-v').text();
            $('#special-character-threads-v').text("You haven't selected a discussion!.");
            $('#special-character-threads-v').show();
            $('#btn_add_threads').prop('disabled', false);
            return false;
        }else if( $("#inp_thread").val() == '' || $("#ta_thread").val() == '' ){
            $('#special-character-threads-v').text();
            $('#special-character-threads-v').text("You haven't inputted a message!.");
            $('#special-character-threads-v').show();
            $('#btn_add_threads').prop('disabled', false);
            return false;
        }else{
            $('#special-character-threads-v').hide();
        }
    },
    success:  function(response){
        var rep1 = response.replace("[","");
        var rep2 = rep1.replace("]","");
        var json = $.parseJSON(rep2);
        $('#inp_thread').val('');
        $('#ta_thread').val('');
        $("<tr><td><a href='" + MyNameSpace.config.base_url + "main/gtt?b=" + json.thread_id + "'>" + json.thread + "</a></td><td>" + json.last_post + "</td><td>0</td><td>" + json.views + "</td></tr>").prependTo("#table-threads > tbody"); //update replies
        $('#btn_add_threads').prop('disabled', false);
    }
});
$('#reply_form').ajaxForm({
    type: 'POST',
    url: MyNameSpace.config.base_url+'main/add_reply',
    beforeSubmit: function(arr, jform, option){
        $('#btn_reply').prop('disabled', true);
        if( $("#ta_reply").val() == '' ){
            $('#special-character-threads-v').show();
            $('#btn_reply').prop('disabled', false);
            return false;
        }else{
            $('#special-character-threads-v').hide();
        }
    },
    success:  function(response){;
        var rep1 = response.replace("[","");
        var rep2 = rep1.replace("]","");
        var json = $.parseJSON(rep2);
        //console.log(json)
        $('#ta_reply').val('');

        $("<tr><td>" + json.fn + "</td><td>"+ json.mes +"</td><td>" + json.dc + "</td></tr>").prependTo("#table-replies > tbody"); //update replies
        $('#btn_reply').prop('disabled', false);
    }
});

function reload_thread_selector(){

    $('#sel_threads_discussion').on('change', function(){
        $.ajax({
            url: MyNameSpace.config.base_url+'admin/ajaxcontent',
            type:'post',
            data: {
                id : $('#sel_threads_discussion').val()
            },
            dataType: 'json',
            success: function(data) {
                //console.log(data);
                $.each( data, function( key, value ) {
                    $('#sel_threads_forum')
                        .show()
                        .empty()
                        .append($("<option></option>")
                        .attr("value", value.content_id)
                        .text(value.content_title));
                });
            }
        });
    })

}

reload_thread_selector();

$('.btn_account').on('click', function(){
    var mid = $(this).attr('value');
    $.ajax({
        url: MyNameSpace.config.base_url+'admin/for_edit_account_type',
        type:'post',
        data: {
            id : mid
        },
        success: function(data) {
            console.log(mid);
            var json = $.parseJSON(data);
            $('#account_alias').text(json.fullname);
            $('#account_type').text(json.account_type);
            $('#hid_id').val( mid );
            $('#change-role-modal').foundation('reveal', 'open');
        }
    });
});

$('#account_list').on('change', function(){
    console.log($('#account_list').val());
    console.log($('#hid_id').val());
    $.ajax({
        url: MyNameSpace.config.base_url+'admin/update_account',
        type:'post',
        data: {
            al : $('#account_list').val(),
            hd : $('#hid_id').val()
        },
        success: function(data) {
            console.log(data);

            if( data == 'Update Success' ){
                $('#alert-success').show();
                $('#alert-fail').hide();
            }else{
                $('#alert-success').hide();
                $('#alert-fail').show();
            }
        }
    });
});