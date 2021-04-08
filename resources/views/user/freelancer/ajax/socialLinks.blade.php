     <form class="socialForm" method="POST" name="socialForm">
         @csrf
      <div class="padding-srt">
         <div class="row">
            <div class="col-md-6">
               <label class="tbl-st"><img src="{{ asset('assets/img/icon-1.png')}}"><span class="img-txt">GitHub</span> </label>
            </div>
            <div class="col-md-6 inp">
               <input type="text" class="form-control" placeholder="Github Username" name="github"
               value="{{ !empty($user->userSocialLinks['github']) ? $user->userSocialLinks['github'] : '' }}"
               onkeyup="isUrlValid(this, 'github');">
               <span class="error help-block" style="display: none;">Please enter a valid value.</span>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
               <label class="tbl-st"><img src="{{ asset('assets/img/medium.png')}}"><span class="img-txt">Medium</span> </label>
            </div>
            <div class="col-md-6 inp">
               <input type="text" class="form-control"  placeholder="Medium Username" name="medium"
               value="{{ !empty($user->userSocialLinks['medium']) ? $user->userSocialLinks['medium'] : '' }}"
               onkeyup="isUrlValid(this, 'medium');">
               <span class="error help-block" style="display: none;">Please enter a valid value.</span>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
               <label class="tbl-st"><img src="{{ asset('assets/img/icon-3.png')}}"><span class="img-txt">Codepen</span> </label>
            </div>
            <div class="col-md-6 inp">
               <input type="text" class="form-control"  placeholder="Codepen Username" name="codepen"
               value="{{ !empty($user->userSocialLinks['codepen']) ? $user->userSocialLinks['codepen'] : '' }}"
               onkeyup="isUrlValid(this, 'codepen');">
               <span class="error help-block" style="display: none;">Please enter a valid value.</span>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
               <label class="tbl-st"><img src="{{ asset('assets/img/behance.png')}}"><span class="img-txt">Behance</span> </label>
            </div>
            <div class="col-md-6 inp">
               <input type="text" class="form-control"  placeholder="Behance Username" name="behance"
               value="{{ !empty($user->userSocialLinks['behance']) ? $user->userSocialLinks['behance'] : '' }}"
               onkeyup="isUrlValid(this, 'behance');">
               <span class="error help-block" style="display: none;">Please enter a valid value.</span>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
               <label class="tbl-st"><img src="{{ asset('assets/img/icon-5.png')}}"><span class="img-txt">Dribbble</span> </label>
            </div>
            <div class="col-md-6 inp">
               <input type="text" class="form-control"  placeholder="Dribbble Username" name="dribbble"
               value="{{ !empty($user->userSocialLinks['dribbble']) ? $user->userSocialLinks['dribbble'] : '' }}"
               onkeyup="isUrlValid(this, 'dribbble');">
               <span class="error help-block" style="display: none;">Please enter a valid value.</span>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
               <label class="tbl-st"><img src="{{ asset('assets/img/icon-6.png')}}"><span class="img-txt">Youtube</span> </label>
            </div>
            <div class="col-md-6 inp">
               <input type="text" class="form-control"  placeholder="https://youtube.com/channel" name="youtube"
               value="{{ !empty($user->userSocialLinks['youtube']) ? $user->userSocialLinks['youtube'] : '' }}"
               onkeyup="isUrlValid(this, 'youtube');">
               <span class="error help-block"  style="display: none;">Please enter a valid youtube channel.</span>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
               <label class="tbl-st"><img src="{{ asset('assets/img/icon7.png')}}"><span class="img-txt">LinkedIn</span> </label>
            </div>
            <div class="col-md-6 inp">
               <input type="text" class="form-control"  placeholder="LinkedIn Username" name="linkedin"
               value="{{ !empty($user->userSocialLinks['linkedin']) ? $user->userSocialLinks['linkedin'] : '' }}"
               onkeyup="isUrlValid(this, 'linkedin');">
               <span class="error help-block" style="display: none;">Please enter a valid value.</span>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
               <label class="tbl-st"><img src="{{ asset('assets/img/icon-8.png')}}"><span class="img-txt">Instagram</span> </label>
            </div>
            <div class="col-md-6 inp">
               <input type="text" class="form-control"  placeholder="Instagram Username" name="instagram"
               value="{{ !empty($user->userSocialLinks['instagram']) ? $user->userSocialLinks['instagram'] : '' }}"
               onkeyup="isUrlValid(this, 'instagram');">
               <span class="error help-block" style="display: none;">Please enter a valid value.</span>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
               <label class="tbl-st"><img src="{{ asset('assets/img/icon-9.png')}}"><span class="img-txt">Twitter</span> </label>
            </div>
            <div class="col-md-6 inp">
               <input type="text" class="form-control"  placeholder="Twitter Username" name="twitter"
               value="{{ !empty($user->userSocialLinks['twitter']) ? $user->userSocialLinks['twitter'] : '' }}"
               onkeyup="isUrlValid(this, 'twitter');">
               <span class="error help-block" style="display: none;">Please enter a valid value.</span>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
               <label class="tbl-st"><img src="{{ asset('assets/img/pin.png')}}"><span class="img-txt">Pinterest</span> </label>
            </div>
            <div class="col-md-6 inp">
               <input type="text" class="form-control"  placeholder="Pinterest Username" name="pinterest"
               value="{{ !empty($user->userSocialLinks['pinterest']) ? $user->userSocialLinks['pinterest'] : '' }}"
               onkeyup="isUrlValid(this, 'pinterest');">
               <span class="error help-block"  style="display: none;">Please enter a valid pinterest username.</span>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
               <label class="tbl-st"><img src="{{ asset('assets/img/fb.png')}}"><span class="img-txt">Facebook</span> </label>
            </div>
            <div class="col-md-6 inp">
               <input type="text" class="form-control"  placeholder="Facebook username" name="facebook"
               value="{{ !empty($user->userSocialLinks['facebook']) ? $user->userSocialLinks['facebook'] : '' }}"
               onkeyup="isUrlValid(this, 'facebook');">
               <span class="error help-block"  style="display: none;">Please enter a valid facebook username.</span>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
               <label class="tbl-st"><img src="{{ asset('assets/img/earth-globe.png')}}"><span class="img-txt">Website</span> </label>
            </div>
            <div class="col-md-6 inp">
               <input type="text" class="form-control"  placeholder="Yourwebsite.com" name="website"
               value="{{ !empty($user->userSocialLinks['website']) ? $user->userSocialLinks['website'] : '' }}" 
               onkeyup="isUrlValid(this, 'website');">
               <span class="error help-block" style="display: none;">Please enter a valid URL.</span>
            </div>
         </div>
      </div>
      <div class="col-sm-12 p-0 save-btn-lg cont-bt">
         <button type="submit" class="btn btn-primary mb-0 mt-1 submitButton">Save Social Links</button>
      </div>
   </form>

