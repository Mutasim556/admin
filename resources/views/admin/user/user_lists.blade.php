@extends('layouts.admin')
@push('title')
    {{ __('User List') }}
@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/custom.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>{{ __('User List') }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)">{{ __('User') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('User List') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Add User Modal Start --}}

    <div class="modal fade" id="add-user-modal" tabindex="-1" aria-labelledby="bs-example-modal-lg" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center" style="border-bottom:1px dashed gray">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        {{ __('Add User') }}
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <p class="px-3 text-danger"><i>{{ __('The field labels marked with * are required input fields.') }}</i>
                </p>
                <div class="modal-body" style="margin-top: -20px">
                    <form action="" id="add_user_form">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 mt-2">
                                <label for="user_name"><strong>{{ __('Full Name') }} *</strong></label>
                                <input type="text" class="form-control" name="user_name" id="user_name">
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label for="username"><strong>{{ __('User Name') }} *</strong></label>
                                <input type="text" class="form-control" name="username" id="username">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mt-2">
                                <label for="user_password"><strong>{{ __('Password') }} *</strong></label>
                                <input type="password" class="form-control" name="user_password" id="user_password">
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label for="user_role"><strong>{{ __('Role') }} *</strong></label>
                                <select class="form-control" name="user_role" id="user_role">
                                    <option value="">Select Please</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Owner</option>
                                    <option value="3">Staff</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mt-2">
                                <label for="user_email"><strong>{{ __('Email') }} *</strong></label>
                                <input type="email" class="form-control" name="user_email" id="user_email">
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label for="user_phone"><strong>{{ __('Phone') }} *</strong></label>
                                <input type="text" class="form-control" name="user_phone" id="user_phone">
                            </div>
                        </div>
                        <div class="row mt-4 mb-2">
                            <div class="form-group col-lg-12">

                                <button class="btn btn-danger text-white font-weight-medium waves-effect text-start"
                                    data-bs-dismiss="modal" style="float: right"
                                    type="button">{{ __('Close') }}</button>
                                <button class="btn btn-primary mx-2" style="float: right"
                                    type="submit">{{ __('Submit') }}</button>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{-- Add User Modal End --}}

    {{-- Add User Modal Start --}}

    <div class="modal fade" id="edit-user-modal" tabindex="-1" aria-labelledby="bs-example-modal-lg" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center" style="border-bottom:1px dashed gray">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        {{ __('Edit User') }}
                    </h4>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <p class="px-3 text-danger"><i>{{ __('The field labels marked with * are required input fields.') }}</i>
                </p>
                <div class="modal-body" style="margin-top: -20px">
                    <form action="" id="edit_user_form">
                        @csrf
                        <input type="hidden" id="user_id" name="user_id" value="">
                        <div class="row">
                            <div class="col-lg-6 mt-2">
                                <label for="user_name"><strong>{{ __('Full Name') }} *</strong></label>
                                <input type="text" class="form-control" name="user_name" id="user_name">
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label for="username"><strong>{{ __('Username') }} *</strong></label>
                                <input type="text" class="form-control" name="username" id="username">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mt-2">
                                <label for="user_password"><strong>{{ __('Password') }} *</strong></label>
                                <input type="password" class="form-control" name="user_password" id="user_password">
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label for="user_role"><strong>{{ __('Role') }} *</strong></label>
                                <select class="form-control" name="user_role" id="user_role">
                                    <option value="">Select Please</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Owner</option>
                                    <option value="3">Staff</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mt-2">
                                <label for="user_email"><strong>{{ __('Email') }} *</strong></label>
                                <input type="email" class="form-control" name="user_email" id="user_email">
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label for="user_phone"><strong>{{ __('Phone') }} *</strong></label>
                                <input type="text" class="form-control" name="user_phone" id="user_phone">
                            </div>
                        </div>
                        <div class="row mt-4 mb-2">
                            <div class="form-group col-lg-12">

                                <button class="btn btn-danger text-white font-weight-medium waves-effect text-start"
                                    data-bs-dismiss="modal" style="float: right"
                                    type="button">{{ __('Close') }}</button>
                                <button class="btn btn-primary mx-2" style="float: right"
                                    type="submit">{{ __('Submit') }}</button>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{-- Add User Modal End --}}



    <div class="container-fluid">
        <div class="row">
            <!-- Column -->
            <div class="col-lg-11 mx-auto">
                <div class="card">
                    <div class="card-header py-3" style="border-bottom: 2px dashed gray">
                        <h3 class="card-title mb-0 text-center">{{ __('User List') }}</h3>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <button class="btn btn-success" type="btn" data-bs-toggle="modal"
                                    data-bs-target="#add-user-modal">+ Add User</button>
                            </div>
                        </div>

                        <div class="table-responsive theme-scrollbar">
                            <table id="basic-1" class="display table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('Full Name') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Phone') }}</th>
                                        <th>{{ __('User Name') }}</th>
                                        <th>{{ __('Role') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr id="tr-{{ $user->id }}" data-id="{{ $user->id }}">
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>
                                                {{ $user->role == 1 ? 'Admin' : ($user->role == 2 ? 'Owner' : 'Staff') }}
                                            </td>
                                            <td class="text-center">
                                                <span class="mx-2">{{ $user->status }}</span><input
                                                    data-status="{{ $user->status == 'Active' ? 'Inactive' : 'Active' }}"
                                                    id="status_change" type="checkbox" data-toggle="switchery"
                                                    data-color="green" data-secondary-color="red" data-size="small"
                                                    {{ $user->status == 'Active' ? 'checked' : '' }} />
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button
                                                        class="btn btn-info text-white px-2 py-1 dropbtn">{{ __('Action') }}
                                                        <i class="fa fa-angle-down"></i></button>
                                                    <div class="dropdown-content">
                                                        <a data-bs-toggle="modal" style="cursor: pointer;"
                                                            data-bs-target="#edit-user-modal" class="text-primary"
                                                            id="edit_button"><i class=" fa fa-edit mx-1"></i>Edit</a>

                                                        {{-- <a class="text-info" id="delete_button" style="cursor: pointer;"><i
                                                            class="fa fa-trash mx-1"></i> Email</a> --}}

                                                        <a class="text-danger" id="delete_button"
                                                            style="cursor: pointer;"><i class="fa fa-trash mx-1"></i>
                                                            Delete</a>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            @csrf
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Row -->
    </div>
@endsection
@push('js')
    <script src="{{ asset('admin/assets/js/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/switchery/switchery.min.js') }}"></script>

    <script>
        $('[data-toggle="switchery"]').each(function(idx, obj) {
            new Switchery($(this)[0], $(this).data());
        });
        var oTable = $("#basic-1").DataTable();

        var form_url = "{{ route('user.store') }}";
    </script>
    <script src="{{ asset('admin/custom/user/create_user.js') }}"></script>
    <script src="{{ asset('admin/custom/user/user_list.js') }}"></script>
@endpush
