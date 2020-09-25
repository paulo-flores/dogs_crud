@extends('layout.app')




@section('content')

<h1 class="text-center">Create</h1>
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
        </div>
    @endif

<div class="mt-4 d-flex justify-content-center">
<div class="flex-grow-1">

</div>
<form action="{{ route('dogs.store')}}" method="POST" class="flex-grow-1">
@csrf
<div class="form-group">


    <label for="name">Name</label>
    <input type="text" name="name" id="name" class="form-control">




    <label for="breed">Breed</label>
    <input type="text" name="breed" id="breed" class="form-control">





    <label for="name">Age</label>
    <input type="number" min="0" max="25" name="age" id="age" class="form-control">



<button type="submit" class="btn btn-block btn-success mt-2" class="">Save</button>
</div>
</form>
<div class="flex-grow-1">

    </div>
</div>


@endsection