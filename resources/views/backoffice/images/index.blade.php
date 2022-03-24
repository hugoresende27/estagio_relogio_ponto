@extends('backoffice.app')

@section('content')
    
<div class="container">
<h1 class="display-4 text-center">All Images</h1>
<button class="btn btn-success homeBtn"><a href="/">HOME</a></button>


    {{ $images->links() }}
    <table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Employee</th>
            <th scope="col">User</th>
            <th scope="col">Path</th>
            <th scope="col">Size</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($images as $image)
            
            <tr class=" text-sm">
            <td>{{ $image->id }}</td>
            <td>{{ $image->employee->name ?? '--'}}</td>
            <td>{{ $image->user->name ?? '--' }}</td>
            <td>{{ $image->image_path }}</td>
            <td>{{ $image->size }}</td>

           
           
            </tr>

        @endforeach
    </tbody>
    </table>

 
       
  
</div>     

@endsection