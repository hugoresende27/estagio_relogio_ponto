@extends('backoffice.app')

@section('content')
    
<div class="container">
<h1 class="display-4 text-center">Edit Employee {{ $employee->name }}</h1>



<div>


   <form action="{{ url('api/employees').'/'.$employee->id }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
  
   
            <div class="form-group">      
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            
                            <label for="image">Photo</label>     
                            <input type="file" name="image" class="form-control" onchange="preview()">
                            <img id="frame" src="" width="400px" height="50px" class="mt-3"/>
                   

               
                        
                        </div>
                        <div class="col-md-4">
                            <label>Details</label>  
                            <input type="text" name="name" class="form-control mylabels" placeholder="Full Name" value="{{ $employee->name }}">
                            <input type="text" name="email" class="form-control mylabels" placeholder="Email" value="{{ $employee->email }}">
                            <input type="text" name="nif" class="form-control mylabels" placeholder="NIF" value="{{ $employee->nif }}">
                            <input type="text" name="niss" class="form-control mylabels" placeholder="NISS" value="{{ $employee->niss }}">
                            <input type="text" name="emercontact" class="form-control mylabels" placeholder="Emergency Contact" value="{{ $employee->emercontact }}">
                            <input type="text" name="bicc" class="form-control mylabels" placeholder="Identity Card Number" value="{{ $employee->bicc }}">
                            <label for="start_date">Start Date</label>
                            <input type="date" name="start_date" class="form-control mylabels" value="{{ $employee->start_date }}">
                            <input type="text" name="iban" class="form-control mylabels" placeholder="IBAN" value="{{ $employee->iban }}">
                            
                            <label for="file">Attach File</label>
                            <input type="file" name="file" class="mb-3">
                            <label for="details">Details</label><br>
                            <textarea name="details" cols="45" rows="3" style="color:#000;padding:3px">{{ $employee->details }}</textarea>

                            
                        </div>


                        <div class="col-md-4">
                          
                                                                <!-- companies Dropdown -->
                            <label>Company Details:</label>
                            <select id='company_id' name='company_id' class="form-control mylabels">
                                <option value='0'>-- Select Company --</option>

                                <!-- Read Departments -->
                                @foreach($companies['data'] as $company)
                                    <option value='{{ $company->id }}' >{{ $company->name }}</option>
                                    {{-- <option value='{{ $employee->company->id }}' >{{ $employee->company->name }}</option> --}}
                                @endforeach

                            </select>
                        


                            <select id='department_id' name='department_id' class="form-control mylabels">
                                <option value=''>-- Select Department --</option>
                            </select>

                        
                        </div>
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