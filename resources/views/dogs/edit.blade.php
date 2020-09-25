@extends('layout.app')




@section('content')

<h1 class="text-center">Update</h1>
@if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
        </div>
    @endif

<div class="mt-4 d-flex justify-content-center">
    <div class="flex-grow-1">

    </div>
<form action="{{ route('dogs.update', $dog->id)}}" method="POST" class="flex-grow-1">
@csrf
@method('PUT')

<div class="form-group">

<label for="name">Name</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ $dog->name }}">




    <label for="breed">Breed</label>
    <input type="text" name="breed" id="breed" class="form-control" value="{{ $dog->breed }}">





    <label for="name">Age</label>
    <input type="number"  name="age" id="age" min="0" max="25" class="form-control" value="{{ $dog->age }}">

</div>


<button type="submit" class="btn btn-block btn-success">Save</button>
</form>
<div class="flex-grow-1">

</div>
</div>


@endsection