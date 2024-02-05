@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{trans('admin.admin')}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('overview') }}">{{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">{{trans('admin.users')}}</a></li>
        <li class="breadcrumb-item">{{trans('admin.edituser')}}</li>
    </ul>





    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">
                <form action="{{ route('users.update', 'test') }}" method="post"enctype="multipart/form-data">
                    {{ method_field('patch') }}
                    @csrf
                      @include('admin.partials._errors')
                    {{--name--}}
                    <input id="id" type="hidden" name="id" class="border"
                           value="{{ $users->id }}">
                    <div class="form-group">
                        <label>{{trans('admin.name')}} <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $users->name) }}" required>
                    </div>

                    {{--email--}}
                    <div class="form-group">
                        <label>{{trans('admin.email')}} <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $users->email) }}" required>
                    </div>



                    {{--email--}}
                    <div class="form-group">
                        <label>{{trans('admin.phone_number')}} <span class="text-danger">*</span></label>
                        <input type="number" name="phone_number" class="form-control" value="{{ old('phone_number', $users->phone_number) }}" required>
                    </div>
                    <div class="form-group">
                        <label>{{trans('admin.identity_card')}} <span class="text-danger">*</span></label>
                        <input type="number" name="identity_card" class="form-control" value="{{ old('identity_card', $users->identity_card) }}" required>
                    </div>


                   <!-- <input  type="hidden" name="password" class="form-control" value="password" required >-->
                   <!--<input  type="hidden" name="password_confirmation" class="form-control" value="password" required >-->

                    @if (app()->getLocale() == 'en')
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1"> {{trans('admin.country_id')}}
                                :</label>
                            <select  class="form-select" aria-label="Default select example" name="country_id"
                                     id="exampleFormControlTextarea1" placeholder="." style="border: 1px solid #e3e3e3;padding: 1rem;border-radius: 1px;font-size: 15px;" required>
                                <option type="hidden" value="{{$users->country_id}}">{{$users->Country->name_en}}</option>
                                @foreach ($countries as $country )
                                    <option value="{{$country->id}}">{{ $country->name_en }}</option>
                                @endforeach
                            </select>
                        </div>
                    @else

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1"> {{trans('admin.country_id')}}
                                :</label>
                            <select  class="form-select" aria-label="Default select example" name="country_id"
                                     id="exampleFormControlTextarea1" placeholder="." style="border: 1px solid #e3e3e3;padding: 1rem;border-radius: 1px;font-size: 15px;" required>
                                <option type="hidden" value="{{$users->country_id}}">{{$users->Country->name_ar}}</option>
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
                            <option type="hidden" value="{{$users->status}}">{{$users->status}}</option>
                            <option value="active">active</option>
                            <option value="inactive">inactive</option>
                        </select>
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
