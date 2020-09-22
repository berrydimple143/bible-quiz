@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>USERS TABLE <a href="{{ route('user.add') }}"><button class="btn bg-green waves-effect pull-right" type="button"><i class="material-icons">add</i> ADD USER</button></a></h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>Lastname</th>
                                    <th>Firstname</th>
                                    <th>Email</th>
                                    <th>Membership</th>
                                    <th>Status</th>
                                    <th style="width: 105px; text-align: center;">Activation</th>
                                    <th style="width: 105px; text-align: center;">Expiration</th>
                                    <th style="width: 120px; text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Lastname</th>
                                    <th>Firstname</th>
                                    <th>Email</th>
                                    <th>Membership</th>
                                    <th>Status</th>
                                    <th style="width: 105px; text-align: center;">Activation</th>
                                    <th style="width: 105px; text-align: center;">Expiration</th>
                                    <th style="width: 120px; text-align: center;">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($model as $usr)
                                    <?php
                                        $act = new \Carbon\Carbon($usr->activated_at);
                                        $actdt = $act->toFormattedDateString();
                                        $ex = new \Carbon\Carbon($usr->expired_at);
                                        $exp = $ex->toFormattedDateString();
                                    ?>
                                    <tr>
                                        <td>{{ $usr->lastname }}</td>
                                        <td>{{ $usr->firstname }}</td>
                                        <td>{{ $usr->email }}</td>
                                        <td>{{ $usr->membership }}</td>
                                        <td>
                                            @if($usr->status == "active")
                                                <button type="button" title="Active" class="btn bg-green waves-effect">
                                                    <i class="material-icons">check_circle</i>
                                                </button>
                                            @else
                                                <button type="button" title="Inactive" class="btn bg-red waves-effect">
                                                    <i class="material-icons">error_outline</i>
                                                </button>
                                            @endif
                                        </td>
                                        <td style="text-align: center;">{{ $actdt }}</td>
                                        <td style="text-align: center;">{{ $exp }}</td>
                                        <td nowrap>
                                            <center>
                                                <a href="{{ route('user.edit', ['id' => $usr->id]) }}"><button class="btn bg-orange waves-effect" title="Edit this user" type="button"><i class="material-icons">edit</i></button></a>
                                                <a href="{{ route('user.delete', ['id' => $usr->id]) }}"><button class="btn bg-red waves-effect" title="Delete this user" type="button"><i class="material-icons">delete</i></button></a>
                                            </center>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection