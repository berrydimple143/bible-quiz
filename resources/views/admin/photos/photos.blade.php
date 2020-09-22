@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>PHOTO GALLERY <em>({{ $model->count() }} out of {{ $params }})</em><a href="{{ route('photo.add') }}"><button class="btn bg-green waves-effect pull-right" type="button"><i class="material-icons">add_a_photo</i> ADD PHOTO</button></a></h2>
                </div>
                <div class="body">
                    <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                        @forelse($model as $m)
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                <?php $src = asset('uploads/photos/'. $m->filename); ?>
                                <a href="{{ route('photo.select', ['id' => $m->id]) }}" data-toggle="tooltip" data-placement="top" title="Click to edit or delete this image">
                                    <img class="img-responsive thumbnail" src="{{ $src }}">
                                </a>
                            </div>
                        @empty
                            <div class="alert bg-red" role="alert">
                                <strong><i class="material-icons">warning</i> &nbsp;&nbsp;You have no active images yet. Please add one.</strong><br/><br/>
                                <p><strong>Note:</strong> If you've already uploaded an image and it's not showing here, maybe it's pending for approval or disapproved due to obscene content.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('[data-toggle="tooltip"]').tooltip();
    </script>
@endsection