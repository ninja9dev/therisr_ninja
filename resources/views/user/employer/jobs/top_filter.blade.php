
   <!-- Search filter Area -->
   <div class="freelancing-landing-page text-center pos-rel">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-7 col-md-7 col-sm-6 srch-bord-res">
               <form class="form-inline md-form form-sm form-news">
                  <img src="../assets/img/search.jpg">
                  <input class="form-control form-control-sm" 
                  id="tags" 
                  type="text" 
                  placeholder="Find freelancers..." 
                  aria-label="Search" 
                  name="searchInput"
                  oninput="applyFilter();" />

               </form>
            </div> 
            <div class="col-lg-5 col-md-5 col-sm-6">  
               <div class="button-right text-right" id="filters">
                  <span class="toogls-srs">  
                     <button type="submit" class="btn btn-primary btn-svts btn-save">Save</button>
                     <div class="bg-box-rs" style="display:none">
                        <input type="text" 
                               placeholder="Filter Name" 
                               class="inpt-flt" 
                               name="filterName"
                         >
                         <span class="help-block error"></span>
                        <div class="main-tab">
                           <span>
                              <label class="cont">
                                 <input type="checkbox" name="alertOn">
                                 <span class="checkmark"></span>
                              </label> 
                           </span>
                           <p>
                              Send me an alert when new jobs match this filter.<span> All alerts will send out weekly. </span>
                           </p>

                        </div>
                        <a href="javascript:void(0);" 
                           onclick="saveFilter();" 
                           class="btn-stra"> Save Filter </a>
                     </div>   
                  </span>

                  <span class="toogls-srs">  
                     <button type="submit" class="btn btn-primary filtr-shoes no-border">Filters</button>
                  </span>

                  <span class="toogls-srs">     
                     <button 
                     class="btn btn-primary sved-tgld no-border"
                     onclick="getSavedSearches();">Saved search</button>
                     <div class="fltr-joins" id="savedSearchesList" style="display:none">
                           <!-- saved searched list here with ajax -->
                     </div>
                  </span>

               </div>
            </div>
         </div>
      </div>
      <div class="filtr-all-flds" style="display:none">
         <div class="container-fluid pl-4 pr-4">
            <div class="row">

               <div class="col-md col-sm-6">
                  <div class="width-ttl"> 
                     <h4 class="tlds"> Category </h4>
                      <select class="form-control select2" 
                        name="services"  
                        id="services_filter"
                        multiple style="width: 100%">
                           <option value=""></option>
                           @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                           @endforeach
                        </select>
                  </div>
               </div>

                <div class="col-md col-sm-6">
                  <div class="width-ttl">
                     <h4 class="tlds"> Skills </h4>
                      <select class="form-control select2" 
                        name="skills"  id="skills_filter"
                        multiple style="width: 100%">
                           <option value=""></option>
                            @foreach($skills as $skill)
                            <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                           @endforeach
                        </select>
                  </div>
               </div>


               
               <div class="col-md col-sm-6">
                  <div class="width-ttl">
                     <h4 class="tlds">  Experience level </h4>
                     <ul class="checkall">
                        <li>
                           <div class="main-tab">
                              <span>
                                 <label class="cont">
                                    <input type="checkbox"
                                    name="experience"
                                    checked="checked" 
                                    value="any">
                                    <span class="checkmark"></span>
                                 </label> 
                              </span>
                              <p> Any experience level </p>
                           </div>
                        </li>
                        <li>
                           <div class="main-tab">
                              <span>
                                 <label class="cont">
                                    <input type="checkbox"
                                    name="experience"
                                    value="1">
                                    <span class="checkmark"></span>
                                 </label> 
                              </span>
                              <p> Entry level </p>
                           </div>
                        </li>
                        <li>
                           <div class="main-tab">
                              <span>
                                 <label class="cont">
                                    <input type="checkbox"
                                    name="experience"
                                    value="2">
                                    <span class="checkmark"></span>
                                 </label> 
                              </span>
                              <p> Advanced  </p>
                           </div>
                        </li>
                        <li>
                           <div class="main-tab">
                              <span>
                                 <label class="cont">
                                    <input type="checkbox"
                                    name="experience"
                                    value="3">
                                    <span class="checkmark"></span>
                                 </label> 
                              </span>
                              <p> Expert   </p>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
               <!-- <div class="col-md col-sm-6">
                  <div class="width-ttl">
                     <h4 class="tlds">  English proficiency </h4>
                      <ul class="checkall">
                        <li>
                           <div class="main-tab">
                              <span>
                                 <label class="cont">
                                    <input type="checkbox"
                                    name="eng_prof"
                                    checked="checked" 
                                    value="any">
                                    <span class="checkmark"></span>
                                 </label> 
                              </span>
                              <p> Any English proficiency level </p>
                           </div>
                        </li>
                        <li>
                           <div class="main-tab">
                              <span>
                                 <label class="cont">
                                    <input type="checkbox"
                                    name="eng_prof"
                                    value="native">
                                    <span class="checkmark"></span>
                                 </label> 
                              </span>
                              <p> Native or Billingual </p>
                           </div>
                        </li>
                        <li>
                           <div class="main-tab">
                              <span>
                                 <label class="cont">
                                    <input type="checkbox"
                                    name="eng_prof"
                                    value="fluent">
                                    <span class="checkmark"></span>
                                 </label> 
                              </span>
                              <p> Fluent  </p>
                           </div>
                        </li>
                        <li>
                           <div class="main-tab">
                              <span>
                                 <label class="cont">
                                    <input type="checkbox"
                                    name="eng_prof"
                                    value="conversational">
                                    <span class="checkmark"></span>
                                 </label> 
                              </span>
                              <p> Conversational   </p>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div> -->
               <div class="col-md col-sm-6">
                  <div class="width-ttl">
                     <h4 class="tlds">  Hourly Rate</h4>
                     <ul class="checkall">
                        <li>
                           <div class="main-tab">
                              <span>
                                 <label class="cont">
                                    <input type="checkbox" 
                                    name="hourly_rate"
                                    checked="checked" 
                                    value="any">
                                    <span class="checkmark"></span>
                                 </label> 
                              </span>
                              <p> Any hourly rate</p>
                           </div>
                        </li>
                         <li>
                           <div class="main-tab">
                              <span>
                                 <label class="cont">
                                    <input type="checkbox" 
                                    name="hourly_rate"
                                    value="0-10">
                                    <span class="checkmark"></span>
                                 </label> 
                              </span>
                              <p> {{ !empty($settings->currency)  ? $settings->currency  : '$'}}10 and below</p>
                           </div>
                        </li>
                         <li>
                           <div class="main-tab">
                              <span>
                                 <label class="cont">
                                    <input type="checkbox" 
                                    name="hourly_rate"
                                    value="10-30">
                                    <span class="checkmark"></span>
                                 </label> 
                              </span>
                              <p> {{ !empty($settings->currency)  ? $settings->currency  : '$'}}10 - {{ !empty($settings->currency)  ? $settings->currency  : '$'}}30 </p>
                           </div>
                        </li>
                         <li>
                           <div class="main-tab">
                              <span>
                                 <label class="cont">
                                    <input type="checkbox" 
                                    name="hourly_rate"
                                    value="30-60">
                                    <span class="checkmark"></span>
                                 </label> 
                              </span>
                              <p>{{ !empty($settings->currency)  ? $settings->currency  : '$'}}30 - {{ !empty($settings->currency)  ? $settings->currency  : '$'}}60 </p>
                           </div>
                        </li>
                         <li>
                           <div class="main-tab">
                              <span>
                                 <label class="cont">
                                    <input type="checkbox" 
                                    name="hourly_rate"
                                    value="60">
                                    <span class="checkmark"></span>
                                 </label> 
                              </span>
                              <p> {{ !empty($settings->currency)  ? $settings->currency  : '$'}}60+  </p>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>

               <div class="col-md col-sm-6">
                  <div class="width-ttl">
                     <h4 class="tlds">  Availability</h4>
                     <ul class="checkall">
                        <li>
                           <div class="main-tab">
                              <span>
                                 <label class="cont">
                                    <input type="checkbox" 
                                    name="availability"
                                    checked="checked" 
                                    value="any">
                                    <span class="checkmark"></span>
                                 </label> 
                              </span>
                              <p> Any hours per week</p>
                           </div>
                        </li>
                        <li>
                           <div class="main-tab"> 
                              <span>
                                 <label class="cont">
                                    <input type="checkbox"
                                    name="availability"
                                    value="<=25">
                                    <span class="checkmark"></span>
                                 </label> 
                              </span>
                              <p> Less than 25 hrs/week </p>
                           </div>
                        </li>
                         <li>
                           <div class="main-tab">
                              <span>
                                 <label class="cont">
                                    <input type="checkbox"
                                    name="availability"
                                    value=">=25">
                                    <span class="checkmark"></span>
                                 </label> 
                              </span>
                              <p> More than 25 hrs/week </p>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="col-md col-sm-6">
                  <div class="width-ttl">
                     <h4 class="tlds">  TheRisr Score </h4>
                     <ul class="checkall">
                        <li>
                           <div class="main-tab">
                              <span>
                                 <label class="cont">
                                    <input type="checkbox"
                                    name="therisr_score"
                                    checked="checked" 
                                    value="any">
                                    <span class="checkmark"></span>
                                 </label> 
                              </span>
                              <p> Any Score </p>
                           </div>
                        </li>
                        <li>
                           <div class="main-tab">
                              <span>
                                 <label class="cont">
                                    <input type="checkbox"
                                    name="therisr_score"
                                    value="3">
                                    <span class="checkmark"></span>
                                 </label> 
                              </span>
                              <p> 3.0 Score </p>
                           </div>
                        </li>
                        <li>
                           <div class="main-tab">
                              <span>
                                 <label class="cont">
                                    <input type="checkbox"
                                    name="therisr_score"
                                    value="4">
                                    <span class="checkmark"></span>
                                 </label> 
                              </span>
                              <p> 4.0 Score </p>
                           </div>
                        </li>
                        <li>
                           <div class="main-tab">
                              <span>
                                 <label class="cont">
                                    <input type="checkbox"
                                    name="therisr_score"
                                    value="5">
                                    <span class="checkmark"></span>
                                 </label> 
                              </span>
                              <p> 5.0 Score </p>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 text-center">
                  <a href="javascript:void(0);" onclick="applyFilter();" class="btn-cntrs"> Close Filters </a>
               </div>
            </div>   
         </div>
      </div>
   </div>
   <!-- Search filter Area -->

   <script>
   $(document).ready(function(){

      $(".btn-svts").click(function(){
         $(".bg-box-rs").slideToggle();
      });
    
      $(".sved-tgld").click(function(){
         $(".fltr-joins").slideToggle();
      });

      $(".filtr-shoes").click(function(){
         $(".filtr-all-flds").slideToggle();
      });

    });
   var ajaxCall = null;
   function applyFilter(url = ''){
    if(url != ''){
      $url = url;
    }else{
     $url =  "{{ route('user.filter_apply_emp') }}"
    }
      if(ajaxCall != null){
         ajaxCall.abort();
      }
      $(".filtr-all-flds").hide();
      var values_avail = [];
      $('input[name="availability"]:checked').each(function () {
        values_avail.push($(this).val());
      });
      console.log(values_avail);

      var values_eng = [];
      $('input[name="eng_prof"]:checked').each(function () {
        values_eng.push($(this).val());
      });
      console.log(values_eng);

      var values_exp = [];
      $('input[name="experience"]:checked').each(function () {
        values_exp.push($(this).val());
      });
      console.log(values_exp);

      var therisr_score = [];
      $('input[name="therisr_score"]:checked').each(function () {
        therisr_score.push($(this).val());
      });
      console.log(therisr_score);

      var hourly_rate = [];
      $('input[name="hourly_rate"]:checked').each(function () {
        hourly_rate.push($(this).val());
      });
      console.log(hourly_rate);

      showScreenLoader();
      ajaxCall =  $.ajax({
            url: $url,
            type: 'POST', 
            data: { 
               services : $('#services_filter').val().join(','),
               skills : $('#skills_filter').val().join(','),
               availability: values_avail.join(','),
               eng_prof: values_eng.join(','),
               experience: values_exp.join(','),
               therisr_score: therisr_score.join(','),
               hourly_rate: hourly_rate.join(','),
               searchInput: $('input[name="searchInput"]').val(),
               '_token' : '{{csrf_token()}}' 
            },
           // dataType: 'json',
            success: function(response) {
               $('#page-area-job').html(response);  
               console.log(response);
                hideLoader();
            }            
        });
   }


