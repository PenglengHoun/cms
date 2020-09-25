@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-2">
    <a href="{{route('categories.create')}}" class="btn btn-success">Add Category</a>
</div>
<div class="card card-default">
    <div class="card-header">
        Categories
    </div>
    <div class="card-body">
        @if($categories->count() > 0)
        <table class="table">
            <thead>
                <th>Name</th>
                <th></th>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->name}}</td>
                        <td>
                            <a href="{{route('categories.edit', $category->id)}}" class="btn btn-info btn-sm text-white">Edit</a>
                            <button onclick="onClickDelete({{$category->id}})" class="btn btn-danger btn-sm text-white" data-toggle="modal" data-target="#deleteModal">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <h3 class="text-center">No Categories Yet</h3>
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
        document.querySelector('#deleteForm').action = "/categories/" + id;
    }
</script>

@endsection