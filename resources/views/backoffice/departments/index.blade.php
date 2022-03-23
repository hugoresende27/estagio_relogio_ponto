@extends('backoffice.app')

@section('content')
    

<h1 class="display-4 text-center">All Departments</h1>
<div class="container">

    {{ $departments->links() }}
    <table class="table table-dark">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>


        <th scope="col">Company</th>
        <th scope="col">File(name)</th>
        
      
       
        </tr>
    </thead>
    <tbody>
        @foreach ($departments as $department)
            
            <tr class=" text-xs">
            <td>{{ $department->id }}</td>    
            <td>{{ $department->name }}</td>
            
            <td>{{ $department->company->name }}</td>
            <td>{{ $department->file->name ?? 'no file'}}</td>
           
                  
            </tr>

        @endforeach
    </tbody>
    </table>

 
       
  
</div>     

@endsection