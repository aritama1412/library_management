@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>Authors</h1>
            </div>
        </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <a href="{{ route('authors.create') }}" class="btn btn-sm btn-primary btn-responsive float-left">
                        <i class="fa fa-plus-circle mr-1" aria-hidden="true"> </i> Add Author
                    </a> 
                </h3>

                <div class="card-tools">
                    
                </div>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-bordered table-striped table-hover" width='100%'>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>About</th>
                            <th width="150">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($authors as $author)
                            <tr>
                                <td>{{ $author->name }}</td>
                                <td>{{ $author->about }}</td>
                                <td>
                                    <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-sm btn-primary btn-responsive float-left">
                                        <i class="fa fa-pencil-alt mr-1" aria-hidden="true"> </i> Edit
                                    </a> 
                                    <form action="{{ route('authors.destroy', $author->id) }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-sm btn-danger ml-2 btn-responsive float-left" onclick="return confirm('Are you sure?')">
                                            <i class="fa fa-trash-alt mr-1" aria-hidden="true"> </i> Delete
                                        </button> 
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('#datatable').dataTable({

            });
        });
    </script>

@endsection
