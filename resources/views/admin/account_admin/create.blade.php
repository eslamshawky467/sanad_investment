@extends('layouts.admin.app')
@section('content')
    <div>
        <h2>{{trans('admin.admin')}}</h2>
    </div>
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('overview') }}">{{trans('admin.home')}}</a></li>
     
    </ul>
    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('accounts_admin.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    @include('admin.partials._errors')

                    {{--name--}}
                    <div class="form-group">
                        <label>{{trans('admin.amount')}} <span class="text-danger">*</span></label>
                        <input type="number" name="balance" autofocus class="form-control" value="{{ old('balance') }}" required>
                    </div>
                    <input type="hidden" name="admin_id" value="1">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>{{trans('admin.submit')}}</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->
@endsection
@push('scripts')
@endpush
