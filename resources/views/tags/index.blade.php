@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-2">
    <a href="{{route('tags.create')}}" class="btn btn-success">Add Tag</a>
</div>
<div class="card card-default">
    <div class="card-header">
        Tags
    </div>
    <div class="card-body">
        @if($tags->count() > 0)
        <table class="table">
            <thead>
                <th>Name</th>
                <th></th>
            </thead>
            <tbody>
                @foreach($tags as $tag)
                    <tr>
                        <td>{{$tag->name}}</td>
                        <td>
                            <a href="{{route('tags.edit', $tag->id)}}" class="btn btn-info btn-sm text-white">Edit</a>
                            <button onclick="onClickDelete({{$tag->id}})" class="btn btn-danger btn-sm text-white" data-toggle="modal" data-target="#deleteModal">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <h3 class="text-center">No Tags Yet</h3>
        @endif
    </div>
</div>
<form action="" id="deleteForm" method="POST">
    @csrf
    @method('DELETE')
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-danger">Yes</button>
            </div>
            </div>
        </div>
    </div>
</form>

@endsection

@section('script')

<script>
    function onClickDelete(id){
        document.querySelector('#deleteForm').action = "/tags/" + id;
    }
</script>

@endsection