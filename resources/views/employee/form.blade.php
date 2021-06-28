@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(!$edit)
                    <div class="card-header">{{ __('Add Employee') }}</div>
                @else
                    <div class="card-header">{{ __('Edit Employee') }}</div>
                @endif

                <div class="card-body">
                    <form class="formValidate" id="formValidate" method="POST" action="{{ $route }}">
                        @csrf
                        @if($edit) @method('PUT') @endif

                        <div class="form-group">
                            <label for="name">{{ __('Name') }} *</label>
                            <input type="text" name="name" value="{{ old('name',$employee->name) }}" class="form-control" id="name" placeholder="{{__('Enter Name')}}" minlength="5" maxlength="50" required>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('Email') }} *</label>
                            <input type="email" name="email" value="{{ old('email',$employee->email) }}" class="form-control" id="email" placeholder="{{__('Enter Email')}}" required @if($edit) readonly @endif>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="detail">{{ __('Details') }} *</label>
                            <textarea name="detail" value="{{ old('detail',$employee->detail) }}" class="form-control" id="detail" cols="30" rows="5" required>{{ old('detail',$employee->detail) }}</textarea>

                            @error('detail')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="company">{{ __('Select Company') }} *</label>
                            <select class="form-control" id="company" name="company_id" required>
                                @foreach($companies as $company)
                                    <option value="{{$company->id}}" {{$employee->company_id == $company->id  ? 'selected' : ''}} >{{$company->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
