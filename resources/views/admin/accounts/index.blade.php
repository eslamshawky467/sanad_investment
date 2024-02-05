@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{trans('admin.accounts')}}</h2>
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
        <li class="breadcrumb-item"><a href="{{route('overview')}}">{{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item">{{trans('admin.accounts')}}</li>
    </ul>

    <div class="row">

        <div class="col-md-12">
            <div class="tile shadow">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <a href="{{ route('accounts.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> {{trans('admin.Accounts')}}</a>
                        <form method="post" action="{{route('account.bulk_delete')}}" style="display: inline-block;">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="record_ids" id="record-ids">
                            <button type="submit" class="btn btn-danger" id="bulk-delete" disabled="true"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</button>
                        </form><!-- end of form -->
                    </div><!-- end of row -->

                    <div class="row">
                        <div class="container">
                            <div class ="search">
                                <label style="font-size: 30px; color:black"><b>{{trans('admin.search')}}</b></label>
                                <input type ="search" name="search" id="search"
                                       placeholder="{{trans('admin.search')}}" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-12">

                            <div class="table-responsive">

                                <table class="table datatable" id="admins-table" style="width: 100%;">
                                    <thead class="alldata">
                                    <tr>
                                        <th><input type="checkbox" id="checkboxall"/></th>
                                        <th>{{trans('admin.name')}}</th>
                                        <th>{{trans('admin.bank_balance')}}</th>
                                        <th>{{trans('admin.user_id')}}</th>
                                        <th>{{trans('admin.status')}}</th>
                                        <th>{{trans('admin.Action')}}</th>
                                    </tr>
                                    <tbody class="alldata">
                                    @foreach($accounts as $account)
                                        @if($account->status!='pending')
                                        <tr id="sid{{ $account->id}}">
                                            <td>
                                                <input type="checkbox" name="ids[{{ $account->id }}]" class="checkbox" value="{{ $account->id }}"/>
                                            </td>
                                            <td>
                                                    {{$account->client->name}}
                                            </td>
                                            <td>
                                                {{$account->balance}}
                                            </td>
                                            <td>
                                                {{$account->id}}
                                            </td>
                                            <td>
                                                {{$account->status}}</td>

                                            <td><a href=" {{route('editaccount',$account->id)}}" class="btn btn-success btn-sm">{{trans('admin.edit')}}</a>
                                          
                                            <a href="{{route('show_details',$account->id)}}" class="btn btn-primary btn-sm">{{trans('admin.details')}}</a></td>
                                        </tr>

                                                @else

                                    <tbody class="alldata">
                                    <tr id="sid{{ $account->id}}">
                                        <td>
                                            <input type="checkbox" name="ids[{{ $account->id }}]" class="checkbox" value="{{ $account->id }}"/>
                                        </td>
                                        <td>
                                                {{$account->client->name}}
                                        </td>

                                        <td>
                                            {{$account->balance}}
                                        </td>
                                        <td>
                                            {{$account->on_hold_balance}}
                                        </td>
                                        <td>
                                            {{$account->status}}</td>
                                        <td><a href=" {{route('approved',$account->id)}}" class="btn btn-success btn-sm">{{trans('admin.approved')}}</a>
                                        <a href="{{route('canceled',$account->id)}}" class="btn btn-danger btn-sm">{{trans('admin.canceled')}}</a>
                                        <a href="{{route('show_details',$account->id)}}" class="btn btn-danger btn-sm">{{trans('admin.showmore')}}</a></td>
                                    </tr>
@endif
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
                {!! $accounts->appends(\Request::except('page'))->render() !!}
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
                    url:'{{ URL::to('search/accounts')}}',
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
