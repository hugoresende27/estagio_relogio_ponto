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


{{-- 
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
                    
                    </select> --}}


                                         <!-- Department Dropdown -->
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
                    <input type="time" class="form-control " name="shift_start"  value="{{ old('shift_type') }}">&nbsp;
                    <input type="time" class="form-control " name="shift_end"  value="{{ old('shift_type') }}">
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



 <!-- Script -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <script type='text/javascript'>
 $(document).ready(function(){
   // Department Change
   $('#company_id').change(function(){
      // Department id
      var code = $(this).val();
     
      // Empty the dropdown
      $('#department_id').find('option').not(':first').remove();
      // AJAX request 
      $.ajax({
       
        url: '/addschedule/'+code,
        type: 'get',
        dataType: 'json',
        success: function(response){
         
          var len = 0;
          if(response['data'] != null){
             len = response['data'].length;
          }
          if(len > 0){
             // Read data and create <option >
             for(var i=0; i<len; i++){
                var id = response['data'][i].id;
                var name = response['data'][i].name;
                var option = "<option value='"+id+"'>"+name+"</option>";
                // console.log(id);
                $("#department_id").append(option); 
             }
          }
          
        }
      });
   });
 });
 
 </script>

@endsection