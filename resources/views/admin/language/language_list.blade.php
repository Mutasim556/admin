@extends('layouts.admin')
@push('title')
    {{ __('Language List') }}
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
                    <h3>{{ __('language List') }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)">{{ __('Language') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('Language List') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Add language Modal Start --}}

    <div class="modal fade" id="add-language-modal" tabindex="-1" aria-labelledby="bs-example-modal-lg" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center" style="border-bottom:1px dashed gray">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        {{ __('Add Language') }}
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <p class="px-3 text-danger"><i>{{ __('The field labels marked with * are required input fields.') }}</i>
                </p>
                <div class="modal-body" style="margin-top: -20px">
                    <form action="" id="add_language_form">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 mt-2">
                                <label for="language"><strong>{{ __('Language') }} *</strong></label>
                                <select class="js-example-basic-single" name="language" id="language">
                                    @foreach (config('language') as $key=>$lang)
                                        <option value="{{ $key }}" {{ $key=='en'?'selected':'' }}>{{ $lang['name'] }}</option>
                                    @endforeach
                                    
                                </select>
                                <span class="text-danger err-mgs"></span>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label for="name"><strong>{{ __('Name') }} *</strong></label>
                                <input type="text" class="form-control" name="name" id="name">
                                <span class="text-danger err-mgs"></span>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label for="slug"><strong>{{ __('Slug') }} *</strong></label>
                                <input type="text" class="form-control" name="slug" id="slug" readonly>
                                <span class="text-danger err-mgs"></span>
                            </div>
                            <div class="col-lg-6 mt-4">
                                <input type="checkbox" name="default">&nbsp;&nbsp;
                                <label for="default"><strong> {{ __('Is it default ?') }}</strong></label>
                                <span class="text-danger err-mgs"></span>
                            </div>
                            <div class="col-lg-6 mt-4">
                                <input type="checkbox" name="status"> &nbsp;&nbsp;
                                <label for="status"><strong> {{ __('Is it active ?') }} </strong></label>
                                <span class="text-danger err-mgs"></span>
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

    {{-- Add language Modal End --}}

    {{-- Add language Modal Start --}}

    <div class="modal fade" id="edit-language-modal" tabindex="-1" aria-labelledby="bs-example-modal-lg" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center" style="border-bottom:1px dashed gray">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        {{ __('Edit language') }}
                    </h4>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <p class="px-3 text-danger"><i>{{ __('The field labels marked with * are required input fields.') }}</i>
                </p>
                <div class="modal-body" style="margin-top: -20px">
                    <form action="" id="edit_language_form">
                        @csrf
                        <input type="hidden" id="language_id" name="language_id" value="">
                        <div class="row">
                            <div class="col-lg-12 mt-2">
                                <label for="language"><strong>{{ __('Language') }} *</strong></label>
                                <select class="js-example-basic-single" name="language" id="language">
                                    @foreach (config('language') as $key=>$lang)
                                        <option value="{{ $key }}" {{ $key=='en'?'selected':'' }}>{{ $lang['name'] }}</option>
                                    @endforeach
                                    
                                </select>
                                <span class="text-danger err-mgs"></span>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label for="name"><strong>{{ __('Name') }} *</strong></label>
                                <input type="text" class="form-control" name="name" id="name">
                                <span class="text-danger err-mgs"></span>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label for="slug"><strong>{{ __('Slug') }} *</strong></label>
                                <input type="text" class="form-control" name="slug" id="slug" readonly>
                                <span class="text-danger err-mgs"></span>
                            </div>
                            <div class="col-lg-6 mt-4">
                                <input type="checkbox" name="default" id="default" >&nbsp;&nbsp;
                                <label for="default"><strong> {{ __('Is it default ?') }}</strong></label>
                                <span class="text-danger err-mgs"></span>
                            </div>
                            <div class="col-lg-6 mt-4">
                                <input type="checkbox" name="status" id="status"> &nbsp;&nbsp;
                                <label for="status"><strong> {{ __('Is it active ?') }} </strong></label>
                                <span class="text-danger err-mgs"></span>
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

    {{-- Add language Modal End --}}



    <div class="container-fluid">
        <div class="row">
            <!-- Column -->
            <div class="col-lg-11 mx-auto">
                <div class="card">
                    <div class="card-header py-3" style="border-bottom: 2px dashed gray">
                        <h3 class="card-title mb-0 text-center">{{ __('Language List') }}</h3>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <button class="btn btn-success" type="btn" data-bs-toggle="modal"
                                    data-bs-target="#add-language-modal">+ Add Language</button>
                            </div>
                        </div>

                        <div class="table-responsive theme-scrollbar">
                            <table id="basic-1" class="display table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('Language') }}</th>
                                        <th>{{ __('Slug') }}</th>
                                        <th>{{ __('Default') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($languages as $language)
                                        <tr id="tr-{{ $language->id }}" data-id="{{ $language->id }}">
                                            <td>{{ $language->name }}</td>
                                            <td>{{ $language->slug }}</td>
                                            <td>@if($language->default==1) <span class="badge badge-success">Yes</span >@else <span class="badge badge-danger">No</span>@endif</td>
                                            <td class="text-center">
                                                <span class="mx-2">{{ $language->status==1?'Active':'Inactive' }}</span><input
                                                    data-status="{{ $language->status == 1 ? 0 : 1 }}"
                                                    id="status_change" type="checkbox" data-toggle="switchery"
                                                    data-color="green" data-secondary-color="red" data-size="small"
                                                    {{ $language->status == 1 ? 'checked' : '' }} />
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button
                                                        class="btn btn-info text-white px-2 py-1 dropbtn">{{ __('Action') }}
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
    <script src="{{ asset('admin/assets/js/select2/select2.full.min.js') }}"></script>
    <script>
        $('[data-toggle="switchery"]').each(function(idx, obj) {
            new Switchery($(this)[0], $(this).data());
        });
        $('.js-example-basic-single').select2({
            dropdownParent: $('#add-language-modal')
        });
        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
        var oTable = $("#basic-1").DataTable();

        var form_url = "{{ route('language.store') }}";
    </script>
    <script src="{{ asset('admin/custom/language/language_list.js') }}"></script>
@endpush
