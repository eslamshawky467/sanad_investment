@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{trans('admin.admin')}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('overview') }}">{{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('properties.index') }}">{{trans('admin.Property')}}</a></li>
        <li class="breadcrumb-item">{{trans('admin.edit')}}</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">


                <form method="post" action="{{ route('properties.updateProperity',$property->id) }}">
                    @csrf
                    @method('post')
                    @include('admin.partials._errors')
                    {{--title--}}
                    <div class="form-group ">
                        <label>{{trans('admin.titleProperty')}} <span class="text-danger">*</span></label>
                        <input type="text" name="title" autofocus class="form-control" value="{{ old('title', $property->title) }}" required>
                    </div>


                    {{--description--}}
                    <div class="form-group ">
                        <label>{{trans('admin.descriptionProperty')}} <span class="text-danger">*</span></label>
                        <input type="text" name="description" autofocus class="form-control" value="{{ old('description', $property->description) }}" required>
                    </div>

                    {{--total_price--}}
                    <div class="form-group ">
                        <label>{{trans('admin.totalPriceProperty')}} <span class="text-danger">*</span></label>
                        <input type="number"  id ="total_price" name="total_price" class="form-control" value="{{ old('total_price',$property->total_price) }}" required>
                    </div>

                    <div class="form-group ">
                        <label>{{trans('admin.location')}} <span class="text-danger">* {{trans('admin.must')}}</span></label>
                        <input type="text" name="location" autofocus class="form-control" value="{{$property->location}}" required>
                    </div>
                    <div class="form-group ">
                        <label>{{trans('admin.presenter')}} <span class="text-danger">*</span></label>
                        <input type="text" name="Name_of_own_box" autofocus class="form-control" value="{{$property->Name_of_own_box}}" required>
                    </div>
                    {{--total_units--}}
                    <div class="form-group ">
                        <label>{{trans('admin.total_unitsProperty')}} <span class="text-danger">*</span></label>
                        <input type="number"  id ="total_units" onkeyup="UnitPrice()" name="total_units" class="form-control" value="{{ old('total_units',$property->total_units) }}" required>
                    </div>

                    {{--unit_price--}}
                    <div class="form-group ">
                        <label>{{trans('admin.unit_priceProperty')}} <span class="text-danger">*</span></label>
                        <input type="number" id ="unit_price" name="unit_price" autofocus class="form-control" value="{{$property->unit_price}}" disabled required>
                    </div>

                    {{--min_investement--}}
                    <div class="form-group ">
                        <label>{{trans('admin.min_investementProperty')}} <span class="text-danger">*</span></label>
                        <input type="number" id="min_investement" name="min_investement" autofocus class="form-control" value="{{ old('min_investement',$property->min_investement) }}"  onkeyup="InvestementPercentage()"  required>
                    </div>
                  
                    {{--last_investement_date--}}
                    <div class="form-group ">
                        <label>{{trans('admin.Last investment date before')}} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{$property->last_investement_date}}" disabled>
                        <label>{{trans('admin.last_investement_dateProperty')}}  <span class="text-danger">*</span></label>
                        <input type="date" name="last_investement_date" class="form-control" value="{{$property->last_investement_date}}"  required>
                    </div>

                  
                    <input  type="hidden" name="investement_percentage" rows="10" cols="30" class="form-control" value="0" required>
                  
                  

                    {{--penefits_from_investement--}}
                    <div class="form-group ">
                        <label>{{trans('admin.penefits_from_investementProperty')}} <span class="text-danger">*</span></label>
                        <input id="confirm" type="number" name="penefits_from_investement" rows="10" cols="30" class="form-control" value="{{ old('penefits_from_investement',$property->penefits_from_investement) }}"required >

                    </div>


                    <div class="form-group ">
                        <label>{{trans('admin.category_1')}} <span class="text-danger">*</span></label>
                        <input type="text" name="category_1" autofocus class="form-control" value="{{ old('category_1', $property->category_1) }}" required>
                    </div>


                    <div class="form-group ">
                        <label>{{trans('admin.category_2')}} <span class="text-danger">*</span></label>
                        <input type="text" name="category_2" autofocus class="form-control" value="{{ old('category_2', $property->category_2) }}">
                    </div>



                    <div class="form-group ">
                        <label>{{trans('admin.category_3')}} <span class="text-danger">*</span></label>
                        <input type="text" name="category_3" autofocus class="form-control" value="{{ old('category_3', $property->category_3) }}" >
                    </div>



                    {{--files--}}



                    <div class="form-group ">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>{{trans('admin.submit')}}</button>
                    </div>

                </form>

                <!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection
@push('scripts')
    <script>
        function UnitPrice() {
            // alert('welcome');
            let totalPrice = document.getElementById("total_price").value;
            let totalUnits = document.getElementById("total_units").value;
            document.getElementById("unit_price").value = totalPrice/totalUnits;
        }

    </script>
    <script>

        function InvestementPercentage() {
            // alert('welcome');
            let totalPrice = document.getElementById("total_price").value;
            let totalUnits = document.getElementById("total_units").value;
            let investPrice = document.getElementById("min_investement").value;
            var unitPrice = totalPrice/totalUnits;
            var persentage =investPrice/unitPrice *100;
            document.getElementById("investement_percentage").value = persentage ;

        }

    </script>

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
