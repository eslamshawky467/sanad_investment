@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{trans('admin.admin')}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('overview') }}">{{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('settings.index') }}">{{trans('admin.settings')}}</a></li>
        <li class="breadcrumb-item">{{trans('settings.create')}}</li>
    </ul>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow ">

                <form method="post" action="{{ route('settings.update',$setting->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                <input type="hidden" name="id" value="{{ $setting->id }}">
                    {{--title_ar--}}
                    <div class="form-group ">
                        <label>{{trans('settings.title_ar')}} <span class="text-danger">*</span></label>
                        <input type="text" name="title_ar" autofocus class="form-control" value="{{ old('title_ar',$setting->title_ar) }}" required>
                    </div>

                    {{--title_en--}}
                    <div class="form-group ">
                        <label>{{trans('settings.title_en')}} <span class="text-danger">*</span></label>
                        <input type="text" name="title_en" autofocus class="form-control" value="{{ old('title_en',$setting->title_en) }}" required>
                    </div>

                    {{--body_ar--}}
                    <div class="form-group ">
                        <label>{{trans('settings.body_ar')}} <span class="text-danger">*</span></label>
                        <textarea class="form-control"  name="body_ar" value="{{ old('body_ar') }}" required>{!! $setting->content_ar !!}</textarea>
                        {{-- <input type="text" name="body_ar" autofocus class="form-control" value="{{ old('body_ar') }}" required> --}}
                    </div>

                    {{--body_en--}}
                    <div class="form-group ">
                        <label>{{trans('settings.body_en')}} <span class="text-danger">*</span></label>
                        <textarea class="form-control"  name="body_en" value="{{ old('body_en') }}" required>{!! $setting->content_en !!}</textarea>

                        {{-- <input type="text" name="body_en" autofocus class="form-control" value="{{ old('body_en') }}" required> --}}
                    </div>
{{-- @dump($setting->content_en) --}}
                    {{--type--}}
                    <input type="hidden"  id ="type" name="type" class="form-control" value="{{ old('type',$setting->type) }}" required>

                    <div class="form-group ">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>{{trans('admin.submit')}}</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->
@endsection
@push('scripts')


    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>
<script src="http://cdn.ckeditor.com/4.11.1/full/ckeditor.js"></script>
{{-- <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script> --}}
    <script>
   CKEDITOR.replace( 'summary-ckeditor-body-ar' );;
    </script>
     <script>
        CKEDITOR.replace( 'summary-ckeditor-body-en' );;
         </script>
<script>
<script>
function myFunction3() {
var x = document.getElementById("pass");
if (x.type === "password") {
x.type = "text";
} else {
x.type = "password";
}
}
function myFunction4() {
var x = document.getElementById("confirm");
if (x.type === "password") {
x.type = "text";
} else {
x.type = "password";
}
}
</script>
@endpush