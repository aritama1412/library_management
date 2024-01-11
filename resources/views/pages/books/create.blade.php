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
        <form action="{{ route('books.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('books.index') }}" class="btn btn-sm btn-secondary btn-responsive float-left">
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
                                <label for="author_id">Author<span class="text-red">*</span></label>
                                <select class="form-control select2" style="width: 100%;" id='author_id' name="author_id" required>
                                    <option value="">── Select Author ──</option>
                                    @foreach ($authors as $author)
                                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-6">
                            <div class="form-group">
                                <label for="title">Title<span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                        </div>
                     
                        <div class="col-6">
                            <div class="form-group">
                                <label for="description">Description<span class="text-red">*</span></label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="3" required></textarea>
                            </div>
                        </div>
    
                        <div class="col-6">
                            <div class="form-group">
                                <label for="note">Note</label>
                                <textarea class="form-control" name="note" id="note" cols="30" rows="1"></textarea>
                            </div>
                        </div>
    
                        <div class="col-6">
                            <div class="form-group">
                                <label for="shelves_id">Shelf</label>
                                <select class="form-control select2" style="width: 100%;" id='shelves_id' name="shelves_id" required>
                                    <option value="">── Select Shelf ──</option>
                                    @foreach ($shelves as $shelf)
                                        <option value="{{ $shelf->id }}">{{ $shelf->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
    
                        <div class="col-6">
                            <div class="form-group">
                                <label for="release_date">Release Date</label>
                                <div class="input-group mb-0">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" name="release_date" autocomplete="off" class="datepicker form-control" id="release_date" placeholder="dd-M-yyyy" required>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div style="overflow: auto;" >
                        <a href="#" class="btn btn-primary btn-sm mt-2 mb-2" id="addData"><i class="fa fa-plus-square"></i> Add Genre</a>
                        <table class="table table-hover table-bordered table-striped " width='100%' id="tabel_tagihan">
                            <thead>
                                <tr>
                                    <th>Genre</th>
                                    <th style="width: 50px;">#</th>
                                </tr>
                            </thead>
                            <tbody id="result">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>

        <div class="modal fade" id="modal_detail" tabindex='-1'>
            <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Add Genre</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id='form_add_detail'>
                        <input type="hidden" name="key" id="key" > 
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label for="">Genre</label>
                                <select class="form-control select2" style="width: 100%;" id='modal_genres_id' name="modal_genres_id">
                                    <option value="">── Select Author ──</option>
                                    @foreach ($genres as $genre)
                                        <option value="{{ $genre->id }}">{{ $genre->genre }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="hidden_genre">
                            </div>
                          
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" style='width:85px' data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-sm btn-success save_detail" style='width:85px'>Add</button> 
                </div>
            </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#release_date').datepicker({
                autoclose: true,
                format: "dd-M-yyyy",
                todayHighlight: true,
                language:'en',
                orientation: "bottom" // add this for placemenet
            });

            $(document).on('click', '#addData', function(event){
                clear();

                $('#modal_detail').modal('show');
            });

            
            $(document).on('click', '.save_detail', function(event){
                const genre  = $('#modal_genres_id').val();
                const genre_hidden = $('#modal_genres_id').select2('data')
                $('#modal_genres_id').val(genre_hidden[0].text);

                let key = $('#key').val();
                if(key == '' || key == null){
                    $('#key').val(0);
                }
                key++;

                var row = $("<tr></tr>");
                row.append(`<td>${genre_hidden[0].text}</td>`)
                row.append(`<td>
                                <input type="hidden" name="data[${key}][genres_id]" value="${genre}" />
                                <button type="button" class="delete btn btn-danger"><i class="fa fa-trash-alt"></i></button>
                            </td>`);

                $("#result").append(row);
                $('#key').val(key);


                $('#modal_detail').modal('hide');
            });

            $(document).on('click', '.delete', function(event){
                var row = this.closest("tr");
                row.remove();
            });

            function clear(){
                $("#modal_genres_id").select2("val", "");
                $('#modal_genres_id').trigger('change'); // Notify any JS components that the value changed
            }
        });
    </script>
@endsection