@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-end mb-2">
    <a href="{{route('posts.create')}}" class="btn btn-success">Add Post</a>
</div>

<div class="card card-default">
    <div class="card-header">
        Posts
    </div>
    <div class="card-body">
        @if($posts->count() > 0)
        <table class="table">
            <thead>
                <th>Image</th>
                <th>Title</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>
                            <img src="{{asset('storage/' . $post->image)}}" style="width:100px;">
                        </td>
                        <td class="align-middle">
                            {{$post->title}}
                        </td>
                        @if(!$post->trashed())
                            <td class="align-middle">
                                <a href="{{route('posts.edit', $post->id)}}" class="btn btn-info text-white btn-sm">Edit</a>
                            </td>
                        @else
                            <td class="align-middle">
                                <form action="{{route('restore-posts', $post->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-info text-white btn-sm">Restore</button>
                                </form>
                            </td>
                        @endif
                        <td class="align-middle">
                            <form action="{{route('posts.destroy', $post->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger text-white btn-sm">
                                    {{ $post->trashed() ? 'Delete' : 'Trash'}}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <h3 class="text-center">No Posts Yet</h3>
        @endif
    </div>
</div>

@endsection