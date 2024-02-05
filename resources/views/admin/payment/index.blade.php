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
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item">{{trans('admin.accounts')}}</li>
    </ul>
    <div class="row">

        <div class="col-md-12">
            <div class="tile shadow">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <a href="{{ route('payment.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> {{trans('admin.pay')}}</a>
                    </div><!-- end of row -->

                    <div class="row">
                        <div class="container">
                        </div>
                        <div class="col-md-12">

                            <div class="table-responsive">
                                <table class="table datatable" id="admins-table" style="width: 100%;">
                                    <thead class="alldata">
                                    <tr>

                                        <th><b>{{ trans('admin.amount') }} @sortablelink('amount','↓↑')</b></th>
                                        <th>{{ trans('admin.type') }} </th>
                                        <th>{{ trans('admin.sender_id') }}</th>
                                        <th>{{ trans('admin.reciever_id') }}</th>
                                        <th>{{ trans('admin.created_at') }} @sortablelink('created_at','↓↑')</th>
                                        <th>{{ trans('admin.withdrawss') }}</th>

                                    </tr>
                                    <tbody class="alldata">
                                    @foreach($payments as $t)
                                        <tr id="sid{{ $t->id}}">
                                            <td>
                                                {{$t->amount}}</td>
                                            <td>
                                                {{$t->type}}
                                            </td>
                                            <td>
                                                Admin
                                            </td>
                                            <td>
                                                {{$t->reciever->client->name}}
                                            </td>

                                            <td>
                                                {{$t->created_at}}
                                            </td>
                                            <td><a href=" {{route('withdraws',$t->id)}}" class="btn btn-success btn-sm">{{ trans('admin.withdrawss') }}</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tbody id="Content" class="searchdata">
                                    </tbody>
                                    <thead class="searchdata" id="Content">
                                    </thead>
                                </table>

                            </div><!-- end of table responsive -->

                        </div><!-- end of col -->

                    </div><!-- end of row -->

                </div><!-- end of tile -->
            </div><!-- end of col -->

        </div><!-- end of row -->
@endsection
