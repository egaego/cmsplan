@extends('layouts.admin.main')
@section('headerTitle', 'Transaction #' . $model->id)
@section('pageTitle', 'Transaction Details #' . $model->code)

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-block">
				<div class="pull-left mrg-btm-20">
					<a href="{{ route('transaction.index') }}" class="btn btn-primary btn-rounded btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
					<a href="{{ route('transaction.edit', ['id'=>$model->id]) }}" class="btn btn-success btn-rounded btn-sm"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;Update Status</a>
				</div>

			<div class="table-responsive">
				<table class="table">
					<tbody>
						<tr>
							<th width="20%">ID</th>
							<td>{{ $model->id }}</td>
						</tr>
						<tr>
							<th> Code </th>
							<td> {{ $model->code }} </td>
						</tr>
						<tr>
							<th> User </th>
							<td> {{ $model->user ? $model->user->name : "" }} </td>
						</tr>
						<tr>
							<th> Bank </th>
							<td> {{ $model->bank ? $model->bank->account_name : $model->bank_id }} </td>
						</tr>
						<tr>
							<th> Payment Type </th>
							<td> {{ $model->paymentType ? $model->paymentType->name : $model->payment_type_id }} </td>
						</tr>
						<tr>
							<th> Total </th>
							<td>{!! \App\Helpers\FormatConverter::rupiahFormat($model->total, 2) !!}</td>
						</tr>
						<tr>
							<th> Admin Fee </th>
							<td>{!! \App\Helpers\FormatConverter::rupiahFormat($model->admin_fee, 2) !!}</td>
						</tr>
						<tr>
							<th> Grand Total </th>
							<td>{!! \App\Helpers\FormatConverter::rupiahFormat($model->grand_total, 2) !!}</td>
						</tr>
						<tr>
							<th> Status </th>
							<td>{!! $model->getStatusLabel() !!}</td>
						</tr>
						<tr>
							<th> Status Payment </th>
							<td>{!! $model->getStatusPaymentLabel() !!}</td>
						</tr>
						<tr>
							<th> Payment Paid At </th>
							<td>{!! $model->payment_paid_at !!}</td>
						</tr>
						<tr>
							<th> Created At </th>
							<td> {{ $model->created_at }} </td>
						</tr>
						<tr>
							<th> Updated At </th>
							<td> {{ $model->updated_at }} </td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="card">
				<div class="card-block">
					<div class="pull-left mrg-btm-20">
						<h4>Detail Lists</h4>
					</div>
					<div class="table-responsive">
						<table id="detail-table" class="table table-lg table-hover" width="100%">
							<thead>
								<tr>
									<th>#</th>
									<th>Concept</th>
									<th>Vendor</th>
									<th>Package</th>
									<th>Voucher</th>
									<th>Total</th>
									<th>Discount</th>
									<th>Grand Total</th>
									<td>Note</td>
									<td>Created At</td>
									<td>Updated At</td>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-block">
					<div class="pull-left mrg-btm-20">
						<h4>Payment Lists</h4>
					</div>
					<div class="table-responsive">
						<table id="payment-table" class="table table-lg table-hover" width="100%">
							<thead>
								<tr>
									<th>#</th>
									<th>User</th>
									<th>Bank</th>
									<th>Evidence Transfer</th>
									<th>User Bank Account</th>
									<th>User Account Holder</th>
									<th>User Account Number</th>
									<th>Total</th>
									<td>Created At</td>
									<td>Updated At</td>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('script')
<script>
var oTable;
oTable = $('#detail-table').DataTable({
    processing: true,
    serverSide: true,
    dom: 'lBfrtip',
    order:  [[ 3, "asc" ]],
    pagingType: 'full_numbers',
    buttons: [
        {
            extend: 'print',
            autoPrint: true,
            customize: function ( win ) {
                $(win.document.body)
                    .css( 'padding', '2px' )
                    .prepend(
                        '<img src="{{asset('img/logo.png')}}" style="float:right; top:0; left:0;height: 40px;right: 10px;background: #101010;padding: 8px;border-radius: 4px" /><h5 style="font-size: 9px;margin-top: 0px;"><br/><font style="font-size:14px;margin-top: 5px;margin-bottom:20px;"> Report Concept</font><br/><br/><font style="font-size:8px;margin-top:15px;">{{date('Y-m-d h:i:s')}}</font></h5><br/><br/>'
                    );


                $(win.document.body).find( 'div' )
                    .css( {'padding': '2px', 'text-align': 'center', 'margin-top': '-50px'} )
                    .prepend(
                        ''
                    );

                $(win.document.body).find( 'table' )
                    .addClass( 'compact' )
                    .css( { 'font-size': '9px', 'padding': '2px' } );


            },
            title: '',
            orientation: 'landscape',
            exportOptions: {columns: ':visible'} ,
            text: '<i class="fa fa-print" data-toggle="tooltip" title="" data-original-title="Print"></i>',
            //className: 'btn btn-primary'
        },
        {extend: 'colvis', text: '<i class="fa fa-eye" data-toggle="tooltip" title="" data-original-title="Column visible"></i>'},
        {extend: 'csv', text: '<i class="fa fa-file-excel-o" data-toggle="tooltip" title="" data-original-title="Export CSV"></i>'}
    ],
    //sDom: "<'table-responsive fixed't><'row'<p i>> B",
    sPaginationType: "bootstrap",
    destroy: true,
    responsive: true,
    scrollCollapse: true,
    oLanguage: {
        "sLengthMenu": "_MENU_ ",
        "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
    },
    lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
    ajax: {
    url: '{!! route('transaction-detail.data', ['id' => $model->id]) !!}',
        data: function (d) {
            d.range = $('input[name=drange]').val();
        }
    },
    columns: [
		{ data: "rownum", name: "rownum" },
		{ data: "concept_id", name: "concept_id" },
		{ data: "vendor_id", name: "vendor_id" },
		{ data: "vendor_package_id", name: "vendor_package_id" },
		{ data: "vendor_voucher_id", name: "vendor_voucher_id" },
		{ data: "total", name: "total" },
		{ data: "voucher_discount", name: "voucher_discount" },
		{ data: "grand_total", name: "grand_total" },
		{ data: "total", name: "total" },
		{ data: "created_at", name: "created_at" },
		{ data: "updated_at", name: "updated_at" },
    ],
}).on( 'processing.dt', function ( e, settings, processing ) {if(processing){Pace.start();} else {Pace.stop();}});

