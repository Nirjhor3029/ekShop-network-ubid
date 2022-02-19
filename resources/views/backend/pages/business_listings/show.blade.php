@extends('backend.layouts.admin')
<?php
$themePath = asset('theme/');
?>
@section('title')
    Role Create - Admin Panel
@endsection
@section('styles')
    <style>
    </style>
@endsection

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">All Data</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Business Listing</a></li>
                        <li class="breadcrumb-item active">All Entries</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('admin-content')
    <section class="content">
        <div class="container-fluid">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            @if (session()->has('delete_message'))
                <div class="alert alert-danger">
                    {{ session()->get('delete_message') }}
                </div>
            @endif
            <!-- Main row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DataTable with default features</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered user_datatable example1">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            {{-- <th>Email</th> --}}
                                            <th width="100px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
@section('scripts')
    {{-- @include('backend.pages.roles.partials.scripts') --}}
    <script>
        $(function() {
            var table = $('.example1').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.business_listings.all') }}",
                columns: [{
                        data: 'applicant_name_en',
                        name: 'applicant_name_en',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'mobile',
                        name: 'mobile',
                        orderable: true,
                        searchable: true

                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true

                    },
                ]
            });
        });

        $(document).ready(function() {
            $(document).on("click", ".btn_delete", function() {
                if (confirm("Are You Sure To Delete")) {
                    return true;
                } else {
                    return false;
                }
            });

        });
    </script>
@endsection
