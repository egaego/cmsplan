@extends('layouts.admin.main')
@section('headerTitle', 'Create New Bank ')
@section('pageTitle', 'Create New Bank ')
@section('content')

{!! Form::open(['url' => route('bank.index'), 'id' => 'formValidate', 'files' => true]) !!}

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">

                <div class="mrg-btm-20">
                    <a href="{{ route('bank.index') }}" class="btn btn-primary btn-rounded btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
                </div>

                @include ('admin.bank.form')
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}
@endsection