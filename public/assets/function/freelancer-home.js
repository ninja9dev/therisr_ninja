  $(document).ready(function(){

    $( "#untilDate" ).datepicker({ 
      minDate: 0, 
      dateFormat: 'yy-mm-dd',
      setDate : "{{ !empty($user->userAvailable['nonavail_untill']) ? $user->userAvailable['nonavail_untill']  : ''  }}"
    });


     //get portfolio section
     get_portfolioBOX();  

        $(".notavail").click(function(){
            $('#available').val($(this).attr('data-id'));
            $('#availableButton').html($(".notavail").html());
            $(".till").hide();
            $(".untill").show();
        });
        $(".avail").click(function(){
            $('#available').val($(this).attr('data-id'));
            $('#availableButton').html($(".avail").html());
            $(".untill").hide();
            $(".till").show();
        });

   });

function get_portfolioBOX(){
     showScreenLoader();
    $.ajax({
         url: "{{ route('user.portfolio_ajax')}}",
         data: { 'route' : "{{Route::current()->getName()}}"},
         success:function(response)
         {
            hideLoader();
            $('#portfolioBOX').html(response);  
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



$(function() { 
   $("form[name='updateStatus']").validate({
    // Specify validation rules
    rules: { 
      avail_for: {
         validOrNah: true
      },
      nonavail_untill : {
         validOrNah_non: true
      }
    },  
    submitHandler: function(form) {
      showScreenLoader();
        var formData = new FormData($('form[name="updateStatus"]')[0]);
       $.ajax({
            url: "{{ route('user.updateAvailable') }}",
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
               $('.updateStatusAvailButton').click();
               if($("#available").val() === "1")
               {
                   $('#h1available').html('Available');
                   $('#h2foruntill').html('Less than '+$("#avail_for").val()+' hrs/week');
              }else{
                $('#h1available').html('Not Available');
                var month = new Array();
                month[0] = "Jan";
                month[1] = "Feb";
                month[2] = "March";
                month[3] = "April";
                month[4] = "May";
                month[5] = "Jun";
                month[6] = "July";
                month[7] = "Aug";
                month[8] = "Sept";
                month[9] = "Oct";
                month[10] = "Nov";
                month[11] = "Dec";

                var d = new Date($("#untilDate").val());
                var date = (d.getDate() < 10) ? '0'+d.getDate() : d.getDate();
                var n = month[d.getMonth()]+ ' ' + date + ', ' + d.getFullYear();
                 $('#h2foruntill').html(n);
              }
               hideLoader();
            }            
        });
       return false; // <- last item inside submitHandler function
     }
  });
});

$.validator.addMethod("validOrNah", function(value, element) {
  if ($("#available").val() === "1" && $("#avail_for")[0].selectedIndex === 0) {
    return false;
  } 
    return true;
}, "Please select something!");


$.validator.addMethod("validOrNah_non", function(value, element) {
  if ($("#available").val() === "2" && $("#untilDate").val() == '') {
    return false;
  } 
    return true;
}, "Please select date!");