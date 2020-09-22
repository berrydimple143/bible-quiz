@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>{{ $title }} <a href="{{ route('verse.add') }}"><button class="btn bg-green waves-effect pull-right" type="button"><i class="material-icons">add</i> ADD VERSE</button></a></h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>Message</th>
                                    <th style="text-align: center; width: 100px;">Book</th>
                                    <th style="text-align: center; width: 80px;">Chapter</th>
                                    <th style="text-align: center; width: 80px;">Verse</th>
                                    <th style="text-align: center;">Topic</th>
                                    <th style="width: 100px; text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Message</th>
                                    <th style="text-align: center; width: 100px;">Book</th>
                                    <th style="text-align: center; width: 80px;">Chapter</th>
                                    <th style="text-align: center; width: 80px;">Verse</th>
                                    <th style="text-align: center;">Topic</th>
                                    <th style="width: 100px; text-align: center;">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($model as $verse)
                                    <tr>
                                        <td>{{ $verse->message }}</td>
                                        <td style="text-align: center;">{{ $verse->book->name }}</td>
                                        <td style="text-align: center;">{{ $verse->chapter }}</td>
                                        <td style="text-align: center;">{{ $verse->verse }}</td>
                                        <td style="text-align: center;">{{ $verse->topic->title }}</td>
                                        <td nowrap>
                                            <center>
                                                <a href="{{ route('verse.edit', ['id' => $verse->id]) }}"><button class="btn bg-orange waves-effect" title="Edit this verse" type="button"><i class="material-icons">edit</i></button></a>
                                                <a href="{{ route('verse.delete', ['id' => $verse->id]) }}"><button class="btn bg-red waves-effect" title="Delete this verse" type="button"><i class="material-icons">delete</i></button></a>
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