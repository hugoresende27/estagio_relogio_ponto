@extends('backoffice.app')

@section('content')
    
<div class="container">
<h1 class="display-4 text-center">Schedules</h1>
<a href="/"><button class="btn btn-success homeBtn">HOME</button></a>
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif




<div>


    <form action="{{ url('api/schedules') }}" method="POST" enctype="multipart/form-data">
     @csrf
   
    
        
        <div class="form-group">      
            <div class="row">
                <div class="col-md-6">
                    <label for="company_id">Company</label>
                    <select name="company_id" class="form-control mylabels" >
                        @foreach ($companies as $company)
                            <option hidden disabled selected value> -- select an option -- </option>
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    
                    </select>

                    <label for="department_id">Department</label>
                    <select name="department_id" class="form-control mylabels" >
                        @foreach ($departments as $department)
                            <option hidden disabled selected value> -- select an option -- </option>
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    
                    </select>
                </div>
                <div class="col-md-6">
                 <label for="file">Attach File</label><br>
                 <input type="file" name="file" class="mb-3">

                 <div class="mytimelabel">
                    <input type="time" class="form-control " name="shift_start"  value="{{ old('shift_type') }}">&nbsp;
                    <input type="time" class="form-control " name="shift_end"  value="{{ old('shift_type') }}">
                 </div>
                 <input type="text" class="form-control mylabels" name="shift_type" placeholder="Shift Type" value="{{ old('shift_type') }}">
                 
                </div>
                
             
                    
             </div>
         
       
         <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                 <button type="submit" class="btn btn-primary">Submit</button>
         </div>
    
        </div>
 </form>
    

   
</div>
 
       
  
</div>     

@endsection