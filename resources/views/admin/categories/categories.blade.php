@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>CATEGORIES TABLE <a href="{{ route('category.add') }}"><button class="btn bg-green waves-effect pull-right" type="button"><i class="material-icons">add</i> ADD CATEGORY</button></a></h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th style="text-align: center;">Post(s)</th>
                                    <th>Status</th>
                                    <th>Dummy</th>
                                    <th>Reported</th>
                                    <th style="text-align: center;">Icon</th>
                                    <th style="width: 160px; text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th style="text-align: center;">Post(s)</th>
                                    <th>Status</th>
                                    <th>Dummy</th>
                                    <th>Reported</th>
                                    <th style="text-align: center;">Icon</th>
                                    <th style="width: 160px; text-align: center;">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($model as $cat)
                                    <tr>
                                        <td>{{ $cat->name }}</td>
                                        <td>{{ Illuminate\Support\Str::limit($cat->description, 130) }}</td>
                                        <td style="text-align: center;">{{ $cat->posts_count }}</td>
                                        <td>
                                            @if($cat->status == "active")
                                                <button type="button" title="Active" class="btn bg-green waves-effect">
                                                    <i class="material-icons">check_circle</i>
                                                </button>
                                            @else
                                                <button type="button" title="Inactive" class="btn bg-red waves-effect">
                                                    <i class="material-icons">error_outline</i>
                                                </button>
                                            @endif
                                        </td>
                                        <td>
                                            @if($cat->dummy == "yes")
                                                <button type="button" title="Yes" class="btn bg-green waves-effect">
                                                    <i class="material-icons">check_circle</i>
                                                </button>
                                            @else
                                                <button type="button" title="No" class="btn bg-red waves-effect">
                                                    <i class="material-icons">error_outline</i>
                                                </button>
                                            @endif
                                        </td>
                                        <td>
                                            @if($cat->reported == "yes")
                                                <button type="button" title="Yes" class="btn bg-green waves-effect">
                                                    <i class="material-icons">check_circle</i>
                                                </button>
                                            @else
                                                <button type="button" title="No" class="btn bg-red waves-effect">
                                                    <i class="material-icons">error_outline</i>
                                                </button>
                                            @endif
                                        </td>
                                        <td style="text-align: center;">{{ $cat->icon }}</td>
                                        <td nowrap>
                                            <center>
                                                <a href="{{ route('category.edit', ['id' => $cat->id]) }}"><button class="btn bg-orange waves-effect" title="Edit this category" type="button"><i class="material-icons">edit</i></button></a>
                                                <a href="{{ route('category.delete', ['id' => $cat->id]) }}"><button class="btn bg-red waves-effect" title="Delete this category" type="button"><i class="material-icons">delete</i></button></a>
                                                <a href="{{ route('category.show', ['id' => $cat->id]) }}"><button class="btn bg-green waves-effect" title="View posts" type="button"><i class="material-icons">speaker_notes</i></button></a>
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