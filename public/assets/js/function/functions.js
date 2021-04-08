


    /*Initialize services and skills*/
   
    // multi select
       $('#services').select2({
           placeholder: "Select services",
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

 /*Validate character limit*/
 function isLimitValidate(thisv){
    //character limit 
   // var thisv = '#'+id;
    var maxLength = $(thisv).attr('data-maxlength');
      if(!maxLength && $(thisv).attr('maxlength')){
       maxLength =  $(thisv).attr('maxlength'); 
      }else if(!maxLength && !$(thisv).attr('maxlength')){
         maxLength = 544;
      }

     var textlen = maxLength - $(thisv).val().length;
     $(thisv).parent().find('span:not(".help-block")').text(textlen + ' characters left');
 }

  function exp_level(thisv, $val=1){
      $('.exp_level_w').removeClass('activeexp');
      $(thisv).addClass('activeexp');
      $('#exp_level').val($val);
  }
function jobType(thisv, $val=1){
          $('.job_type_box').removeClass('activeexp');
          $(thisv).addClass('activeexp');
          $('#job_type').val($val);
}

   function isAmountValidate(evt,thisv) 
    {  
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode != 46 || $(thisv).val().indexOf('.') != -1)) 
        {
            $(thisv).closest('form').find('.btnSubmit').attr('disabled','disabled');
            return false;
        }else{
             var len = $(thisv).val().length;
             var index = $(thisv).val().indexOf('.');
             if (index > 0) { 
                 var CharAfterdot = (len + 1) - index;
                 if (CharAfterdot > 3) {
                     $(thisv).closest('form').find('.btnSubmit').attr('disabled','disabled');
                     return false;
                 }
             }
          $(thisv).removeClass('is-invalid');
          $(thisv).parent().find('span.help-block').html('');
          $(thisv).closest('form').find('.btnSubmit').removeAttr('disabled'); 
           return true;
        }
    } 


    function isWeeklyLimit(thisv){
       thisv = '#'+thisv;

      var maxamount = $(thisv).attr('data-maxamount');
      if(!maxamount && $(thisv).attr('max')){
       maxamount =  $(thisv).attr('max'); 
      }else if(!maxamount && !$(thisv).attr('max')){
         maxamount = 60;
      }
      console.log('maxamount   ' + maxamount);
     if(!$(thisv).hasClass('is-invalid'))
     {
       if($(thisv).val() < 1 && $(thisv).val() != ''){
          $(thisv).addClass('is-invalid'); 
          $(thisv).parent().find('span.help-block').html('Should not be less than 1hrs');
          $(thisv).closest('form').find('.btnSubmit').attr('disabled','disabled');
          return false;
        }else if($(thisv).val() > parseFloat(maxamount)){
          $(thisv).addClass('is-invalid');
          $(thisv).parent().find('span.help-block').html('It must be less than or equal to '+maxamount + ' hrs');
          $(thisv).closest('form').find('.btnSubmit').attr('disabled','disabled');
          return false;
        }else{
          var value = $(thisv).val().split('.');
          if(value.length > 1){
            $(thisv).val(value[0]);
             /*if(value[1] >= 60){
                $(thisv).addClass('is-invalid');
                $(thisv).parent().find('span.help-block').html('Minutes should be less than 60!');
                $(thisv).closest('form').find('.btnSubmit').attr('disabled','disabled');
                return false;
             }*/
          }
          $(thisv).removeClass('is-invalid');
          $(thisv).parent().find('span.help-block').html('');
          $(thisv).closest('form').find('.btnSubmit').removeAttr('disabled'); 
           return true;
        }
      }

    }

  function validateFloatKeyPress(el) 
  {
        var v = parseFloat(el.value); 
        el.value = (isNaN(v)) ? '' : v.toFixed(2);
  }


   function isAmountValidate_default(thisv) 
   {
      thisv = '#'+thisv;

      var maxamount = $(thisv).attr('data-maxamount');
      if(!maxamount && $(thisv).attr('max')){
       maxamount =  $(thisv).attr('max'); 
      }else if(!maxamount && !$(thisv).attr('max')){
         maxamount = 99.99;
      }
      console.log('maxamount   ' + maxamount + '--' + $(thisv).val() +  thisv);
     if(!$(thisv).hasClass('is-invalid'))
     {
       if($(thisv).val() < 0.02 && $(thisv).val() != ''){
          $(thisv).addClass('is-invalid'); 
          $(thisv).parent().find('span.help-block').html('Should not be less than $0.02');
          $(thisv).closest('form').find('.btnSubmit').attr('disabled','disabled');
          return false;
        }else if($(thisv).val() > parseFloat(maxamount)){
          $(thisv).addClass('is-invalid');
          $(thisv).parent().find('span.help-block').html('It must be less than or equal to '+maxamount);
          $(thisv).closest('form').find('.btnSubmit').attr('disabled','disabled');
          return false;
        }else{
          $(thisv).removeClass('is-invalid');
          $(thisv).parent().find('span.help-block').html('');
          $(thisv).closest('form').find('.btnSubmit').removeAttr('disabled'); 
           return true;
        }
      }
   }

   


/*functions of edit profile page*/
 function calculateFee(thisv,$service_fee) {
      if(isAmountValidate_default(thisv))
      {
        console.log($('#'+thisv).val());
         $h_rate = $('#'+thisv).val();
         $c_fee = ($h_rate * $service_fee) / 100 ;
         $av_amt = $h_rate - $c_fee;
          console.log($c_fee, $av_amt, $service_fee);
         $('#calculatedFee').html($c_fee);
         $('#receiveAmt').html($av_amt);
      }else{
        console.log('false');
      }
    }
