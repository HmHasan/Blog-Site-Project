@extends('layouts.app')
@section('content')
<h2>All Post</h2>
        <div class="card">
            @if (count($posts) > 0)
            @foreach ($posts as $post)
            <div class="card-header">
                <div class="card-heading">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                        <img style="width: 100%" src="/storage/cover_images/{{$post->cover_image}}" alt="Cover Image" srcset="">
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <h2><a href="/posts/{{$post->id}}">{{$post->title}}</a></h2>
                <p>Writen Time : {{$post->created_at->format('D,M,Y')}} by {{$post->user->name}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            @endforeach
            @else
            <p>No Post In Database</p>
            @endif
        </div>
@endsection
