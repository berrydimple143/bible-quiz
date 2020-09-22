@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>{{ $title }} <a href="{{ route('subscription.add') }}"><button class="btn bg-green waves-effect pull-right" type="button"><i class="material-icons">add</i> ADD SUBSCRIPTION</button></a></h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th style="text-align: center;"># of Articles</th>
                                    <th style="text-align: center;"># of Images</th>
                                    <th style="text-align: center;">Price</th>
                                    <th style="width: 160px; text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th style="text-align: center;"># of Articles</th>
                                    <th style="text-align: center;"># of Images</th>
                                    <th style="text-align: center;">Price</th>
                                    <th style="width: 160px; text-align: center;">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($model as $subs)
                                    <tr>
                                        <td>{{ $subs->name }}</td>
                                        <td style="text-align: center;">{{ $subs->article }}</td>
                                        <td style="text-align: center;">{{ $subs->image }}</td>
                                        <td style="text-align: center;">{{ $subs->price }}</td>
                                        <td nowrap>
                                            <center>
                                                <a href="{{ route('subscription.edit', ['id' => $subs->id]) }}"><button class="btn bg-orange waves-effect" title="Edit this subscription" type="button"><i class="material-icons">edit</i></button></a>
                                                <a href="{{ route('subscription.delete', ['id' => $subs->id]) }}"><button class="btn bg-red waves-effect" title="Delete this subscription" type="button"><i class="material-icons">delete</i></button></a>
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