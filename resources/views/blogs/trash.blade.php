@extends('layouts.app')
@section('content')


<h1>Latest Blogs</h1> 

<hr/>

<div class="container-fluid">
    <div class="jumbotron">
        <h1>Trashed Posts  :( </h1>
    </div>
</div>

<div class="col-md-12"> 
    @foreach ($trashedBlogs as $blog)
            <h2>
                {{ $blog->title }}
             
            <h2>
            
            <p>{{ $blog->body}}</p>

            <br />


    <div class="btn-group">
        <form action="{{ route('blogs.restore', $blog->id) }}" method="get">
            <button type="submit" class="btn btn-success btn-xs pull-left">
                Restore Post
            </button>
            {{ csrf_field()}}
        </form>

        <form action="{{ route('blogs.permanent-delete', $blog->id) }}" method="post">
            {{ method_field('delete') }}
            <button type="submit" class="btn btn-danger btn-xs pull-left">
                Permanent Delete
            </button>
            {{ csrf_field()}}
        </form>
    </div>

    @endforeach

</div>

  

@endsection