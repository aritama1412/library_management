@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Books</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('books.create') }}" class="btn btn-sm btn-primary btn-responsive float-left">
                    <i class="fa fa-plus-circle mr-1" aria-hidden="true"> </i> Add Book
                </a> 

                <div class="card-tools">
                </div>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-bordered table-striped table-hover" width='100%'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Shelf</th>
                            <th>Release date</th>
                            <th width="150">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td>{{ $book->id }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->getAuthor->name }}</td>
                                <td>{{ $book->getShelf->name }}</td>
                                <td>{{date("d-M-Y", strtotime($book->release_date))}}</td>
                                <td>
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-primary btn-responsive float-left">
                                        <i class="fa fa-pencil-alt mr-1" aria-hidden="true"> </i> Edit
                                    </a> 
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST">
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
