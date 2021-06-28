@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if(!$edit)
                        <div class="card-header">{{ __('Add item') }}</div>
                    @else
                        <div class="card-header">{{ __('Edit item') }}</div>
                    @endif

                    <div class="card-body">
                        <form class="formValidate" id="formValidate" method="POST" action="{{ $route }}">
                            @csrf
                            @if($edit) @method('PUT') @endif

                            <div class="form-group">
                                <label for="name">{{ __('Name') }} *</label>
                                <input type="text" name="name" value="{{ old('name',$item->name) }}" class="form-control" id="name" placeholder="{{__('Enter Name')}}" minlength="5" maxlength="50" required>
                            </div>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <div class="form-group">
                                <label for="email">{{ __('Email') }} *</label>
                                <input type="email" name="email" value="{{ old('email',$item->email) }}" class="form-control" id="email" placeholder="{{__('Enter Email')}}" required >
                            </div>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <div class="form-group">
                                <label for="detail">{{ __('Details') }} *</label>
                                <textarea name="detail" value="{{ old('email',$item->detail) }}" class="form-control" id="detail" cols="30" rows="10" required>{{ old('email',$company->detail) }}</textarea>
                            </div>

                            @error('detail')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
