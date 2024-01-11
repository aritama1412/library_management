@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Genres</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <form action="{{ route('genres.update', $genre->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('genres.index') }}" class="btn btn-sm btn-secondary btn-responsive float-left">
                        <i class="fa fa-arrow-left mr-1" aria-hidden="true"> </i> Back
                    </a> 
                    <button type="submit" class="btn btn-sm ml-2 btn-success btn-responsive float-left">
                        <i class="fa fa-save mr-1" aria-hidden="true"> </i> Save
                    </button> 
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="genre">Genre<span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="genre" name="genre" value="{{ $genre->genre }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <script type="text/javascript">
        $(document).ready(function() {
    
        });
    </script>
@endsection