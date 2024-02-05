@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('admin.admin')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('overview') }}">{{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">{{trans('admin.users')}}</a></li>
        <li class="breadcrumb-item">{{trans('admin.createuser')}}</li>
    </ul>
    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('users.store') }}">
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



                    {{--email--}}
                    <div class="form-group">
                        <label>{{trans('admin.phone_number')}} <span class="text-danger">*</span></label>
                        <input type="number" name="phone_number" class="form-control" value="{{ old('phone_number') }}" required>
                    </div>

                    <div class="form-group">
                        <label>{{trans('admin.identity_card')}} <span class="text-danger">*</span></label>
                        <input type="number" name="identity_card" class="form-control" value="{{ old('identity_card') }}" required>
                    </div>




                    {{--password--}}

                    <input type="hidden"  name="password"  class="form-control" value="password" required>


                    {{--password_confirmation--}}
                    @if (app()->getLocale() == 'en')
                    <input  type="hidden" name="password_confirmation" class="form-control" value="password" required >
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1"> {{trans('admin.country_id')}}
                            :</label>
                        <select  class="form-select" aria-label="Default select example" name="country_id"
                                 id="exampleFormControlTextarea1" placeholder="." style="border: 1px solid #e3e3e3;padding: 1rem;border-radius: 1px;font-size: 15px;" required>
                            @foreach ($countries as $country )
                                <option value="{{$country->id}}">{{ $country->name_en }}</option>
                            @endforeach
                        </select>
                    </div>
                    @else
                            <input  type="hidden" name="password_confirmation" class="form-control" value="password" required >
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1"> {{trans('admin.country_id')}}
                                    :</label>
                                <select  class="form-select" aria-label="Default select example" name="country_id"
                                         id="exampleFormControlTextarea1" placeholder="." style="border: 1px solid #e3e3e3;padding: 1rem;border-radius: 1px;font-size: 15px;" required>
                                    @foreach ($countries as $country )
                                        <option value="{{$country->id}}">{{ $country->name_ar }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1"> Status
                            :</label>
                        <select  class="form-select" aria-label="Default select example" name="status"
                                 id="exampleFormControlTextarea1" placeholder="." style="border: 1px solid #e3e3e3;padding: 1rem;border-radius: 1px;font-size: 15px;" required>
                            <option value="active">active</option>
                            <option value="inactive">inactive</option>
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
