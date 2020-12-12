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
        function setIssueDateID(id, date)
        {
            $("#issue_id").val(id);
            $("#issue_date").val(date);
        }
        function calcRent(return_date)
        {
            const date1 = new Date($("#issue_date").val());  
            const date2 = new Date(return_date);  
  
            //calculate time difference  
            const time_difference = date2.getTime() - date1.getTime();  
  
            //calculate days difference by dividing total milliseconds in a day  
            const days_difference = time_difference / (1000 * 60 * 60 * 24);  
            if(days_difference < 0) 
            {
                $("#return_date").val('');
                $("#rent").val('0');
            }
            else
            {
                const rent = days_difference*2;
                $("#rent").val(rent);
            }
        }
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
                <div class="card-header">Books Issued</div>

                <div class="card-body">
                    {!! Form::open(['action' => 'BooksController@getAllBookIssued', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}                        
                       
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
                    @if(isset($booksIssued))
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
                                            <th class="text-center">Total Rent</th>
                                            <th class="text-center">Return</th>
                                        </tr>
                                    </thead>
                                    <tbody>                      
                                        @php $sl =0 @endphp
                                        @foreach($booksIssued as $book)
                                           
                                            <tr>
                                                <td class="text-center">{{$sl+=1}}</td>
                                                <td class="text-center">{{$book->books->book_name}}</td>
                                                <td class="text-center">{{$book->person->name}}</td>
                                                <td class="text-center">{{$book->issue_date}}</td>
                                                <td class="text-center">
                                                    @php
                                                        $today = date_create(date("Y-m-d"));
                                                        $issue_date = date_create($book->issue_date);
                                                        $diff = $today->diff($issue_date)->format("%a");
                                                        echo "Rs. ".$rent = 2 * $diff;
                                                    @endphp
                                                </td>
                                                <td class="text-center">
                                                    <a href="javascript:void(0)" onClick="setIssueDateID({{$book->id}}, '{{$book->issue_date}}')" data-toggle="modal" data-target="#returnModal" class="btn btn-sm btn-success">Return Book</a>
                                                </td>
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
<!-- Modal -->
<div class="modal" id="returnModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open(['action' => 'BooksController@returnBook', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}  
                <div class="modal-header">
                    <h5 class="modal-title">Return Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" name="issue_id" id="issue_id" value=""/>
                            <input type="hidden" name="issue_date" id="issue_date" value=""/>
                            Select Return Date
                            <input type="text" name="return_date" id="return_date" autocomplete="off" class="form-control date" value="" onchange="calcRent(this.value)"  required/>
                        </div>
                        <div class="col-md-6">
                            Total Rent
                            <input type="text" name="rent"  id="rent" autocomplete="off" class="form-control" required/>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Return Book</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection