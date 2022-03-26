@extends('backoffice.app')

@section('content')
    
<div class="container">
<h1 class="display-4 text-center">Schedules</h1>

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



                                         <!-- companies Dropdown -->
                    <label>Company Details:</label>
                    <select id='company_id' name='company_id' class="form-control mylabels">
                        <option value='0'>-- Select Company --</option>

                        <!-- Read Departments -->
                        @foreach($companies['data'] as $company)
                            <option value='{{ $company->id }}' >{{ $company->name }}</option>
                        @endforeach

                    </select>
                  


                    <select id='department_id' name='department_id' class="form-control mylabels">
                        <option value=''>-- Select Department --</option>
                    </select>


                </div>
                <div class="col-md-6">
                 <label for="file">Attach File</label><br>
                 <input type="file" name="file" class="mb-3">

                 <div class="mytimelabel">
                    <input type="time" class="form-control " name="shift_start"  value="{{ old('shift_start') }}">&nbsp;
                    <input type="time" class="form-control " name="shift_end"  value="{{ old('shift_end') }}">
                 </div>
                 <input type="text" class="form-control mylabels" name="shift_type" placeholder="Shift Type" value="{{ old('shift_type') }}">
                 
                </div>
                
             
                    
             </div>
         
       
         <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                 <button type="submit" class="submitBtn">Submit</button>
         </div>
    
        </div>
 </form>
    

   
</div>
 
       
  
</div>    



 <!-- Scripts  populate selects companies and departments-->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <script src="{{ asset('js/comp_deps_populates.js') }}" type='text/javascript' ></script>

@endsection