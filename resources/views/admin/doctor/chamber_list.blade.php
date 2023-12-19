@extends('layouts.admin')
@push('title')
    {{ __('Chamber List') }}
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
                    <h3>{{ __('Chamber List') }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)">{{ __('Chamber') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('Chamber List') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Chamber Modal Start --}}

    <div class="modal fade" id="add-chamber-modal" tabindex="-1" aria-labelledby="bs-example-modal-lg" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center" style="border-bottom:1px dashed gray">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        {{ __('Add Chamber') }}
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <p class="px-3 text-danger"><i>{{ __('The field labels marked with * are required input fields.') }}</i>
                </p>
                <div class="modal-body" style="margin-top: -20px">
                    <form action="" id="add_chamber_form">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 mt-2">
                                <label for="chamber_name"><strong>{{ __('Chamber Name') }} *</strong></label>
                                <input type="text" class="form-control" name="chamber_name" id="chamber_name">
                                <span class="text-danger err-mgs"></span>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label for="chamber_phone"><strong>{{ __('Chamber Phone') }} *</strong></label>
                                <input type="text" class="form-control" name="chamber_phone" id="chamber_phone">
                                <span class="text-danger err-mgs"></span>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <label for="chamber_address"><strong>{{ __('Chamber Address') }} *</strong></label>
                                <textarea name="chamber_address" id="chamber_address" cols="30" rows="2" class="form-control"></textarea>
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

    {{-- Add Chamber Modal End --}}

    {{-- Add Chamber Modal Start --}}

    <div class="modal fade" id="edit-chamber-modal" tabindex="-1" aria-labelledby="bs-example-modal-lg" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center" style="border-bottom:1px dashed gray">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        {{ __('Edit Chamber') }}
                    </h4>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <p class="px-3 text-danger"><i>{{ __('The field labels marked with * are required input fields.') }}</i>
                </p>
                <div class="modal-body" style="margin-top: -20px">
                    <form action="" id="edit_chamber_form">
                        @csrf
                        <input type="hidden" id="chamber_id" name="Chamber_id" value="">
                        <div class="row">
                            <div class="col-lg-6 mt-2">
                                <label for="chamber_name"><strong>{{ __('Chamber Name') }} *</strong></label>
                                <input type="text" class="form-control" name="chamber_name" id="chamber_name">
                                <span class="text-danger err-mgs"></span>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label for="chamber_phone"><strong>{{ __('Chamber Phone') }} *</strong></label>
                                <input type="text" class="form-control" name="chamber_phone" id="chamber_phone">
                                <span class="text-danger err-mgs"></span>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <label for="chamber_address"><strong>{{ __('Chamber Address') }} *</strong></label>
                                <textarea name="chamber_address" id="chamber_address" cols="30" rows="2" class="form-control"></textarea>
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

    {{-- Add Chamber Modal End --}}



    <div class="container-fluid">
        <div class="row">
            <!-- Column -->
            <div class="col-lg-11 mx-auto">
                <div class="card">
                    <div class="card-header py-3" style="border-bottom: 2px dashed gray">
                        <h3 class="card-title mb-0 text-center">{{ __('Chamber List') }}</h3>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <button class="btn btn-success" type="btn" data-bs-toggle="modal"
                                    data-bs-target="#add-chamber-modal">+ Add Chamber</button>
                            </div>
                        </div>

                        <div class="table-responsive theme-scrollbar">
                            <table id="basic-1" class="display table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('Chamber Name') }}</th>
                                        <th>{{ __('Phone') }}</th>
                                        <th>{{ __('Address') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($chambers as $chamber)
                                        <tr id="tr-{{ $chamber->id }}" data-id="{{ $chamber->id }}">
                                            <td>{{ $chamber->chamber_name }}</td>
                                            <td>{{ $chamber->chamber_phone }}</td>
                                            <td>{{ $chamber->chamber_address }}</td>
                                            <td class="text-center">
                                                <span class="mx-2">{{ $chamber->chamber_status }}</span><input
                                                    data-status="{{ $chamber->chamber_status == 'Active' ? 'Inactive' : 'Active' }}"
                                                    id="status_change" type="checkbox" data-toggle="switchery"
                                                    data-color="green" data-secondary-color="red" data-size="small"
                                                    {{ $chamber->chamber_status == 'Active' ? 'checked' : '' }} />
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button
                                                        class="btn btn-info text-white px-2 py-1 dropbtn">{{ __('Action') }}
                                                        <i class="fa fa-angle-down"></i></button>
                                                    <div class="dropdown-content">
                                                        <a data-bs-toggle="modal" style="cursor: pointer;"
                                                            data-bs-target="#edit-chamber-modal" class="text-primary"
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

    <script>
        $('[data-toggle="switchery"]').each(function(idx, obj) {
            new Switchery($(this)[0], $(this).data());
        });
        var oTable = $("#basic-1").DataTable();

        var form_url = "{{ route('chamber.store') }}";
    </script>
    <script src="{{ asset('admin/custom/chamber/chamber_list.js') }}"></script>
@endpush
