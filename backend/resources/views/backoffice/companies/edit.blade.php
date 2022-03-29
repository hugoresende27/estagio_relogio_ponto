@extends('backoffice.app')

@section('content')
    
<div class="container">
<h1 class="display-4 text-center">Edit Company {{ $company->name }}</h1>



<div>


   <form action="{{ url('api/companies').'/'.$company->id }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
  
   
            <div class="form-group">      
                <div class="container">
                    <div class="row justify-content-center">
                  
                        <div class="col-md-6">
                            <label>Details</label>  
                            <input type="text" name="name" class="form-control mylabels" placeholder="Full Name" value="{{ $company->name }}">
                            <input type="text" name="email" class="form-control mylabels" placeholder="Email" value="{{ $company->email }}">
                            <input type="text" name="nif" class="form-control mylabels" placeholder="NIF" value="{{ $company->nif}}">
                        
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