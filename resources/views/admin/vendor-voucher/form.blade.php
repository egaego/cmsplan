@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div aria-required="true" class="form-group required form-group-default {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>

<div aria-required="true" class="form-group required form-group-default {{ $errors->has('discount') ? 'has-error' : ''}}">
    {!! Form::label('discount', 'Discount') !!}
    {!! Form::text('discount', null, ['class' => 'form-control', 'placeholder' => "100000"]) !!}
    {!! $errors->first('discount', '<p class="help-block">:message</p>') !!}
</div>

<div aria-required="true" class="form-group required form-group-default {{ $errors->has('start_date') ? 'has-error' : ''}}">
    {!! Form::label('start_date', 'Start Date') !!}
    {!! Form::text('start_date', null, ['class' => 'form-control datepicker', 'placeholder' => "eg:2019-06-20"]) !!}
    {!! $errors->first('start_date', '<p class="help-block">:message</p>') !!}
</div>

<div aria-required="true" class="form-group required form-group-default {{ $errors->has('end_date') ? 'has-error' : ''}}">
    {!! Form::label('end_date', 'End Date') !!}
    {!! Form::text('end_date', null, ['class' => 'form-control datepicker', 'placeholder' => "eg:2019-06-30"]) !!}
    {!! $errors->first('end_date', '<p class="help-block">:message</p>') !!}
</div>

<div aria-required="true" class="form-group required form-group-default form-group-default-select2 {{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', 'Status') !!}
    {!! Form::select('status', \App\VendorVoucher::statusLabels(), null, ['class' => 'select2 full-width', 'data-init-plugin' => 'select2']) !!}
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>

{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
<button class="btn btn-default" type="reset"><i class="pg-close"></i> Clear</button>

@push('script')
<script>
$(".summernote").summernote({
    height: 200,
});
$('.datepicker').datepicker({
    format: 'yyyy-mm-dd'
});
$('.select2').selectize({
    sortField: 'text'
});    
</script>
@endpush