@extends('layouts.app')

@section('includes')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/css/bootstrap-select.css" />

        
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/js/bootstrap-select.js"></script>

    <style>
        .caret {
            display: none !important;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('.date').datepicker({  
                format: 'yyyy-mm-dd'
            }); 
            $("select").selectpicker();
        });
    </script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(isset($message))
                <div class="alert alert-success" role="alert">
                   {{$message}}
                </div>
            @endif
            
            @if(!empty($error))
                <div class="alert alert-danger" role="alert">
                  {{$error}}
                </div>
            @endif
            
            @if(!empty($errors))
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            <div class="card">
                <div class="card-header">Issue Books</div>

                <div class="card-body">
                    {!! Form::open(['action' => 'BooksController@storeBookIssued', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}                        
                        <div class="row">
                            <div class="col-md-6">
                                Select Book
                                {{Form::select("book_id", $books, old('book_id'), ["id"=> "book_id", "class" => "form-control selectpicker", "placeholder" => "Select Book"])}}
                            </div>                              
                            <div class="col-md-6">  
                                Select Person
                                {{Form::select("person_id", $people, old('person_id'), ["id"=> "person_id", "class" => "form-control selectpicker", "placeholder" => "Select Person"])}}
                            </div>
                        </div><br/>
                        <div class="row">
                            <div class="col-md-6">
                                Date
                                <input type="text" name="date" id="datepicker" class="form-control date" autocomplete="off" />
                            </div>
                            <div class="col-md-2 text-center"><br/>                              
                                {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
                            </div>
                        </div>
                    {!! Form::close() !!}                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
