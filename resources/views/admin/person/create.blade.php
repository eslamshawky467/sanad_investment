@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('admin.admin')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('overview') }}">{{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('person.index') }}">{{trans('admin.users')}}</a></li>
        
    </ul>

   
    <div class="row">
        <div class="col-md-12">

            <div class="tile shadow">
                <form method="post" action="{{ route('person.store') }}">
                    @csrf
                    @method('post')
                    @include('admin.partials._errors')

                    <div class="form-group">
                        <label>{{trans('admin.name')}} <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>


                    <div class="form-group">
                        <label>{{trans('admin.job')}} <span class="text-danger">*</span></label>
                        <input type="text" name="job" class="form-control" value="{{ old('job') }}" required>
                    </div>



                    <div class="form-group">
                        <label>{{trans('admin.link')}} <span class="text-danger">*</span></label>
                        <input type="text" name="link" class="form-control" value="{{ old('link') }}" required>
                    </div>


                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">property
                            :</label>
                        <select  class="form-select" aria-label="Default select example" name="property_id"
                                 id="exampleFormControlTextarea1" placeholder="." style="border: 1px solid #e3e3e3;padding: 1rem;border-radius: 1px;font-size: 15px;" required>
                            @foreach ($properties as $property )
                                <option value="{{$property->id}}">{{ $property->title }}</option>
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

