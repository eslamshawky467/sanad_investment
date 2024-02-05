@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>{{trans('admin.admin')}}</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{trans('admin.home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admins.index') }}">{{trans('admin.index')}}</a></li>
        <li class="breadcrumb-item">{{trans('admin.edit')}}</li>
    </ul>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">
                <form action="{{ route('transactions.update', 'test') }}" method="post"enctype="multipart/form-data">
                    {{ method_field('patch') }}
                    @csrf
                    @include('admin.partials._errors')
                    <input id="id" type="hidden" name="id" class="border"
                           value="{{ $transactions->id }}">
                    <input type="hidden"  name="sender_id"  class="form-control" value="{{ old('sender_id', $transactions->sender_id) }}" required>
                    {{--name--}}
                    <div class="form-group">
                        <label>{{trans('admin.amount')}} <span class="text-danger">*</span></label>
                        <input type="number" name="amount" autofocus class="form-control" min="0" oninput="this.value = Math.abs(this.value)" value=  "{{ old('amount', $transactions->amount) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1"> {{trans('admin.reciever_id')}}
                            :</label>
                        <select  class="form-select" aria-label="Default select example" name="reciever_id"
                                 id="exampleFormControlTextarea1" placeholder="." style="border: 1px solid #e3e3e3;padding: 1rem;border-radius: 1px;font-size: 15px;" required>
                            @foreach ($users as $user )
                            <option type="hidden" value="{{$user->id}}">{{$user->name}}</option>
                                <option value="{{$user->id}}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1"> {{trans('admin.type')}}
                            :</label>
                        <select  class="form-select" aria-label="Default select example" name="type"
                                 id="exampleFormControlTextarea1" placeholder="." style="border: 1px solid #e3e3e3;padding: 1rem;border-radius: 1px;font-size: 15px;" required>


                                 <option type="hidden" value="{{$transactions->type}}">{{$transactions->type}}</option>
                                 <option value="Add_Balance">Add_Balance</option>
                            <option value="Withdraw">Withdraw</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1"> {{trans('admin.account_id')}}
                            :</label>
                        <select  class="form-select" aria-label="Default select example" name="account_id"
                                 id="exampleFormControlTextarea1" placeholder="." style="border: 1px solid #e3e3e3;padding: 1rem;border-radius: 1px;font-size: 15px;" required>
                            @foreach ($accounts as $account )
                            <option type="hidden" value="{{$account->id}}">{{$account->bank_number}}</option>
                            <option value="{{$account->id}}">{{ $account->bank_number }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{trans('admin.note')}} <span class="text-danger">*</span></label>
                        <input type="text" name="note"  class="form-control" value=  "{{ old('note', $transactions->note) }}" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>{{trans('admin.submit')}}</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection
@push('scripts')
@endpush
