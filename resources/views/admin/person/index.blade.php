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
                        <a href="{{ route('person.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> {{trans('admin.persons')}}</a>
                    </div><!-- end of row -->

                    <div class="row">
                        <div class="container">
                        </div>
                        <div class="col-md-12">

                            <div class="table-responsive">
                                <table class="table datatable" id="admins-table" style="width: 100%;">
                                    <thead class="alldata">
                                    <tr>
                                       
                                        <th><b>{{ trans('admin.name') }}</b></th>
                                        <th>{{ trans('admin.job') }} </th>
                                        <th>{{ trans('admin.link') }} </th>
                                        <th>{{ trans('admin.titleProperty') }} </th>
                                        <th>{{ trans('admin.edit') }}</th>
                                        <th>{{ trans('admin.delete') }}</th>
                                    </tr>
                                    <tbody class="alldata">
                                    @foreach($person as $p)
                                        <tr id="sid{{ $p->id}}">
                                    
                                            <td>
                                                {{$p->name}}</td>
                                            <td>
                                                {{$p->job}}
                                            </td>
                                            <td>
                                                {{$p->link}}
                                            </td>
                                            <td>
                                                {{$p->property->title}}
                                            </td>
                                            <td><a href=" {{route('editperson',$p->id)}}" class="btn btn-success btn-sm">{{ trans('admin.edit') }}</a></td>
                                            <td><a href="{{route('deleteperson',$p->id)}}" class="btn btn-danger btn-sm">{{ trans('admin.delete') }}</a></td>
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