$("#concept-table_wrapper > .dt-buttons").appendTo("div.export-options-container");

$('#formsearch').submit(function () {
    oTable.search( $('#search-table').val() ).draw();
    return false;
} );

oTable.page.len(25).draw();

function modalDelete(id) {
    $('#modal-delete').modal('show');
    $('#delete_value').val(id);
}

function deleteRecord(){
    $('#modal-delete').modal('hide');
    var id = $('#delete_value').val();
    $.ajax({
        url: '{{route("vendor-detail.delete", ["id" => $model->id])}}' + "/" + id + '?' + $.param({"_token" : '{{ csrf_token() }}' }),
        type: 'DELETE',
        complete: function(data) {
            oTable.draw();
        }
    });
}

</script>
<!-- Transaction Payment -->
<script>
var paymentTables;
paymentTables = $('#payment-table').DataTable({
    processing: true,
    serverSide: true,
    dom: 'lBfrtip',
    order:  [[ 3, "asc" ]],
    pagingType: 'full_numbers',
    buttons: [
        {
            extend: 'print',
            autoPrint: true,
            customize: function ( win ) {
                $(win.document.body)
                    .css( 'padding', '2px' )
                    .prepend(
                        '<img src="{{asset('img/logo.png')}}" style="float:right; top:0; left:0;height: 40px;right: 10px;background: #101010;padding: 8px;border-radius: 4px" /><h5 style="font-size: 9px;margin-top: 0px;"><br/><font style="font-size:14px;margin-top: 5px;margin-bottom:20px;"> Report Concept</font><br/><br/><font style="font-size:8px;margin-top:15px;">{{date('Y-m-d h:i:s')}}</font></h5><br/><br/>'
                    );


                $(win.document.body).find( 'div' )
                    .css( {'padding': '2px', 'text-align': 'center', 'margin-top': '-50px'} )
                    .prepend(
                        ''
                    );

                $(win.document.body).find( 'table' )
                    .addClass( 'compact' )
                    .css( { 'font-size': '9px', 'padding': '2px' } );


            },
            title: '',
            orientation: 'landscape',
            exportOptions: {columns: ':visible'} ,
            text: '<i class="fa fa-print" data-toggle="tooltip" title="" data-original-title="Print"></i>',
            //className: 'btn btn-primary'
        },
        {extend: 'colvis', text: '<i class="fa fa-eye" data-toggle="tooltip" title="" data-original-title="Column visible"></i>'},
        {extend: 'csv', text: '<i class="fa fa-file-excel-o" data-toggle="tooltip" title="" data-original-title="Export CSV"></i>'}
    ],
    //sDom: "<'table-responsive fixed't><'row'<p i>> B",
    sPaginationType: "bootstrap",
    destroy: true,
    responsive: true,
    scrollCollapse: true,
    oLanguage: {
        "sLengthMenu": "_MENU_ ",
        "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
    },
    lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
    ajax: {
    url: '{!! route('transaction-payment.data', ['id' => $model->id]) !!}',
        data: function (d) {
            d.range = $('input[name=drange]').val();
        }
    },
    columns: [
		{ data: "rownum", name: "rownum" },
		{ data: "user_id", name: "user_id" },
		{ data: "bank_id", name: "bank_id" },
		{ data: "file", name: "file" },
		{ data: "user_bank_account_name", name: "user_bank_account_name" },
		{ data: "user_account_holder", name: "user_account_holder" },
		{ data: "user_account_number", name: "user_account_number" },
		{ data: "total", name: "total" },
		{ data: "created_at", name: "created_at", visible: false  },
		{ data: "updated_at", name: "updated_at", visible: false },
    ],
}).on( 'processing.dt', function ( e, settings, processing ) {if(processing){Pace.start();} else {Pace.stop();}});

$("#concept-table_wrapper > .dt-buttons").appendTo("div.export-options-container");

$('#formsearch').submit(function () {
    paymentTables.search( $('#search-table').val() ).draw();
    return false;
} );

paymentTables.page.len(25).draw();

</script>

@endpush
