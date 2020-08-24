@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <p>Thank You For Login</p>

                    <hr>


                    <a href="/posts/create" class="btn btn-primary">Create New Post</a>
                    <hr>
                            <table class="table table-striped">

<tr>
    <th>Post Title</th>
    <th>Create Time</th>
    <th>Edit</th>
    <th>Delete</th>
</tr>
@foreach ($posts as $post)
    <tr>
    <td>{{$post->title}}</td>
    <td>{{ $post->created_at->format('d.m.Y') }}</td>
    <td><a href="/posts/{{$post->id}}/edit" class="btn btn-info">Edit</a></td>
        <td>{!! Form::open(['action' => ['PostController@destroy',$post->id],'method'=>'POST','class'=>'float-right']) !!}
            {!! Form::hidden('_method','DELETE') !!}
            {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}


            {!! Form::close() !!}</td>
    </tr>
@endforeach
                            </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
