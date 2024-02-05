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
    </ul>
    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <a href="{{ route('accounts_admin.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> {{trans('admin.money')}}</a>
                            <a href="{{ route('transformed') }}" class="btn btn-success" style="display: inline-block;"><i class="fa fa-plus"></i> {{trans('admin.mone')}}</a>
                        </div>
                    <div class="row">
                        <div class="container">
                        </div>
                        <div class="col-md-12">

                            <div class="table-responsive">

                                <table class="table datatable" id="admins-table" style="width: 100%;">
                                    <thead class="alldata">
                                    <tr>
                                        <th>{{trans('id')}}</th>
                                        <th>{{trans('admin.name')}}</th>
                                        <th>{{trans('admin.bank_balance')}}</th>
                                        <th>{{trans('admin.Action')}}</th>
                                    </tr>
                                    <tbody class="alldata">
                                    @foreach($admin as $adm)
                                            <tr>
                                                <td>
                                                    {{$adm->id}}
                                                </td>
                                                <td>
                                                    {{$adm->user->name}}
                                                </td>
                                                <td>
                                                    {{$adm->balance}}
                                                </td>
                                                <td><a href=" {{route('editaccount_admin',$adm->id)}}" class="btn btn-success btn-sm">{{trans('admin.withdrawss')}}</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                </table>

                            </div><!-- end of table responsive -->

                        </div><!-- end of col -->

                    </div><!-- end of row -->

                </div><!-- end of tile -->
            </div><!-- end of col -->

        </div><!-- end of row -->
        @endsection
