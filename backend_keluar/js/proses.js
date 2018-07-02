 $(document).ready(function(){
           $('#btnonline').on('click', function () {
               var row_id = [];
               $(':checkbox:checked').each(function(i){
                         row_id[i] = $(this).val();
                   
                       });
               if(row_id.length === 0)
                           {
                               alert("Please Select Checkbox");
                           }
               else{
                   if(confirm("Are you sure want to proses this?"))
                   {
                       //alert(row_id);
                       $.ajax({
                           url: 'proses.php',
                           method: 'POST',
                           data : {id:row_id},
                           success: function(data)
                           {
                               for(var i=0; i<row_id.length; i++)
                                   {
                                       $('tr#'+row_id[i]+'').css('backgroundColor','#ccc');
                                        $('tr#'+row_id[i]+'').fadeOut('slow');
                                   }
                                $('#msg').html('<div class="alert alert-info">data sukses di inputkan </div>').fadeIn('slow');          
                               $('#msg').delay(1000).fadeOut(700, function() { 
                                window.location = 'index.php'; });
                               //alert("Deleted");
                           }
                          
                          
                             
                           });
                       
                   }
               else
               {
                   return false;
               }
               }
               
               
               
           });

            
        });
