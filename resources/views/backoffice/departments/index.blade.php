@extends('backoffice.app')

@section('content')
    
<div class="container">
<h1 class="display-4 text-center">All Departments</h1>

<a href="/departments/create"><button class="btn btn-success addBtn">ADD</button></a>

<div class="m-3">
    {{ $departments->links() }}
</div>

    <table class="table table-dark">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>


        <th scope="col">Company</th>
        <th scope="col">File(name)</th>
        
      
       
        </tr>
    </thead>
    <tbody>
        @foreach ($departments as $department)
            
            <tr class="text-sm">
            <td>{{ $department->id }}</td>    
            <td>{{ $department->name }}</td>
            <td>{{ $department->email }}</td>
            
            <td>{{ $department->company->name }}</td>
            <td>{{ $department->file->name ?? 'no file'}}</td>
           
                  
            </tr>

        @endforeach
    </tbody>
    </table>

 
       
  
</div>     

@endsection