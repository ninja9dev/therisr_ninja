function onModalClose(){
   if(typeof currentPath != 'undefined' && typeof resultList == 'undefined')
    job_areaGet(currentPath,currentPagep);
  else
    applyFilter();
}


 
  function get_HirePopupView($userId,$proposalId,$jobId){
    console.log(base_url,'base_url', base_url+"get_hirePopup/"+$userId+'/'+$proposalId+'/'+$jobId);
     showScreenLoader(); 
     $('#freelancerViewPopup').modal('hide');
     $('#proposalViewPopup').modal('hide');
     $('#Fairymdl').modal('hide');
      $.ajax({
           url: base_url+"/get_hirePopup/"+$userId+'/'+$proposalId+'/'+$jobId,
           type: 'GET',
           success: function(response) {
            $('#hireFreelancer').find('.modal-content').html(response);
            $('#hireFreelancer').modal('show');
            $('body').addClass('modal-open');
              hideLoader();
           }            
     });
  }


function onSuccessClode(){
   $('#successHirePopup').modal('hide');
   if(typeof currentPath != 'undefined')
     job_areaGet(currentPath,currentPagep);
   else
     applyFilter();
}

   $('.delete_hire').confirmation({
      template: '<div class="popover">' +
         '<div class="arrow"></div>' +
         '<h3 class="popover-title">Are you sure?</h3>' +
         '<div class="popover-content text-center">' +
         '<div class="btn-group">' +
         '<a class="btn btn-small" href="javascript:void(0);" data-id="">Yes</a>' +
         '<a class="btn btn-small" data-dismiss="confirmation">No</a>' +
         '</div>' +
         '</div>' +
         '</div>',
       onConfirm: function(event, element) { 
         $pid= $('#contractId').val();
         job_hiredelete(base_url+"/job_hiredelete/"+$pid);
        },
   }); 

function job_hiredelete($url)
{ 

   $.ajax({
      url: $url,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
       console.log(response.data);
          $('#successHirePopup').modal('hide');
           $('#contractView').modal('hide');
           if(typeof currentPath != 'undefined')
             job_areaGet(currentPath,currentPagep);
           else
             applyFilter();
         $.toast({
                   heading: (response.code == 200) ? 'Success' : 'Error',
                   text: response.message,
                   showHideTransition: 'slide',
                   icon: (response.code == 200) ? 'success' : 'error'
               })
      }            
  });
}

function getFreelancerModel($id,$url){
   showScreenLoader();
   $.ajax({
      url: $url,
      type: 'GET',
      success: function(response) {
         hideLoader();
         $('#freelancerViewPopup').find('.modal-content').html(response);
         $('#freelancerViewPopup').modal('show');
      }            
  });
}