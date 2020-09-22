@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>{{ $title }} <a href="{{ route('book.add') }}"><button class="btn bg-green waves-effect pull-right" type="button"><i class="material-icons">add</i> ADD BOOK</button></a></h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th style="text-align: center; width: 100px;">Short Name</th>
                                    <th style="text-align: center; width: 140px;"># of Verse(s)</th>
                                    <th style="text-align: center; width: 80px;">Priority #</th>
                                    <th style="width: 100px; text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th style="text-align: center; width: 100px;">Short Name</th>
                                    <th style="text-align: center; width: 140px;"># of Verse(s)</th>
                                    <th style="text-align: center; width: 80px;">Priority #</th>
                                    <th style="width: 100px; text-align: center;">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($model as $book)
                                    <tr>
                                        <td>{{ $book->name }}</td>
                                        <td style="text-align: center;">{{ $book->shortname }}</td>
                                        <td style="text-align: center;">
                                            <button type="button" class="btn bg-pink btn-lg waves-effect">{{ $book->verses_count }}</button>
                                        </td>
                                        <td style="text-align: center;">
                                            <button type="button" class="btn bg-purple btn-lg waves-effect">{{ $book->priority }}</button>
                                        </td>
                                        <td nowrap>
                                            <center>
                                                <a href="{{ route('book.edit', ['id' => $book->id]) }}"><button class="btn bg-orange waves-effect" title="Edit this book" type="button"><i class="material-icons">edit</i></button></a>
                                                <a href="{{ route('book.delete', ['id' => $book->id]) }}"><button class="btn bg-red waves-effect" title="Delete this book" type="button"><i class="material-icons">delete</i></button></a>
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