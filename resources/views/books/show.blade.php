@extends('layout')
@section('title')
    item
@endsection
@section('content')
<div class="container">
    <h2> {{$book->title}} </h2>
    <p> {{$book->desc}} </p>
    <h4>categories:</h4>
    <ul>
        @foreach ($book->Categories as $cat)
            <a href="{{route('categories.show',$cat->id)}}" > {{$cat->name}} </a>
            <br>
        @endforeach
    </ul>
    <a class="btn btn-primary" href=" {{route('books.index')}} ">back to home</a>
    @auth
    @if (Auth::user()->is_admin == 1)
    <a class="btn btn-info" href=" {{route('books.edit',$book->id)}} ">edit</a>
    <a class="btn btn-danger" href=" {{route('books.delete',$book->id)}} ">delete</a>
    @endif
    @endauth
</div>
@endsection