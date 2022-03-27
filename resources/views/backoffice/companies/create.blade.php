@extends('backoffice.app')

@section('content')
    
<div class="container">
<h1 class="display-4 text-center">Add Company</h1>



<div>


<form action="{{ url('api/companies') }}" method="POST" enctype="multipart/form-data">
@csrf
   
    
    <div class="form-group">   
            <div class="row">
                <div class="col-md-6">      
                    <label>Details</label>  
                    <input type="text" name="name" class="form-control mylabels" placeholder="Full Name" value="{{ old('name') }}">
                    <input type="text" name="email" class="form-control mylabels" placeholder="Email" value="{{ old('email') }}">
                    <input type="text" name="nif" class="form-control mylabels" placeholder="NIF" value="{{ old('nif') }}">
                   
                    <label for="file">Attach File</label>
                    <input type="file" name="file" class="mb-3">

                </div>
                <div class="col-md-6"> 
                    <label>Address</label>  
                    <input type="text" name="country" class="form-control mylabels" placeholder="Country" value="{{ old('country') }}">
                    <input type="text" name="city" class="form-control mylabels" placeholder="City" value="{{ old('city') }}">
                    <input type="text" name="street" class="form-control mylabels" placeholder="Street" value="{{ old('street') }}">
                    <input type="text" name="door_number" class="form-control mylabels" placeholder="Door Nr" value="{{ old('door_number') }}">
                    <input type="text" name="zip_code" class="form-control mylabels" placeholder="Zip Code" value="{{ old('zip_code') }}">

                 
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