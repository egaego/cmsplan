@extends('layouts.admin.main')
@section('headerTitle', 'Create New Vendor Package ['. $vendor->name .']')
@section('pageTitle', 'Create New Vendor Package ['. $vendor->name .']')
@section('content')

{!! Form::open(['url' => route('vendor-package.store', ['vendorId'=>$vendor->id]), 'id' => 'formValidate', 'files' => true]) !!}

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">

                <div class="mrg-btm-20">
                    <a href="{{ route('vendor.show', ['id'=>$vendor->id]) }}" class="btn btn-primary btn-rounded btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
                </div>

                @include ('admin.vendor-package.form')
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}
@endsection