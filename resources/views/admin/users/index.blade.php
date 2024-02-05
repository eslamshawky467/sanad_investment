@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{trans('admin.users')}}</h2>
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
        <li class="breadcrumb-item">{{trans('admin.users')}}</li>
    </ul>

    <div class="row">

        <div class="col-md-12">
            <div class="tile shadow">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> {{trans('admin.createuser')}}</a>
                        <form method="post" action="{{route('user.bulk_delete')}}" style="display: inline-block;">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="record_ids" id="record-ids">
                            <button type="submit" class="btn btn-danger" id="bulk-delete" disabled="true"><i class="fa fa-trash"></i> {{trans('admin.block')}}</button>
                        </form><!-- end of form -->
                    </div><!-- end of row -->

                    <div class="row">
                        <div class="container">
                            <div class ="search">
                                <label style="font-size: 30px; color:black"><b>{{trans('admin.search')}}</b></label>
                                <input type ="search" name="search" id="search"
                                       placeholder="{{trans('admin.search')}}" class="form-control" style="width: 890%"; >
                            </div>
                        </div>
                        </div>
                        <div class="col-md-12">

                            <div class="table-responsive">

                                <table class="table datatable" id="admins-table" style="width: 100%;">
                                    <thead class="alldata">
                                    <tr>
                                        <th><input type="checkbox" id="checkboxall"/></th>
                                        <th><b>{{trans('admin.name')}} @sortablelink('name','↓↑')</b></th>
                                        <th>{{trans('admin.email')}}</th>
                                        <th>{{trans('admin.phone_number')}}</th>
                                        <th>{{trans('admin.identity_card')}}</th>
                                        <th>{{trans('admin.country_id')}}</th>
                                        <th>{{trans('admin.edit')}}</th>
                                        <th>{{trans('admin.block')}}</th>
                                    </tr>
                                    <tbody class="alldata">
                                    @foreach($users as $user)
                                        <tr id="sid{{ $user->id}}">
                                            <td>
                                                <input type="checkbox" name="ids[{{ $user->id }}]" class="checkbox" value="{{ $user->id }}"/>
                                            </td>
                                            <td>
                                                {{$user->name}}</td>
                                            <td>
                                                {{$user->email}}
                                            </td>
                                            <td>
                                                {{$user->phone_number}}
                                            </td>
                                            <td>
                                                {{$user->identity_card}}
                                            </td>
                                            @if (app()->getLocale() == 'en')
                                            <td>
                                                {{$user->Country->name_en}}
                                            </td>
                                            @else
                                            <td>
                                                {{$user->Country->name_ar}}
                                            </td>
                                            @endif
                                            <td><a href=" {{route('edituser',$user->id)}}" class="btn btn-success btn-sm">{{trans('admin.edit')}}</a></td>
                                            <td><a href="{{route('deleteuser',$user->id)}}" class="btn btn-danger btn-sm">{{trans('admin.block')}}</a></td>
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
   {!! $users->appends(\Request::except('page'))->render() !!}
                </div><!-- end of tile -->
             
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
                    url:'{{ URL::to('search/user')}}',
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
