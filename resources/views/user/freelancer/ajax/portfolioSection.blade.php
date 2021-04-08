   <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <h3 class="main-glt main-km">
                  Portfolio
               </h3>
                @php
                 $pagesShow = array("user.editprofile");
                @endphp
                @if (in_array($route, $pagesShow))
               <div class="col-sm-12 p-0 save-btn-lg cont-bt ad-prj">
                  <a href="{{ route('user.addproject') }}">
                  <button type="submit" class="btn btn-primary mb-0 mt-1">Add Project</button>
                  </a>
               </div>
               @endif
            </div>
         </div>
         <div class="grids-all">
            @if(count($user->userPortfolio) > 0)
            <div class="row">
                @forelse($user->userPortfolio as $port)
                  <div class="col-md-4 col-sm-6">
                     <div class="box-portfoli raev-porfolio">
                        <div class="portfoli-hover">
                           @php  $pro_images =  !empty($port->images ) ?
                                                 explode(',',$port->images) : array();  
                           @endphp
                           @forelse($pro_images as $key=>$img)
                               @if ($loop->first)
                                 <img src="{{ asset('assets/project_images/').'/'.$img }}" class="img-alvs">
                               @endif
                           @empty   
                               <img src="{{ asset('assets/img/no-image.jpg') }}" class="img-alvs">
                           @endforelse
                           <ul>
                              <li>
                                  <a href="javascript:void(0)" 
                                  onclick="return get_portfolioView('{{$port->id }}');" 
                                  data-toggle="modal" 
                                  data-target="#Fairymdl">
                                   <i class="fa fa-eye" aria-hidden="true"></i>
                                 </a>
                               </li>

                                @if (in_array($route, $pagesShow))
                                  <li><a href="{{ route('user.editproject', ['id' => $port->id]) }}">
                                     <i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                  <li><a href="javascript:void(0)" data-title="{{ $port->title }}" onclick="return deleteProject(this, '{{$port->id}}');" data-toggle="modal" data-target="#delet-proj">
                                     <i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                                @endif     
                           </ul>
                        </div>
                        <h4 class="sc-ttl">
                           <a  href="javascript:void(0)"  
                           onclick="return get_portfolioView('{{$port->id }}');" 
                           data-toggle="modal" 
                           data-target="#Fairymdl"> 
                           {{ $port->title }}
                           <span class="sml-rx"> 
                          @php
                               $totalr  = 0;
                               $skills =  !empty($port->skills ) ?
                                                   explode(',',$port->skills) : array(); 
                               $totalr = count($skills); 

                               foreach($skills as $key=>$skill) {
                                 echo getSkillName($skill).($key < $totalr-1 ) ? ', ' : '';
                               }
                                 
                           @endphp
                           </span>
                           </a>
                        </h4>
                     </div>
                  </div>
               @empty   
               @endforelse
            </div>
            @else
                   <p class="text-center">No Portfolio added yet!</p>
            @endif
         </div>
   </div>



<!-- Add project model -->
<div class="modal hiring-popup" id="Fairymdl">
  <div class="modal-dialog modal-lg ">
    <div class="modal-content">

     
    </div>
  </div>
</div>  
<!-- add project model end-->





<!-- delete project-->
<div class="modal hiring-popup update-proj" id="delet-proj">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header pb-0">
        <h4 class="modal-title fairy-tale-in-the-wo">Delete project</h4>
        <button type="button" class="close" data-dismiss="modal"><img src="{{ asset('assets/img/cross.png')}}"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body py-0">
       <div class="row">
          <div class="col-sm-12">
             <div class="left-hiring-txt">
                <p>Wait a sec! Are you sure you want to delete your <b id="title"></b> project? </p>
             </div>
           </div>  
       </div>         
      </div>
        <div class="modal-footer">
            <div class="right-hiring-txt">
                <button type="button" onclick="confirm_delete();" class="btn btn-primary" data-dismiss="modal">Delete</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>
       </div>
     
    </div>
  </div>
</div>
<!-- delete project model end-->
<input type="hidden" name="deleteId" id="deleteId"/>

<script type="text/javascript">
   function get_portfolioView($id){
      showScreenLoader();
      $.ajax({
               url: "{{ url('get_portfolio') }}/"+$id,
               type: 'GET',
               success: function(response) {
                 $('#Fairymdl').find('.modal-content').html(response);
                  hideLoader();
               }            
     });
   }


   function deleteProject(thisv, id){
     var title =  $(thisv).attr('data-title');
     $('#delet-proj').find('#title').html('[' + title+ ']');

     $('#deleteId').val(id);
   }

function confirm_delete()
{ 
   $id =  $('#deleteId').val();
   $.ajax({
      url: "{{ url('delete_portfolio') }}/"+$id,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
       console.log(response.data);
         $.toast({
                   heading: (response.code == 200) ? 'Success' : 'Error',
                   text: response.message,
                   showHideTransition: 'slide',
                   icon: (response.code == 200) ? 'success' : 'error'
        });
          get_portfolioBOX();  
      }            
  });
}
</script>