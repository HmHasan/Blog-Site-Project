@extends('layouts.app')
@section('content')
<h2>Create New Post</h2>
{!! Form::open(['action' => 'PostController@store','method'=>'post','enctype'=>'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {!! Form::text('title','', ['class'=>'form-control','placeholder'=>'Blog Title']) !!}
    </div>
    <div class="form-group">
        {!! Form::textarea('body','', ['class'=>'form-control description','Placeholder'=>'Blog']) !!}
    </div>
    <div class="form-group">
        {!! Form::file('cover_image',['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
    </div>
{!! Form::close() !!}

@endsection


{{-- <textarea class="description" name="description"></textarea> --}}
