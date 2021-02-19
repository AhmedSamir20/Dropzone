@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">


                {{$post->title}}
                <hr>

                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>
                @endif

                @if($post->images()->count() >0)
                    <div class="row">
                        @foreach($post ->images as $image)
                            <div class="col-md-4">
                                <div class="card">
                                    <!-- use lity library in image   -->
                                    <a href="{{asset('storage/images'). '/' . $image->path}}" data-lity>
                                        <img src="{{asset('storage/images'). '/' . $image->path}}" height="150px"
                                             width="150px" class="card-img-top ">
                                    </a>

                                    {{--<div class="card-body"></div>--}}
                                    <div class="card-footer">
{{--                                        @can('upload-image',$post)--}}
                                            <form action="{{route('image.destroy', ['image'=>$image])}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class=" btn btn-danger"> delete</button>
                                            </form>
{{--                                        @endcan--}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p> No images in This Post </p>

                @endif

            </div>
        </div>
        <!--====================== form dropzone==================================-->
        <div class="row justify-content-center">
            <div class="col-md-10 ">
{{--                @can('upload-image',$post)--}}
                    <form action="{{route('posts.upload',['post'=>$post])}}" class="dropzone" id="myDropzoneForm">
                        @csrf
                    </form>
{{--                @endcan--}}
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        Dropzone.options.myDropzoneForm = {
            acceptedFiles: 'image/*',
            init: function () {
                this.on('success', function () {
                    if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {

                        // console.log('finish')
                        location.reload();
                    }
                });
            }
        }

    </script>

@endsection
