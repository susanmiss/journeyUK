@extends('layouts.app')
@section('content')


<div class="container-fluid">
    <div class="jumbotron">
        <h1>Edit category</h1>    
    </div>

    <div class="col-md-12">
        <form action="{{ route('categories.update', $categories->id) }}" method="post">
            {{method_field('patch')}}
            <div class="form-group">
                <lable for="title">Category Name</lable>
                <input type="text" name="name" class="form-control" value="{{ $categories->name }}">
            </div>
      
            <button class="btn btn-primary" type="submit">
                 Edit Category
            </button>

            {{ csrf_field() }}
          
        </form>
    </div>

   
    
</div>

@endsection