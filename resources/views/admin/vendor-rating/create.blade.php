@extends('layouts.admin.main')
@section('headerTitle', 'Create New Voucher')
@section('pageTitle', 'Create New Voucher')
@section('content')

{!! Form::open(['url' => route('vendor-voucher.store'), 'id' => 'formValidate', 'files' => true]) !!}

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">

                <div class="mrg-btm-20">
                    <a href="{{ route('vendor-voucher.index') }}" class="btn btn-primary btn-rounded btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
                </div>

                @include ('admin.vendor-voucher.form')
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}
@endsection