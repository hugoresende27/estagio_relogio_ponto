@extends('backoffice.app')

@section('content')
    
<div class="container">
<h1 class="display-4 text-center">Edit User {{ $user->name }}</h1>



<div>


   <form action="{{ url('api/admin').'/'.$user->id }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
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
                            <label>Login details</label>  
                            <input type="text" name="name" class="form-control mylabels" placeholder="Full Name" value="{{ $user->name }}">
                            <input type="text" name="email" class="form-control mylabels" placeholder="Email" value="{{ $user->email }}">
                            <input type="password" name="password" class="form-control mylabels" placeholder="Password">
                            <input type="password" name="password_confirmation" class="form-control mylabels" placeholder="Password Confirmation" >
                        
                        
                        </div>

                        <div class="col-md-4">
                            <label>Details</label>  
                            <input type="text" name="nif" class="form-control mylabels" placeholder="NIF" value="{{ $user->nif }}">
                            <input type="text" name="emer_contact" class="form-control mylabels" placeholder="Emergency Contact" value="{{ $user->emer_contact }}">
                            <input type="text" name="bi_cc" class="form-control mylabels" placeholder="Identity Card Number" value="{{ $user->bi_cc }}">
                  
                        

                        
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