@extends('layouts.admin.main')
@section('headerTitle', 'Vendor #' . $model->id)
@section('pageTitle', 'Vendor #' . $model->id)

@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    
                    <div class="pull-left mrg-btm-20">
                        <a href="{{ route('vendor.index') }}" class="btn btn-primary btn-rounded btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
                        <a href="{{ route('vendor.edit', ['id'=>$model->id]) }}" class="btn btn-success btn-rounded btn-sm"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;Update</a>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th width="20%">ID</th>
                                    <td>{{ $model->id }}</td>
                                </tr>
                                <tr>
                                    <th> Concept </th>
                                    <td> {{ $model->concept ? $model->concept->name : "" }} </td>
                                </tr>
                                <tr>
                                    <th> Name </th>
                                    <td> {{ $model->name }} </td>
                                </tr>
                                <tr>
                                    <th> Description </th>
                                    <td> {{ $model->description }} </td>
                                </tr>
                                <tr>
                                    <th> Image </th>
                                    <td> {!! $model->getFileImg() !!} </td>
                                </tr>
                                <tr>
                                    <th> Image Thumbnail </th>
                                    <td> {!! $model->getFileThumbImg() !!} </td>
                                </tr>
                                <tr>
                                    <th> Email </th>
                                    <td> {!! $model->email !!} </td>
                                </tr>
                                <tr>
                                    <th> Phone </th>
                                    <td> {!! $model->phone !!} </td>
                                </tr>
                                <tr>
                                    <th> Instagram </th>
                                    <td> {!! $model->instagram !!} </td>
                                </tr>
                                <tr>
                                    <th> Address </th>
                                    <td> {!! $model->address !!} </td>
                                </tr>
                                <tr>
                                    <th> Phone </th>
                                    <td> {!! $model->phone !!} </td>
                                </tr>
                                <tr>
                                    <th> Rating </th>
                                    <td> {!! $model->rating !!} </td>
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
                                            <th>Name</th>
                                            <th>File</th>
                                            <th>Status</th>
                                            <th>Order</th>
                                            <th>Created at</th>
                                            <th>Updated At</th>
                                            <td></td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                        </div>
                        <div class="card-footer">
                            <a href="{{ route('vendor-detail.create', ['vendorId'=>$model->id]) }}" class="btn btn-primary btn-rounded">Add New Detail</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-block">

                            <div class="pull-left mrg-btm-20">
                                <h4>Voucher Lists</h4>
                            </div>

                            <div class="table-responsive">
                                <table id="voucher-table" class="table table-lg table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Discount</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Status</th>
                                            <th>Created at</th>
                                            <th>Updated At</th>
                                            <td></td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                        </div>
                        <div class="card-footer">
                            <a href="{{ url('admin/vendor-voucher/create', ['vendorId'=>$model->id]) }}" class="btn btn-primary btn-rounded">Add New Detail</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-block">

                            <div class="pull-left mrg-btm-20">
                                <h4>Package Lists</h4>
                            </div>

                            <div class="table-responsive">
                                <table id="package-table" class="table table-lg table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Created at</th>
                                            <th>Updated At</th>
                                            <td></td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                        </div>
                        <div class="card-footer">
                            <a href="{{ url('admin/vendor-package/create', ['vendorId'=>$model->id]) }}" class="btn btn-primary btn-rounded">Add New Detail</a>
                        </div>
                    </div>
                    
                </div>

                <div class="card">
                    <div class="card-block">

                        <div class="pull-left mrg-btm-20">
                            <h4>Rating Lists</h4>
                        </div>

                        <div class="table-responsive">
                            <table id="rating-table" class="table table-lg table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>Rate</th>
                                        <th>Comment</th>
                                        <th>Created at</th>
                                        <th>Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($model->vendorRatings as $rating)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $rating->user->name }}</td>
                                        <td>{{ $rating->rate }}</td>
                                        <td>{{ $rating->comment }}</td>
                                        <td>{{ $rating->created_at }}</td>
                                        <td>{{ $rating->updated_at }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
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
    url: '{!! route('vendor-detail.data', ['id' => $model->id]) !!}',
        data: function (d) {
            d.range = $('input[name=drange]').val();
        }
    },
    columns: [
		{ data: "rownum", name: "rownum" },
		{ data: "name", name: "name" },
		{ data: "file", name: "file" },
		{ data: "status", name: "status" },
		{ data: "order", name: "order" },
		{ data: "created_at", name: "created_at", visible:false },
		{ data: "updated_at", name: "updated_at" },
        { data: "action", name: "action", searchable: false, orderable: false },
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
<!-- vouchers -->
<script>
var voucherTables;
voucherTables = $('#voucher-table').DataTable({
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
    url: '{!! route('vendor-voucher.data', ['id' => $model->id]) !!}',
        data: function (d) {
            d.range = $('input[name=drange]').val();
        }
    },
    columns: [
		{ data: "rownum", name: "rownum" },
		{ data: "name", name: "name" },
		{ data: "discount", name: "discount" },
        { data: "start_date", name: "start_date" },
        { data: "end_date", name: "end_date" },
        { data: "status", name: "status" },
		{ data: "created_at", name: "created_at", visible:false },
		{ data: "updated_at", name: "updated_at" },
        { data: "action", name: "action", searchable: false, orderable: false },
    ],
}).on( 'processing.dt', function ( e, settings, processing ) {if(processing){Pace.start();} else {Pace.stop();}});

$("#voucher-table_wrapper > .dt-buttons").appendTo("div.export-options-container");

$('#formsearch').submit(function () {
    voucherTables.search( $('#search-table').val() ).draw();
    return false;
} );

voucherTables.page.len(25).draw();

function modalDelete(id) {
    $('#modal-delete').modal('show');
    $('#delete_value').val(id);
}

function deleteRecord(){
    $('#modal-delete').modal('hide');
    var id = $('#delete_value').val();
    $.ajax({
        url: '{{route("vendor-voucher.delete", ["id"=>$model->id])}}' + "/" + id + '?' + $.param({"_token" : '{{ csrf_token() }}' }),
        type: 'DELETE',
        complete: function(data) {
            voucherTables.draw();
        }
    });
}

</script>
<!-- packages -->
<script>
var packageTables;
packageTables = $('#package-table').DataTable({
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
    url: '{!! route('vendor-package.data', ['id' => $model->id]) !!}',
        data: function (d) {
            d.range = $('input[name=drange]').val();
        }
    },
    columns: [
		{ data: "rownum", name: "rownum" },
		{ data: "name", name: "name" },
        { data: "description", name: "description" },
        { data: "price", name: "price" },
        { data: "status", name: "status" },
		{ data: "created_at", name: "created_at", visible:false },
		{ data: "updated_at", name: "updated_at" },
        { data: "action", name: "action", searchable: false, orderable: false },
    ],
}).on( 'processing.dt', function ( e, settings, processing ) {if(processing){Pace.start();} else {Pace.stop();}});

$("#package-table_wrapper > .dt-buttons").appendTo("div.export-options-container");

$('#formsearch').submit(function () {
    packageTables.search( $('#search-table').val() ).draw();
    return false;
} );

packageTables.page.len(25).draw();

function modalDelete(id) {
    $('#modal-delete').modal('show');
    $('#delete_value').val(id);
}

function deleteRecord(){
    $('#modal-delete').modal('hide');
    var id = $('#delete_value').val();
    $.ajax({
        url: '{{route("vendor-package.delete", ["id"=>$model->id])}}' + "/" + id + '?' + $.param({"_token" : '{{ csrf_token() }}' }),
        type: 'DELETE',
        complete: function(data) {
            packageTables.draw();
        }
    });
}

</script>
@endpush