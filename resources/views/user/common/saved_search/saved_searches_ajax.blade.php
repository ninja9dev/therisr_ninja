    <ul class="fltr-alrts">
      <li> Filter </li>
      <li> <i class="fa fa-trash-o"></i> </li>
      <li> Alert </li>
   </ul> 
 
   @foreach($savedSearches as $search)
   <ul class="fltr-alrts list-icns" id="rowId{{ $search->id }}">
      <li> {{ $search->search_name }}    </li> 
      <li> 
          <a class="delete_search{{$search->id}}"
                data-placement="right"
                data-toggle="confirmation"
                data-id="{{ $search->id }}"
                href="javascript:void(0);">
               <img src="../assets/img/close.svg" class="img-close">
            </a>
      </li>
      <li> 
         <div class="main-tab"> 
            <span>
               <label class="cont">
                  <input type="checkbox" 
                   onchange="changeSearchOption('{{$search->id}}');"
                  {{ ($search->alert_on == '1') ? 'checked="checked"' : '' }}
                 >
                  <span class="checkmark"></span>
               </label> 
            </span>
         </div>
      </li>
   </ul>
   <script type="text/javascript">
          //toggle confirmation
         $('.delete_search{{$search->id}}').confirmation({
            template: '<div class="popover">' +
               '<div class="arrow"></div>' +
               '<h3 class="popover-title">Are you sure?</h3>' +
               '<div class="popover-content text-center">' +
               '<div class="btn-group">' +
               '<a class="btn btn-small" href="javascript:void(0);" data-id="{{$search->id}}">Yes</a>' +
               '<a class="btn btn-small" data-dismiss="confirmation">No</a>' +
               '</div>' +
               '</div>' +
               '</div>',
             onConfirm: function(event, element) { 
               $jid= $(this).attr('data-id');
                delete_search($jid,"{{ url('editSavedSearch') }}/delete/"+$jid);
              },
           });
   </script>
   @endforeach

   <script type="text/javascript">
      function delete_search($id,$url)
         { 
           showScreenLoader();
            $.ajax({
               url: $url,
               type: 'GET',
               dataType: 'json',
               success: function(response) {
                console.log(response.data);
                  $('#rowId'+$id).remove();
                  $.toast({
                            heading: (response.code == 200) ? 'Success' : 'Error',
                            text: response.message,
                            showHideTransition: 'slide',
                            icon: (response.code == 200) ? 'success' : 'error'
                        });
                hideLoader();
               }            
           });

         }
         function changeSearchOption(id){
           showScreenLoader();
          $.ajax({
               url: "{{ url('editSavedSearch') }}/edit/"+id,
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
                  hideLoader();
               }            
           });
         }
   </script>