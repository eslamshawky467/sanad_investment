@extends('layouts.admin.app')
@section('content')
    <div>
        <h2>{{trans('admin.admin')}}</h2>
    </div>
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('overview') }}">{{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('accounts.index') }}">{{trans('admin.accounts')}}</a></li>
    </ul>
    <div class="row">
        @if(session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
        </div>
    @endif
        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('accounts.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    @include('admin.partials._errors')
                    {{--name--}}
                        <input type="hidden" name="balance" autofocus class="form-control" value="0" required>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1"> {{trans('admin.name')}}
                            </label>
                        <select  class="form-select" aria-label="Default select example" name="user_id"
                                 id="exampleFormControlTextarea1" placeholder="." style="border: 1px solid #e3e3e3;padding: 1rem;border-radius: 1px;font-size: 15px;" required>
                            @foreach ($users as $user )
                                <option value="{{$user->id}}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{--email--}}
                    <div class="form-group ">
                        <label> {{trans('admin.file')}}<span class="text-danger">*</span></label>
                        <input
                            name="image[]"
                            type="file"
                            class="form-control"
                            multiple required>
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
@endpush
