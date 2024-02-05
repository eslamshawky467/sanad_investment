@extends('layouts.admin.app')
@section('content')

    <div>
        <h2>{{ trans('admin.Property') }}</h2>
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
        <li class="breadcrumb-item"><a href="{{route('overview')}}">{{ trans('admin.home') }}</a></li>
        <li class="breadcrumb-item">{{ trans('admin.Property') }}</li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                <div class="row mb-2">
                     <div class="col-md-12">
                        <a href="{{ route('properties.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>{{ trans('admin.createProperty') }}</a>
                    <form method="post" action="{{route('properties.bulk_delete')}}" style="display: inline-block;">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="record_ids" id="record-ids">
                        <button type="submit" class="btn btn-danger" id="bulk-delete" disabled="true"><i class="fa fa-trash"></i> {{ trans('admin.delete') }}</button>
                    </form><!-- end of form -->
                </div>
                    <div class="row">
                        <div class="container">
                            <div class ="search">
                                <label style="font-size: 30px; color:black"><b>{{ trans('admin.search') }}</b></label>
                                <input type ="search" name="search" id="search"
                                       placeholder="{{ trans('admin.search') }}" class="form-control"  style="width: 900%"; >
                            </div>
                        </div>
                        </div>
                        <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table datatable" id="admins-table" style="width: 100%;">
                                <thead class="alldata">
                                <tr>
                                    <th><input type="checkbox" id="checkboxall"/></th>
                                    <th><b>{{ trans('admin.titleProperty') }} @sortablelink('title','↓↑')</b></th>
                                    <th>{{ trans('admin.totalPriceProperty') }}</th>
                                    <th>{{ trans('admin.unit_priceProperty') }}</th>
                                    <th>{{ trans('admin.total_unitsProperty') }}</th>
                                    <th>{{ trans('admin.min_investementProperty') }}</th>
                                    <th>{{ trans('admin.last_investement_dateProperty') }}</th>
                                    <th>{{ trans('admin.penefits_from_investementProperty') }}</th>
                                    <th>{{ trans('admin.locationProperty') }}</th>
                                    <th>{{ trans('admin.remain_units') }}</th>
                                    <th>{{ trans('admin.status') }}</th>
                                    <th>{{ trans('admin.presenter') }}</th>
                                    <th>{{ trans('admin.edit') }}</th>
                                    <th>{{ trans('admin.delete') }}</th>
                                </tr>
                                <tbody class="alldata">
                                @foreach($properties as $property)
                                <tr id="sid{{ $property->id}}">
                                    <td>
                                        <input type="checkbox" name="ids[{{ $property->id }}]" class="checkbox" value="{{ $property->id }}"/>
                                    </td>
                                        <td>{{$property->title}}</td>
                                        <td>{{$property->total_price}}</td>
                                        <td>{{$property->unit_price}}</td>
                                        <td>{{$property->total_units}}</td>
                                        <td>{{$property->min_investement}}</td>
                                        <td>{{$property->last_investement_date}}</td>
                                        <td>{{$property->penefits_from_investement}}</td>
                                        <td>{{$property->location}}</td>
                                        <td>{{$property->remain_units}}</td>
                                       <td>{{$property->status}}</td>
                                    <td>{{$property->Name_of_own_box}}</td>
                                   <td><a href="{{route('properties.edit',$property->id)}}" class="btn btn-success btn-sm">{{ trans('admin.edit') }}</a></td>
                                    <td><a href="{{route('properties.DeleteProperity',$property->id)}}" class="btn btn-danger btn-sm">{{ trans('admin.delete') }}</a></td>

                                </tr>
                                @endforeach
                                </tbody>
                                <tbody id="Content" class="searchdata">
                                </tbody>
                                <thead class="searchdata" id="Content">
                                </thead>
                            </table>
                            </table>

                        </div><!-- end of table responsive -->
                
                    </div><!-- end of col -->

                </div><!-- end of row -->

            </div><!-- end of tile -->
                {!! $properties->appends(\Request::except('page'))->render() !!}
        </div><!-- end of col -->

    </div><!-- end of row -->
        <script type="text/javascript">
            $('#search').on('keyup',function(){
                $value=$(this).val();
                if($value)
                {
                    $('.alldata').hide();
                    $('.searchdata').show();
                }
                else{
                    $('.alldata').show();
                    $('.searchdata').hide();
                }
                $.ajax({
                    type:'get',
                    url:'{{ URL::to('search/properity')}}',
                    data:{'search':$value},
                    success:function(data){
                        console.log(data);
                        $('#Content').html(data);
                    }
                });
            })
        </script>
@endsection
@push('scripts')
            <script>
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            </script>
            <script>
                $(document).on('change', '.checkbox', function () {
                    getSelectedRecords();
                });
                // used to select all records
                $(document).on('change', '#checkboxall', function () {
                    $('.checkbox').prop('checked', this.checked);
                    getSelectedRecords();
                });
                function getSelectedRecords() {
                    var recordIds = [];
                    $.each($(".checkbox:checked"), function () {
                        recordIds.push($(this).val());
                    });
                    $('#record-ids').val(JSON.stringify(recordIds));
                    recordIds.length > 0
                        ? $('#bulk-delete').attr('disabled', false)
                        : $('#bulk-delete').attr('disabled', true)
                }
            </script>

<script>
    $('.selectAll').on('click', function () {
       const allCheckedCheckbox = $(this);
       $('.myChexbox').each(function () {
           $(this).prop('checked', allCheckedCheckbox.prop('checked'));
       });
   });

   </script>
@endpush
























