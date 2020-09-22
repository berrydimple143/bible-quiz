@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>{{ $title }} <a href="{{ route('topic.add') }}"><button class="btn bg-green waves-effect pull-right" type="button"><i class="material-icons">add</i> ADD TOPIC</button></a></h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th style="text-align: center;">Book</th>
                                    <th style="text-align: center; width: 80px;">Chapter</th>
                                    <th style="text-align: center; width: 80px;">Verse</th>
                                    <th style="text-align: center; width: 80px;">Visible</th>
                                    <th style="width: 100px; text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Title</th>
                                    <th style="text-align: center;">Book</th>
                                    <th style="text-align: center; width: 80px;">Chapter</th>
                                    <th style="text-align: center; width: 80px;">Verse</th>
                                    <th style="text-align: center; width: 80px;">Visible</th>
                                    <th style="width: 100px; text-align: center;">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($model as $topic)
                                    <tr>
                                        <td>{{ $topic->title }}</td>
                                        <td style="text-align: center;">{{ $topic->book }}</td>
                                        <td style="text-align: center; width: 80px;">{{ $topic->chapter }}</td>
                                        <td style="text-align: center; width: 80px;">{{ $topic->verse }}</td>
                                        <td style="text-align: center;">
                                            @if($topic->visible == "yes")
                                                <button type="button" title="Active" style="cursor: text;" class="btn bg-green waves-effect">
                                                    <i class="material-icons">check_circle</i>
                                                </button>
                                            @else
                                                <button type="button" title="Inactive" style="cursor: text;" class="btn bg-red waves-effect">
                                                    <i class="material-icons">error_outline</i>
                                                </button>
                                            @endif
                                        </td>
                                        <td nowrap>
                                            <center>
                                                <a href="{{ route('topic.edit', ['id' => $topic->id]) }}"><button class="btn bg-orange waves-effect" title="Edit this topic" type="button"><i class="material-icons">edit</i></button></a>
                                                <a href="{{ route('topic.delete', ['id' => $topic->id]) }}"><button class="btn bg-red waves-effect" title="Delete this topic" type="button"><i class="material-icons">delete</i></button></a>
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