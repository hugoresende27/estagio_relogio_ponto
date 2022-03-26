@extends('backoffice.app')

@section('content')
    
<div class="container">
<h1 class="display-4 text-center">All Locations</h1>


<div class="m-3">
    {{ $locations->links() }}
</div>

<a href="/locations/create"><button class="btn btn-success addBtn">ADD</button></a>

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
        <th scope="col">EDIT</th>
        <th scope="col">DELETE</th>


        </tr>
    </thead>
    <tbody>
        @foreach ($locations as $location)
            
            <tr class=" text-sm">
            <td>{{ $location->id }}</td>
            <td>{{ $location->country }}</td>
            <td>{{ $location->city }}</td>
            <td>{{ $location->street }}</td>
            <td>{{ $location->door_number }}</td>
            <td>{{ $location->zip_code }}</td>
            <td>{{ $location->file->name ?? 'no file'}}</td>

            <td class="editBtn"> <a href="locations/{{ $location->id }}/edit"> Edit</a></td>
            <td class="deleteBtn">
                
                
                <form action="../api/locations/{{ $location->id }}" method="POST">
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