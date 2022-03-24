@extends('backoffice.app')

@section('content')
    
<div class="container">
<h1 class="display-4 text-center">All Users</h1>
<button class="btn btn-success homeBtn"><a href="/">HOME</a></button>


    {{ $users->links() }}
    <table class="table table-dark">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Company</th>
        <th scope="col">Department</th>
        <th scope="col">Schedulle</th>
        <th scope="col">Image (size)</th>

      
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col">NIF</th>
        <th scope="col">Emergency Contact</th>
        <th scope="col">BI/CC</th>
        <th scope="col">Created at</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            
            <tr class=" text-sm">
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>

            <td>{{ $user->company->name ?? 'no company'  }}</td>   
            <td>{{ $user->department->name ?? 'no department' }}</td>
            <td>{{ $user->schedule->shift_type ?? 'no shift'}}</td>        
        
            <td>{{ $user->image->size ?? 'no image' }}</td>
 
           
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>{{ $user->nif }}</td>

            <td>{{ $user->emercontact }}</td>
            <td>{{ $user->bicc }}</td>
            <td>{{ $user->created_at }}</td>
           
            </tr>

        @endforeach
    </tbody>
    </table>

 
       
  
</div>     

@endsection