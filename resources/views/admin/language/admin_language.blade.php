@extends('layouts.admin')
@push('title')
    {{ __('Admin Language') }}
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
                    <h3>{{ __('Admin Language') }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)">{{ __('Language') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('Admin Language') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Column -->
            <div class="col-lg-12 mx-auto">
                <div class="card">
                    <div class="card-header py-3" style="border-bottom: 2px dashed gray">
                        <h3 class="card-title mb-0 text-center">{{ __('Admin Language') }}</h3>
                    </div>

                    <div class="card-body">
                        <ul class="nav nav-tabs nav-primary" id="pills-warningtab" role="tablist">
                            @foreach ($languages as $language)
                                <li class="nav-item"><a class="nav-link {{ $language->lang == getLanguageSession() ? 'active' : '' }}"
                                        id="{{ $language->name }}-tab" data-bs-toggle="pill" href="#{{ $language->name }}"
                                        role="tab" aria-controls="{{ $language->name }}"
                                        aria-selected="true">{{ $language->name }}</a></li>
                            @endforeach

                            {{-- <li class="nav-item"><a class="nav-link" id="pills-warningprofile-tab" data-bs-toggle="pill"
                                    href="#pills-warningprofile" role="tab" aria-controls="pills-warningprofile"
                                    aria-selected="false"><i class="icofont icofont-man-in-glasses"></i>Profile</a></li>
                            <li class="nav-item"><a class="nav-link" id="pills-warningcontact-tab" data-bs-toggle="pill"
                                    href="#pills-warningcontact" role="tab" aria-controls="pills-warningcontact"
                                    aria-selected="false"><i class="icofont icofont-contacts"></i>Contact</a></li> --}}
                        </ul>
                        <div class="tab-content" id="pills-warningtabContent">
                            @foreach ($languages as $language)
                                <div class="tab-pane fade show {{ $language->lang == getLanguageSession() ? 'active' : '' }}"
                                    id="{{ $language->name }}" role="tabpanel" aria-labelledby="{{ $language->name }}-tab">

                                    <a class="btn btn-success m-t-30">Generate String</a>
                                    <a class="btn btn-dark mx-3 m-t-30">Translate String</a>

                                    <div class="table-responsive theme-scrollbar mb-0 m-t-30">
                                        <table class="display table-bordered dataTable">
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
                                                <tr>
                                                    <td>dsfd</td>
                                                    <td>sdf</td>
                                                    <td>sdfsd</td>
                                                    <td>sdfds</td>
                                                    <td>fff</td>
                                                </tr>
                                                @if ($language->lang=='en')
                                                <tr>
                                                    <td>dsfd</td>
                                                    <td>4</td>
                                                    <td>1</td>
                                                    <td>sdfds</td>
                                                    <td>fff</td>
                                                </tr>
                                                @endif
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- <p class="">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                        when an unknown printer took a galley of type and scrambled it to make a type specimen
                                        book. It has survived not only five centuries, but also the leap into electronic
                                        typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
                                        release of Letraset sheets containing Lorem Ipsum passages, and more recently with
                                        desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p> --}}
                                </div>
                            @endforeach

                        </div>
                        {{-- <div class="row mb-3">
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
                                            <td>@if ($language->default == 1) <span class="badge badge-success">Yes</span >@else <span class="badge badge-danger">No</span>@endif</td>
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
                        </div> --}}
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
        $('.js-example-basic-single1').select2({
            dropdownParent: $('#edit-language-modal')
        });
        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
        // var oTable = $("#basic-1").DataTable();
        $('.dataTable').each(function(idx,val){
            $(this).DataTable();
        })

        var form_url = "{{ route('language.store') }}";
    </script>
    <script src="{{ asset('admin/custom/language/language_list.js') }}"></script>
@endpush
