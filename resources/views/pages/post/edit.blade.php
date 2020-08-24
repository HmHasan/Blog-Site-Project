@extends('layouts.app')
@section('content')
<h2>Update Post</h2>
{!! Form::open(['action' => ['PostController@update',$post->id],'method'=>'POST','enctype'=>'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {!! Form::text('title',$post->title, ['class'=>'form-control','placeholder'=>'Blog Title']) !!}
    </div>
    <div class="form-group">
        {!! Form::textarea('body',$post->body, ['class'=>'form-control description','Placeholder'=>'Blog']) !!}
    </div>
    <div class="form-group">
        {!! Form::file('cover_image',['class'=>'form-control']) !!}
    </div>
    {!! Form::hidden('_method','put') !!}
    <div class="form-group">
        {!! Form::submit('Update', ['class'=>'btn btn-primary']) !!}
    </div>
{!! Form::close() !!}

@endsection


{{-- <textarea class="description" name="description"></textarea> --}}
