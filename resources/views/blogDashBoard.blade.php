@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="postAdd col-lg-12 text-right" style="margin-bottom: 20px;">
           <a href="{{url('/add-post')}}" class="btn btn-primary">Add Post</a>
       </div>   
   </div>
   <posts-component></posts-component>
</div>
@endsection