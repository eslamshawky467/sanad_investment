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
                <form method="post" action="{{ route('withdrawn') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    @include('admin.partials._errors')
                    {{--name--}}
                    <div class="form-group">
                        <label>{{trans('admin.now')}} <span class="text-danger"></span></label>
                        <input type="number" value="{{$amount}}" disabled >
                    </div>
                        <input type="hidden" name="process" value="{{$admin->id}}">

                    <div class="form-group">
                        <label>{{trans('admin.amount')}} <span class="text-danger">*</span></label>
                        <input type="number" name="balance" autofocus class="form-control" value="{{ old('balance') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">{{trans('admin.Reciever_Name')}}
                            :</label>
                        <select  class="form-select" aria-label="Default select example" name="reciever_id"
                                 id="exampleFormControlTextarea1" placeholder="." style="border: 1px solid #e3e3e3;padding: 1rem;border-radius: 1px;font-size: 15px;" required>
                            @foreach($accounts as $account)
                                <option value="{{$account->id}}">{{$account->client->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">{{trans('admin.Reciever_Email')}}
                            :</label>
                        <select  class="form-select" aria-label="Default select example" name="email"
                                 id="exampleFormControlTextarea1" placeholder="." style="border: 1px solid #e3e3e3;padding: 1rem;border-radius: 1px;font-size: 15px;" required>
                            @foreach($accounts as $account)
                                <option value="{{$account->client->email}}"> {{$account->client->name}}</option>
                            @endforeach
                        </select>

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
