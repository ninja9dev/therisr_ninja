 <div class="row">
   <div class="col-md-12">
      <label class="tbl-st">Work experience</label>
   </div>
   <div class="col-md-12">
      @forelse ($user->userWorkExp as $workExp)
         @if($workExp->currently_working == 'on')
          @php $currentwork = 1; @endphp
         @endif
      <div class="border-upper" id="work-block-{{ $workExp->id }}">
         <div class="main-box">
            <img class="pointer" onclick="workExp_edit('{{ $workExp->id }}')" src="{{ asset('assets/img/equal.png')}}">
            <div class="main-lft">
               <div class="main-my">
                  <p class="designation color-black ui-ux-designer">{{ $workExp->title }}</p>
                  <p class="location mutual-mobile">{{ $workExp->company_name }}
                  </p>
                  <p class="location may-2018-current mb-0">
                     {{ date("M",strtotime(date("Y")."-".$workExp->start_month."-01")).' '.$workExp->start_year }} - {{ ($workExp->currently_working == 'on') ? 'Current' :  date("M",strtotime(date("Y")."-".$workExp->end_month."-01")).' '.$workExp->end_year }}
                     <br/>{{ $workExp->location }}
                  </p>
               </div>
               <span>
                  <button type="submit" class="btn delete btn1 link delete_workExp{{ $workExp->id }}" 
                   data-placement="right"
                  data-toggle="confirmation"
                  data-id="{{ $workExp->id }}"
                  href="javascript:void(0);"
                  >Delete</button>
                  <button type="submit" class="btn btn1 link1 link pr-2 workExp_edit" 
                  onclick="workExp_edit('{{ $workExp->id }}')" 
                  >Edit</button>
               </span>
            </div>
         </div>
      </div>
      <script type="text/javascript">
       //toggle confirmation
            $('.delete_workExp{{ $workExp->id }}').confirmation({
               template: '<div class="popover">' +
                  '<div class="arrow"></div>' +
                  '<h3 class="popover-title">Are you sure?</h3>' +
                  '<div class="popover-content text-center">' +
                  '<div class="btn-group">' +
                  '<a class="btn btn-small" href="javascript:void(0);" data-id="{{$workExp->id}}">Yes</a>' +
                  '<a class="btn btn-small" data-dismiss="confirmation">No</a>' +
                  '</div>' +
                  '</div>' +
                  '</div>',
                onConfirm: function(event, element) { 
                  $wid= $(this).attr('data-id');
                  workExp_delete($wid);
                 },
              });
      </script>
      @empty
          <!--<p>No Work History added yet!</p>-->
      @endforelse
     
   </div>
   <div class="col-md-12">
      <div class="raev-date-upper" style="display: none;" id="workExpModel">
       <form class="workExpForm" method="POST" name="workExpForm">
         @csrf
         <input type="hidden" name="workId" id="workId">
         <div class="row">
            <div class="col-lg-12">
               <div class="form-group">
                  <label>Title</label>
                  <input type="text" class="form-control" name="title">
               </div>
            </div>
            <div class="col-lg-12">
               <div class="form-group">
                  <label>Company Name</label>
                  <input type="text" class="form-control" name="company_name">
               </div>
            </div>
            <div class="col-lg-12">
               <div class="form-group">
                  <label>Location</label>
                  <input type="text" class="form-control" name="location">
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
                           <select class="form-control" name="start_month">
                              <option value="">Month</option>
                              @for($i=1; $i<=12; $i++)
                              <option value="{{ $i }}">{{ date("M",strtotime(date("Y")."-".$i."-01")) }}</option>
                              @endfor
                           </select>
                        </div>
                        <div class="col">
                           <select class="form-control" name="start_year" id="start_year">
                              <option value="">Year</option>
                                  @for($i= date('Y'); $i >= (date('Y')-50); $i--)
                                 <option class="dropdown-item" 
                                   {{ (!empty($user->userProfile['start_year']) && $user->userProfile['start_year'] == $i) ? 'selected="selected"' : '' }} >
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
                           <select class="form-control" id="end_month" name="end_month">
                              <option value="">Month</option>
                              @for($i=1; $i<=12; $i++)
                              <option value="{{ $i }}">{{ date("M",strtotime(date("Y")."-".$i."-01")) }}</option>
                              @endfor
                           </select>
                        </div>
                        <div class="col">
                           <select class="form-control" id="end_year" name="end_year">
                              <option value="">Year</option>
                                  @for($i= date('Y'); $i >= (date('Y')-50); $i--)
                                 <option class="dropdown-item" 
                                   {{ (!empty($user->userProfile['start_year']) && $user->userProfile['start_year'] == $i) ? 'selected="selected"' : '' }} >
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
               <div class="form-group">
                  <label class="check-label">I currently work here
                  <input type="checkbox" id="currently_working" name="currently_working">
                  <span class="checkmark"></span>
                  </label>
               </div>
            </div>
            <div class="col-lg-12">
               <div class="sve-job-sec">
                  <a class="cancel_job cncl-btn " href="javascript:void(0)">Cancel</a>
                  <button type="submit" class="sve-jb-btn" href="javascript:void(0)">Save Job</button>
               </div>
            </div>
         </div>
       </form>
      </div>
   </div>
