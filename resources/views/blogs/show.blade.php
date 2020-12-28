@extends('layouts.app')
@section('content')






<div class="container-fluid">
    <article>
        <div class="jumbotron">

            <h1>
                {{ $blog->title }}
             
            </h1>  

            @if(Auth::user())
            

            <div class="col-md-12">
            <div class="btn-group">
            <a href="{{  route('blogs.edit', $blog->id)}}" class="btn btn-primary btn-sm pull-left">Edit your blog</a>

            <form method="post" action="{{ route('blogs.delete', $blog->id) }}">
                {{ method_field('delete') }}
                <button type="submit" class="btn btn-danger btn-sm pull-left">Delete</button>

                {{ csrf_field() }}
            </form> 
            </div> 
        </div>

        </div>

       
        @endif

        <div class="col-md-12">
                @if($blog->featured_image)
                    <img src="/images/featured_image/{{ $blog->featured_image ? $blog->featured_image : '' }}" alt="{{$blog->title }}" class="img-responsive featured_image">
                @endif    
            </div>

      
           
        <div class="col-md-12">
           {!! $blog->body !!}

            <br>
           @if($blog->user)
             Author: <a href="{{ route('users.show', $blog->user->name) }}">{{ $blog->user->name}} </a> | Posted: {{ $blog->created_at->diffForHumans() }}
            @endif  
  
            <hr>
            
          

        </div>

      

    </article>

    <aside>
    <div id="disqus_thread"></div>
<script>
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://trip4me.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>


</aside>

</div>

@endsection