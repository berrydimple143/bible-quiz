@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>TAGS TABLE FOR "{{ $model->title }}"<a href="{{ route('post.tag.add', ['id' => $model->id]) }}"><button class="btn bg-green waves-effect pull-right" type="button"><i class="material-icons">add</i> ADD TAG</button></a></h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>Tag Name</th>
                                    <th>Tag Slug</th>
                                    <th style="width: 110px; text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Tag Name</th>
                                    <th>Tag Slug</th>
                                    <th style="width: 110px; text-align: center;">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($model->tags as $tag)
                                    <tr>
                                        <td>{{ $tag->name  }}</td>
                                        <td>{{ $tag->slug  }}</td>
                                        <td nowrap>
                                            <center>
                                                <a href="{{ route('post.tag.delete', ['id' => $model->id, 'tag_id' => $tag->id]) }}"><button class="btn bg-red waves-effect" data-toggle="tooltip" data-placement="top" title="Delete this tag" type="button"><i class="material-icons">delete</i></button>
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