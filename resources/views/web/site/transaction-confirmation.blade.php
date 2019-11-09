@extends('layouts.web.main')
@section('headerTitle', 'Payment Confirmation')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Payment Confirmation</div>

                <div class="panel-body">
                    <div class="row">
                    @foreach (\App\Bank::actived()->get() as $model)
                        <div class="col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading text-center">{{ $model->account_name }}</div>
                                <div class="panel-body text-center">
                                    <p>AN. {{ $model->account_holder }}<br>{{ $model->account_number }}<br>Cabang {{ $model->account_branch }}</p>      
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="ng-pristine ng-valid form-horizontal" method="POST" action="{{ url('transaction-confirmation') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {!! Form::hidden('code', $transaction->code) !!}
                        <table class="table table-striped">
                            <tr>
                                <th align="center" colspan="3">Detail</th>
                            </tr>
                            <tr>
                                <td>Invoice Transaksi</td>
                                <td width="60%">{!! $transaction->code !!}</td>
                            </tr>
                            <tr>
                                <td>Customer</td>
                                <td width="60%">{!! $transaction->user ? $transaction->user->name : '' !!}</td>
                            </tr>
                            <tr>
                                <td>Total Pembayaran</td>
                                <td width="60%">{!! \App\Helpers\FormatConverter::rupiahFormat($transaction->grand_total) !!}</td>
                            </tr>
                            <tr>
                                <th align="center" colspan="3">Form Pembayaran</th>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group{{ $errors->has('bank_id') ? ' has-error' : '' }}">
                                        <label for="bank_id" class="col-md-8 control-label">Transfer ke Bank</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group{{ $errors->has('bank_id') ? ' has-error' : '' }}">
                                        <div class="col-md-10">
                                            {!! Form::select('bank_id', \App\Bank::actived()->pluck('account_name', 'id'), null, ['class' => 'select2 form-control full-width', 'data-init-plugin' => 'select2']) !!}

                                            @if ($errors->has('bank_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('bank_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group{{ $errors->has('user_bank_account_name') ? ' has-error' : '' }}">
                                        <label for="user_bank_account_name" class="col-md-8 control-label">Dari Bank</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group{{ $errors->has('user_bank_account_name') ? ' has-error' : '' }}">
                                        <div class="col-md-10">
                                            <input id="user_bank_account_name" type="text" class="form-control" name="user_bank_account_name" required placeholder="BCA" />

                                            @if ($errors->has('user_bank_account_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('user_bank_account_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group{{ $errors->has('user_account_holder') ? ' has-error' : '' }}">
                                        <label for="user_account_holder" class="col-md-8 control-label">Bank Atas Nama</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group{{ $errors->has('user_account_holder') ? ' has-error' : '' }}">
                                        <div class="col-md-10">
                                            <input id="user_account_holder" type="text" class="form-control" name="user_account_holder" required />

                                            @if ($errors->has('user_account_holder'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('user_account_holder') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group{{ $errors->has('user_account_number') ? ' has-error' : '' }}">
                                        <label for="user_account_number" class="col-md-8 control-label">Dari No Rekening</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group{{ $errors->has('user_account_number') ? ' has-error' : '' }}">
                                        <div class="col-md-10">
                                            <input id="user_account_number" type="number" class="form-control" name="user_account_number" required />

                                            @if ($errors->has('user_account_number'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('user_account_number') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group{{ $errors->has('total') ? ' has-error' : '' }}">
                                        <label for="total" class="col-md-8 control-label">Total Pembayaran</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group{{ $errors->has('total') ? ' has-error' : '' }}">
                                        <div class="col-md-10">
                                            <input id="total" type="number" class="form-control" name="total" required placeholder="90000" />

                                            @if ($errors->has('total'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('total') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                                        <label for="file" class="col-md-8 control-label">Bukti Pembayaran</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                                        <div class="col-md-10">
                                            <input id="file" type="file" class="form-control" name="file" required />

                                            @if ($errors->has('file'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('file') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">
                                                CONFIRMATION
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    var IS_IPAD = navigator.userAgent.match(/iPad/i) != null,
        IS_IPHONE = !IS_IPAD && ((navigator.userAgent.match(/iPhone/i) != null) || (navigator.userAgent.match(/iPod/i) != null)),
        IS_IOS = IS_IPAD || IS_IPHONE,
        IS_ANDROID = !IS_IOS && navigator.userAgent.match(/android/i) != null,
        IS_MOBILE = IS_IOS || IS_ANDROID;

    function open() {
        // If it's not an universal app, use IS_IPAD or IS_IPHONE
        if (IS_IOS) {
            window.location = "{{ $iosUrlScheme }}";

            setTimeout(function() {

                // If the user is still here, open the App Store
                if (!document.webkitHidden) {
                    // Replace the Apple ID following '/id'
                    window.location = '{{ $webRealUrl }}';
                }
            }, 25);

        } else if (IS_ANDROID) {
            // Instead of using the actual URL scheme, use 'intent://' for better UX
            window.location = '{{ $androidUrlScheme }}';
        }
    }
    window.onload = open();
</script>
<script>
$('.select2').selectize({
    sortField: 'text'
});    
</script>
@endpush