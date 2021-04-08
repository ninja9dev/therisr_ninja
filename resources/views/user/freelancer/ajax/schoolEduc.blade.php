 <div class="row">
   <div class="col-md-12">
      <label class="tbl-st">Schools attended</label>
   </div>
   <div class="col-md-12">
      @forelse($user->userEducation as $educ)
      <div class="border-upper" id="edu-block-{{ $educ->id }}">
         <div class="main-box">
            <img class="pointer" onclick="edu_edit('{{ $educ->id }}')"  src="{{ asset('assets/img/equal.png')}}">
            <div class="main-lft">
               <div class="main-my">
                  <p class="designation color-black ui-ux-designer">{{ $educ->major }}</p>
                  <p class="location may-2018-current mb-0">
                    {{ $educ->school_name }}
                    <br/>Attended
                    {{ $educ->start_year.' - '.$educ->end_year }}
                     <br/>
                  </p>
               </div>
               <span>
                  <button type="submit" class="btn delete btn1 link delete_edu{{$educ->id}}" 
                   data-placement="right"
                  data-toggle="confirmation"
                  data-id="{{ $educ->id }}"
                  href="javascript:void(0);"
                  >Delete</button>
                  <button type="submit" class="btn btn1 link1 link pr-2 edu_edit" 
                  onclick="edu_edit('{{ $educ->id }}')" 
                  >Edit</button>
               </span>
            </div>
         </div>
      </div>
      <script type="text/javascript">
       //toggle confirmation
            $('.delete_edu{{$educ->id}}').confirmation({
               template: '<div class="popover">' +
                  '<div class="arrow"></div>' +
                  '<h3 class="popover-title">Are you sure?</h3>' +
                  '<div class="popover-content text-center">' +
                  '<div class="btn-group">' +
                  '<a class="btn btn-small" href="javascript:void(0);" data-id="{{$educ->id}}">Yes</a>' +
                  '<a class="btn btn-small" data-dismiss="confirmation">No</a>' +
                  '</div>' +
                  '</div>' +
                  '</div>',
                onConfirm: function(event, element) { 
                  $wid= $(this).attr('data-id');
                  edu_delete($wid);
                 },
              });
      </script>
      @empty
          <!--<p>No Work History added yet!</p>-->
      @endforelse
     
   </div>
   <div class="col-md-12">
      <div class="raev-date-upper" style="display: none;" id="eduModel">
       <form class="eduForm" method="POST" name="eduForm">
         @csrf
         <input type="hidden" name="eduId" id="eduId">
         <div class="row">
            <div class="col-lg-12">
               <div class="form-group">
                  <label>Major</label>
                  <input type="text" class="form-control" name="major">
               </div>
            </div>
            <div class="col-lg-12">
               <div class="form-group">
                  <label>School Name</label>
                  <input type="text" class="form-control" name="school_name">
               </div>
            </div>
            <div class="col-lg-12">
               <div class="row mb-4">
                  <div class="col-lg-12">
                     <label class="date-hed">Dates</label>
                  </div>
                  <div class="col-sm-6">
                     <div class="form-row frm-relatve">
                        <div class="col">
                           <select class="form-control" name="start_year" id="start_edyear">
                              <option value="">Year</option>
                                  @for($i= date('Y'); $i >= (date('Y')-50); $i--)
                                 <option class="dropdown-item" value="{{ $i }}" >
                                    {{ $i }}
                                 </option>
                                 @endfor
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="form-row">
                        <div class="col">
                           <select class="form-control" id="end_year" name="end_year">
                              <option value="">Year</option>
                                  @for($i= date('Y'); $i >= (date('Y')-50); $i--)
                                 <option class="dropdown-item" value="{{ $i }}" >
                                    {{ $i }}
                                 </option>
                                 @endfor
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-12">
               <div class="sve-job-sec">
                  <a class="cancel_edu cncl-btn " href="javascript:void(0)">Cancel</a>
                  <button type="submit" class="sve-jb-btn" href="javascript:void(0)">Save Education</button>
               </div>
            </div>
         </div>
       </form>
      </div>
   </div>
</div>
@if(@$currentwork != 1)
<div class="col-sm-12 p-0 save-btn-lg cont-bt">
   <button type="submit" class="btn btn-primary height-main" id="edu_add">Add education</button>
</div>
@endif

<script type="text/javascript">
function edu_delete($wid)
{ 
   $.ajax({
      url: "{{ url('delete_education') }}/"+$wid,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
       console.log(response.data);
         $('#edu-block-'+$wid).remove();
         $.toast({
                   heading: (response.code == 200) ? 'Success' : 'Error',
                   text: response.message,
                   showHideTransition: 'slide',
                   icon: (response.code == 200) ? 'success' : 'error'
               })
      }            
  });
}

function edu_edit($wid){
     showScreenLoader();
   $.ajax({
            url: "{{ url('get_education') }}/"+$wid,
            type: 'GET',
            dataType: 'json',
            success: function(response) {

             console.log(response.data);
            $('#eduId').val(response.data.id);
            $("input[name='major']").val(response.data.major);
            $("input[name='school_name']").val(response.data.school_name);
            $("select[name='start_year']").val(response.data.start_year);
            $("select[name='end_year']").val(response.data.end_year);
               $("#eduModel").toggleClass("main");
               $(".edu_edit").toggleClass("hide");
               $("#edu_add").toggleClass("hide");
                // scroll to form
               scrollToForm();
               hideLoader();
            }            
  });
}

$(function() {    //work exp form
   $("form[name='eduForm'").validate({
         rules: {  
         major: "required",
         school_name: "required",
         start_year: "required",
         end_year: {required:true , greaterStart: "#start_edyear"},
       },  
       // Specify validation error messages
       messages: {
         major: "Please enter major.",
         school_name: "Please enter school name.",
         start_year : "Required",
         end_year : {
            required : "Required",
            greaterStart : "Must be greater than start Year."
         }
       },
       // Make sure the form is submitted to the destination defined
       // in the "action" attribute of the form when valid
       submitHandler: function(form) {
          showScreenLoader();
          $.ajax({
               url: "{{ route('user.education_sub') }}",
               type: form.method,
               data: $(form).serialize(),
               dataType: 'json',
               success: function(response) {
                  $.toast({
                      heading: 'Success',
                      text: response.message,
                      showHideTransition: 'slide',
                      icon: 'success'
                  })
                    // scroll to form
                   scrollToForm();
                  get_eduBOX();
                  hideLoader();
               }            
           });
          return false; // <- last item inside submitHandler function
       }
   });

// custom validation message
   jQuery.validator.addMethod("greaterStart", function (value, element, params) {
       return this.optional(element) || new Date(value) >= new Date($(params).val());
   },'Must be greater than start date.');


});



$(document).ready(function(){
      $("#edu_add").click(function(){
         $("#eduModel").toggleClass("main");
         $("#edu_add").toggleClass("hide");
          scrollToForm();
      });
      $(".cancel_edu").click(function(){
         $("#eduModel").toggleClass("main");
         $("#edu_add").toggleClass("hide");
         $(".edu_edit").toggleClass("hide");
          scrollToForm('eduBOX');
      });
});


function scrollToForm($id = 'eduModel'){
    // scroll to form
     $('html, body').animate({
          'scrollTop' : $("#"+$id).offset().top
      });
}
</script>