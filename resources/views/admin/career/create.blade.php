@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Career</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Create Career</h3>
                        <a href="{{url('admin/careers')}}" class="back-button">List</a>

                    </div>
                    <div class="card-body">
                        @include('success.success')
                        @include('errors.error')
                        {!! Form::open(['url' => '/admin/careers', 'class' => 'form-horizontal', 'method'=> 'POST','files' => true,'autocomplete' => 'OFF']) !!}
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image <span style="color: red";> * </span> </label>
                                    <input type="file" class="form-control"   name="image" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Title <span style="color: red";> * </span> </label>
                                    <input type="text" class="form-control"  id="inputPassword3" name="title" value="{{old('title')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6" >
                                <div class="form-group" >
                                    <label>Sub Title <span style="color: red";> * </span></label>
                                    <textarea name="sub_title" class="summernote_class" rows="5" required style="height: 658px;" >{{old('sub_title')}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6" >
                                <div class="form-group" >
                                    <label>Point Title <span style="color: red";> * </span> </label>
                                        <textarea name="point_title" class="summernote_class"  rows="5" required style="height: 658px;" >{{old('point_title')}}
                                     </textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Seo Title</label>
                                    <input type="text" class="form-control"  id="inputPassword3" name="seo_title" value="{{old('seo_title')}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Keyword <span style="color: red";> * </span> </label>
                                    <input type="text" class="form-control"  id="inputPassword3" name="keyword" value="{{old('keyword')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Seo Description </label>
                                    <textarea class="summernote_class" name="seo_description">{{old('seo_description')}}</textarea>
{{--                                    <input type="text" class="form-control"  id="inputPassword3" name="seo_description" >--}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Meta Keyword</label>
                                    <textarea class="summernote_class" name="meta_keyword"  >{{old('meta_keyword')}}</textarea>
                                </div>
                            </div>
                            
                        </div>

                        <div class="row" id="point_dom">
                            <div class="col-md-6 rel-close" id="point_row_1">
                                <div class="dom-box">
                                    <div class="add-points card">
                                        <div class="form-group" id="point_g_1" >
                                            <!-- <label for=""> Point Title <span style="color: red";> * </span></label> <br> -->
                                            <!-- <input type="text" name="point_title" id="title1"  placeholder="Title"> <br> -->
                                            <div id="point1" class="point1" >
                                                <label for="">Points <span style="color: red";> * </span> </label> <br>
                                                <input type="text" class="point"  name="points[]"  placeholder="Points"> <br>
                                                <button  class="close-point" onclick="deletePoint(1)" type="button"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </div>

                                        </div>
                                        <button type="button"  class="add-point-btn btn btn-primary" onclick="getPoint(1)">Add Points</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status <span style="color: red";> * </span> </label>
                                    <select name="status" class="form-control" id="type" required>
                                        <option value="" selected disabled>Please select Status</option>
                                        @foreach(config('custom.status') as $in => $val)
                                            <option value="{{$in}}" {{(old('status')==$in) ? 'selected':''}}>{{$val}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row create-button">
                            <div class="col-sm-10 col-md-12">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.summernote_class').summernote()
        })

        var point_count = 1;
        function getPoint(count){
            point_count = point_count +1;
            debugger;
            var html = '<div id="point'+point_count+'" class="point1">'+
                '<input type="text" class="point"  name="points[]"  placeholder="Points"> <br>'+
                '<button type="button" class="close-point" onclick="deletePoint('+point_count+')"><i class="fa fa-trash" aria-hidden="true"></i></button>'+
                '</div>';
            $('#point_g_1').append(html);
        }
        function deletePoint(count){
            if($('.point').length > 1){
                $('#point'+count).remove();
            }
        }

    </script>


@endsection

