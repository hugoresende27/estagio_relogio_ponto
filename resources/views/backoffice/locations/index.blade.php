@extends('backoffice.app')

@section('content')
    

<h1 class="display-4 text-center">All Locations</h1>
<div class="container">

    {{ $locations->links() }}
    <table class="table table-dark">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Country</th>
        <th scope="col">City</th>
        <th scope="col">Street</th>
        <th scope="col">Nr</th>
        <th scope="col">Postal Code</th>
        <th scope="col">File(name)</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($locations as $location)
            
            <tr class=" text-xs">
            <td>{{ $location->id }}</td>
            <td>{{ $location->country }}</td>
            <td>{{ $location->city }}</td>
            <td>{{ $location->street }}</td>
            <td>{{ $location->door_number }}</td>
            <td>{{ $location->zip_code }}</td>
            <td>{{ $employee->file->name ?? 'no file'}}</td>
            </tr>

        @endforeach
    </tbody>
    </table>

 
       
  
</div>     

@endsection