</div>
@if(@$currentwork != 1)
<div class="col-sm-12 p-0 save-btn-lg cont-bt">
   <button type="submit" class="btn btn-primary height-main" id="workExp_add">Add work experience</button>
</div>
@endif

<script type="text/javascript">
function workExp_delete($wid)
{ 
   $.ajax({
      url: "{{ url('delete_workExp') }}/"+$wid,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
       console.log(response.data);
         $('#work-block-'+$wid).remove();
         $.toast({
                   heading: (response.code == 200) ? 'Success' : 'Error',
                   text: response.message,
                   showHideTransition: 'slide',
                   icon: (response.code == 200) ? 'success' : 'error'
               });
         
                  get_workExpBOX();
      }            
  });
}

function workExp_edit($wid){

     showScreenLoader();
   $.ajax({
            url: "{{ url('get_workExp') }}/"+$wid,
            type: 'GET',
            dataType: 'json',
            success: function(response) {

             console.log(response.data);
            $('#workId').val(response.data.id);
            $("input[name='title']").val(response.data.title);
            $("input[name='company_name']").val(response.data.company_name);
            $("input[name='location']").val(response.data.location);
            $("select[name='start_month']").val(response.data.start_month);
            $("select[name='start_year']").val(response.data.start_year);
            $("select[name='end_month']").val(response.data.end_month);
            $("select[name='end_year']").val(response.data.end_year);
            if(response.data.currently_working == 'on')
            {
               $('#currently_working').prop( "checked", true );
               $("select[name='end_month']").val('');
               $("select[name='end_year']").val('');
            }else{
               $('#currently_working').prop( "checked", false );
            }

               $("#workExpModel").toggleClass("main");
               $(".workExp_edit").toggleClass("hide");
               $("#workExp_add").toggleClass("hide");
             // scroll to form
               scrollToFormWrk(); 
               hideLoader();
            }            
  });
}

$(function() {    //work exp form
   $("form[name='workExpForm'").validate({
         rules: {  
         title: "required",
         company_name: "required",
         location: "required",
         start_month : "required",
         start_year: "required",
         end_month: {required:"#currently_working:not(:checked)"},
         end_year: {required:"#currently_working:not(:checked)" , greaterStartV: "#start_year"},
         currently_working : {required:false}
       },  
       // Specify validation error messages
       messages: {
         title: "Please enter job title.",
         company_name: "Please enter company name.",
         start_month : "Required",
         start_year : "Required",
         end_month : "Required",
         end_year : {
            required : "Required",
            greaterStartV : "Must be greater than start Year."
         }
       },
       // Make sure the form is submitted to the destination defined
       // in the "action" attribute of the form when valid
       submitHandler: function(form) {

        //if currently working checkout select then unset value of end date and end month
        if ($("#currently_working").prop(":checked")) {
            $('#end_month').val('');
            $('#end_year').val('');
         }
        
         showScreenLoader();
          $.ajax({
               url: "{{ route('user.workExp') }}",
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
                  scrollToFormWrk();
                  get_workExpBOX();
                  hideLoader();
                  //$('#headingThree').find('button').click();
               }            
           });
          return false; // <- last item inside submitHandler function
       }
   });

// custom validation message
   jQuery.validator.addMethod("greaterStartV", function (value, element, params) {
       return this.optional(element) || new Date(value) >= new Date($(params).val());
   },'Must be greater than start date.');


});



$(document).ready(function(){
      $("#workExp_add").click(function(){
         $("#workExpModel").toggleClass("main");
         $("#workExp_add").toggleClass("hide");
           // scroll to form
               scrollToFormWrk();
      });
      $(".cancel_job").click(function(){
         $("#workExpModel").toggleClass("main");
         $("#workExp_add").toggleClass("hide");
         $(".workExp_edit").toggleClass("hide");
           // scroll to form
               scrollToFormWrk('workExpBOX');
      });
});

function scrollToFormWrk($id = 'workExpModel'){
    // scroll to form
     $('html, body').animate({
          'scrollTop' : $("#"+$id).offset().top
      });
}

</script>