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
                                <h3 class="card-title">Ndis Pricing</h3>
                                <div class="card-tools">
                                    <a class="btn btn-green" href="{{url('admin/ndis_pricing/create')}}" role="button">Create</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @include('success.success')
                                @include('errors.error')
                                <!-- <form id="search" class="search-form">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-group input-group-sm mb-3 table-search w-100">
                                                <input type="search" name="title" class="form-control ds-input" placeholder="Please Enter title" aria-label="Small" aria-describedby="inputGroup-sizing-sm" onchange="filterList()">
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
                                </form> -->
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col" style="width:10px">S.N.</th>
                                        <th scope="col" class="text-center">Title</th>
                                        <th scope="col" class="text-center">Sub Title</th>
                                        <th scope="col" class="text-center">Description</th>
                                        <th scope="col" class="text-center">Sub Description</th>
                                        <th scope="col" class="text-center">Image</th>
                                        <!-- <th scope="col" class="text-center">ImageAlt</th> -->
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($settings as $setting)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td class="text-center">{{$setting->title}}</td>
                                            <td class="text-center">{{$setting->sub_title}}</td>
                                            <td class="text-center">{!! strip_tags($setting->description) !!}</td>
                                            <td class="text-center">{!! strip_tags($setting->sub_description) !!}</td>
                                            <td class="text-center">
                                                <a href="{{url($setting->image)}}" target="_blank">
                                                    <img src="{{url($setting->image)}}" alt="" style="width: 100px;">
                                                </a>
                                            </td>
                                            <td class="action-icons d-flex justify-content-center">
                                                <a href="{{url('admin/ndis_pricing/'.$setting->id.'/edit')}}" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a href="{{url('admin/ndis_pricing/'.$setting->id.'/delete')}}" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="delete" onclick="return confirm('Are you sure want to delete?')">
                                                    <i class="fas fa-trash"></i>
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