@extends('admin.layouts.app')
@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Applicants</h3>
                                
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                @include('success.success')
                                @include('errors.error')
                                <form id="search" class="search-form">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-group input-group-sm mb-3 table-search w-100">
                                                <input type="search"  name="name" class="form-control ds-input" placeholder="Name" aria-label="Small" aria-describedby="inputGroup-sizing-sm" onchange="filterList()">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group input-group-sm mb-3 table-search w-100">
                                                <select name="status" class="form-control ds-input" onchange="filterList()">
                                                    <option value="" disabled selected>Search By Status</option>
                                                    @foreach(config('custom.status') as $in => $val)
                                                        <option value="{{$in}}">{{$val}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">S.N.</th>
                                        <th class="text-center">Applicants Name</th>
                                        <th class="text-center">Mobile</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($settings as $setting)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td class="text-center">{{$setting->name}}</td>
                                            <td class="text-center">{{$setting->phone}}</td>
                                            <td class="text-center">{{$setting->email}}</td>

                                            <!-- <td class="text-center">
                                                <a class="btn btn-primary btn-sm" href="{{url('admin/referrals/'.$setting->id.'/view')}}">
                                                    <i class="fas fa-folder">
                                                    </i>
                                                    View
                                                </a>
                                            </td> -->

                                            <td class="d-flex justify-content-center action-icons">
                                                <a href="{{url('admin/applicants/'.$setting->id.'/view')}}" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="view">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                <div class="pagination-default" style="margin-top: 30px;">
                                    {!! $settings->links() !!}
                                </div>
                            </div>

                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>

    <script>
        const exampleEl = document.getElementById('example')
        const tooltip = new bootstrap.Tooltip(exampleEl, options)
    </script>

@endsection
