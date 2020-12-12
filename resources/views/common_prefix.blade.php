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
                <div class="card-header">Common Prefix</div>

                <div class="card-body">
                   @php 
                    print_r($array_common_prefix);
                    echo '<br/>';
                    echo $message1;

                    echo '<br/><br/>';
                    print_r($array_no_common_prefix);
                    echo '<br/>';
                    echo $message2;
                    @endphp
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
