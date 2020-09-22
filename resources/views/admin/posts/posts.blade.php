@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>POSTS TABLE <em>({{ $model->count() }} out of {{ $params }})</em><a href="{{ route('post.add') }}"><button class="btn bg-green waves-effect pull-right" type="button"><i class="material-icons">add</i> ADD POST</button></a></h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th style="text-align: center;">Comment(s)</th>
                                    <th style="text-align: center;">Visit(s)</th>
                                    @if($user->membership == "admin")
                                        <th>Status</th>
                                    @endif
                                    <th>Link</th>
                                    <th style="width: 110px; text-align: center;" nowrap>Published At</th>
                                    <th>Published</th>
                                    <th style="width: 110px; text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Title</th>
                                    <th style="text-align: center;">Comment(s)</th>
                                    <th style="text-align: center;">Visit(s)</th>
                                    @if($user->membership == "admin")
                                        <th>Status</th>
                                    @endif
                                    <th>Link</th>
                                    <th style="text-align: center;" nowrap>Published At</th>
                                    <th>Published</th>
                                    <th style="width: 110px; text-align: center;">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($model as $ps)
                                    <?php
                                        $link = 'https://onlinestorehouse.com/blog/'. $ps->slug .'-'. $ps->id; 
                                        $dt = new \Carbon\Carbon($ps->date_posted);
                                        $fmt = $dt->toFormattedDateString();
                                    ?>
                                    <tr>
                                        <td>{{ $ps->title }}</td>
                                        <td style="text-align: center;">
                                            <a href="{{ route('post.comments.show', ['id' => $ps->id]) }}"><button type="button" class="btn bg-pink btn-lg waves-effect" data-toggle="tooltip" data-placement="top" title="Click to see all comments for this post">
                                                {{ $ps->comments_count }}
                                            </button></a>  
                                        </td>
                                        <td style="text-align: center;">
                                            <button type="button" class="btn bg-pink btn-lg waves-effect" data-toggle="tooltip" data-placement="top" title="Overall number of visitors">
                                                {{ $ps->visit }}
                                            </button>
                                        </td>
                                        @if($user->membership == "admin")
                                            <td>
                                                @if($ps->status == "active")
                                                    <button type="button" class="btn bg-green waves-effect" data-toggle="tooltip" data-placement="top" title="This article is active">
                                                        <i class="material-icons">check_circle</i>
                                                    </button>
                                                @else
                                                    <button type="button" class="btn bg-red waves-effect" data-toggle="tooltip" data-placement="top" title="This article is not active">
                                                        <i class="material-icons">error_outline</i>
                                                    </button>
                                                @endif
                                            </td>
                                        @endif
                                        <td><a href="{{ $link }}" data-toggle="tooltip" data-placement="top" title="Click to view this article/post" target="_blank">{{ $link }}</a></td>
                                        <td>{{ $fmt }}</td>
                                        <td>
                                            <center>
                                            @if($ps->published == "yes")
                                                <button type="button" data-toggle="tooltip" data-placement="top" title="Already published" class="btn bg-green waves-effect">
                                                    <i class="material-icons">check_circle</i>
                                                </button>
                                            @else
                                                <button type="button" data-toggle="tooltip" data-placement="top" title="Not published yet" class="btn bg-red waves-effect">
                                                    <i class="material-icons">error_outline</i>
                                                </button>
                                            @endif
                                            </center>
                                        </td>
                                        <td nowrap>
                                            <center>
                                                <a href="{{ route('post.edit', ['id' => $ps->id]) }}"><button class="btn bg-orange waves-effect" data-toggle="tooltip" data-placement="top" title="Edit this post" type="button"><i class="material-icons">edit</i></button></a>
                                                <a href="{{ route('post.delete', ['id' => $ps->id]) }}"><button class="btn bg-red waves-effect" data-toggle="tooltip" data-placement="top" title="Delete this post" type="button"><i class="material-icons">delete</i></button></a>
                                                <a href="{{ route('post.tags', ['id' => $ps->id]) }}"><button class="btn bg-primary waves-effect" data-toggle="tooltip" data-placement="top" title="Show all tags of this post" type="button"><i class="material-icons">bookmark</i></button></a>
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
    <script>
        $('[data-toggle="tooltip"]').tooltip();
    </script>
@endsection