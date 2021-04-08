<!-- Modal -->
<div class="modal modal-report fade" id="reportmodal" tabindex="-1" role="dialog" 
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
     <form name="job_report" method="POST">
     @csrf
        <div class="modal-header">
          <h5 class="modal-title" >Report this post</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>		
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="job_id" id="jobid" />
            <textarea class="form-control px-3"  
            rows="5" 
            placeholder="Enter the reason" 
            name="reason"
            maxlength="5000" 
            onkeyup="return isLimitValidate(this);" ></textarea>
           <span class="help-block invalid-feedback"></span>
            <span class="chara-data" id="description_limit"> 5000 characters left</span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary cncl" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary submit">Submit</button>
        </div> 
    </form>
    </div>
  </div>
</div>	


<script>
     <?php 
   if(!empty($currentpage) && $currentpage == 'likedjobs' ){ ?>
   var currentPath = "{{ route('user.get_job_ajax_frlncr', ['page' => 'likedjobs'])}}";
   var currentPagep = "likedjobs";
   <?php }else if(!empty($currentpage) && $currentpage == 'skippedjobs' ){?>
   var currentPath = "{{ route('user.get_job_ajax_frlncr', ['page' => 'skippedjobs'])}}";
   var currentPagep = "skippedjobs";
 <?php }else if(!empty($currentpage) && $currentpage == 'appliedjobs' ){?>
   var currentPath = "{{ route('user.get_job_ajax_frlncr', ['page' => 'appliedjobs'])}}";
   var currentPagep = "appliedjobs";
  <?php  }else{?>
   var currentPath = "{{ route('user.get_job_ajax_frlncr', ['page' => 'all'])}}";
   var currentPagep = "all";

   <?php }?> 
$( function() {
  $("form[name='job_report'").validate({
      rules: { 
         reason: "required"
    },  
    submitHandler: function(form) {   
           showScreenLoader();
           var formData = new FormData($('form[name="job_report"]')[0]);
            $.ajax({ 
               url: "{{ route('user.job_report') }}",
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
                  });
                 job_areaGet(currentPath,currentPagep);
                  hideLoader();
                   $('#reportmodal').find('.close').click();
               }            
            });
          return false; // <- last item inside submitHandler function
    }
   });
});

  </script>