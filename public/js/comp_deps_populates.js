$(document).ready(function(){
    // Department Change
    $('#company_id').change(function(){
       // Department id
       var code = $(this).val();
      
       // Empty the dropdown
       $('#department_id').find('option').not(':first').remove();
       // AJAX request 
       $.ajax({
        
         url: '/populate/'+code,
         type: 'get',
         dataType: 'json',
         success: function(response){
          
           var len = 0;
           if(response['data'] != null){
              len = response['data'].length;
           }
           if(len > 0){
              // Read data and create <option >
              for(var i=0; i<len; i++){
                 var id = response['data'][i].id;
                 var name = response['data'][i].name;
                 var option = "<option value='"+id+"'>"+name+"</option>";
                 // console.log(id);
                 $("#department_id").append(option); 
              }
           }
           
         }
       });
    });
  });