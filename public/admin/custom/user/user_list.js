// Show data on edit modal
$(document).on('click', '#edit_button', function () {
    $('#edit_user_form').trigger('reset');
    let user_id = $(this).closest('tr').data('id');
    $.ajax({
        type: "get",
        url: 'user/' + user_id + "/edit",
        dataType: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            $('#edit_user_form #user_id').val(data.id);
            $('#edit_user_form #user_name').val(data.name);
            $('#edit_user_form #username').val(data.username);
            $('#edit_user_form #user_role').val(data.role);
            $('#edit_user_form #user_email').val(data.email);
            $('#edit_user_form #user_phone').val(data.phone);
        },
        error: function (err) {
            var err_message = err.responseJSON.message.split("(");
            swal({
                icon: "warning",
                title: "Warning !",
                text: err_message[0],
                confirmButtonText: "Ok",
            });
        }
    });

})

//update data
$('#edit_user_form').submit(function (e) {
    e.preventDefault();
    $('button[type=submit]', this).html('Submitting....');
    $('button[type=submit]', this).addClass('disabled');
    var trid = '#tr-'+$('#user_id', this).val();
    $.ajax({
        type: "put",
        url: 'user/' + $('#user_id', this).val(),
        data: $(this).serialize(),
        dataType: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            console.log(data);
            $('button[type=submit]', '#edit_user_form').html('Submit');
            $('button[type=submit]', '#edit_user_form').removeClass('disabled');
            $('td:nth-child(1)',trid).html(data.name);
            $('td:nth-child(2)',trid).html(data.email);
            $('td:nth-child(3)',trid).html(data.phone);
            $('td:nth-child(4)',trid).html(data.username);
            $('td:nth-child(5)',trid).html(data.role==1?'Admin':(data.role==2?"Owner":"Staff"));
            swal({
                icon: "success",
                title: "Congratulations !",
                text: 'User data updated suvccessfully',
                confirmButtonText: "Ok",
            }).then(function () {
                $('#edit_user_form').trigger('reset');
                $('button[type=button]', '#edit_user_form').click();
                

            });
        },
        error: function (err) {
            $('button[type=submit]', '#edit_user_form').html('Submit');
            $('button[type=submit]', '#edit_user_form').removeClass('disabled');
            var err_message = err.responseJSON.message.split("(");
            swal({
                icon: "warning",
                title: "Warning !",
                text: err_message[0],
                confirmButtonText: "Ok",
            });
        }
    });
});

//update status
$(document).on('change','#status_change',function(){
    var status = $(this).data('status');
    var update_id = $(this).closest('tr').data('id');
    var parent_td = $(this).parent();
    parent_td.empty().append(`<div class="loader-box"><div class="loader-35"></div></div>`);
    $.ajax({
        type: "get",
        url: 'user/update/status/'+update_id+"/"+status,
        success: function (data) {
            parent_td.empty().append(`<span class="mx-2">${data.status}</span><input data-status="${data.status=='Active'?'Inactive':'Active'}" id="status_change" type="checkbox" data-toggle="switchery" data-color="green"  data-secondary-color="red" data-size="small" ${data.status=='Active'?'checked':''} />`);
            // parent_td.children('input').each(function (idx, obj) {
            //     new Switchery($(this)[0], $(this).data());
            // });
            new Switchery(parent_td.find('input')[0], parent_td.find('input').data());
        },
        error: function (err) {
            var err_message = err.responseJSON.message.split("(");
            swal({
                icon: "warning",
                title: "Warning !",
                text: err_message[0],
                confirmButtonText: "Ok",
            });
        }
    });
});
//delete data
$(document).on('click','#delete_button',function(){
    var delete_id = $(this).closest('tr').data('id');
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this user",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "delete",
                url: 'user/'+delete_id,
                data: {
                    _token : $("input[name=_token]").val(),
                },
                success: function (data) {
                    swal({
                        icon: "success",
                        title: "Congratulations !",
                        text: 'User deleted successfully',
                        confirmButtonText: "Ok",
                    }).then(function () {
                        $('#tr-'+delete_id).remove();
                    });
                },
                error: function (err) {
                    var err_message = err.responseJSON.message.split("(");
                    swal({
                        icon: "warning",
                        title: "Warning !",
                        text: err_message[0],
                        confirmButtonText: "Ok",
                    });
                }
            });
           
        } else {
            swal("Delete request canceld successfully");
        }
    })
});

