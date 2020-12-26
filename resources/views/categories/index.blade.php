@extends('layouts.app')
@section('content')


<h1>Latest CAtegories</h1> 

<hr/>

    @foreach ($categories as $category)
        <h2>
            <a href="{{ route('categories.show', $category->slug) }}" >
            {{ $category->name }}
            </a>
         <h2>
       

    @endforeach

@endsection