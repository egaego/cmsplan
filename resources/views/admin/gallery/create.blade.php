@extends('layouts.admin.main')
@section('headerTitle', 'Create New Gallery ')
@section('pageTitle', 'Create New Gallery ')
@section('content')

{!! Form::open(['url' => route('gallery.index'), 'id' => 'formValidate', 'files' => true]) !!}

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">

                <div class="mrg-btm-20">
                    <a href="{{ route('gallery.index') }}" class="btn btn-primary btn-rounded btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
                </div>

                @include ('admin.gallery.form')
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}
@endsection