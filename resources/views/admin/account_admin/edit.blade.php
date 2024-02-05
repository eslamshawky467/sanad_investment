@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{trans('admin.admin')}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('overview') }}">{{trans('admin.home')}}</a></li>
      
        <li class="breadcrumb-item">{{trans('admin.edit')}}</li>
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
                <form action="{{ route('accounts_admin.update', 'test') }}" method="post"enctype="multipart/form-data">
                    {{ method_field('patch') }}
                    @csrf
                    {{--name--}}
                    <input id="id" type="hidden" name="id" class="border"
                           value="{{ $admin->id }}">
                    <input id="id" type="hidden" name="admin_id" class="border"
                           value="{{ $admin->admin_id }}">
                    <div class="form-group">
                        <label>{{trans('admin.amount')}} <span class="text-danger">*</span></label>
                        <input type="text" name="balance" class="form-control" value="{{ old('balance')}}" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>{{trans('admin.submit')}}</button>
                    </div>
                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection
