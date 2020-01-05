@extends('layouts.admin.main')
@section('headerTitle', 'Partner #' . $model->id)
@section('pageTitle', 'Partner #' . $model->id)

@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    
                    <div class="pull-left mrg-btm-20">
                        <a href="{{ route('user-relation.index') }}" class="btn btn-primary btn-rounded btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
                        <a href="{{ route('user-relation.edit', ['id' => $model->id]) }}" class="btn btn-primary btn-rounded btn-sm">Update Partner</a>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th width="20%">ID</th>
                                    <td>{{ $model->id }}</td>
                                </tr>
                                <tr>
                                    <th> Relation </th>
                                    <td> {{ $model->getRelationName() }} </td>
                                </tr>
                                <tr>
                                    <th> Wedding Day </th>
                                    <td> {{ \Carbon\Carbon::parse($model->wedding_day)->format('d M Y') }} </td>
                                </tr>
                                <tr>
                                    <th> Venue </th>
                                    <td> {{ $model->venue }} </td>
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
                                <h4>Male</h4>
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th width="20%">ID</th>
                                            <td>{{ $model->maleUser->id }}</td>
                                        </tr>
                                        <tr>
                                            <th> Name </th>
                                            <td>
                                                <a href="{!! route('user-app.show', ['id' => $model->maleUser->id]) !!}">
                                                    {{ $model->maleUser->name }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> Email </th>
                                            <td>{{ $model->maleUser->email }}</td>
                                        </tr>
                                        <tr>
                                            <th> Phone </th>
                                            <td>{{ $model->maleUser->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th> Last Login At </th>
                                            <td>{{ $model->maleUser->last_login_at }}</td>
                                        </tr>
                                        <tr>
                                            <th> Created At </th>
                                            <td>{{ $model->maleUser->created_at }}</td>
                                        </tr>
                                        <tr>
                                            <th> Updated At </th>
                                            <td>{{ $model->maleUser->updated_at }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-block">

                            <div class="pull-left mrg-btm-20">
                                <h4>Female</h4>
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th width="20%">ID</th>
                                            <td>{{ $model->femaleUser->id }}</td>
                                        </tr>
                                        <tr>
                                            <th> Name </th>
                                            <td>
                                                <a href="{!! route('user-app.show', ['id' => $model->femaleUser->id]) !!}">
                                                    {{ $model->femaleUser->name }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> Email </th>
                                            <td>{{ $model->femaleUser->email }}</td>
                                        </tr>
                                        <tr>
                                            <th> Phone </th>
                                            <td>{{ $model->femaleUser->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th> Last Login At </th>
                                            <td>{{ $model->femaleUser->last_login_at }}</td>
                                        </tr>
                                        <tr>
                                            <th> Created At </th>
                                            <td>{{ $model->femaleUser->created_at }}</td>
                                        </tr>
                                        <tr>
                                            <th> Updated At </th>
                                            <td>{{ $model->femaleUser->updated_at }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
</div>
@endsection