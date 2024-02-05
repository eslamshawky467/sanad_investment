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

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('make_invest') }}">
                    @csrf
                    @method('post')

                    @include('admin.partials._errors')
                    <div class="form-group ">
                        <label>{{trans('admin.many')}} <span class="text-danger"></span></label>
                        <input type="text" name="units" autofocus class="form-control" value="{{ old('units') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">{{trans('admin.propup')}}
                            :</label>
                        <select  class="form-select" aria-label="Default select example" name="propperity_id"
                                 id="exampleFormControlTextarea1" placeholder="." style="border: 1px solid #e3e3e3;padding: 1rem;border-radius: 1px;font-size: 15px;" required>
                            @foreach ($properties as $property )
                                <option value="{{$property->id}}">{{ $property->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group ">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>{{trans('admin.submit')}}</button>
                    </div>

                </form>

                <!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection

