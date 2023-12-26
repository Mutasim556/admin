
$('#add_user_form').submit(function (e) {
    e.preventDefault();
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
            $('button[type=submit]', '#add_user_form').html('Submit');
            $('button[type=submit]', '#add_user_form').removeClass('disabled');
            swal({
                icon: "success",
                title: "Congratulations !",
                text: 'User create suvccessfully',
                confirmButtonText: "Ok",
            }).then(function () {
                $('#add_user_form').trigger('reset');
                $('button[type=button]', '#add_user_form').click();
                $('#basic-1 tbody').append(`<tr id="tr-${data.id}" data-id="${data.id}">
                    <td>${data.name}</td>
                    <td>${data.email}</td>
                    <td>${data.phone}</td>
                    <td>${data.username}</td>
                    <td>
                        ${data.role == 1 ? 'Admin' : (data.role == 2 ? 'Owner' : 'Staff')}
                    </td>
                    <td class="text-center">
                        <span class="mx-2">${data.status}</span><input
                            data-status="${data.status == 'Active' ? 'Inactive' : 'Active'}"
                            id="status_change" type="checkbox" data-toggle="switchery"
                            data-color="green" data-secondary-color="red" data-size="small"
                            ${data.status == 'Active' ? 'checked' : ''} />
                    </td>
                    <td>
                        <div class="dropdown">
                            <button
                                class="btn btn-info text-white px-2 py-1 dropbtn">Action
                                <i class="fa fa-angle-down"></i></button>
                            <div class="dropdown-content">
                                <a data-bs-toggle="modal" style="cursor: pointer;"
                                    data-bs-target="#edit-user-modal" class="text-primary"
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
            $('button[type=submit]', '#add_user_form').html('Submit');
            $('button[type=submit]', '#add_user_form').removeClass('disabled');
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