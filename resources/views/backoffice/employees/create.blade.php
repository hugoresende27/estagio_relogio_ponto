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
                        <div class="col-md-2">
                            
                            <label for="image">Photo</label>     
                            <input type="file" name="image" class="form-control" onchange="preview()">
                            <img id="frame" src="" width="200px" height="100px" class="mt-3"/>
                   
                               
                            <label for="company_id">Company</label>
                            <select name="company_id" class="form-control mylabels" >
                                @foreach ($companies as $company)
                                    <option hidden disabled selected value> -- select an option -- </option>
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            
                            </select>
                        
                        </div>
                        <div class="col-md-4">
                            <label>Details</label>  
                            <input type="text" name="name" class="form-control mylabels" placeholder="Full Name" value="{{ old('name') }}">
                            <input type="text" name="email" class="form-control mylabels" placeholder="Email" value="{{ old('email') }}">
                            <input type="text" name="nif" class="form-control mylabels" placeholder="NIF" value="{{ old('nif') }}">
                            <input type="text" name="niss" class="form-control mylabels" placeholder="NISS" value="{{ old('niss') }}">
                            <input type="text" name="emercontact" class="form-control mylabels" placeholder="Emergency Contact" value="{{ old('emercontact') }}">
                            <input type="text" name="bicc" class="form-control mylabels" placeholder="Identity Card Number" value="{{ old('bicc') }}">
                            <label for="start_date">Start Date</label>
                            <input type="date" name="start_date" class="form-control mylabels" value="{{ old('start_date') }}">
                            <input type="text" name="iban" class="form-control mylabels" placeholder="IBAN" value="{{ old('iban') }}">
                            
                            <label for="file">Attach File</label>
                            <input type="file" name="file" class="mb-3">
                            <label for="details">Details</label><br>
                            <textarea name="details" cols="45" rows="3" style="color:#000;padding:3px">{{ old('details') }}</textarea>

                            
                        </div>

                        <div class="col-md-4">
                            <label>Address</label>  
                            <input type="text" name="country" class="form-control mylabels" placeholder="Country" value="{{ old('country') }}">
                            <input type="text" name="city" class="form-control mylabels" placeholder="City" value="{{ old('city') }}">
                            <input type="text" name="street" class="form-control mylabels" placeholder="Street" value="{{ old('street') }}">
                            <input type="text" name="door_number" class="form-control mylabels" placeholder="Door Nr" value="{{ old('door_number') }}">
                            <input type="text" name="zip_code" class="form-control mylabels" placeholder="Zip Code" value="{{ old('zip_code') }}">
                        
                        
                        
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



@endsection