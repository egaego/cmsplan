@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div aria-required="true" class="form-group required form-group-default form-group-default-select2 {{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', 'Status') !!}
    {!! Form::select('status', \App\Transaction::statusLabels(), null, ['class' => 'select2 full-width', 'data-init-plugin' => 'select2']) !!}
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>

{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
<button class="btn btn-default" type="reset"><i class="pg-close"></i> Clear</button>

@push('script')
<script>
$('.select2').selectize({
    sortField: 'text'
});    
</script>
@endpush