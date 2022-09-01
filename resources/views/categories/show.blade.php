@extends('layout')
@section('title')
    Category 
@endsection
@section('content')
<div class="container">
    <h2> {{$Category->name}} </h2>
    <h4>books:</h4>
    <ul>
        @foreach ($Category->books as $book)
            <a href="{{route('books.show',$book->id)}}" > {{$book->title}} </a>
            <br>
        @endforeach
    </ul>
    <a class="btn btn-primary" href=" {{route('categories.index')}} ">back to home</a>
    @auth
    @if (Auth::user()->is_admin == 1)
    <a class="btn btn-info" href=" {{route('categories.edit',$Category->id)}} ">edit</a>
    <a class="btn btn-danger" href=" {{route('categories.delete',$Category->id)}} ">delete</a>                
    @endif
    @endauth
</div>
@endsection