@extends('layouts.app')

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
                <div class="card-header">Add Books</div>

                <div class="card-body">
                    {!! Form::open(['action' => 'BooksController@create', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}                        
                        <div class="row">
                            <div class="col-md-4">Book Name</div>
                            <div class="col-md-6">                               
                                {{Form::text('book_name', '', ['class' => 'form-control', 'placeholder' => 'Book Name', 'required' => 'required'])}}
                            </div>
                            <div class="col-md-2 text-center">                              
                                {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
                            </div>
                        </div>    
                    {!! Form::close() !!}
                    @if(isset($books))
                        <br/>
                        <div class="row">                                            
                            <div class="col-md-12" text-align="center">
                                <table cellspacing="0"  cellpadding="0" width="100%" class=" table table-bordered ">
                                    <thead class="thead-light text-center">                    
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Book Name</th>
                                            <th class="text-center">Updated at</th>
                                        </tr>
                                    </thead>
                                    <tbody>                      
                                        @php $sl =0 @endphp
                                        @foreach($books as $book)
                                            <tr>
                                                <td class="text-center">{{$sl+=1}}</td>
                                                <td class="text-center">{{$book->book_name}}</td>
                                                <td class="text-center">{{$book->created_date}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>                            
                            </div>                        
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                @if($books instanceof \Illuminate\Pagination\LengthAwarePaginator )
                                    {{$books->links()}}
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
