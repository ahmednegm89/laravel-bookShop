@extends('layout')
@section('title')
categories 
@endsection
@section('content')
    <div class="container mt-3">
        <h1>All categories 
            @if (Auth::user() !== null)
            @if (Auth::user()->is_admin == 1)
            <a href="{{route('categories.create')}}">ADD NEW</a>
            @endif
            @endif
         </h1> 
        @foreach ($categories as $Category)
        <a  class="display-6" style="text-decoration: none" href="{{route('categories.show', $Category->id)}}">{{$Category->name}}</a> 
        <br>
        @endforeach
        <div class="d-flex justify-content-center mt-5">
            {{$categories->render()}}
        </div>
    </div>
@endsection