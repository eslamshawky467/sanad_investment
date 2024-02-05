@extends('layouts.admin.app')

@section('content')
 <a class="btn btn-primary" href="{{ URL::to('/info/pdf') }}">Export to PDF</a>
 
    <div class="row" >
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-success">
                                <i class="fa fa-users fa-5x" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">{{trans('admin.manyusers')}} </p>
                            <h4>{{\App\Models\Client::count()}}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <a href="{{route('users.index')}}" target="_blank"><span class="text-danger">{{trans('admin.showdata')}}</span></a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-warning">
                               <i class="fa fa-users fa-5x" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark"></p>{{trans('admin.manyaccounts')}} </p>
                            <h4>{{\App\Models\Account::count()}}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        </i><a href="{{route('accounts.index')}}" target="_blank"><span class="text-danger">{{trans('admin.showdata')}} </span></a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-success">
                               <i class="fa fa-money fa-5x" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark"> {{trans('admin.moneysanad')}}   </p>
                            <h4>{{$money}} {{trans('admin.QAR')}}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <a href="{{route('accounts_admin.index')}}" target="_blank"><span class="text-danger">{{trans('admin.showdata')}}</span></a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-primary">
                                  <i class="fa fa-money fa-5x" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">  {{trans('admin.moneyinvest')}}   </p>
                            <h4>{{$onhold}} {{trans('admin.QAR')}}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <a href="{{route('investments.index')}}" target="_blank"><span class="text-danger">{{trans('admin.showdata')}}</span></a>
                    </p>
                </div>
            </div>
        </div>
        
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-primary">
                              <i class="fa fa-money fa-5x" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">  {{trans('admin.allmoney')}}   </p>
                            <h4>{{$balanced}} {{trans('admin.QAR')}}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                       <a href="{{route('transactions.index')}}" target="_blank"><span class="text-danger">{{trans('admin.showdata')}} </span></a>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-primary">
                             <i class="fa fa-building-o fa-5x"  aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">  {{trans('admin.unitsremain')}}    </p>
                            <h4>{{$remain}}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <a href="{{route('properties.index')}}" target="_blank"><span class="text-danger">{{trans('admin.showdata')}}</span></a>
                    </p>
                </div>
            </div>
        </div>
        
                   
        
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-primary">
                                 <i class="fa fa-building-o fa-5x"  aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">  {{trans('admin.allunits')}}        </p>
                            <h4>{{$total}}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <a href="{{route('properties.index')}}" target="_blank"><span class="text-danger">{{trans('admin.showdata')}}</span></a>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-primary">
                                <i class="fa fa-building-o fa-5x"  aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">   {{trans('admin.units_invested')}}       </p>
                            <h4>{{$inv}}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <a href="{{route('investments.index')}}" target="_blank"><span class="text-danger">{{trans('admin.showdata')}}</span></a>
                    </p>
                </div>
            </div>
        </div>
        
    </div>
    <!-- Orders Status widgets-->


    <div class="row">

        <div  style="height: 400px;" class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="tab nav-border">
                        <div class="d-block d-md-flex justify-content-between">
                            <div class="d-block w-100">
                                <h4>        {{trans('admin.userin')}}    </h4>
                            </div>
                            <div class="d-block d-md-flex nav-tabs-custom">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content" id="myTabContent">

                            {{--students Table--}}
                            <div class="tab-pane fade active show" id="students" role="tabpanel" aria-labelledby="students-tab">
                                <div class="table-responsive mt-15">
                                    <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                        <thead>
                                        <tr  class="table-info text-danger">
                                            <th>#</th>
                                            <th>{{trans('admin.name')}} </th>
                                            <th> {{trans('admin.status')}}  </th>
                                            <th>{{trans('admin.created_at')}} </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse(\App\Models\Client::latest()->take(5)->get() as $student)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$student->name}}</td>
                                                <td>{{$student->status}}</td>
                                                <td class="text-success">{{$student->created_at}}</td>
                                                @empty
                                                    <td class="alert-danger" colspan="8">{{trans('admin.nodata')}}</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

