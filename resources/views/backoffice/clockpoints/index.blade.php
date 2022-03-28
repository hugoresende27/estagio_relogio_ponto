@extends('backoffice.app')

@section('content')
    
<div class="container">
<h1 class="display-4 text-center">Clockpoint Regists</h1>

<div class="m-3">
    {{ $clockpoints->links() }}
</div>



<a href="{{ url('api/clockpointentrysexportexcel') }}"><button class="btn btn-success addBtn">EXPORT XLSX</button></a>
<a href="{{ url('api/clockpointentrysexportcsv') }}"><button class="btn btn-success addBtn">EXPORT CSV</button></a>

<a href="/clockpointentry/create"><button class="btn btn-success addBtn">ADD</button></a>



    <table class="table table-dark">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Employee</th>
        <th scope="col">Company</th>
        <th scope="col">File (name)</th>
        <th scope="col">Clock IN</th>
        <th scope="col">Clock OUT</th>
        <th scope="col">Total</th>
       
 
        </tr>
    </thead>
    <tbody>
        @foreach ($clockpoints as $clockpoint)
            
            <tr class=" text-sm">
            <td>{{ $clockpoint->id }}</td>
            <td>{{ $clockpoint->employee->name ?? ' ' }}</td>
            <td>{{ $clockpoint->employee->company->name ?? ' ' }}</td>

            <td>{{ $clockpoint->file->name ?? 'no file'  }}</td>   
            <td>{{ $clockpoint->clock_in  }}</td>   
            <td>{{ $clockpoint->clock_out   }}</td>   

            <td>{{ $clockpoint->clock_total }}</td>
              
            </tr>

        @endforeach
    </tbody>
    </table>

 
       
  
</div>     

@endsection