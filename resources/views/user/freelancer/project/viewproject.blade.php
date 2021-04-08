
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title fairy-tale-in-the-wo">{{ $portfolio->title }}</h4>
        <button type="button" class="close" data-dismiss="modal">
          <img src="{{ asset('assets/img/cross.png')}}">
        </button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          @if (Auth::user()->user_type == '2')
           <div class="row mb-3">
             <div class="col-sm-6">
               <div class="left-hiring-txt">
                 @php
                   if(@$user->image != '') $image =  asset('assets/users').'/'.@$user->image; 
                   else $image =  asset('assets/users/default.jpg'); 
                @endphp

                 <img src="{{$image}}" class="topProfile-image round-pic user_image ng-star-inserted">

                 <span class="man-name">by {{ $user->name }}</span>
               </div>
              </div>
             <div class="col-sm-6">
                <div class="right-hiring-txt">
                  <button type="submit" 
                  class="btn btn-primary"
                  onclick="return get_HirePopupView('{{$user->id}}',0,0);"
                  >Hire Me</button>
               </div>
              </div>
           </div>
         @endif
       <div class="main-in">
         <div class="row">
            <div class="col-sm-12 p-0">
              @php  $pro_images =  !empty($portfolio->images ) ?
                                explode(',',$portfolio->images) : array();  
             @endphp
             @forelse($pro_images as $key=>$img)
                 @if ($loop->first)
                   <img src="{{ asset('assets/project_images/').'/'.$img }}" class="img-alvs" id="mainImage">
                 @endif
             @empty   
                 <img src="{{ asset('assets/img/no-image.jpg') }}" class="img-alvs" id="mainImage">
             @endforelse

            </div>
         </div>
         <div class="row">
            <div class="col-sm-12 p-0">
              @forelse($pro_images as $key=>$img) 
              <img src="{{ asset('assets/project_images/').'/'.$img }}" class="double-img" onclick="previewThis(this)">
              @empty   
             @endforelse
            </div>
         </div>
       </div>

       <div class="main-mrg">
       <div class="row">
         <div class="col-sm-6">
              <p class="sed-ut-perspiciatis">
                {{ !empty($portfolio->description ) ? $portfolio->description  : "No Description found!"}}
              </p>
         </div>
         <div class="col-sm-6">
            <div class="row">
                 <div class="col-sm-3 pr-0">
                    <img src="{{ asset('assets/img/sys.jpg')}}"><span>Role</span>
                 </div>
                 <div class="col-sm-9 pl-0">
                    <p class="grap">{{ $portfolio->role }}</p>
                  </div>
            </div>
            <div class="row">
               <div class="col-sm-3 pr-0">
                  <img src="{{ asset('assets/img/mind.png')}}"><span>Skills</span>
                </div>
               <div class="col-sm-9 pl-0">
                  <div class="tags">
                     @php
                       $skillname  = array();
                       $skills =  !empty($portfolio->skills ) ?
                                           explode(',',$portfolio->skills) : array();  
                           foreach($skills as $skill) {
                             $skillname[] = getSkillName($skill);
                           }
                     @endphp
                      @forelse($skillname as $key=>$skil) 
                        <span class="badge badge-primary">{{ $skil }}</span>
                      @empty   
                      @endforelse
                  </div>
               </div>
           </div>
           <div class="row">
              <div class="col-sm-3 pr-0">
                  <img src="{{ asset('assets/img/link.png')}}"><span>Link</span>
              </div>
               <div class="col-sm-9 pl-0">
                 <p class="grap">{{ $portfolio->link }}</p>
              </div>
           </div>
         </div>
      </div>
       </div>
      </div>
<script type="text/javascript">
  function previewThis(thisv){
    $('#mainImage').attr('src', $(thisv).attr('src'));
  }

</script>