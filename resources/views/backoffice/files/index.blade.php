@extends('backoffice.app')

@section('content')
    
<div class="container">
<h1 class="display-4 text-center">All Employees</h1>
<button class="btn btn-success"><a href="/">HOME</a></button>


    {{ $files->links() }}
    <table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Type</th>
            <th scope="col">Name</th>
            <th scope="col">Path</th>
            <th scope="col">Size</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($files as $file)
            
            <tr class=" text-sm">
            <td>{{ $file->id }}</td>
            <td>{{ $file->type }}</td>
            <td>{{ $file->name }}</td>
            <td>{{ $file->path }}</td>
            <td>{{ $file->size }}</td>

           
           
            </tr>

        @endforeach
    </tbody>
    </table>

 
       
  
</div>     

@endsection