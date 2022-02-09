
	

 $(function(){ 

   showData();
 
    $("#up_load").submit('on',function(e){
          e.preventDefault();
         
        var form = $("#up_load");
        var formdata = false;
    if (window.FormData){
        formdata = new FormData(form[0]);
    }

    var formAction = form.attr('action');
    $.ajax({

 xhr: function() {
var xhr = new window.XMLHttpRequest();

xhr.upload.addEventListener("progress", function(evt) {
  if (evt.lengthComputable) {
    var percentComplete = evt.loaded / evt.total;
    percentComplete = parseInt(percentComplete * 100);

    $('.progress-bar').width(percentComplete+'%').css('background-color','#42bd47');
    $('.progress-bar').html(percentComplete+'%');

  }
}, false);

return xhr;
},
        url         : $('#up_load').attr('action'),
        data        : formdata ? formdata : form.serialize(),
        cache       : false,
        contentType : false,
        processData : false,
        type        : 'POST',

            dataType : "json",
             headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  },

            success:function(data)
              {
                 console.log(data);
                   if(data.code == 404)
                {
                  $('#ErrorMessage').html('<span style="color:red;">'+data.error+'</span>');
                
                   stoppr();
                }
                
                if(data.status == 0)
                {
                  $('#ErrorMessage').html('<span style="color:red;">'+data.message+'</span>');
                stoppr();
         
                }
                if(data.status == 1)
                {
                  
         
                    $('#ErrorMessage').html('<span style="color:#42bd47;">'+data.message+' <i class="fa fa-check-circle" aria-hidden="true" style="color:#42bd47;"></i></span>');

                    $('#up_load').trigger('reset');
                    $(".ud").attr("style", "display:none");
                     showData();
                   
                }
            },
            error: function (jqXHR, status, err) {
              $(".loader").attr("style", "display:none");
              stoppr();
              $('#ErrorMessage').html("'<span style='color:red;'><i class='fa fa-exclamation-triangle' aria-hidden='true' style='color:red;'></i> This system is allowed only  PNG file and file size 5MB.</span>");
            }
        
          });
           

    });
    
//data read 



function showData(){

 $.ajax({
     type:'GET',
     dataType:'json',
     contentType:'application/json',
     url:"json/show=data",
     success: function(data){
     
     var output = $(data).get().reverse()
    //console.log(output);
      var as = $("#asset").data('id');
     var d = '';
     for(var i =0; i < output.length; i++){
           
             d +='<div class="col-lg-2 col-md-3 elm col-sm-4 col-xs-6">';
             d +='<div class="thumbnail" style="border: 1px solid #c9c3c3;" id="searvel">';
             d +='<a href="javascript:void(0)" id="pimv"><img src="'+as+output[i].image +'"style=" height:135px; width:177px;" id ="myImg" alt"'+ output[i].image_title +'" class="thimg"/></a><hr style="margin:0px;">';
             d +='<div  class="caption pf" style="white-space:nowrap;overflow: hidden;    margin-bottom: -22px;">';
             d +='<h4 style="font-size: small;" class="advanced ane"><p class="el cf" id="lenthsl">'+ output[i].image_title +'</p></h4></div>';
             d +='<div class="caption"><a href="javascript:void(0)" id="delet" data-id="'+ output[i].image +'"><i class="fa fa-trash" aria-hidden="true"> Remove</i></a>';
             d +='</div></div></div>';
     
     }
         if (d =='') {
           d += '<h3 class="col-md-12 " style="text-align: center;"> No Content found</h3>';

         }


       $('#postData').html(d);
     }





});

}

function stoppr() {
 $('#pp').css({"background-color": "red", "width": "0%"});

}
$('#up').change(function(){
  $('#pp').attr('style','width:0%; background-color:#42bd47;')
  $('#ErrorMessage').html('');
});


//data delete

$(document).on('click', '#delet', function(e){
      e.preventDefault(); 
      var imageId = $(this).data('id');
      SwalDelete(imageId);
     
    });
    
  
  function SwalDelete(imageId){
    
    swal({
      title: "Are you sure?",
       text: "Once deleted, you will not be able to recover this imaginary file!",
       icon: "warning",
    buttons: true,
 dangerMode: true,
        })
.then((willDelete) => {
      if (willDelete) {
      $.ajax({
               url: 'data/img=del/s',
               type: 'POST',
               data: 'delete='+imageId,
               dataType: 'json',
               headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  },

          success:function(response)
              {
                showData();
                 console.log(response);
                 
                 if (response.status == 1) {
                       showData();
                             }
                       showData();   
                           },
                   });

          showData();
      swal("Poof! Your imaginary file has been deleted!", {
      icon: "success",
    }); 

 } else {
    swal("Your imaginary file is safe!");
  }

 });
    
  }    
   


  $.getJSON('storage/app/json/imageGallery.json', function(data){
            //console.log(data.image);
            //console.log(data.image_title); 

 $('#searchInput').keyup(function(){
            var searchField = $(this).val();
      if(searchField === '')  {
        showData();
        return;
      }
      
            var regex = new RegExp(searchField, "i");
            var d = '';
            var count = 1;
            var as = $("#asset").data('id');
        $.each(data, function(key, val){
        if ((val.image_title.search(regex) != -1) || (val.image_title.search(regex) != -1)) {
            d +='<div class="col-lg-2 col-md-3 elm col-sm-4 col-xs-6">';
             d +='<div class="thumbnail" style="border: 1px solid #c9c3c3;" id="searvel">';
             d +='<a href="javascript:void(0)" id="pimv"><img src="'+as+val.image +'"style=" height:135px; width:177px;" id ="myImg" alt"'+ val.image_title +'" class="thimg"/></a><hr style="margin:0px;">';
             d +='<div  class="caption" style="white-space:nowrap;overflow: hidden;    margin-bottom: -22px;">';
             d +='<h4 style="font-size: small;" class="advanced ane"><p class="el" id="lenthsl">'+ val.image_title +'</p></h4></div>';
             d +='<div class="caption"><a href="javascript:void(0)" id="delet" data-id="'+ val.image +'"><i class="fa fa-trash" aria-hidden="true"> Remove</i></a>';
             d +='</div></div></div>';
         
          }
        });
         
         if (d =='') {
           d += '<h3 class="col-md-12 fa fa-search " style="text-align: center;font-size: 30px;"> No results found</h3><p class="col-md-12" style="text-align: center;">Try different keywords or search</p>';

         }

        $('#postData').html(d);

        });

});


$(document).on('click','.cancal', function(e){
   e.preventDefault();
    $('#pp').attr('style','width:0%; background-color:#42bd47;')
$('#ErrorMessage').html('');

})


});

