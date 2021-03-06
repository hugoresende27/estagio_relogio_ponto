@extends('backoffice.app')

@section('content')
    
<div class="container">
<h1 class="display-4 text-center">Create Location</h1>



<div>


<form action="{{ url('api/locations') }}" method="POST" enctype="multipart/form-data">
@csrf
   
    
    <div class="form-group">   
        <div class="row justify-content-center">
                
            <div class="col-md-6">
                <label>Address</label>  
                <input type="text" name="country" class="form-control mylabels inputRequired" placeholder="Country" value="{{ old('country') }}">
                <input type="text" name="city" class="form-control mylabels inputRequired" placeholder="City" value="{{ old('city') }}">
                <input type="text" name="street" class="form-control mylabels inputRequired" placeholder="Street" value="{{ old('street') }}">
                <input type="text" name="door_number" class="form-control mylabels inputRequired" placeholder="Door Nr" value="{{ old('door_number') }}">
                <input type="text" name="zip_code" class="form-control mylabels inputRequired" placeholder="Zip Code" value="{{ old('zip_code') }}">

                
                <label for="file">Attach File</label>
                <input type="file" name="file" class="mb-3">
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