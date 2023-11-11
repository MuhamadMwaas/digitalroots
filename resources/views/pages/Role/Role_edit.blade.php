@extends('layout.Main_Layout')
@section('title', 'edit role ' . $role->name)


@section('Main_Content')

    <div class="page-wrapper cardhead">
        {{-- contaner start --}}
        <div class="content container-fluid">
            {{-- herder page --}}
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Edite user {{ $role->name }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('Dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">roles List</a></li>

                            <li class="breadcrumb-item active"> Edite user {{ $role->name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card">
                        {{-- header card --}}
                        <div class="card-header">
                            <h5 class="card-title">role Edite</h5>
                        </div>
                        <div class="card-body">
                            {{-- start form --}}

                            {!! Form::model($role, ['method' => 'PUT', 'route' => ['roles.update', $role->id]]) !!}
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Name:</strong>
                                        {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Permission:</strong>
                                        <br />
                                        @foreach ($permission as $value)
                                            <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name']) }}
                                                {{ $value->name }}</label>
                                            <br />
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- contaner end --}}
    </div>
@endsection
