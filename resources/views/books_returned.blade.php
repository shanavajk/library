@extends('layouts.app')

@section('includes')
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>


    <script>
        $(document).ready(function() {
            $('.date').datepicker({  
                format: 'yyyy-mm-dd'
            }); 
           
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

            @if(!empty($errors))
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            <div class="card">
                <div class="card-header">Books Returned</div>

                <div class="card-body">
                    {!! Form::open(['action' => 'BooksController@getBooksReturned', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}                        
                       
                        <div class="row">
                            <div class="col-md-6">
                                Date
                                <input type="text" name="date" id="datepicker" autocomplete="off" class="form-control date" value="{{$date}}" />
                            </div>
                            <div class="col-md-2 text-center"><br/>                              
                                {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
                            </div>
                        </div>
                    {!! Form::close() !!}
                    @if(isset($booksReturned))
                        <br/>
                        <div class="row">                                            
                            <div class="col-md-12" text-align="center">
                                <table cellspacing="0"  cellpadding="0" width="100%" class=" table table-bordered ">
                                    <thead class="thead-light text-center">                    
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Book Name</th>
                                            <th class="text-center">Person Name</th>
                                            <th class="text-center">Issued at</th>
                                            <th class="text-center">Return Date</th>
                                            <th class="text-center">Rent</th>
                                        </tr>
                                    </thead>
                                    <tbody>                      
                                        @php $sl =0 @endphp
                                        @foreach($booksReturned as $book)
                                            <tr>
                                                <td class="text-center">{{$sl+=1}}</td>
                                                <td class="text-center">{{$book->books->book_name}}</td>
                                                <td class="text-center">{{$book->person->name}}</td>
                                                <td class="text-center">{{$book->issue_date}}</td>
                                                <td class="text-center">{{$book->return_date}}</td>
                                                <td class="text-center">{{$book->rent}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>                            
                            </div>                        
                        </div>                       
                    @endif             
                </div>
            </div>
        </div>
    </div>    
</div>

@endsection