@extends('backoffice.app')

@section('content')
    
<div class="container">
<h1 class="display-4 text-center">Add User</h1>



<div>


   <form action="{{ url('api/admin') }}" method="POST" enctype="multipart/form-data">
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
                        <div class="col-md-4">
                            <label>Login details</label>  
                            <input type="text" name="name" class="form-control mylabels inputRequired" placeholder="Full Name" value="{{ old('name') }}">
                            <input type="text" name="email" class="form-control mylabels inputRequired" placeholder="Email" value="{{ old('email') }}">
                            <input type="password" name="password" class="form-control mylabels inputRequired" placeholder="Password">
                            <input type="password" name="password_confirmation" class="form-control mylabels inputRequired" placeholder="Password Confirmation" >
                        
                        
                        </div>

                        <div class="col-md-4">
                            <label>Details</label>  
                            <input type="text" name="nif" class="form-control mylabels" placeholder="NIF" value="{{ old('nif') }}">
                            <input type="text" name="emer_contact" class="form-control mylabels" placeholder="Emergency Contact" value="{{ old('emer_contact') }}">
                            <input type="text" name="bi_cc" class="form-control mylabels" placeholder="Identity Card Number" value="{{ old('bi_cc') }}">
                  

                         
                        
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