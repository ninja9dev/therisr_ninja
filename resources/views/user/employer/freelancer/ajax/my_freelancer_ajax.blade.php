@if(!empty($users) && count($users) > 0)

     <div class="left-right actve-drop-sec"> 
         
             <span class="span-main right-menu">
                Sort by:
                <select class="form-group sortingSelect" name="sorting_on" onchange="applySorting();">
                   <option 
                   value="hourly_rate"
                   {{ (!empty($sorting['sortby']) && $sorting['sortby'] == 'hourly_rate') ? 'selected="selected"' : '' }}
                   >Hourly Rate</option>
                   <option 
                   value="therisr_score"
                    {{ (!empty($sorting['sortby']) && $sorting['sortby'] == 'therisr_score') ? 'selected="selected"' : '' }}
                    >Rating</option>
                    <option 
                     value="name"
                     {{ (!empty($sorting['sortby']) && $sorting['sortby'] == 'name') ? 'selected="selected"' : '' }}
                     >Name</option>
                </select>
                <button 
                    class="btn btn-default btn-circle btn-sm m-sm-right m-0-bottom p-0-left-right sortingButton"  
                    type="button" 
                    onclick="applySorting('change_sorting_by');">
                    <i class="fa 
                      {{ (!empty($sorting['order']) && $sorting['order'] == 'desc') ? 'fa-sort-desc' : 'fa-sort-asc' }}"
                      >
                    </i>
                     <input 
                     type="hidden" 
                     name="sorting_by" 
                     value="{{ !empty($sorting['order']) ? $sorting['order'] : 'asc' }}">
                </button>
          </span>
      </div>
        @endif
       <div class="allproposal-card-header tab-content" 
         id="myTabContent">
             <!-- tab1 -->
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        @forelse($users as $key=>$user)
       

          <div class="allproposalLists">
             @php
               if(@$user->image != '') $image =  asset('assets/users').'/'.@$user->image; 
               else $image =  asset('assets/users/default.jpg'); 
            @endphp

              <div class="freelanImg">
                <a  
                    onclick='getFreelancerModel("{{$user->id}}","{{ route('user.get_freelancer_content', ['id' => $user->id ])}}");' 
                    href="javascript:void(0);">
                    <img src="{{$image}}" alt="">
                </a>
              </div>
              <div class="freelanDetails">
                 <div class="nameTitle">
                  <a  
                    onclick='getFreelancerModel("{{$user->id}}","{{ route('user.get_freelancer_content', ['id' => $user->id ])}}");' 
                    href="javascript:void(0);">
                      <h3>{{ $user->name }}</h3>
                  </a>

                     <?php echo getUserScoreHtml($user->id, $user->therisr_score);?>

                    <p>
                      {{ (
                          !empty($settings->currency)  ? $settings->currency  : '$').(
                          !empty($user->hourly_rate) 
                          ? $user->hourly_rate.'/hr' 
                          : (!empty($user->userProfile['hourly_rate']) 
                                 ? $user->userProfile['hourly_rate'].'/hr' : '') 
                        ) }}
                    </p>

                    <p>
                      <img src="../assets/img/location-cream.png" alt=""> 
                     {{ !empty($user->countryName['country_name'] ) ? $user->countryName['country_name']  : ''}}
                     </p>
                 </div>

                 <p class="coverTxt">
                  {{ (
                      !empty($user->prim_title) 
                      ? $user->prim_title 
                      : (!empty($user->userProfile['prim_title']) ? $user->userProfile['prim_title'] : '') 
                    ) }} /{{ (
                      !empty($user->sec_title) 
                      ?  $user->sec_title 
                      :  (!empty($user->userProfile['sec_title']) ? $user->userProfile['sec_title'] : '')
                    ) }}
                 </p>

                 <div class="d-flex" style="margin-left:-70px;">
                    <div class="inner-table-box skillreuqired mt-3">
                       <ul class="mb-0">
                         @if(!empty($user->userProfile['services'] ) || !empty($user->services)) 
                          @php 
                           $services = array();
                          $services = explode(',', !empty($user->userProfile['services']) ? $user->userProfile['services'] : $user->services)
                          @endphp
                      

                            @forelse($services as $key=>$ser)
                              <li> {{ getServiceName($ser) }}</li>
                            @empty
                            @endforelse
                          @else
                             No service added!
                          @endif
                       </ul>
                    </div>
                    <div class="actnBtns ml-auto">
                      @if(!empty($user->myFreelancer) && $user->myFreelancer['like_status'] == '2')
                       <a 
                       class="mt-1 unlike_user{{$user->id}}"
                       data-placement="right"
                       data-toggle="confirmation"
                       data-id="{{ $user->id }}"
                       href="javascript:void(0);"
                       title="Do you want to unlike this Freelancer?"
                       ><i class="fa fa-heart"></i></a>
                     @else
                       <a 
                       class="mt-1 like_user{{$user->id}}"
                       data-placement="right"
                       data-toggle="confirmation"
                       data-id="{{ $user->id }}"
                       href="javascript:void(0);"
                       title="Do you want to like this Freelancer?"
                       ><i class="fa fa-heart-o"></i></a>
                     @endif

                       <a href="" class="btn btn-primary" data-toggle="modal" data-target="#invitebtn">Invite</a>
                       <a 
                       href="javascript:void(0);"
                       onclick="return get_HirePopupView('{{$user->id}}',0,0);" 
                       class="btn btn-primary btn-hire">Hire</a>
                    </div>
                 </div>
              </div>
           </div>
             <script type="text/javascript">
             //toggle confirmation
             var templateAll = '<div class="popover">' +
                        '<div class="arrow"></div>' +
                        '<h3 class="popover-title">Are you sure?</h3>' +
                        '<div class="popover-content text-center">' +
                        '<div class="btn-group">' +
                        '<a class="btn btn-small" href="javascript:void(0);" data-id="{{$user->id}}">Yes</a>' +
                        '<a class="btn btn-small" data-dismiss="confirmation">No</a>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
             
                  $('.like_user{{$user->id}}').confirmation({
                     template: templateAll,
                      onConfirm: function(event, element) { 
                        $jid= $(this).attr('data-id');
                         freelancer_status($jid,"{{ url('freelancer_status') }}/like/"+$jid);
                       },
                    });
                  $('.unlike_user{{$user->id}}').confirmation({
                     template: templateAll,
                      onConfirm: function(event, element) { 
                        $jid= $(this).attr('data-id');
                         freelancer_status($jid,"{{ url('freelancer_status') }}/unlike/"+$jid);
                       },
                    });
            </script>
              
         @empty
           <div class="inner-table-box">
              <div class="pt-30 text-center">
                 <img src="{{ asset('assets/img/no-trans.png')}}" class="m-auto">
                 <p class="no-work-yet"> 
                    No result found.
               </p>
              </div>
           </div>
        @endforelse

        @if($users->total() > 1)
            <!-- showing record  -->
            Showing {{($users->currentPage()-1)* $users->perPage()+($users->total() ? 1:0)}} to {{($users->currentPage()-1)*$users->perPage()+count($users)}}  of  {{$users->total()}}  Results
          
            <!-- pagination buttons -->
           {!! $users->onEachSide(0)->render() !!}
        @endif

