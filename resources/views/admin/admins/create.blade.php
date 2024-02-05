@extends('layouts.admin.app')
@section('content')

    <div>
        <h2>{{trans('admin.admin')}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('overview') }}">{{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admins.index') }}">{{trans('admin.index')}}</a></li>
        <li class="breadcrumb-item">{{trans('admin.create')}}</li>
    </ul>
    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admins.store') }}">
                    @csrf
                    @method('post')

                    @include('admin.partials._errors')

                    {{--name--}}
                    <div class="form-group">
                        <label>{{trans('admin.name')}} <span class="text-danger">*</span></label>
                        <input type="text" name="name" autofocus class="form-control" value="{{ old('name') }}" required>
                    </div>

                    {{--email--}}
                    <div class="form-group">
                        <label>{{trans('admin.email')}} <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>

                    {{--password--}}
                    <div class="form-group">
                        <label>{{trans('admin.password')}} <span class="text-danger">*</span></label>
                        <input id="pass" type="password" name="password" rows="10" cols="30" class="form-control" required>
                        <br>
                        <input type="checkbox"  onclick="myFunction3()"
                               id="exampleCheck1"><span>{{trans('admin.show')}}</span>
                    </div>

                    {{--password_confirmation--}}
                    <div class="form-group">
                        <label>{{trans('admin.confirm')}} <span class="text-danger">*</span></label>
                        <input id="confirm" type="password" name="password_confirmation" rows="10" cols="30" class="form-control" required >
                        <br>
                        <input type="checkbox"  onclick="myFunction4()"
                               id="exampleCheck1"><span>{{trans('admin.show')}}</span>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>{{trans('admin.submit')}}</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->
@endsection
@push('scripts')
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
