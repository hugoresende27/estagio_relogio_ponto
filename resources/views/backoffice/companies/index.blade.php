@extends('backoffice.app')

@section('content')
    
<div class="container">
<h1 class="display-4 text-center">All Companies</h1>

<a href="/companies/create"><button class="btn btn-success addBtn">ADD</button></a>

<div class="m-3">
    {{ $companies->links() }}
</div>

    <table class="table table-dark">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Location(country)</th>
        <th scope="col">File(name)</th>      
        <th scope="col">Email</th>
        <th scope="col">NIF</th>
       
        </tr>
    </thead>
    <tbody>
        @foreach ($companies as $company)
            
            <tr class=" text-sm">
            <td>{{ $company->id }}</td>    
            <td>{{ $company->name }}</td>
            <td>{{ $company->location->country ?? 'no address' }}</td>
            <td>{{ $company->file->name ?? 'no file'}}</td>        
            <td>{{ $company->email }}</td>
            <td>{{ $company->nif }}</td>
          
           
            </tr>

        @endforeach
    </tbody>
    </table>

 
       
  
</div>     

@endsection