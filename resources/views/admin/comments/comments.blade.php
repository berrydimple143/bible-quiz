@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>COMMENTS TABLE 
                        @if($user->membership == "admin")
                            <a href="{{ route('comment.add') }}"><button class="btn bg-green waves-effect pull-right" type="button"><i class="material-icons">add</i> ADD COMMENT</button></a>
                        @endif
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>Post Title</th>
                                    <th>Message</th>
                                    <th>Commented By</th>
                                    <th>Email</th>
                                    <th>Date Commented</th>
                                    <th style="width: 160px; text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Post Title</th>
                                    <th>Message</th>
                                    <th>Commented By</th>
                                    <th>Email</th>
                                    <th>Date Commented</th>
                                    <th style="width: 160px; text-align: center;">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($model as $cm)
                                    <?php
                                        $dt = new \Carbon\Carbon($cm->created_at);
                                        $fmt = $dt->toFormattedDateString();
                                    ?>
                                    <tr>
                                        <td>{{ $cm->post->title }}</td>
                                        <td>{{ $cm->message }}</td>
                                        <td>{{ $cm->name }}</td>
                                        <td>{{ $cm->email }}</td>
                                        <td class="center">{{ $fmt }}</td>
                                        <td nowrap>
                                            <center>
                                                <a href="{{ route('comment.edit', ['id' => $cm->id]) }}"><button class="btn bg-orange waves-effect" title="Edit this comment" type="button"><i class="material-icons">edit</i></button></a>
                                                <a href="{{ route('comment.delete', ['id' => $cm->id]) }}"><button class="btn bg-red waves-effect" title="Delete this comment" type="button"><i class="material-icons">delete</i></button></a>
                                                <a href="{{ route('comment.show', ['id' => $cm->id]) }}"><button class="btn bg-green waves-effect" title="View this comment" type="button"><i class="material-icons">search</i></button></a>
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