<script type="text/javascript">  
$(function() {    //work exp form
   $("form[name='socialForm'").validate({
         rules: {  
         website: {required:false},
       },  
       // Specify validation error messages
       messages: {
         website : {
            required : "Required"
         }
       },
       submitHandler: function(form) {
         showScreenLoader();
          $.ajax({
               url: "{{ route('user.social_sub') }}",
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
                  get_socialBOX();
                  hideLoader();
               }            
           });
          return false; 
       }
   });

});
function isUrlValid(thisv, urltype) {

  var input = $(thisv).val();
  var valid = true;
   if(urltype == 'website')
   {
     var valid = /^(http:\/\/www\.|https:\/\/www\.|www\.)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(input);
   }else if(urltype == 'youtube'){
      var arr = input.split('.com');
      console.log(arr);
      if(arr.length > 1)
      {
        var valid = /^http:\/\/www\.youtube|https:\/\/www\.youtube|www\.youtube|youtube?$/.test(arr[0]);
        valid = (arr[1] != '' && arr[1] != '/') ? true : false;
      }
   }else if(urltype == 'pinterest'){
      var arr = input.split('.com');
      console.log(arr);
      if(arr.length > 1)
      {
        var valid = /^http:\/\/www\.pinterest|https:\/\/www\.pinterest|www\.pinterest|pinterest?$/.test(arr[0]);
        valid = (arr[1] != '' && arr[1] != '/') ? true : false;
      }
   }else if(urltype == 'twitter'){
      var arr = input.split('.com');
      console.log(arr);
      if(arr.length > 1)
      {
        var valid = /^http:\/\/www\.twitter|https:\/\/www\.twitter|www\.twitter|twitter?$/.test(arr[0]);
        valid = (arr[1] != '' && arr[1] != '/') ? true : false;
      }
   }else if(urltype == 'facebook'){
      var arr = input.split('.com');
      console.log(arr);
      if(arr.length > 1)
      {
        var valid = /^http:\/\/www\.facebook|https:\/\/www\.facebook|www\.facebook|facebook?$/.test(arr[0]);
        valid = (arr[1] != '' && arr[1] != '/') ? true : false;
      }
   }else if(urltype == 'instagram'){
      var arr = input.split('.com');
      console.log(arr);
      if(arr.length > 1)
      {
        var valid = /^http:\/\/www\.instagram|https:\/\/www\.instagram|www\.instagram|instagram?$/.test(arr[0]);
        valid = (arr[1] != '' && arr[1] != '/') ? true : false;
      }
   }else if(urltype == 'linkedin'){
      var arr = input.split('.com');
      console.log(arr);
      if(arr.length > 1)
      {
        var valid = /^http:\/\/www\.linkedin|https:\/\/www\.linkedin|www\.linkedin|linkedin?$/.test(arr[0]);
        valid = (arr[1] != '' && arr[1] != '/') ? true : false;
      }
   }else if(urltype == 'dribbble'){
      var arr = input.split('.com');
      console.log(arr);
      if(arr.length > 1)
      {
        var valid = /^http:\/\/www\.dribbble|https:\/\/www\.dribbble|www\.dribbble|dribbble?$/.test(arr[0]);
        valid = (arr[1] != '' && arr[1] != '/') ? true : false;
      }
   }else if(urltype == 'behance'){
      var arr = input.split('.com');
      console.log(arr);
      if(arr.length > 1)
      {
        var valid = /^http:\/\/www\.behance|https:\/\/www\.behance|www\.behance|behance?$/.test(arr[0]);
        valid = (arr[1] != '' && arr[1] != '/') ? true : false;
      }
   }else if(urltype == 'codepen'){
      var arr = input.split('.io');
      console.log(arr);
      if(arr.length > 1)
      {
        var valid = /^http:\/\/www\.codepen|https:\/\/www\.codepen|www\.codepen|codepen?$/.test(arr[0]);
        valid = (arr[1] != '' && arr[1] != '/') ? true : false;
      }
   }else if(urltype == 'github'){
      var arr = input.split('.com');
      console.log(arr);
      if(arr.length > 1)
      {
        var valid = /^http:\/\/www\.github|https:\/\/www\.github|www\.github|github?$/.test(arr[0]);
        valid = (arr[1] != '' && arr[1] != '/') ? true : false;
      }
   }else if(urltype == 'medium'){
      var arr = input.split('.com');
      console.log(arr);
      if(arr.length > 1)
      {
        var valid = /^http:\/\/www\.medium|https:\/\/www\.medium|www\.medium|medium?$/.test(arr[0]);
        valid = (arr[1] != '' && arr[1] != '/') ? true : false;
      }
   }else{

   }

   if(valid  || input == ''){
       $(thisv).parent().find('span.error').hide();
       $('.submitButton').removeAttr('disabled');
       console.log("valid url");
   } else {
      $(thisv).parent().find('span.error').show();
      $('.submitButton').attr('disabled', 'disabled'); 
       console.log("invalid url");
   }
}



   </script>