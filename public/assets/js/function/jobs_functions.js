
function getJobReportModel($jobid){ 
   $('#reportmodal').find('#jobid').val($jobid);
}

function get_jobBasicF($id,$url,$fromPage = '',$jobstatus = ''){
    
    if($fromPage == 'alljobs' && $jobstatus != '1'){
      $('.card').removeClass('viewzeroHired');
      $('#job-block-'+$id).toggleClass('viewzeroHired');
    }

  // if(!$('#job_basic_box'+$id).find('div').length){
     showScreenLoader();
    $.ajax({
         url:$url,
         success:function(response)
         {
            hideLoader();
            $('#job_basic_box'+$id).html(response);  
         },error:function(errorResponse)
         {
            if(errorResponse.status == 401)
            {
              location.reload();
            }
            hideLoader();
         }
     }); 
  // }
}

function get_jobBasicSingle($id,$url){
     showScreenLoader();
    $.ajax({
         url:$url,
         success:function(response)
         {
            hideLoader();
            $('#job_basic_box'+$id).html(response);  
         },error:function(errorResponse)
         {
            if(errorResponse.status == 401)
            {
              location.reload();
            }
            hideLoader();
         }
     }); 
}


function get_timesheets($cid, $url){
     showScreenLoader();
    $.ajax({
         url:$url,
         success:function(response)
         {
            hideLoader();
            $('#timesheets_box'+$cid).html(response);  
         },error:function(errorResponse)
         {
            if(errorResponse.status == 401)
            {
              location.reload();
            }
            hideLoader();
         }
     }); 
}


function get_milestones($cid, $url){
  console.log('get milestones');
  // if(!$('#milestones_box'+$cid).find('div').length){
     showScreenLoader();
    $.ajax({
         url:$url,
         success:function(response)
         {
            hideLoader();
            $('#milestones_box'+$cid).html(response);  
         },error:function(errorResponse)
         {
            if(errorResponse.status == 401)
            {
              location.reload();
            }
            hideLoader();
         }
     }); 
  // }
}

function get_payments($cid, $url){
     showScreenLoader();
    $.ajax({
         url:$url,
         success:function(response)
         {
            hideLoader();
            $('#payments_box'+$cid).html(response);  
         },error:function(errorResponse)
         {
            if(errorResponse.status == 401)
            {
              location.reload();
            }
            hideLoader();
         }
     }); 
  
}

function get_feedbacks($cid, $url){
     showScreenLoader();
    $.ajax({
         url:$url,
         success:function(response)
         {
            hideLoader();
            $('#feedbacks_box'+$cid).html(response);  
         },error:function(errorResponse)
         {
            if(errorResponse.status == 401)
            {
              location.reload();
            }
            hideLoader();
         }
     }); 
  
}

function get_jobBasic_freelancer($url,$fromPage = '',$jobstatus = ''){
    
   $('#jobslisting').hide();
   showScreenLoader();
    $.ajax({
         url:$url,
         success:function(response)
         {
            hideLoader();
            $('#jobdetails').show();
            $('#jobdetails').html(response);  
         },error:function(errorResponse)
         {
            if(errorResponse.status == 401)
            {
              location.reload();
            }
            hideLoader();
         }
     }); 
  
}

function hideJobDetail(){
  $('#jobslisting').show();
  $('#jobdetails').hide();
}

function job_statusChange($jidm,$url)
{ 
   $.ajax({
      url: $url,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
       console.log(response.data);
        if(response.code == 200 && response.action == 'delete')
        {
          $('#job-block-'+$jid).remove();
        }else{
          job_areaGet(jobareaajax_path,currentPage);
        }
         $.toast({
                   heading: (response.code == 200) ? 'Success' : 'Error',
                   text: response.message,
                   showHideTransition: 'slide',
                   icon: (response.code == 200) ? 'success' : 'error'
               })
      }            
  });
}

function freelancer_status($jidm,$url)
{ 
   $.ajax({
      url: $url,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
       console.log(response.data);
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

function contract_statusChange($jidm,$url)
{ 
   $.ajax({
      url: $url,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
       console.log(response.data);
        if(response.code == 200 && response.action == 'delete')
        {
          $('#contract-block-'+$jid).remove();
        }else{
          job_areaGet(jobareaajax_path,currentPage);
        }
         $.toast({
                   heading: (response.code == 200) ? 'Success' : 'Error',
                   text: response.message,
                   showHideTransition: 'slide',
                   icon: (response.code == 200) ? 'success' : 'error'
               })
      }            
  });
}




function job_areaGet($url,$page, $id='')
{  
    showScreenLoader();
    $.ajax({
         url:$url,
         success:function(response)
         {
            hideLoader();
            if($id == ''){
               $('#page-area-job').html(response);  
            }else{
              $('#'+$id).html(response);  
            }
         },error:function(errorResponse)
         {
            if(errorResponse.status == 401)
            {
              location.reload();
            }
            hideLoader();
         }
     }); 
}