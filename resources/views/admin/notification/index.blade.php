@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{ trans('admin.notify') }}</h2>
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
                    <div class="col-md-12">
                        <a href="{{ route('notifications') }}" class="btn btn-primary"><i class="fa fa-plus"></i>{{ trans('admin.notify') }}</a>
                    </div><!-- end of row -->
                    <div class="row">
                        <div class="container">
                            <div class ="search">
                                <label style="font-size: 30px; color:black"><b>{{ trans('admin.search') }}</b></label>
                                <input type ="search" name="search" id="search"
                                       placeholder="{{ trans('admin.search') }}" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-12">

                            <div class="table-responsive">

                                <table class="table datatable" id="admins-table" style="width: 100%;">
                                    <thead class="alldata">
                                    <tr>

                                        <th>{{ trans('admin.title') }} </th>
                                        <th>{{ trans('admin.body') }}</th>

                                        <th>{{ trans('admin.created_at') }} @sortablelink('created_at','↓↑')</th>
                                        <th>{{ trans('admin.delete') }}</th>
                                    </tr>
                                    <tbody class="alldata">
                                    @foreach($push_notifications as $p)
                                        <tr id="sid{{ $p->id}}">
                                            <td>
                                                {{$p->title}}</td>
                                            <td>
                                                {{$p->body}}
                                            </td>
                                           
                                            <td>
                                                {{$p->created_at}}
                                            </td>
                                            <td><a href="{{route('deletenotifications',$p->id)}}" class="btn btn-danger btn-sm">{{ trans('admin.delete') }}</a></td>
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
                {!! $push_notifications->appends(\Request::except('page'))->render() !!}
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
                    url:'{{ URL::to('/search/notifications')}}',
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