<!-- Modal -->
<div class="modal fade modl-jb-lst2" 
   id="hireFreelancer" data-backdrop="static" 
   tabindex="-1" 
   role="dialog" 
   aria-labelledby="staticBackdropLabel" 
   aria-hidden="true" 
   data-dismiss="modal">
   <div class="modal-dialog modal-lg modal-dialog-centered"  
      role="document">
      <div class="modal-content">
         
      </div>
   </div>
</div>
<!-- modal css -->

<!-- job success model -->
    <div class="modal fade mdl-jb-wdth" id="successHirePopup" data-backdrop="static" 
      tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg modal-dialog-centered"  role="document">
              <div class="modal-content">
                <div class="modal-body text-center"  >
                  <input type="hidden" name="contractId" id="contractId" value=""/>
                    <img src="{{ asset('assets/img/popup.png')}}" />
                   <h1 class="modal-title">
                      Your application for the <b id="freelancerName">[]</b> is on its way!  
                   </h1>
                </div>
                <div class="modal-footer" 
                style="text-align:center;margin:auto;border-top: white;margin-bottom: 74px;">
                  <button type="button" 
                    class="btn btn-outline-info undo-btn delete_hire"
                    data-placement="right"
                    data-toggle="confirmation"
                    data-id=""
                    href="javascript:void(0);"
                    title="Do you want to delete this Offer?"
                    id="undo_button">Undo</button>
                  <button type="button" class="btn btn-primary close-btn" 
                    onclick="onSuccessClode();">Close</button>
                </div>
              </div>
            </div>
      </div>

      <!-- Modal -->
<div class="modal fade modl-jb-lst2" 
   id="freelancerViewPopup" data-backdrop="static" 
   tabindex="-1" 
   role="dialog" 
   aria-labelledby="staticBackdropLabel" 
   aria-hidden="true" 
   data-dismiss="modal">
   <div class="modal-dialog modal-lg modal-dialog-centered"  
      role="document">
      <div class="modal-content">
         
      </div>
   </div>
</div>
<!-- modal css -->


   </div>
 </div>

 <script src="{{ asset ('assets/js/function/hire_functions.js') }}"></script>

 <script type="text/javascript">

   var currentPath = "{{ route('user.get_myfreelancers_area_ajax', ['page' => 'all'])}}";
   var currentPagep = "all";

$( document ).ready(function() {
      $('.moreOptnDropdwn_custom ').on('click', function (event) {
        $(this).parent().toggleClass('show'); $(this).parent().find('.dropdown-menu').toggleClass('show');
    });
      $('body').on('click', function (e) {
          if (!$('.moreOptnDropdwn_custom').is(e.target) && $('.moreOptnDropdwn_custom').has(e.target).length === 0 && $('.show').has(e.target).length === 0) {
              $('.moreOptnDropdwn_custom ').parent().removeClass('show');
              $('.moreOptnDropdwn_custom ').parent().find('.dropdown-menu').removeClass('show');
          }
      });
});


function applySorting($sorting_by_change = ''){
  var sorting_by = $('input[name="sorting_by"]').val();
  if($sorting_by_change != ''){
   sorting_by =  (sorting_by == 'asc') ? 'desc' : 'asc';
    $('input[name="sorting_by"]').val(sorting_by);
  }
  var sorting_on = $('select[name="sorting_on"]').val();

  jobareaajax_path2 = currentPath+'?sortby='+sorting_on+'&order='+sorting_by;
  console.log(jobareaajax_path2);
  job_areaGet(jobareaajax_path2, currentPagep);
}


</script>
