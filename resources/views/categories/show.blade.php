@extends('layouts.app')
@section('content')




<div class="container-fluid">




        <h2>
          
            {{ $categories->name }}
        
         <h2>

         <img src="/images/featured_image/{{ $categories->featured_image ? $categories->featured_image : '' }}" alt="{{$categories->name }}" class="img-responsive featured_image">
       



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




</div>



@endsection