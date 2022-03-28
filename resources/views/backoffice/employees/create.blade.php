@extends('backoffice.app')

@section('content')
    
<div class="container">
<h1 class="display-4 text-center">Add Employees</h1>



<div>


   <form action="{{ url('api/employees') }}" method="POST" enctype="multipart/form-data">
    @csrf
  
   
            <div class="form-group">      
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            
                            <label for="image">Photo</label>     
                            <input type="file" name="image" class="form-control" onchange="preview()">
                            <img id="frame" src="" width="200px" height="100px" class="mt-3"/>
                                                <!-- companies Dropdown -->
                            <label>Company Details:</label>
                            <select id='company_id' name='company_id' class="form-control mylabels inputRequired">
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
                        <div class="col-md-4">
                            <label>Details</label>  
                            <input type="text" name="name" class="form-control mylabels inputRequired" placeholder="Full Name" value="{{ old('name') }}">
                            <input type="text" name="email" class="form-control mylabels inputRequired" placeholder="Email" value="{{ old('email') }}">
                            <input type="text" name="nif" class="form-control mylabels inputRequired" placeholder="NIF" value="{{ old('nif') }}">
                            <input type="text" name="niss" class="form-control mylabels inputRequired" placeholder="NISS" value="{{ old('niss') }}">
                            <input type="text" name="emercontact" class="form-control mylabels inputRequired" placeholder="Emergency Contact" value="{{ old('emercontact') }}">
                            <input type="text" name="bicc" class="form-control mylabels inputRequired" placeholder="Identity Card Number" value="{{ old('bicc') }}">
                            <label for="start_date">Start Date</label>
                            <input type="date" name="start_date" class="form-control mylabels inputRequired" value="{{ old('start_date') }}">
                            <input type="text" name="iban" class="form-control mylabels" placeholder="IBAN" value="{{ old('iban') }}">
                            
                            <label for="file">Attach File</label>
                            <input type="file" name="file" class="mb-3">
                            <label for="details">Details</label><br>
                            <textarea name="details" cols="45" rows="3" style="color:#000;padding:3px">{{ old('details') }}</textarea>

                            
                        </div>

                        <div class="col-md-4">
                            <label>Address</label>  
                            <input type="text" name="country" class="form-control mylabels inputRequired" placeholder="Country" value="{{ old('country') }}">
                            <input type="text" name="city" class="form-control mylabels inputRequired" placeholder="City" value="{{ old('city') }}">
                            <input type="text" name="street" class="form-control mylabels inputRequired" placeholder="Street" value="{{ old('street') }}">
                            <input type="text" name="door_number" class="form-control mylabels inputRequired" placeholder="Door Nr" value="{{ old('door_number') }}">
                            <input type="text" name="zip_code" class="form-control mylabels inputRequired" placeholder="Zip Code" value="{{ old('zip_code') }}">
                        
                          
                        
                        
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