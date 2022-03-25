@extends('backoffice.app')

@section('content')
    
<div class="container">
<h1 class="display-4 text-center">Departments</h1>

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


    <form action="{{ url('api/departments') }}" method="POST" enctype="multipart/form-data">
     @csrf
   
      <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
             <div class="form-group">      
                 
                <label for="company_id">Company</label>
                <select name="company_id" class="form-control mylabels" >
                    @foreach ($companies as $company)
                        <option hidden disabled selected value> -- select an option -- </option>
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                
                </select>
                
                 <input type="text" name="name" class="form-control mylabels" placeholder="Department Name" value="{{ old('name') }}">
                 <input type="text" name="email" class="form-control mylabels" placeholder="Email" value="{{ old('email') }}">
                 <label for="file">Attach File</label>
                 <input type="file" name="file" class="mb-3"><br>
                 

                
             
               
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