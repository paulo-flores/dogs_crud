@extends('layout.app')


@section('content')


<h2 class="mt-2">Dog List</h2>

<div class="d-flex justify-content-between">
  <form action="/search" method="GET">
      <div class="input-group">
          <input type="search" name="search" id="" class="form-control">
          <span class="input-group-prepend">
            <button type="submit" class="btn btn-primary rounded">Search</button>
          </span>
      </div>
  </form>

  <form action="/orderByColumn" method="get">
  <div class="input-group">
  <select name="column" id="column" class="form-control">
  <option value="">Select one...</option>
    <option value="name">Name</option>
    <option value="breed">Breed</option>
    <option value="age">Age</option>
   
  </select>
  <span class="input-group-prepend">
  <button type="submit" class="btn btn-primary rounded">Sort By Column</button>
  </span>
  </div>
  </form>

</div>

@if(Session::has('message'))
<div class="alert alert-success alert-dismissible fade show mt-2">
  {{ session('message') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>


@endif


@if(Session::has('error'))
<div class="alert alert-danger alert-dismissible fade show mt-2">
  {{ session('error') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>


@endif


<table class="table table-striped mt-4">
  <thead>
    <tr>

      <th scope="col">Name</th>
      <th scope="col">Breed</th>
      <th scope="col">Age</th>
      <th>Actions</th>
    </tr>
  </thead>

  <tbody>

    @foreach($dogs as $dog)
    <tr>
      <td>{{ $dog->name }}</td>
      <td>{{ $dog->breed }}</td>
      <td>{{ $dog->age }}</td>
      <td>

        <div class="d-flex">
          <a class="btn btn-info btn-sm mr-1" href="{{ route('dogs.edit', $dog->id)}}">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
            </svg>
          </a>


          <form method="post" action="{{ route('dogs.destroy', $dog->id)}}" onsubmit="return confirm('Are you sure?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm">



              <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
              </svg>
            </button>
          </form>
        </div>
      </td>


    </tr>
    @endforeach


  </tbody>
</table>



{{ $dogs->appends([$field => $value])->links('pagination::bootstrap-4') }}

@endsection