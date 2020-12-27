@extends('layouts.app')
@section('content')


<h1>Latest CAtegories</h1> 

<hr/>

    @foreach ($categories as $category)
        <h2>
            <a href="{{ route('categories.show', $category->id) }}" >
            {{ $category->name }}
            </a>
         <h2>

         <img src="/images/featured_image/{{ $category->featured_image ? $category->featured_image : '' }}" alt="{{$category->title }}" class="img-responsive featured_image">
       

    @endforeach

@endsection