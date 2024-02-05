@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('admin.admin')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('overview') }}">{{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('all-notifications') }}">{{trans('admin.notify')}}</a></li>

    </ul>

    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <div class="row">
        <div class="col-md-12">

            <div class="tile shadow">
<form action="{{route('bulksend')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">{{ trans('admin.title') }}</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="title" required>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">{{ trans('admin.body') }}</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="body" required>
    </div>
    <button type="submit" class="btn btn-primary">{{ trans('admin.send_not') }}</button>
</form>
@endsection
                @push('scripts')
                    <script>
                        function loadPhoto(event) {
                            var reader = new FileReader();
                            reader.onload = function () {
                                var output = document.getElementById('photo');
                                output.src = reader.result;
                            };
                            reader.readAsDataURL(event.target.files[0]);
                        }
                    </script>
                    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
                    <script>

                        var firebaseConfig = {
                            apiKey: "BPn9url2fnYdnWrRlQpeQQQJgBmphfxdDEWXlj05iVx16SQKv62O4aAFQXzc26U67RMxTWGKyY11C2zPcVOToIA",
                            authDomain: "sanad-ac704.firebaseapp.com",
                            databaseURL: "https://sanad-ac704.firebaseio.com",
                            projectId: "sanad-ac704",
                            storageBucket: "sanad-ac704.appspot.com",
                            messagingSenderId: "960436005317",
                            appId: "1:960436005317:android:c8325cf4b639bde38003ac",
                        };
                    </script>
    @endpush
