@extends('layouts.app')
@section('content')


<div class="container-fluid">
    <div class="jumbotron">
        <h1>Create a new category</h1>    
    </div>

    <div class="col-md-12">
        <form action="{{ route('categories.store')}}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <lable for="title">Category Name</lable>
                <input type="text" name="name" class="form-control">
            </div>

            <div class="form-group">
                <label class="btn-btn-default">
                <span class="btn btn-outline btn-sm btn-info">Upload Image </span>
                <input type="file" name="featured_image" class="form-controller" hidden>
                </label>
            </div>
      
            <button class="btn btn-primary" type="submit">
                 Create a new Category
            </button>

            {{ csrf_field() }}
          
        </form>
    </div>

   
    
</div>

@endsection