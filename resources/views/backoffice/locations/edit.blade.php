@extends('backoffice.app')

@section('content')
    
<div class="container">
<h1 class="display-4 text-center">Create Location</h1>



<div>


<form action="{{ url('api/locations').'/'.$location->id }}" method="POST" enctype="multipart/form-data">
@method('PUT')
@csrf
   
    
    <div class="form-group">   
        <div class="row justify-content-center">
                
            <div class="col-md-6">
                <label>Address</label>  
                <input type="text" name="country" class="form-control mylabels" placeholder="Country" value="{{ $location->country }}">
                <input type="text" name="city" class="form-control mylabels" placeholder="City" value="{{ $location->city }}">
                <input type="text" name="street" class="form-control mylabels" placeholder="Street" value="{{ $location->street }}">
                <input type="text" name="door_number" class="form-control mylabels" placeholder="Door Nr" value="{{ $location->door_number }}">
                <input type="text" name="zip_code" class="form-control mylabels" placeholder="Zip Code" value="{{ $location->zip_code }}">

                
         
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