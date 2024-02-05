@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('admin.admin')</h2>
    </div>
        @if(session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
        </div>
    @endif
    @if(session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
        </div>
    @endif
    @if(session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
        </div>
    @endif
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('overview') }}">{{trans('admin.home')}}</a></li>
    
      
    </ul>
    <div class="row">
        <div class="col-md-12">

            <div class="tile shadow">
                <form method="post" action="{{ route('image.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    @include('admin.partials._errors')

                    <div class="form-group">
                        <label class="label">{{trans('admin.img')}} </label>
                        <input type="file" name="image" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>{{trans('admin.submit')}}</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->
@endsection

