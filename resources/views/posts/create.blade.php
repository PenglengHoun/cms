@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
        {{ isset($post) ? 'Edit Post' : 'Create Post'}}
    </div>
    <div class="card-body">
        <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if( isset($post) )
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ isset($post) ? $post->title : '' }}">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea rows="5" class="form-control" name="description" id="description">{{ isset($post) ? $post->description : '' }}</textarea>
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <input type="hidden" id="content" name="content" value="{{ isset($post) ? $post->content : '' }}">
                <trix-editor input="content"></trix-editor>
            </div>

            <div class="form-group">
                <label for="published_at">Published at</label>
                <input type="text" class="form-control" name="published_at" id="published_at" value="{{ isset($post) ? $post->published_at : '' }}">
            </div>

            @if( isset($post) )
                <div class="form-group">
                    <img src="{{asset('storage/' . $post->image)}}" style="width: 100%;">
                </div>
            @endif
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image" id="image">
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" name="category" id="category">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}"
                            @if(isset($post) && $category->id == $post->category->id)
                                selected
                            @endif
                        >
                            {{$category->name}}
                        </option>
                    @endforeach
                </select>
            </div>

            @if($tags->count() > 0)
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <select class="form-control" name="tags[]" id="tags" multiple>
                    @foreach($tags as $tag)
                        <option value="{{$tag->id}}"
                            @if(isset($post) && in_array($tag->id, $post->tags->pluck('id')->toArray()))
                                selected
                            @endif
                        >
                            {{$tag->name}}
                        </option>
                    @endforeach
                </select>
                </div>
            @endif

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    {{ isset($post) ? 'Update Post' : 'Add Post' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr('#published_at');
</script>

@endsection

@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.css" integrity="sha512-qjOt5KmyILqcOoRJXb9TguLjMgTLZEgROMxPlf1KuScz0ZMovl0Vp8dnn9bD5dy3CcHW5im+z5gZCKgYek9MPA==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

@endsection