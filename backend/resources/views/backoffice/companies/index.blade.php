@extends('backoffice.app')

@section('content')
    
<div class="container">
<h1 class="display-4 text-center">All Companies</h1>
<div class="m-3">
    {{ $companies->links() }}
</div>


<a href="{{ url('api/companiesexportexcel') }}"><button class="btn btn-success addBtn">EXPORT XLSX</button></a>
<a href="{{ url('api/companiesexportcsv') }}"><button class="btn btn-success addBtn">EXPORT CSV</button></a>

<a href="/companies/create"><button class="btn btn-success addBtn">ADD</button></a>


    <table class="table table-dark">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Employees</th>
        <th scope="col">Departments</th>
        <th scope="col">Location(country)</th>
        <th scope="col">EDIT</th>
        <th scope="col">File(name)</th>      
        <th scope="col">Email</th>
        <th scope="col">NIF</th>
        <th scope="col">EDIT</th>
        <th scope="col">DELETE</th>
       
        </tr>
    </thead>
    <tbody>
        @foreach ($companies as $company)
            
            <tr class=" text-sm">
            <td>{{ $company->id }}</td>    
            <td>{{ $company->name }}</td>

            <td> <a href="{{ url('api/companies/'. $company->id .'/showemployees' ) }}">show</a> </td>
            
            <td> <a href="{{ url('api/companies/'. $company->id .'/showdepartments' ) }}">show</a> </td>

            <td>{{ $company->location->country ?? 'no address' }}</td>
            
            <td class="editBtn"> <a href='locations/{{ $company->location->id ?? "no address" }}/edit'> Edit</a></td>
            <td>{{ $company->file->name ?? 'no file'}}</td>        
            <td>{{ $company->email }}</td>
            <td>{{ $company->nif }}</td>

            <td class="editBtn"> <a href="companies/{{ $company->id }}/edit"> Edit</a></td>
            <td class="deleteBtn">
                
                
                <form action="../api/companies/{{ $company->id }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit"
                            class="hero-btn"
                            onclick="return confirm('Are you sure?')" 
                            > Delete </button>

                </form>
            
            </td>
           
            </tr>

        @endforeach
    </tbody>
    </table>

 
       
  
</div>     

@endsection