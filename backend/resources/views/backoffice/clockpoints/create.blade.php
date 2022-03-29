@extends('backoffice.app')

@section('content')
    
<div class="container">
<h1 class="display-4 text-center">Point Clock</h1>




<div class="myform">


   <form action="{{ url('api/clockpointentry') }}" method="POST">
    @csrf
  

            <div class="form-group">           
               

                <label for="employee_id">Employee</label>
                <select name="employee_id" class="form-control mylabels inputRequired" >
                    @foreach ($employees as $employee)
                        <option hidden disabled selected value> -- select an option -- </option>
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                   
                </select>

            
                <div class="myclock text-center">
                    <label for="clock_in">IN</label>
                    <input type="time" name="clock_in" class="mylabels m-3 inputRequired" value="{{ old('clock_in') }}">
                    {{-- <input type="text" value="{{Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i')}}" name="clock_in" class="mylabels"> --}}
                    <br>
                    <label for="clock_out">OUT</label>
                    <input type="time" name="clock_out" class=" mylabels m-3 inputRequired" value="{{ old('clock_out') }}">
                    {{-- <input type="text" value="{{Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i')}}" name="clock_out" class="mylabels"> --}}
                    </div>
                </div>
        
        
      
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="submitBtn">Submit</button>
        </div>
  
   
    </form>
</div>
</div>  

@endsection