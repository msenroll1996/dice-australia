@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
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
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Edit About Us</h3>
                        <a href="{{url('admin/about_us')}}" class="back-button btn-green">List</a>
                        <a href="{{url('admin/about_us/create')}}" class="back-button btn-green mx-2">Create</a>
                    </div>
                    <div class="card-body">
                        @include('success.success')
                        @include('errors.error')
                        {!! Form::open(['url' => '/admin/about_us/'.$about_us->id, 'class' => 'form-horizontal', 'method'=> 'PUT','files' => true]) !!}
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control"   name="image" >
                                    <br>
                                    <span>
                                        <a href="{{url($about_us->image)}}" target="_blank">
                                            <img src="{{url($about_us->image)}}" alt="" style="width: 100px">
                                        </a>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group" >
                                    <label>Top Description <span style="color: red";> * </span></label>
                                    <textarea name="description" class="summernote_class" rows="5" style="height: 658px;" >{{$about_us->description}}
                                     </textarea>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group" >
                                    <label>Bottom Description <span style="color: red";> * </span> </label>
                                    <textarea name="sub_description" class="summernote_class" rows="5" style="height: 658px;" >{{$about_us->sub_description}}
                                     </textarea>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Seo Title</label>
                                    <input type="text" class="form-control"  id="inputPassword3" name="seo_title" value="{{$about_us->seo_title}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Keyword <span style="color: red";> * </span> </label>
                                    <input type="text" class="form-control"  id="inputPassword3" name="keyword" value="{{$about_us->keyword}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Seo Description</label>
                                    <textarea class="summernote_class" name="seo_description">{{$about_us->seo_description}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Meta Keyword</label>
                                    <textarea class="summernote_class" name="meta_keyword"  >{{$about_us->meta_keyword}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Point Title</label>
                                    <textarea class="summernote_class" name="point_title"  >{{$about_us->point_title}}</textarea>
                                </div>
                            </div>
                            

                            <div class="row" id="point_dom">
                            <div class="col-md-6 rel-close" id="point_row_1">
                                <div class="dom-box">
                                    <div class="add-points card">
                                        <div class="form-group" id="point_g_1" >
                                            <!-- <label for="">Point Title <span style="color: red";> * </span> </label> <br> -->
                                            <!-- <input type="text" name="point_title" id="title1"  placeholder="title" value="{{$about_us->point_title}}"> <br> -->
                                            <label for="">Points <span style="color: red";> * </span> </label>
                                            <br>
                                            @foreach($about_us->about_us_points as $point)
                                                <div id="point_old{{$point->id}}" class="point1" >
                                                    <input type="text" class="point"  name="points[]"  placeholder="Point" value="{{$point->point}}"> <br>
                                                    <input type="hidden"   name="point_old_id[]"  placeholder="points" value="{{$point->id}}"> <br>
                                                    <button  class="close-point" onclick="deletePointPermanently({{$point->id}})" type="button"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                </div>
                                            @endforeach

                                        </div>
                                        <button type="button"  class="add-point-btn btn btn-primary" onclick="getPoint(1)">Add Points</button>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status <span style="color: red";> * </span> </label>
                                    <select name="status" class="form-control" id="type" required>
                                        <option value="" selected disabled>Please select Status</option>
                                        @foreach(config('custom.status') as $in => $val)
                                        <option value="{{$in}}" {{($about_us->status ==$in) ? 'selected':''}}>{{$val}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-green">Update</button>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('.summernote_class').summernote()
        })

        var point_count = 1;
        function getPoint(count){
            point_count = point_count +1;
            var html = '<div id="point'+point_count+'" class="point1">'+
                '<input type="text" class="point"  name="points[]"  placeholder="Point"> <br>'+
                '<button type="button" class="close-point" onclick="deletePoint('+point_count+')"><i class="fa fa-trash" aria-hidden="true"></i></button>'+
                '</div>';
            $('#point_g_1').append(html);
        }
        function deletePoint(count){
            if($('.point').length > 1){
                $('#point'+count).remove();
            }
        }

        function deletePointPermanently(id){
            if($('.point').length > 1){
                if (confirm("Are you sure Delete?")) {
                    $.ajax({
                        /* the route pointing to the post function */
                        type: 'GET',
                        url: Laravel.url +"/admin/blog_point/"+id,
                        dataType: 'json',
                        processData: false,  // tell jQuery not to process the data
                        contentType: false,
                        /* remind that 'data' is the response of the AjaxController */
                        success: function (data) {
                            $('#point_old'+data.blog_point_id).remove();
                        },
                        error: function(error) {

                        }
                    });
                }
                return false;
            }
        }
    </script>
@endsection

