@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        <a href="/posts" class="btn btn-primary float-right">Back</a>
            <div class="card-heading">
                <h2>{{$post->title}}</h2>
                </div>

    </div>
    <hr>
    <img style="width: 100%;height:400px" src="/storage/cover_images/{{$post->cover_image}}" alt="Cover Image" srcset="">
<hr>
<div class="card-body"><p>{!!$post->body!!}</p></div>
<div class="card-footer"><p>Writen Time : {{$post->created_at->format('D,M,Y')}} Writen by {{$post->user->name}}</p>
</div>


</div>
<hr>
@if (!Auth::guest())
@if (Auth::user()->id == $post->user_id)



<a href="/posts/{{$post->id}}/edit" class="btn btn-secondary">Update</a>
{!! Form::open(['action' => ['PostController@destroy',$post->id],'method'=>'POST','class'=>'float-right']) !!}
{!! Form::hidden('_method','DELETE') !!}
{!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
{!! Form::close() !!}
@endif
@endif
@endsection
