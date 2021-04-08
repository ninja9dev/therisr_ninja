
   <!-- Search filter Area -->
   <div class="freelancing-landing-page text-center pos-rel">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-7 col-md-7 col-sm-6 srch-bord-res">
               <form class="form-inline md-form form-sm form-news2">
                  <img src="../assets/img/search.jpg">
                  <!-- <input class="form-control form-control-sm" 
                  id="tags" 
                  type="text" 
                  placeholder="Find freelancers..." 
                  aria-label="Search" 
                  name="searchInput"
                  oninput="applyFilter();" /> -->
                  <select class=" select2" 
                        name="services"  
                        id="services_filter"
                        multiple style="width: 100%" 
                        onchange="applyFilter();">
                           <option value=""></option>
                           @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                           @endforeach
                  </select>
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
                     <h4 class="tlds">   Job type </h4>
                     <ul class="checkall">
                        <li>
                           <div class="main-tab">
                              <span>
                                 <label class="cont">
                                    <input type="checkbox"
                                    name="job_type"
                                    checked="checked" 
                                    value="any">
                                    <span class="checkmark"></span>
                                 </label> 
                              </span>
                              <p> Any job type </p>
                           </div>
                        </li>
                        <li>
                           <div class="main-tab">
                              <span>
                                 <label class="cont">
                                    <input type="checkbox"
                                    name="job_type"
                                    value="1">
                                    <span class="checkmark"></span>
                                 </label> 
                              </span>
                              <p> Hourly </p>
                           </div>
                        </li>
                        <li>
                           <div class="main-tab">
                              <span>
                                 <label class="cont">
                                    <input type="checkbox"
                                    name="job_type"
                                    value="2">
                                    <span class="checkmark"></span>
                                 </label> 
                              </span>
                              <p> Fixed price  </p>
                           </div>
                        </li>
                      
                     </ul>
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
               <div class="col-md col-sm-6 col-wdth">
                    <div class="width-ttl">
                        <h4 class="tlds">  Budget </h4>
                        <ul class="checkall">
                            <li>
                                <div class="main-tab">
                                    <span>
                                        <label class="cont">
                                            <input type="checkbox"
                                               name="total_cost"
                                               checked="checked" 
                                               value="any">
                                            <span class="checkmark"></span>
                                        </label>    
                                    </span>
                                    <p> Any budget </p>
                                </div>
                            </li>
                            <li>
                                <div class="main-tab">
                                    <span>
                                        <label class="cont">
                                            <input type="checkbox"
                                               name="total_cost"
                                               value="<=500">
                                            <span class="checkmark"></span>
                                        </label>    
                                    </span>
                                    <p> Less than $500 </p>
                                </div>
                            </li>
                            <li>
                                <div class="main-tab">
                                    <span>
                                        <label class="cont">
                                            <input type="checkbox"
                                               name="total_cost"
                                               value="500-1500">
                                            <span class="checkmark"></span>
                                        </label>    
                                    </span>
                                    <p> $500 - $1.5k </p>
                                </div>
                            </li>
                            <li>
                                <div class="main-tab">
                                    <span>
                                        <label class="cont">
                                            <input type="checkbox"
                                               name="total_cost"
                                               value="1500-5000">
                                            <span class="checkmark"></span>
                                        </label>    
                                    </span>
                                    <p> $1.5k - $5k  </p>
                                </div>
                            </li>
                            <li>
                                <div class="main-tab">
                                    <span>
                                        <label class="cont">
                                            <input type="checkbox"
                                               name="total_cost"
                                               value=">=5000">
                                            <span class="checkmark"></span>
                                        </label>    
                                    </span>
                                    <p> $5k+  </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md col-sm-6 col-wdth">
                    <div class="width-ttl">
                        <h4 class="tlds">  Hours per week </h4>
                        <ul class="checkall">
                            <li>
                                <div class="main-tab">
                                    <span>
                                        <label class="cont">
                                            <input type="checkbox"
                                               name="weekly_limit"
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
                                               name="weekly_limit"
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
                                               name="weekly_limit"
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
                <div class="col-md col-sm-6 col-wdth">
                    <div class="width-ttl">
                        <h4 class="tlds">  Project length </h4>
                        <ul class="checkall">
                            <li>
                                <div class="main-tab">
                                    <span>
                                        <label class="cont">
                                            <input type="checkbox"
                                               name="project_length"
                                               checked="checked"
                                               value="any">
                                            <span class="checkmark"></span>
                                        </label>    
                                    </span>
                                    <p> Any project length </p>
                                </div>
                            </li>
                            <li>
                                <div class="main-tab">
                                    <span>
                                        <label class="cont">
                                            <input type="checkbox"
                                               name="project_length"
                                               value="<=1">
                                            <span class="checkmark"></span>
                                        </label>    
                                    </span>
                                    <p> Less than 1 month </p>
                                </div>
                            </li>
                            <li>
                                <div class="main-tab">
                                    <span>
                                        <label class="cont">
                                            <input type="checkbox"
                                               name="project_length"
                                               value="1-3">
                                            <span class="checkmark"></span>
                                        </label>    
                                    </span>
                                    <p> 1 - 3 months </p>
                                </div>
                            </li>
                            <li>
                                <div class="main-tab">
                                    <span>
                                        <label class="cont">
                                            <input type="checkbox"
                                               name="project_length"
                                               value="3-6">
                                            <span class="checkmark"></span>
                                        </label>    
                                    </span>
                                    <p> 3 - 6 months </p>
                                </div>
                            </li>
                            <li>
                                <div class="main-tab">
                                    <span>
                                        <label class="cont">
                                            <input type="checkbox"
                                               name="project_length"
                                               value=">=6">
                                            <span class="checkmark"></span>
                                        </label>    
                                    </span>
                                    <p> More than 6 months </p>
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
     $url =  "{{ route('user.filter_apply_free') }}"
    }

      if(ajaxCall != null){
         ajaxCall.abort();
      }
      $(".filtr-all-flds").hide();
      var values_job_type = [];
      $('input[name="job_type"]:checked').each(function () {
        values_job_type.push($(this).val());
      });
      console.log(values_job_type);

      var values_exp = [];
      $('input[name="experience"]:checked').each(function () {
        values_exp.push($(this).val());
      });
      console.log(values_exp);

      var total_cost = [];
      $('input[name="total_cost"]:checked').each(function () {
        total_cost.push($(this).val());
      });
      console.log(total_cost);

      var weekly_limit = [];
      $('input[name="weekly_limit"]:checked').each(function () {
        weekly_limit.push($(this).val());
      });
      console.log(weekly_limit);

      var project_length = [];
      $('input[name="project_length"]:checked').each(function () {
        project_length.push($(this).val());
      });
      console.log(project_length);
      

      showScreenLoader();
      ajaxCall =  $.ajax({
            url: $url,
            type: 'POST', 
            data: { 
               services : $('#services_filter').val().join(','),
               job_type: values_job_type.join(','),
               experience: values_exp.join(','),
               total_cost: total_cost.join(','),
               weekly_limit: weekly_limit.join(','),
               project_length: project_length.join(','),
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
        var values_job_type = [];
         $('input[name="job_type"]:checked').each(function () {
           values_job_type.push($(this).val());
         });
         console.log(values_job_type);

         var values_exp = [];
         $('input[name="experience"]:checked').each(function () {
           values_exp.push($(this).val());
         });
         console.log(values_exp);

         var total_cost = [];
         $('input[name="total_cost"]:checked').each(function () {
           total_cost.push($(this).val());
         });
         console.log(total_cost);

         var weekly_limit = [];
         $('input[name="weekly_limit"]:checked').each(function () {
           weekly_limit.push($(this).val());
         });
         console.log(weekly_limit);

         var project_length = [];
         $('input[name="project_length"]:checked').each(function () {
           project_length.push($(this).val());
         });
         console.log(project_length);

         showScreenLoader();
         $.ajax({
               url: "{{ route('user.filter_apply_free') }}",
               type: 'POST', 
               data: { 
                  type: 'save',
                  filterName : $('input[name="filterName"]').val(),
                  alertOn : ($('input[name="alertOn"]').is(":checked") == true) ? 1 : 2,
                  services : $('#services_filter').val().join(','),
                  job_type: values_job_type.join(','),
                  experience: values_exp.join(','),
                  total_cost: total_cost.join(','),
                  weekly_limit: weekly_limit.join(','),
                  project_length: project_length.join(','),
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

   $('input[name="job_type"]').click(function() {
         var values = [];
         if ($(this).is(':checked')){
            if($(this).val() == 'any') {
               $('input[name="job_type"]:checked').each(function () {
                  if($(this).val() == 'any'){
                     $(this).prop('checked', true);
                  }else{
                     $(this).prop('checked', false);
                  }
               });
           }else{
               $('input[name="job_type"]:checked').each(function () {
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
    
   $('input[name="weekly_limit"]').click(function() {
         var values = [];
         if ($(this).is(':checked')){
            if($(this).val() == 'any') {
               $('input[name="weekly_limit"]:checked').each(function () {
                  if($(this).val() == 'any'){
                     $(this).prop('checked', true);
                  }else{
                     $(this).prop('checked', false);
                  }
               });
           }else{
               $('input[name="weekly_limit"]:checked').each(function () {
                  if($(this).val() == 'any'){
                     $(this).prop('checked', false);
                  }
               });
           }
         }
   });

   $('input[name="total_cost"]').click(function() {
         var values = [];
         if ($(this).is(':checked')){
            if($(this).val() == 'any') {
               $('input[name="total_cost"]:checked').each(function () {
                  if($(this).val() == 'any'){
                     $(this).prop('checked', true);
                  }else{
                     $(this).prop('checked', false);
                  }
               });
           }else{
               $('input[name="total_cost"]:checked').each(function () {
                  if($(this).val() == 'any'){
                     $(this).prop('checked', false);
                  }
               });
           }
         }
   });

   $('input[name="project_length"]').click(function() {
         var values = [];
         if ($(this).is(':checked')){
            if($(this).val() == 'any') {
               $('input[name="project_length"]:checked').each(function () {
                  if($(this).val() == 'any'){
                     $(this).prop('checked', true);
                  }else{
                     $(this).prop('checked', false);
                  }
               });
           }else{
               $('input[name="project_length"]:checked').each(function () {
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