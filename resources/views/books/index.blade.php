@extends('layout')
@section('title')
    Home
@endsection
@section('content')

{{-- <div class="container">
    <div class="mb-3">
        <label class="form-label">find a book</label>
        <input type="email" class="form-control" id="keyword" >
    </div>
</div> --}}


@auth
    <div class="container">
        <h2>Your Notes:</h2>
        @foreach (Auth::user()->notes as $note)
                <div class="mb-3" style="display: flex; width:250px; justify-content: space-between;">
                    <h5>{{$note->content}}</h5> 
                    <a class="btn btn-danger" href="{{route('notes.delete',$note->id)}}">delete</a>
                </div>
        @endforeach
        <a class="btn btn-primary" href="{{route('notes.create')}}">Add new note</a>
    </div>
@endauth
    <div class="container mt-3">
        <h1>All books</h1>
        @foreach ($books as $book)
        <a  class="display-6" style="text-decoration: none" href="{{route('books.show', $book->id)}}">{{$book->title}}</a>
        <h5 class="mt-3" >{{$book->desc}}</h5>
        @endforeach
        <div class="d-flex justify-content-center mt-5">
            {{$books->render()}}
        </div>
    </div>
@endsection

{{-- @section('script')
    <script>
        $('#keyword').keyup(function(){
          let keyword =  $(this).val();
          let url = "{{route('books.search')}}" + "?keyword=" + keyword
        //   console.log(url)
          $.ajax({
            type:"get",
            url: url ,
            contentType: false,
            processData: false,
            success: function (data){
                // console.log(data);
                for (book of data){
                   console.log(book.title) 
                }
            }
          })
        })
    </script>
@endsection --}}