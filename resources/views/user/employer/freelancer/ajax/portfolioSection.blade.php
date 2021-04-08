   <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <h3 class="main-glt main-km">
                  Portfolio
               </h3>
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

</script>