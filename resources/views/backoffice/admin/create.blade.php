@extends('backoffice.app')

@section('content')
    
<div class="container">
<h1 class="display-4 text-center">Add User</h1>
<button class="btn btn-success homeBtn"><a href="/">HOME</a></button>


<div>


   <form action="{{ url('api/admin') }}" method="POST" enctype="multipart/form-data">
    @csrf
  
   
            <div class="form-group">      
                <div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            
                            <label for="image">Photo</label>     
                            <input type="file" name="image" class="form-control" onchange="preview()">
                            <img id="frame" src="" width="300px" height="300px" class="mt-3"/>
                   
                        
                        </div>
                        <div class="col-md-4">
                            
                            <input type="text" name="name" class="form-control mylabels" placeholder="Full Name" value="{{ old('name') }}">
                            <input type="text" name="email" class="form-control mylabels" placeholder="Email" value="{{ old('email') }}">
                            <input type="password" name="password" class="form-control mylabels" placeholder="Password">
                            <input type="password" name="password_confirmation" class="form-control mylabels" placeholder="Password Confirmation" >
                            <input type="text" name="nif" class="form-control mylabels" placeholder="NIF" value="{{ old('nif') }}">
                            <input type="text" name="emercontact" class="form-control mylabels" placeholder="Emergency Contact" value="{{ old('emercontact') }}">
                            <input type="text" name="bicc" class="form-control mylabels" placeholder="Identity Card Number" value="{{ old('bicc') }}">
                  
                        
                        </div>

                        <div class="col-md-4">
   
                        

                            <label for="company_id">Company</label>
                            <select name="company_id" class="form-control mylabels" >
                                @foreach ($companies as $company)
                                    <option hidden disabled selected value> -- select an option -- </option>
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            
                            </select>
                        
                        </div>
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