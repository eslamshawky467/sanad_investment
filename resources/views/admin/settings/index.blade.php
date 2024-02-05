@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{ trans('settings.show') }}</h2>
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
        <li class="breadcrumb-item">{{ trans('admin.settings') }}</li>
    </ul>

    <div class="row">

        <div class="col-md-12">
            <div class="tile shadow">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <a href="{{ route('settings.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>{{ trans('settings.add') }}</a>
                        <form method="post" action="{{route('settings.DeleteMany')}}" style="display: inline-block;">
                            @csrf
                            {{-- <input type="hidden" name="properties_id[]" > --}}
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> {{ trans('admin.delete') }}</button>
                        <!-- end of form -->
                </div><!-- end of row -->

                <div class="row">
                    <div class="container">
                    </div>
                    <div class="col-md-12">

                        <div class="table-responsive">

                            <table class="table datatable" id="admins-table" style="width: 100%;">
                                <thead class="alldata">
                                <tr>
                                    <th><input type="checkbox" class="selectAll"/></th>
                                    <th>{{ trans('settings.title') }}</th>
   
                               
                                    <th>{{ trans('admin.edit') }}</th>
                                    <th>{{ trans('admin.delete') }}</th>
                                </tr>
                                <tbody class="alldata">
                                @foreach($settings as $setting)
                                <tr id="sid{{ $setting->id}}">
                                    <td>
                                        <input type="checkbox" class="myChexbox" name="settings_id[]" value="{{$setting->id  }}" />
                                    </td>
                                    
                                        <td>{{$setting->title}}</td>
                                        
                                   <td><a href="{{route('settings.edit',$setting->id)}}" class="btn btn-success btn-sm">{{ trans('admin.edit') }}</a></td>
                                    <td><a href="{{route('settings.DeleteSetting',$setting->id)}}" class="btn btn-danger btn-sm">{{ trans('admin.delete') }}</a></td>
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
                    </form>
                    </div><!-- end of col -->

                </div><!-- end of row -->

            </div><!-- end of tile -->
                {{-- {!! $properties->appends(\Request::except('page'))->render() !!} --}}
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
                    url:'{{ URL::to('search/settings')}}',
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

<script>
    $('.selectAll').on('click', function () {
       const allCheckedCheckbox = $(this);
       $('.myChexbox').each(function () {
           $(this).prop('checked', allCheckedCheckbox.prop('checked'));
       });
   });
   
   </script>
@endpush