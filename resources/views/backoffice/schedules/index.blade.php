@extends('backoffice.app')

@section('content')
    
<div class="container">
<h1 class="display-4 text-center">All Schedulles</h1>

<div class="m-3">
    {{ $schedules->links() }}
</div>



<a href="/schedules/create"><button class="btn btn-success addBtn">ADD</button></a>


    <table class="table table-dark">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Start</th>
        <th scope="col">End</th>
        <th scope="col">Total</th>
        <th scope="col">Type</th>
        <th scope="col">Company</th>
        <th scope="col">Department</th>
        <th scope="col">File</th>
        <th scope="col">EDIT</th>
        <th scope="col">DELETE</th>
   
        </tr>
    </thead>
    <tbody>
        @foreach ($schedules as $schedule)
            
            <tr class=" text-sm">
            <td>{{ $schedule->id }}</td>
            <td>{{ $schedule->shift_start }}</td>
            <td>{{ $schedule->shift_end }}</td>
            <td>{{ $schedule->shift_total }}</td>
            <td>{{ $schedule->shift_type }}</td>
            <td>{{ $schedule->company->name ?? 'no company' }}</td>
            <td>{{ $schedule->department->name ?? 'no department' }}</td>
            <td>{{ $schedule->file->name ?? 'no file'}}</td>
            <td class="editBtn"> <a href="schedules/{{ $schedule->id }}/edit"> Edit</a></td>
     
            <td class="deleteBtn">
                
                
                <form action="../api/schedules/{{ $schedule->id }}" method="POST">
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