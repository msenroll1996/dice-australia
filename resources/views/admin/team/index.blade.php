@extends('admin.layouts.app')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Teams</h1>
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
                                <h3 class="card-title">Teams Table</h3>
                                    <div class="card-tools">
                                        <a class="btn btn-green" href="{{url('admin/teams/create')}}" role="button">Create</a>
                                    </div>
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
                                        <th class="text-center">Full Name</th>
                                        <th class="text-center">Designation</th>
                                        <th class="text-center">Image</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Contact</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($settings as $setting)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td class="text-center">{{$setting->team_name}}</td>
                                            <td class="text-center">{{$setting->designation}}</td>
                                            <td class="text-center">     @if($setting->image != null)
                                                <a href="{{url($setting->image)}}" target="_blank">
                                                    <img src="{{url($setting->image)}}" alt="Failed to display image" style="width: 100px;">
                                                </a>
                                                @else
                                                    Image not available
                                                @endif</td>
                                            <td class="text-center">{{$setting->email}}</td>
                                            <td class="text-center">{{$setting->mobile_no}}</td>
                                            <td class="text-center">{{config('custom.status')[$setting->status]}}</td>
                                            <!-- <td class="text-center">
                                                <a class="btn btn-primary btn-sm" href="{{url('admin/teams/'.$setting->id)}}">
                                                    <i class="fas fa-folder">
                                                    </i>
                                                    View
                                                </a>
                                                <a class="btn btn-info btn-sm" href="{{url('admin/teams/'.$setting->id.'/edit')}}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Edit
                                                </a>
                                            </td> -->
                                            <td class="d-flex justify-content-center action-icons">
                                                <a href="{{url('admin/teams/'.$setting->id)}}" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="view">
                                                    <i class="fas fa-folder"></i>
                                                </a>
                                                <a href="{{url('admin/teams/'.$setting->id.'/edit')}}" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination-default" style="margin-top: 10px;">
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
