@extends('backoffice.app')

@section('content')
    

<h1 class="display-4 text-center">All Schedulles</h1>
<div class="container">

    {{ $schedules->links() }}
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
   
        </tr>
    </thead>
    <tbody>
        @foreach ($schedules as $schedule)
            
            <tr class=" text-xs">
            <td>{{ $schedule->id }}</td>
            <td>{{ $schedule->shift_start }}</td>
            <td>{{ $schedule->shift_end }}</td>
            <td>{{ $schedule->shift_total }}</td>
            <td>{{ $schedule->shift_type }}</td>
            <td>{{ $schedule->company->name ?? 'no company' }}</td>
            <td>{{ $schedule->department->name ?? 'no department' }}</td>
            <td>{{ $schedule->file->name ?? 'no file'}}</td>
          
     
            </tr>

        @endforeach
    </tbody>
    </table>

 
       
  
</div>     

@endsection