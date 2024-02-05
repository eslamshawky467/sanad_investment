@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{trans('admin.admin')}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admins.index') }}">{{trans('admin.index')}}</a></li>
        <li class="breadcrumb-item">{{trans('admin.editprofile')}}</li>
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

            <div class="tile shadow">
                <form action="{{ route('admins.update', 'test') }}" method="post"enctype="multipart/form-data">
                    {{ method_field('patch') }}
                    @csrf
                    {{--name--}}
                    <input id="id" type="hidden" name="id" class="border"
                           value="{{ $admins->id }}">
                    <div class="form-group">
                        <label>{{trans('admin.name')}} <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $admins->name) }}" required>
                    </div>

                    {{--email--}}
                    <div class="form-group">
                        <label>{{trans('admin.email')}} <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $admins->email) }}" required>
                    </div>

                    {{--password--}}
                    <div class="form-group">
                        <label>{{trans('admin.password')}} <span class="text-danger">*</span></label>
                        <input id="pass" type="password" name="password" rows="10" cols="30" class="form-control">
                        <br>
                        <input type="checkbox"  onclick="myFunction()"
                               id="exampleCheck1"><span>{{trans('admin.show')}}</span>
                    </div>

                    {{--password_confirmation--}}
                    <div class="form-group">
                        <label>{{trans('admin.confirm')}} <span class="text-danger">*</span></label>
                        <input id="confirm" type="password" name="password_confirmation" rows="10" cols="30" class="form-control"  >
                        <br>
                        <input type="checkbox"  onclick="myFunction2()"
                               id="exampleCheck1"><span>{{trans('admin.show')}}</span>
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>{{trans('admin.submit')}}</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection
@push('scripts')
    <script>
        function myFunction() {
            var x = document.getElementById("pass");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
        function myFunction2() {
            var x = document.getElementById("confirm");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@endpush
