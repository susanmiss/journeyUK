@extends('layouts.app')
@section('content')




<div class="container-fluid">
    <div class="jumbotron">
        <h2>{{ $categories->name }}</h2>

            <div class="btn-group">
                <a href="{{ route('categories.edit', $categories->id) }}" class=" btn btn-warning btn-sm btn-margin-right">
            Edit Category
                </a>

                <form action="{{ route('categories.destroy', $categories->id) }}" method="post">
                {{method_field('delete')}}
                    <button class="btn btn-danger btn-sm pull-left">
                        Delete Category
                    </button>
                {{csrf_field()}}

                </form>
            </div>
    </div>


    <div class="col-md-12">
        @foreach($categories->blog as $blog)
            <h3><a href="{{ route('blogs.show', $blog->id) }}">{{$blog->title}}</a></h3>
        @endforeach
    </div>
    

</div>



@endsection