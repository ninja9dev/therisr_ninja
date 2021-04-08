
@extends('user.layouts.main')

@section('content')
<form name="editproject" enctype="multipart/form-data" method="POST" action="{{ route('user.addproject') }}">
 @csrf
 <input type="hidden" name="porftId" value="{{ $portfolio->id }}">
	<section class="upload-new-alla">
			<!-- <p class="pos-erroe">
				<span class="error-msgs"> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> [image_title] dimensions should be at least 400x300 </span>
			</p> -->
		
			<div class="container">
				<div class="row">
					<div class="col-md-7">
						<div class="uplad-sction">
							<div class="top-bar-upls">
								<ul class="top-imgsa">
									<li>
										<img src="{{ asset('assets/img/image.svg')}}">
									    <h4> One image at a time </h4>
										<p> PNG, JPG, GIF </p>
									</li>
									<li>
										<img src="{{ asset('assets/img/gif.svg')}}">
									    <h4> Animated GIF </h4>
										<p> 400*300, 800*600 or 1600*1200</p>
									</li>
								</ul>
							</div>
							<label for="img-str" class="btm-drgs">
								<img src="{{ asset('assets/img/upload.svg')}}" class="iamh-img">
								<h4> Drag & drop an image </h4>
								<p> or <span> browse </span> to choose a file </p>
								<small> (400 x 300 or larger recommeded, up to 5MB each) </small>
								<input type="file" multiple="multiple" name="images[]" id="img-str" 
								 style="width:0px; height:0px; opacity:0; visibility:hidden;" />
							</label>
						</div>
						<ul class="uploaded-imgs">
							@php  $pro_images =  !empty($portfolio->images ) ?
								                         explode(',',$portfolio->images) : array();  
							@endphp
							@forelse($pro_images as $key=>$img)
							<li class="old">
								<img src="{{ asset('assets/project_images/').'/'.$img }}" class="sr-str">
								<a href="javascript:void(0);" data-index="old-{{$key}}" onclick="deleteThis(this);"
								 class="dlt-ims"> 
									<img src="{{ asset('assets/img/close.svg')}}"> 
								</a>
						    </li>
							@empty   
                            @endforelse
						</ul>
					</div>
					<div class="col-md-5">
						<div class="feilds-alsl">
							<div class="row">
								<div class="col-md-12">
									<label class="tbl-st"> Title  </label>
								</div>
								<div class="col-md-12 inp">
									<input type="text" class="form-control w-100"  placeholder="Add a Title"
									name="title" value="{{ ($portfolio->title) ? $portfolio->title : ''}}">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<label class="tbl-st"> Role  </label>
								</div>
								<div class="col-md-12 inp">
									<input type="text" class="form-control w-100"  placeholder="Add a Role" 
									name="role" value="{{ ($portfolio->role) ? $portfolio->role : ''}}">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<label class="tbl-st"> Skills  </label>
								</div>
								<div class="col-md-12 inp">
								@php  $user_skills =  !empty($portfolio->skills ) ?
								                         explode(',',$portfolio->skills) : array(); 
								@endphp
 
                                  <select class="form-control select2" name="skills"  id="skills"
                                   multiple style="width: 100%">
                                     <option value=""></option>
                                     @foreach($skills as $skill)
                                      <option value="{{ $skill->id }}" 
                                      	{{ in_array( $skill->id, $user_skills) ? 'selected="selected"'  : ''}} >
                                      	{{ $skill->name }}</option>
                                     @endforeach
                                  </select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<label class="tbl-st"> Description </label>
								</div>
								<div class="col-md-12">
									<textarea class="form-control" name="description" rows="5" id="description" 
									placeholder="Tell your potential clients your process and how you overcome the challenge, solve the problem, etc.">{{ ($portfolio->description) ? $portfolio->description : ''}}</textarea>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<label class="tbl-st"> Link  </label>
								</div>
								<div class="col-md-12 inp">
									<input type="url"  name="link" class="form-control w-100"  
									placeholder="Link to the project if applicable" value="{{ ($portfolio->link) ? $portfolio->link : ''}}">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="btn-ffotr">
			<div class="container-fluid">
				<div class="btn-foots">
					<input type="hidden" name="removeImage" id="removeImage"/>
					<a href="{{ route('user.editprofile') }}" class="btn btn-cancl gray-color"> Cancel </a>
					<button  type="submit" class="btn btn-publsi float-right"> Publish </button>
				</div>
			</div>
		</section>
	</form>

