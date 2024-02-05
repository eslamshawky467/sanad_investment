@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{ trans('admin.transactions') }}</h2>
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
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{route('overview')}}">{{ trans('admin.home') }}</a></li>
        <li class="breadcrumb-item">{{ trans('admin.transactions') }}</li>
    </ul>
    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <a href="{{ route('transactions.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>{{ trans('admin.create-t') }}</a>
                    </div><!-- end of row -->

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
                       
                        <th><b>{{ trans('admin.amount') }} @sortablelink('amount','↓↑')</b></th>
                        <th>{{ trans('admin.type') }} </th>
                        <th>{{ trans('admin.sender') }}</th>
                        <th>{{ trans('admin.sender_id') }}</th>
                        <th>{{ trans('admin.created_at') }} @sortablelink('created_at','↓↑')</th>
                      
                    </tr>
                    <tbody class="alldata">
                    @foreach($transactions as $t)
                        <tr id="sid{{ $t->id}}">
                          
                            <td>
                                {{$t->amount}}</td>
                            <td>
                                {{$t->type}}
                            </td>
                            <td>
                                {{$t->sender->client->name}}
                            </td>
                            <td>
                                {{$t->sender_id}}
                            </td>

                            <td>
                                {{$t->created_at}}
                            </td>
                            
                        </tr>
                    @endforeach
                    </tbody>
                    <tbody id="Content" class="searchdata">
                    </tbody>
                    <thead class="searchdata" id="Content">
                    </thead>
                </table>

            </div><!-- end of table responsive -->
                </div><!-- end of tile -->
    </div>
          <div>{!! $transactions->appends(\Request::except('page'))->render() !!}
            </div><!-- end of col -->


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
                    url:'{{ URL::to('search/transactions')}}',
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
