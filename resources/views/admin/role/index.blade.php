@extends('layouts.admin')
@push('title')
    {{ __('admin_local.Roles And Permissions') }}
@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/custom.css') }}">
@endpush
@push('page_css')
    <style>
        .loader-box {
            height: auto;
            padding: 10px 0px;
        }

        .loader-box .loader-35:after {
            height: 20px;
            width: 10px;
        }

        .loader-box .loader-35:before {
            width: 20px;
            height: 10px;
        }

    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>{{ __('admin_local.Roles And Permissions') }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)">{{ __('admin_local.role') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('admin_local.Roles And Permissions') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Add role Modal Start --}}

    <div class="modal fade" id="add-role-modal" tabindex="-1" aria-labelledby="bs-example-modal-lg" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center" style="border-bottom:1px dashed gray">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        {{ __('admin_local.Create Role') }}
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <p class="px-3 text-danger"><i>{{ __('admin_local.The field labels marked with * are required input fields.') }}</i>
                </p>
                <div class="modal-body" style="margin-top: -20px">
                    <form action="" id="add_role_form">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 mt-2">
                                <label for="role_name"><strong>{{ __('admin_local.Role Name') }} *</strong></label>
                                <input type="text" class="form-control" name="role_name" id="role_name">
                                <span class="text-danger err-mgs"></span>
                            </div>
                            
                        </div>

                        <div class="row mt-4 mb-2">
                            <div class="form-group col-lg-12">

                                <button class="btn btn-danger text-white font-weight-medium waves-effect text-start"
                                    data-bs-dismiss="modal" style="float: right"
                                    type="button">{{ __('admin_local.Close') }}</button>
                                <button class="btn btn-primary mx-2" style="float: right"
                                    type="submit">{{ __('admin_local.Submit') }}</button>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{-- Add role Modal End --}}

    {{-- Add role Modal Start --}}

    <div class="modal fade" id="edit-role-modal" tabindex="-1" aria-labelledby="bs-example-modal-lg" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center" style="border-bottom:1px dashed gray">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        {{ __('admin_local.Edit role') }}
                    </h4>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <p class="px-3 text-danger"><i>{{ __('admin_local.The field labels marked with * are required input fields.') }}</i>
                </p>
                <div class="modal-body" style="margin-top: -20px">
                    <form action="" id="edit_role_form">
                        @csrf
                        <input type="hidden" id="role_id" name="role_id" value="">
                        <div class="row">
                            <div class="col-lg-12 mt-2">
                                <label for="role"><strong>{{ __('admin_local.role') }} *</strong></label>
                                <select class="js-example-basic-single1" name="role" id="role">
                                    @foreach (config('role') as $key=>$lang)
                                        <option value="{{ $key }}">{{ $lang['name'] }}</option>
                                    @endforeach

                                </select>
                                <span class="text-danger err-mgs"></span>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label for="name"><strong>{{ __('admin_local.Name') }} *</strong></label>
                                <input type="text" class="form-control" name="name" id="name">
                                <span class="text-danger err-mgs"></span>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label for="slug"><strong>{{ __('admin_local.Slug') }} *</strong></label>
                                <input type="text" class="form-control" name="slug" id="slug" readonly>
                                <span class="text-danger err-mgs"></span>
                            </div>
                            <div class="col-lg-6 mt-4">
                                <input type="checkbox" name="default" id="default" >&nbsp;&nbsp;
                                <label for="default"><strong> {{ __('admin_local.Is it default ?') }}</strong></label>
                                <span class="text-danger err-mgs"></span>
                            </div>
                            <div class="col-lg-6 mt-4">
                                <input type="checkbox" name="status" id="status"> &nbsp;&nbsp;
                                <label for="status"><strong> {{ __('admin_local.Is it active ?') }} </strong></label>
                                <span class="text-danger err-mgs"></span>
                            </div>
                        </div>

                        <div class="row mt-4 mb-2">
                            <div class="form-group col-lg-12">

                                <button class="btn btn-danger text-white font-weight-medium waves-effect text-start"
                                    data-bs-dismiss="modal" style="float: right"
                                    type="button">{{ __('admin_local.Close') }}</button>
                                <button class="btn btn-primary mx-2" style="float: right"
                                    type="submit">{{ __('admin_local.Submit') }}</button>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{-- Add role Modal End --}}



    <div class="container-fluid">
        <div class="row">
            <!-- Column -->
            <div class="col-lg-11 mx-auto">
                <div class="card">
                    <div class="card-header py-3" style="border-bottom: 2px dashed gray">
                        <h3 class="card-title mb-0 text-center">{{ __('admin_local.Roles And Permissions') }}</h3>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <button class="btn btn-success" type="btn" data-bs-toggle="modal"
                                    data-bs-target="#add-role-modal">+  {{ __('admin_local.Add role')}}</button>
                            </div>
                        </div>

                        <div class="table-responsive theme-scrollbar">
                            <table id="basic-1" class="display table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('admin_local.role') }}</th>
                                        <th>{{ __('admin_local.Slug') }}</th>
                                        <th>{{ __('admin_local.Default') }}</th>
                                        <th>{{ __('admin_local.Status') }}</th>
                                        <th>{{ __('admin_local.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>


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
    <script src="{{ asset('admin/assets/js/select2/select2.full.min.js') }}"></script>
    <script>
        $('[data-toggle="switchery"]').each(function(idx, obj) {
            new Switchery($(this)[0], $(this).data());
        });
        $('.js-example-basic-single').select2({
            dropdownParent: $('#add-role-modal')
        });
        $('.js-example-basic-single1').select2({
            dropdownParent: $('#edit-role-modal')
        });
        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
        var oTable = $("#basic-1").DataTable();

        var form_url = "{{ route('role.store') }}";
    </script>
    {{-- <script src="{{ asset('admin/custom/role/role_list.js') }}"></script> --}}
@endpush
