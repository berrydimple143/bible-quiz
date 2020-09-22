@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>CHOICES TABLE <a href="{{ route('choice.add', ['id' => $params]) }}"><button class="btn bg-green waves-effect pull-right" type="button"><i class="material-icons">add</i> ADD CHOICE</button></a></h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">Question</th>
                                    <th style="text-align: center;">Label</th>
                                    <th style="text-align: center;">Status</th>
                                    <th style="width: 160px; text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th style="text-align: center;">Question</th>
                                    <th style="text-align: center;">Label</th>
                                    <th style="text-align: center;">Status</th>
                                    <th style="width: 160px; text-align: center;">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($model as $ch)
                                    <tr>
                                        <td>{{ $ch->quiz->question }}</td>
                                        <td>{{ $ch->label }}</td>
                                        <td style="text-align: center;">
                                            @if($ch->status == "active")
                                                <button type="button" title="Active" class="btn bg-green waves-effect">
                                                    <i class="material-icons">check_circle</i>
                                                </button>
                                            @else
                                                <button type="button" title="Inactive" class="btn bg-red waves-effect">
                                                    <i class="material-icons">error_outline</i>
                                                </button>
                                            @endif
                                        </td>
                                        <td nowrap>
                                            <center>
                                                <a href="{{ route('choice.edit', ['id' => $ch->id, 'qid' => $params]) }}"><button class="btn bg-orange waves-effect" title="Edit this choice" type="button"><i class="material-icons">edit</i></button></a>
                                                <a href="{{ route('choice.delete', ['id' => $ch->id, 'qid' => $params]) }}"><button class="btn bg-red waves-effect" title="Delete this choice" type="button"><i class="material-icons">delete</i></button></a>
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