@extends('layouts.admin.app')
@section('content')
    <div>
        <h2>{{ trans('admin.show_detail') }}</h2>
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

    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                <div class="row mb-2">
                    <div class="row">
                        <div class="container">
                            <div class ="search">
                                <label style="font-size: 30px; color:black"><b>{{ trans('admin.search') }}</b></label>
                                <input type ="search" name="search" id="search"
                                       placeholder="{{ trans('admin.searchby') }}" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-12">

                            <div class="table-responsive">

                                <table class="table datatable" id="admins-table" style="width: 100%;">
                                    <thead class="alldata">
                                    <tr>
                                        
                                        <th><b>{{ trans('admin.titleProperty') }} @sortablelink('title','↓↑')</b></th>
                                        <th>{{ trans('admin.unit_priceProperty') }}</th>
                                        <th>{{ trans('admin.invested_units') }}</th>
                                        <th>{{ trans('admin.invested_cost') }}</th>
                                        <th>{{ trans('admin.last_investement_dateProperty') }}</th>
                                        <th>{{ trans('admin.showstat') }}</th>z
                                    </tr>
                                    <tbody class="alldata">
                                    @foreach($investments as $i)
                                        <tr id="sid{{ $i->id}}">
                                          
                                            <td>
                                                {{$i->invest->title}}
                                            </td>
                                            <td>
                                                {{$i->invest->unit_price}}
                                            </td>

                                            <td>
                                                {{$i->units}}
                                            </td>
                                            <td>
                                                {{$i->cost}}
                                            </td>
                                            <td>
                                                {{$i->invest->last_investement_date}}
                                            </td>
                                            <td> <a href="{{route('show_investments',$i->id)}}" class="btn btn-primary btn-sm">{{ trans('admin.show_detail') }} </a></td>
                                            <td> <a href="{{route('show_active',$i->id)}}" class="btn btn-danger btn-sm">{{ trans('admin.active_invest') }}</a></td>
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
                {!! $investments->appends(\Request::except('page'))->render() !!}
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
                    url:'{{ URL::to('/search/investments')}}',
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
    @endpush
