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
            $('#special-character').hide();
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