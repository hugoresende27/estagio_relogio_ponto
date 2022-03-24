@extends('backoffice.app')

@section('content')
    
<div class="container">
<h1 class="display-4 text-center">Companies</h1>
<button class="btn btn-success homeBtn"><a href="/">HOME</a></button>
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


    <form action="{{ url('api/companies') }}" method="POST">
     @csrf
   
      <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
             <div class="form-group">           
                 <input type="text" name="name" class="form-control mylabels" placeholder="Full Name" value="{{ old('name') }}">
                 <input type="text" name="email" class="form-control mylabels" placeholder="Email" value="{{ old('email') }}">
                 <input type="text" name="nif" class="form-control mylabels" placeholder="NIF" value="{{ old('nif') }}">
              
 
                 <input type="text" name="country" class="form-control mylabels" placeholder="Country" value="{{ old('country') }}">
                 <input type="text" name="city" class="form-control mylabels" placeholder="City" value="{{ old('city') }}">
                 <input type="text" name="street" class="form-control mylabels" placeholder="Street" value="{{ old('street') }}">
                 <input type="text" name="door_number" class="form-control mylabels" placeholder="Door Nr" value="{{ old('door_number') }}">
                 <input type="text" name="zip_code" class="form-control mylabels" placeholder="Zip Code" value="{{ old('zip_code') }}">
               
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