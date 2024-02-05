@extends('layouts.admin.app')

@section('content')

<div>
        <h2>{{trans('admin.admin')}}</h2>
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
                <form action="{{ route('inactive') }}" method="post"enctype="multipart/form-data">
                    @csrf
                    {{--name--}}
                    @if($accounts->sender_id==0)
                     <label> {{trans('admin.status')}}:</label>
                      <input  class="border" value="{{$accounts->status}}" disabled >
                    @else
                    <input  type="hidden" name="id" class="border"
                           value="{{ $accounts->id }}">

                                <input id="id" type="hidden" name="propperity_id" class="border"
                                value="{{ $accounts->propperity_id }}">

                       <input id="id" type="hidden" name="sender_id" class="border"
                           value="{{ $accounts->sender_id }}">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1"> {{trans('admin.status')}}
                            :</label>
                        <select  class="form-select" aria-label="Default select example" name="status"
                                 id="exampleFormControlTextarea1" placeholder="." style="border: 1px solid #e3e3e3;padding: 1rem;border-radius: 1px;font-size: 15px;" required>
                            <option type="hidden" value="{{$accounts->status}}">{{$accounts->status}}</option>
                            <option value="onhold">onhold</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>{{trans('admin.submit')}}</button>
                    </div>

                </form><!-- end of form -->
@endif
            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->
@endsection

