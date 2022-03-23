@extends('backoffice.app')

@section('content')
    

<h1 class="display-4 text-center">All Employees</h1>
<div class="container">

    {{ $employees->links() }}
    <table class="table table-dark">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Company</th>
        <th scope="col">Department</th>
        <th scope="col">Schedulle</th>
        <th scope="col">Location(city)</th>
        <th scope="col">Image (size)</th>
        <th scope="col">File(name)</th>
      
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col">NIF</th>
        <th scope="col">NISS</th>
        <th scope="col">IBAN</th>
        <th scope="col">Details</th>
        <th scope="col">Emergency Contact</th>
        <th scope="col">BI/CC</th>
        <th scope="col">Start Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employees as $employee)
            
            <tr class=" text-xs">
            <td>{{ $employee->id }}</td>
            <td>{{ $employee->name }}</td>

            <td>{{ $employee->company->name }}</td>   
            <td>{{ $employee->department->name ?? 'no department' }}</td>
            <td>{{ $employee->schedule->shift_type ?? 'no shift'}}</td>        
            <td>{{ $employee->location->city ?? 'no address' }}</td>
            <td>{{ $employee->image->size ?? 'no image' }}</td>
            <td>{{ $employee->file->name ?? 'no file'}}</td>
           
            <td>{{ $employee->email }}</td>
            <td>{{ $employee->role }}</td>
            <td>{{ $employee->nif }}</td>
            <td>{{ $employee->niss }}</td>
            <td>{{ $employee->iban }}</td>
            <td>{{ $employee->details }}</td>
            <td>{{ $employee->emercontact }}</td>
            <td>{{ $employee->bicc }}</td>
            <td>{{ $employee->start_date }}</td>
           
            </tr>

        @endforeach
    </tbody>
    </table>

 
       
  
</div>     

@endsection