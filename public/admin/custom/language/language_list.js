$(document).ready(function(){
    $('#name').val('English');
    $('#slug').val('en');
})
$('#add_language_form #language').change(function(){
    $('#name').val($('#add_language_form #language option:selected').text());
    $('#slug').val($(this).val());
});


//add language
$('#add_language_form').submit(function (e) {
    e.preventDefault();
    $('#add_language_form .err-mgs').each(function(id,val){
        $(this).prev('input').removeClass('border-danger is-invalid')
        $(this).prev('textarea').removeClass('border-danger is-invalid')
        $(this).empty();
    })
    $('button[type=submit]', this).html('Submitting....');
    $('button[type=submit]', this).addClass('disabled');

    $.ajax({
        type: "post",
        url: form_url,
        data: $(this).serialize(),
        dataType: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            $('button[type=submit]', '#add_language_form').html('Submit');
            $('button[type=submit]', '#add_language_form').removeClass('disabled');
            swal({
                icon: "success",
                title: "Congratulations !",
                text: 'Language create suvccessfully',
                confirmButtonText: "Ok",
                showConfirmButton: true,
                timer: 1500,
            }).then(function () {
                // $('#add_language_form').trigger('reset');
                $('button[type=button]', '#add_language_form').click();
                $('#basic-1 tbody').append(`<tr id="tr-${data.id}" data-id="${data.id}">
                    <td>${data.name}</td>
                    <td>${data.slug}</td>
                    <td>${data.default==1?'<span class="badge badge-success">Yes</span>':'<span class="badge badge-danger">No</span>'}</td>
                    <td class="text-center">
                        <span class="mx-2">${data.status==0?'Inactive':'Active'}</span><input
                            data-status="${data.status == 1 ? 0 : 1}"
                            id="status_change" type="checkbox" data-toggle="switchery"
                            data-color="green" data-secondary-color="red" data-size="small"
                            ${data.status == 1 ? 'checked' : ''} />
                    </td>
                    <td>
                        <div class="dropdown">
                            <button
                                class="btn btn-info text-white px-2 py-1 dropbtn">Action
                                <i class="fa fa-angle-down"></i></button>
                            <div class="dropdown-content">
                                <a data-bs-toggle="modal" style="cursor: pointer;"
                                    data-bs-target="#edit-language-modal" class="text-primary"
                                    id="edit_button"><i class=" fa fa-edit mx-1"></i>Edit</a>

                                <a class="text-danger" id="delete_button"
                                    style="cursor: pointer;"><i class="fa fa-trash mx-1"></i>
                                    Delete</a>
                            </div>
                        </div>

                    </td>
                </tr>`)
                new Switchery($('#tr-'+data.id).find('input')[0], $('#tr-'+data.id).find('input').data());
            });
        },
        error: function (err) {
            $('button[type=submit]', '#add_language_form').html('Submit');
            $('button[type=submit]', '#add_language_form').removeClass('disabled');
            $('#add_language_form .err-mgs').each(function(id,val){
                $(this).prev('input').removeClass('border-danger is-invalid')
                $(this).prev('textarea').removeClass('border-danger is-invalid')
                $(this).empty();
            })
            $.each(err.responseJSON.errors,function(idx,val){
                $('#add_language_form #'+idx).addClass('border-danger is-invalid')
                $('#add_language_form #'+idx).next('.err-mgs').empty().append(val);
            })
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
        url: 'language/update/status/'+update_id+"/"+status,
        success: function (data) {
            parent_td.empty().append(`<span class="mx-2">${data.status==1?'Active':'Inactive'}</span><input data-status="${data.status==1?0:1}" id="status_change" type="checkbox" data-toggle="switchery" data-color="green"  data-secondary-color="red" data-size="small" ${data.status==1?'checked':''} />`);
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

// Show data on edit modal
$(document).on('click', '#edit_button', function () {
    $('#edit_language_form').trigger('reset');
    $('#edit_language_form .err-mgs').each(function(id,val){
        $(this).prev('input').removeClass('border-danger is-invalid')
        $(this).empty();
    })
    let language_id = $(this).closest('tr').data('id');
    $.ajax({
        type: "get",
        url: 'language/' + language_id + "/edit",
        dataType: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            $('#edit_language_form #language_id').val(data.id);
            $('#edit_language_form #language').val(data.lang);
            $('#edit_language_form #name').val(data.name);
            $('#edit_language_form #slug').val(data.slug);
            if(data.default==1){
                // console.log($('#edit_language_form #defalut').prop('checked'));
                $('#edit_language_form #default').prop('checked',true);
            }else{
                $('#edit_language_form #default').prop('checked',false);
            }
            if(data.status==1){
                $('#edit_language_form #status').prop('checked',true);
            }else{
                $('#edit_language_form #status').prop('checked',false);
            }
           
        },
        error: function (err) {
            $('#edit_language_form .err-mgs').each(function(id,val){
                $(this).prev('input').removeClass('border-danger is-invalid')
                $(this).empty();
            })
            $.each(err.responseJSON.errors,function(idx,val){
                $('#edit_language_form #'+idx).addClass('border-danger is-invalid')
                $('#edit_language_form #'+idx).next('.err-mgs').empty().append(val);
            })
        }
    });

});

