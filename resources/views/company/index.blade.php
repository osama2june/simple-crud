@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($message = Session::get('success'))
                <div class="card-alert card gradient-45deg-green-teal">
                    <div class="card-content white-text">
                        <p>
                            <i class="material-icons">check</i>{{ $message }}</p>
                    </div>
                    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Company Section') }} <a href="{{route('company.create')}}" style="float: right">{{ __('Add') }}</a></div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Details') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($companies as $company)
                            <tr>
                                <td>{{$company->id}}</td>
                                <td>{{$company->name}}</td>
                                <td>{{$company->email}}</td>
                                <td>{{$company->detail}}</td>
                                <td><a href="{{route('company.edit',['company' => $company->id])}}">{{ __('Edit') }}</a> /
                                    <a href="#" onclick="deleterecord({{ $company->id }})">{{ __('Delete') }}</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <form id="delete-form" method="POST" style="display:none">
                        @method('DELETE')
                        @csrf
                        <button type="submit">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script type="text/javascript">
        function deleterecord(id){
            let confirmBox = confirm('{{ __("Delete Message") }}');

            if(confirmBox){
                let path = `{{ url('company/${id}') }}`;
                $('#delete-form').attr('action',path);
                $('#delete-form').submit();
            }
        }
    </script>
@endsection
