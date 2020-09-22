@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>QUIZZES TABLE <a href="{{ route('quiz.add') }}"><button class="btn bg-green waves-effect pull-right" type="button"><i class="material-icons">add</i> ADD QUIZ</button></a></h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">ID</th>
                                    <th style="text-align: center;">Question</th>
                                    <th style="text-align: center;">Answer</th>
                                    <th style="text-align: center;">Verse(s)</th>
                                    <th style="text-align: center;">Category</th>
                                    <th style="text-align: center;">Level</th>
                                    <th style="text-align: center;">Choices</th>
                                    <th style="text-align: center;">Status</th>
                                    <th style="width: 100px; text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Verse(s)</th>
                                    <th>Category</th>
                                    <th>Level</th>
                                    <th>Choices</th>
                                    <th>Status</th>
                                    <th style="width: 100px; text-align: center;">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($model as $quiz)
                                    <tr>
                                        <td>{{ $quiz->id }}</td>
                                        <td>{{ $quiz->question }}</td>
                                        <td>{{ $quiz->answer }}</td>
                                        <td>{{ $quiz->verse }}</td>
                                        <td>{{ $quiz->category }}</td>
                                        <td>{{ $quiz->type }}</td>
                                        <td style="text-align: center;">
                                            <a href="{{ route('quiz.choices', ['id' => $quiz->id]) }}"><button type="button" class="btn bg-pink btn-lg waves-effect" data-toggle="tooltip" data-placement="top" title="Click to see all comments for this post">
                                                {{ $quiz->choices_count }}
                                            </button></a>  
                                        </td>
                                        </td>
                                        <td style="text-align: center;">
                                            @if($quiz->status == "active")
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
                                                <a href="{{ route('quiz.edit', ['id' => $quiz->id]) }}"><button class="btn bg-orange waves-effect" title="Edit this quiz" type="button"><i class="material-icons">edit</i></button></a>
                                                <a href="{{ route('quiz.delete', ['id' => $quiz->id]) }}"><button class="btn bg-red waves-effect" title="Delete this quiz" type="button"><i class="material-icons">delete</i></button></a>
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