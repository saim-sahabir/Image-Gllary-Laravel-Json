<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="referrer" content="no-referrer" />
		<meta name="description" content="...">
		<meta name="keywords" content="...">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="author" content="...">
		<title> image gallery </title>

       <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">

       <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
        
        <link rel="stylesheet" href="{{ asset('assets/css/font.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/css/sawl.css')}}">

  
        <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{ asset('assets/js/proData.js')}}" defer></script>
        <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>


       <style>
       	

   .ane {
     display: inline-block;
     animation: 3s linear 0s infinite alternate animate;
      }

   .advanced {
    word-wrap: none;

    position: relative;
   animation: 3s linear 0s infinite alternate advanced;
    }

  @keyframes animate {
   from {
     transform: translateX(0%);
   }
   to {
    transform: translateX(-100%);
   }
  }

@keyframes advanced {
  0%, 25% {
    transform: translateX(0%);
    left: 0%;
  }
  75%,
  100% {
    transform: translateX(-100%);
    left: 100%;
  }
}
</style>
	    </head>
	        <body>
     	     <div class="o-container"> 
				<div class="col-lg-12">
				  <h3 style="padding: 5px;margin-top: 6px;margin-bottom: 16px;">IMAGE GALLAREY</h3>	
				    <div class="row">
				    <div class="col-md-2">	
                      <div class="well well-sm">
					 <button class="btn btn-default" id="upBtn"><i class="fa fa-upload" aria-hidden="true"> Upload Image</i></button>
				    </div>
				  </div>
				  <div class="col-md-10">
                 <div class="well well-sm">
				   <form>
					  <div class="input-group">
						  <input type="text" class="form-control" placeholder="Search Image Here..." id="searchInput" style="z-index: 0;">
								<span class="input-group-btn">
									<button class="btn sb btn-primary "style="position: initial;z-index: 0;" type="submit"><i class="fa fa-search" aria-hidden="true" ></i></button>
								</span>
							</div>
						</form>
					</div>
                      </div>	
                        </div>
					     <hr class="hrr">
					     <div class="row selected-classifieds thum" id="postData">
					</div>
				</div>
			</div>
		</div>
      </div>  
     </div>

     <!-- Modal -->
<div class="modal fade in  bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top: 56px;">
  <div class=" modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border: solid #3c3a3a 2px;">
      <div class="modal-header mh">
       <h4 style="color: #ffff;">Upload Image</h4>
        <i class="fa fa-times cancal" data-dismiss="modal" aria-label="Close" style="margin-top: 9px;color: #fff;cursor: pointer;margin-right: 6px; font-size: 19px;"></i>
      </div>
      <div class="modal-body">
        
      <div class="file-upload-wrapper">
        <div class="card card-body view file-upload">
        	<div class="card-text file-upload-message">
            
        		<i class="fa fa-cloud-upload"></i>
       
        		<p style="font-size: 14px;">Drag and drop a file here or click to select</p>
        		 <img src="" class="ud pwimag" id="output"/>
        	</div>
        	<div class="mask rgba-stylish-slight">
        		
        	</div>
        	<div class="file-upload-errors-container">
        		<ul id="asset" data-id="{{asset('/')}}/">
        		
        		</ul>
        	</div>
        	<form action="{{url('/image_upload/s')}}" method="post" id="up_load" enctype="multipart/form-data">

        	<input type="file"class="file_upload" id="up" name="image" accept="image/*" onchange="loadFile(event)">
        	<button type="button" id="outbtn" class="btn btn-sm btn-danger waves-effect waves-light ud"><span class="fa fa-remove"></span> Remove 
        	</button>
        	<div class="file-upload-preview">
        		
        		<span class="file-upload-render"></span>
        		<div class="file-upload-infos">
        			<div class="file-upload-infos-inner">
        				<p class="file-upload-filename">
        					<span class="file-upload-filename-inner"></span>
        				</p>	
        				<p class="file-upload-infos-message">Drag and drop or click to replace</p>
        			</div>
        		</div>
        	</div>
        </div>
   
      <div class="progress">
    <div class="progress-bar" id="pp" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;background-color: #42bd47; ">
      0%
    </div>
  </div>

        
        <div id="ErrorMessage"></div>
        <hr>
     <div class="form-group row" style="margin-top: 15px;">
    <label for="inputPassword" class="col-sm-2 col-form-label"><i class="fa fa-picture-o" aria-hidden="true"></i> Image title :*</label>
    <div class="col-sm-10">
      <input type="text" name="image_title" class="form-control" id="" placeholder="Image title is here..." style="border: solid 1px;" required >
    </div>
     </div>
      </div>
      <div class="d-flex justify-content-center" style="margin-top: 32px;margin-bottom: 16px;"> 
      <button type="submit" class="btn btn-default" style="border: solid 1px;"><i class="fa fa-upload" aria-hidden="true"> UPLOAD</i></button>
        </div>
         </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="cancal btn btn-default" data-dismiss="modal">Cancal</button>
      </div>
    </div>
  </div>
</div>

<!-- The Modal -->
<div id="immyModal" class="immodal">
  <span class="imclose">&times;</span>
  <img class="immodal-content" id="img01" style="height: 100%; width:auto;">
  <div id="imcaption"></div>
</div>
         <!--footer-->
 

<script>
    var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
    URL.revokeObjectURL(output.src) // free memory
     }
    document.getElementById("output").style.display = "block";
    document.getElementById("outbtn").style.display = "block";
     };

 </script>
        			
  
<script type="text/javascript">
$(document).ready(function(){
	
  $("#upBtn").click(function(){
    $("#myModal").modal({backdrop: 'static', keyboard: false});
  });

$('#outbtn').click(function(){

 $("#output").css('display','none');
 $("#outbtn").css('display','none');
 $('#ErrorMessage').html('');
stoppr();

});



});
</script>



        
		<script src="{{asset('assets/js/sawl.js')}}"></script>
        <script src="{{ asset('assets/js/popur.js')}}"></script>

 <script>
  $(document).ready(function(){

   $(document).on('click', '#myImg', function(e){

   $('#immyModal').attr('style','display:block;');
     var im = $(this).attr('src');
     var cp = $(this).attr('alt');
     $('#img01').attr('src', ''+ im +'');
     $('#imcaption').html("<h5>"+cp+"</h5>");	
     });


    $(document).on('click','.imclose', function() {
	$('#immyModal').attr('style','display:none;');
	
     });
    
       

 });



  </script>

</body>
</html>
