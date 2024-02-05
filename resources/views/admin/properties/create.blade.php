@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{trans('admin.admin')}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('overview') }}">{{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('properties.index') }}">{{trans('admin.Property')}}</a></li>
        <li class="breadcrumb-item">{{trans('admin.createProperty')}}</li>
    </ul>
    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow ">

                <form method="post" action="{{ route('properties.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    @include('admin.partials._errors')
                    {{--title--}}
                    <div class="form-group ">
                        <label>{{trans('admin.titleProperty')}} <span class="text-danger">*</span></label>
                        <input type="text" name="title" autofocus class="form-control" value="{{ old('title') }}" required>
                    </div>

                        {{--description--}}
                        <div class="form-group ">
                            <label>{{trans('admin.descriptionProperty')}} <span class="text-danger">*</span></label>
                            <input type="text" name="description" autofocus class="form-control" value="{{ old('description') }}" required>
                        </div>

                    {{--total_price--}}
                    <div class="form-group ">
                        <label>{{trans('admin.totalPriceProperty')}} <span class="text-danger">*</span></label>
                        <input type="number"  id ="total_price" name="total_price" class="form-control" value="{{ old('total_price') }}" required>
                    </div>


                    {{--total_units--}}
                    <div class="form-group ">
                        <label>{{trans('admin.total_unitsProperty')}} <span class="text-danger">*</span></label>
                        <input type="number"  id ="total_units" onkeyup="UnitPrice()" name="total_units" class="form-control" value="{{ old('total_units') }}" required>
                    </div>

                        {{--unit_price--}}
                        <div class="form-group ">
                            <label>{{trans('admin.unit_priceProperty')}} <span class="text-danger">*</span></label>
                            <input type="number" id ="unit_price" name="unit_price" autofocus class="form-control" value="{{ old('unit_price') }}" disabled required>
                        </div>

                    {{--min_investement--}}
                    <div class="form-group ">
                        <label>{{trans('admin.min_investementProperty')}} <span class="text-danger">*</span></label>
                        <input type="number" id="min_investement" name="min_investement" autofocus class="form-control" value="{{ old('min_investement') }}" onkeyup="InvestementPercentage()"  required>
                    </div>
                    
                    {{--last_investement_date--}}
                    <div class="form-group ">
                        <label>{{trans('admin.last_investement_dateProperty')}} <span class="text-danger">*</span></label>
                        <input type="date" name="last_investement_date" class="form-control" value="{{ old('last_investement_date') }}"  required>
                    </div>

                    <div class="form-group ">
                        <label>{{trans("admin.presenter")}} <span class="text-danger">*</span></label>
                        <input type="text" name="Name_of_own_box" autofocus class="form-control" value="{{ old('title') }}" required>
                    </div>
                    {{--investement_percentage--}}
                   
                      
                        <input  type="hidden" name="investement_percentage" rows="10" cols="30" class="form-control" value="0" required>
                  

                    {{--penefits_from_investement--}}
                    <div class="form-group ">
                        <label>{{trans('admin.penefits_from_investementProperty')}} <span class="text-danger">*</span></label>
                        <input id="confirm" type="number" name="penefits_from_investement" rows="10" cols="30" class="form-control" required >

                    </div>


                    <div class="form-group ">
                        <label>{{trans('admin.category_1')}} <span class="text-danger">*</span></label>
                        <input type="text" name="category_1" autofocus class="form-control" value="{{ old('title') }}" required>
                    </div>


                    <div class="form-group ">
                        <label>{{trans('admin.category_2')}} <span class="text-danger">*</span></label>
                        <input type="text" name="category_2" autofocus class="form-control" value="{{ old('title') }}" >
                    </div>





                    <div class="form-group ">
                        <label>{{trans('admin.category_3')}} <span class="text-danger">*</span></label>
                        <input type="text" name="category_3" autofocus class="form-control" value="{{ old('title') }}" >
                    </div>



                    <div class="form-group ">
                        <label>{{trans('admin.location')}} <span class="text-danger">* {{trans('admin.must')}}</span></label>
                        <input type="text" name="location" autofocus class="form-control" value="{{ old('title') }}" required>
                    </div>


                      {{--files--}}
                      <div class="form-group ">
                        <label>{{trans('admin.file')}} <span class="text-danger">*{{trans('admin.file_n')}}</span></label>
                        <input
                        name="image[]"
                        type="file"
                        class="form-control"
                         multiple required>
                    </div>
                    <div class="form-group ">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>{{trans('admin.submit')}}</button>
                    </div>

                </form><!-- end of form -->

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