function saveFilter(){
   if($('input[name="filterName"]').val().trim() == ''){
      $('.error').html('This field is required!');
   }else{
       $('.error').html('');
         $(".filtr-all-flds").hide();
         var values_avail = [];
         $('input[name="availability"]:checked').each(function () {
           values_avail.push($(this).val());
         });
         console.log(values_avail);

         var values_eng = [];
         $('input[name="eng_prof"]:checked').each(function () {
           values_eng.push($(this).val());
         });
         console.log(values_eng);

         var values_exp = [];
         $('input[name="experience"]:checked').each(function () {
           values_exp.push($(this).val());
         });
         console.log(values_exp);

         var therisr_score = [];
         $('input[name="therisr_score"]:checked').each(function () {
           therisr_score.push($(this).val());
         });
         console.log(therisr_score);

         var hourly_rate = [];
         $('input[name="hourly_rate"]:checked').each(function () {
           hourly_rate.push($(this).val());
         });
         console.log(hourly_rate);

         showScreenLoader();
         $.ajax({
               url: "{{ route('user.filter_apply_emp') }}",
               type: 'POST', 
               data: { 
                  type: 'save',
                  filterName : $('input[name="filterName"]').val(),
                  alertOn : ($('input[name="alertOn"]').is(":checked") == true) ? 1 : 2,
                  services : $('#services_filter').val().join(','),
                  skills : $('#skills_filter').val().join(','),
                  availability: values_avail.join(','),
                  eng_prof: values_eng.join(','),
                  experience: values_exp.join(','),
                  therisr_score: therisr_score.join(','),
                  hourly_rate: hourly_rate.join(','),
                  searchInput: $('input[name="searchInput"]').val(),
                  '_token' : '{{csrf_token()}}' 
               },
              // dataType: 'json',
               success: function(response) {
                  $.toast({
                      heading: 'Success',
                      text: response.message,
                      showHideTransition: 'slide',
                      icon: 'success'
                  });
                  console.log(response);
                   hideLoader();
               }            
           });
   }
}

   $('input[name="availability"]').click(function() {
         var values = [];
         if ($(this).is(':checked')){
            if($(this).val() == 'any') {
               $('input[name="availability"]:checked').each(function () {
                  if($(this).val() == 'any'){
                     $(this).prop('checked', true);
                  }else{
                     $(this).prop('checked', false);
                  }
               });
           }else{
               $('input[name="availability"]:checked').each(function () {
                  if($(this).val() == 'any'){
                     $(this).prop('checked', false);
                  }
               });
           }
         }
   });

    $('input[name="eng_prof"]').click(function() {
         var values = [];
         if ($(this).is(':checked')){
            if($(this).val() == 'any') {
               $('input[name="eng_prof"]:checked').each(function () {
                  if($(this).val() == 'any'){
                     $(this).prop('checked', true);
                  }else{
                     $(this).prop('checked', false);
                  }
               });
           }else{
               $('input[name="eng_prof"]:checked').each(function () {
                  if($(this).val() == 'any'){
                     $(this).prop('checked', false);
                  }
               });
           }
         }
   });

    $('input[name="experience"]').click(function() {
         var values = [];
         if ($(this).is(':checked')){
            if($(this).val() == 'any') {
               $('input[name="experience"]:checked').each(function () {
                  if($(this).val() == 'any'){
                     $(this).prop('checked', true);
                  }else{
                     $(this).prop('checked', false);
                  }
               });
           }else{
               $('input[name="experience"]:checked').each(function () {
                  if($(this).val() == 'any'){
                     $(this).prop('checked', false);
                  }
               });
           }
         }
   });
    
     $('input[name="hourly_rate"]').click(function() {
         var values = [];
         if ($(this).is(':checked')){
            if($(this).val() == 'any') {
               $('input[name="hourly_rate"]:checked').each(function () {
                  if($(this).val() == 'any'){
                     $(this).prop('checked', true);
                  }else{
                     $(this).prop('checked', false);
                  }
               });
           }else{
               $('input[name="hourly_rate"]:checked').each(function () {
                  if($(this).val() == 'any'){
                     $(this).prop('checked', false);
                  }
               });
           }
         }
   });

     $('input[name="therisr_score"]').click(function() {
         var values = [];
         if ($(this).is(':checked')){
            if($(this).val() == 'any') {
               $('input[name="therisr_score"]:checked').each(function () {
                  if($(this).val() == 'any'){
                     $(this).prop('checked', true);
                  }else{
                     $(this).prop('checked', false);
                  }
               });
           }else{
               $('input[name="therisr_score"]:checked').each(function () {
                  if($(this).val() == 'any'){
                     $(this).prop('checked', false);
                  }
               });
           }
         }
   });


   function getSavedSearches(){
          showScreenLoader();
       $.ajax({
            url:"{{ route('user.getSavedSearches')}}",
            success:function(response)
            {
               hideLoader();
               $('#savedSearchesList').html(response);  
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

    $( document ).ready(function() {
   // pagination
    $(document).on('click', '#filter-pagination .pagination a',function(event)
    {
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var myurl = $(this).attr('href');
        applyFilter(myurl);
        event.preventDefault();
    });
});

   </script>