@endsection


@section('footer') 
<script>
	var queue = [];
           // multi select
       $('#skills').select2({
           placeholder: "Select skills",
           tags: true,
           multiple: true,
           tokenSeparators:[","],
           createTag: function (params) {
             var term = $.trim(params.term);

             if (term === '') {
               return null;
             }

             return {
               id: 'new:' + term,
               text: term
             }
           }
       });


         // editproject
   $("form[name='editproject'").validate({
      rules: {  
	      title: "required",
	      role: "required",
	      skills: "required"
    },  
    // Specify validation error messages
    messages: {
      title: "Please enter title.",
      role: "Please enter your role.",
      skills: "Please enter skills you have.",
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
     console.log(queue);
        showScreenLoader();

        var formData = new FormData($('form[name="editproject"]')[0]);
        var filesLength=queue.length;
		for(var i=0;i<filesLength;i++){
			formData.append("imagesfinal[]", queue[i]);
		}
		formData.append('skills' ,$('#skills').val().join(','));

       $.ajax({ 
            url: "{{ route('user.addproject') }}",
            type: "POST",
            data:formData,
            dataType: 'JSON',
            cache:false,
            contentType: false,
            processData: false,
            success: function(response) {
               $.toast({
                   heading: 'Success',
                   text: response.message,
                   showHideTransition: 'slide',
                   icon: 'success'
               })
               hideLoader();
            }            
        });
       // end submit image


      //form.submit();
       return false; // <- last item inside submitHandler function
    }
   });


$("#img-str").change(function() {
  readURL(this);
});

function readURL(input) {

	 //Get the files
  var files = input.files || [];
  if (files.length) {
    for (let index = 0; index < files.length; index++) {
       var filePath = files[index].name; 
	   var allowedExtensions =  
	           /(\.jpg|\.jpeg|\.png|\.gif)$/i; 
	   if (!allowedExtensions.exec(filePath)) { 
	         $.toast({
	             heading: 'Error',
	             text:'Invalid file type.',
	             showHideTransition: 'slide',
	             icon: 'error'
	         });
	       fileInput.value = ''; 
	       return false; 
	   }else  
	   {

	   	   //instantiate a FileReader for the current file to read
		    var reader = new FileReader();
		    reader.onload = function(e) {
                var width = 0;
                var height = 0;

		      	  var image = new Image();
				    image.src = e.target.result;
				    image.onload = function() {
				    	width = this.width;
				    	height = this.height;
				        // access image size here 
				        console.log(this.width,this.height);				  
				           console.log(width,height);

				         if(width < 300 || height < 300){
			                 $.toast({
					             heading: 'Error',
					             text:files[index].name + ' dimensions should be at least 400x300',
					             showHideTransition: 'slide',
					             icon: 'error'
					           });
		                }else{
		               		queue.push( files[index] );
					      	var count = $('.uploaded-imgs').find('li:not(.old)').length;
					      	console.log(e.target);
					       		var li = '<li id="'+count+'"> '+
										'<img src="'+e.target.result+'" class="sr-str">'+
											'<a href="javascript:void(0);"  data-index="'+count+'"  onclick="deleteThis(this);" class="dlt-ims"> <img src="{{ asset('assets/img/close.svg')}}"> </a>'+
									 '</li>';
					         $('.uploaded-imgs').append(li);

					    }
				    };
               
		    }
		    reader.readAsDataURL(files[index]);
		}
    }
  }
}

function deleteThis(thisv){
	var rm = [];
	rm = (($('#removeImage').val()) != '') ? $('#removeImage').val().split(',') : [];
	var index = $(thisv).attr('data-index');
	rm.push(index);
	console.log(rm);

	if (Array.isArray(rm) && rm.length) 
	rm = rm.join(',');
    else
    rm = ''
    
     queue.splice(index, 1);
	$('#removeImage').val(rm);
	$(thisv).parent('li').remove();
}



</script>

@endsection