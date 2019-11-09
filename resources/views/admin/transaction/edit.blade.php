@extends('layouts.admin.main')
@section('headerTitle', 'Update Transaction #' . $model->code)
@section('pageTitle', 'Update Transaction #' . $model->code)
@section('content')


    {!! Form::model($model, [
            'method' => 'PATCH',
            'url' => ['/admin/transaction', $model->id],
            'files' => true,
            'id' => 'formValidate',
        ]) !!}

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-block">
                        
                        <div class="mrg-btm-20">
                            <a href="{{ route('transaction.show', ['id'=>$model->id]) }}" class="btn btn-primary btn-rounded btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
                        </div>
                        
                        @include ('admin.transaction.form', ['submitButtonText' => 'Update'])
                    </div>
                </div>
            </div>
        </div>
        

	{!! Form::close() !!}
@endsection