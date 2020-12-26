@extends('layouts.app')
@section('content')



<div class="container-fluid">
    <div class="jumbotron">
        <h1>Contact Trip4Me</h1>    
    </div>

    <div class="col-md-12">
        <form action="{{ route('mail.send') }}" method="post" enctype="multipart/form-data">

            @include('partials.error-message')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name')}}">
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input name="email" type="email" value="{{ old('email')}}"  class="form-control"/>
            </div>

            <div class="form-group">
                <label for="subject">Subject</label>
                <input name="subject" type="text" value="{{ old('subject')}}" class="form-control"/>
            </div>  

            <div class="form-group">
                <label for="mail_message">Message</label>
                <textarea type="text" name="mail_message" class="form-control my-editor" value="{{ old('mail_message')}}"></textarea>
            </div>  


            <div>
                <button class="btn btn-primary" type="submit">
                    Send a Hi :)
                </button>
            </div>

            {{ csrf_field() }}
          
        </form>
    </div>

   
    
</div>

@endsection