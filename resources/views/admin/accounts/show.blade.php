
@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{trans('admin.accounts')}}</h2>
    </div>
    @if(session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
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
                    <div class="row">
                        <div class="container">
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table datatable" id="admins-table" style="width: 100%;">
                                    <label style="font-size: 30px; color:black"><b>{{ trans('admin.file') }}</b></label>
                                    <thead class="alldata">
                                    <tr>
                                        <th><b>{{ trans('admin.file') }}</b></th>
                                        <th>{{ trans('admin.delete') }}</th>
                                    </tr>
                                    
                                    <tbody class="alldata">
                                        
                                    @foreach($accounts->file as $file)

                                        @php
                                            $name=explode('/',$file->file_name);
                                        @endphp
                                        {{-- @dump($file->url()) --}}
                                        <!--<form action="{{ route('download')}}" method="post">-->
                                        <!--    @csrf-->
                                        <!--    <h4>{{ end($name)}}</h4>-->

                                        <!--    <input type="hidden" name="file" value="{{$file->file_name}}">-->
                                        <!--    <input type="submit" value="download">-->
                                        <!--</form>-->
<tr>
                                        <td> <a href="{{$file->file_name}}" download="">{{ end($name)}}</a></td>
                                        <td>  <a href="{{route('deletefile',$file->id)}}" class="btn btn-danger btn-sm">{{trans('admin.delete')}}</a></td>
                                        </tr>
                                    @endforeach
                                    
                                    </tbody>
                                    </thead>
                                </table>

                            </div><!-- end of table responsive -->

                        </div><!-- end of col -->

                    </div><!-- end of row -->

                </div><!-- end of tile -->
            </div><!-- end of col -->

        </div><!-- end of row -->

@endsection







