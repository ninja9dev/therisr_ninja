@php 
  	$chat_messages = $chat_messages->reverse();
  	@endphp
  	@forelse($chat_messages as $res)
        <li class="sent"
        id="message-id-{{$res->id}}" 
        style="text-align:
        {{ ($res->sendByClient == '1' && Auth::user()->id == $res->clientId) 
        ? 'right'
        : (($res->sendByFreelancer == '1' && Auth::user()->id == $res->freelancerId) ? 'right' : 'left') }};">
			<p> 				
				@if($res->attach_url != '')
				    @php
				        $string = $res->message;
                        $array1  = array('.jpg', '.png', '.jpeg', '.gif');
                        $array2  = array('.psd', '.pdf', '.doc', '.docx');
                        $array3  = array('.mp3');
                        $array4  = array('.mp4');
                     @endphp
                        
                    @if(Str::contains($string, $array1))
                            <a target='_blank' 
                            href="{{ asset('assets/message-attchments/')}}/{{$res->message}}">
                                <img src="{{ asset('assets/message-attchments/')}}/{{$res->message}}"  style='width:100px;height:100px;'/>
                            </a>
                    @elseif (Str::contains($string, $array2))

                            <a target='_blank' href="{{ asset('assets/message-attchments/')}}/{{$res->message}}">
                                <img src='https://icons.iconarchive.com/icons/graphicloads/long-shadow-documents/256/document-arrow-download-icon.png' style='width:100px;height:100px;'/>
                            </a>
                    @elseif (Str::contains($string, $array3))
                        
                            <audio controls>
                                <source src="{{ asset('assets/message-attchments/')}}/{{$res->message}}" type="audio/ogg">
                                <source src="{{ asset('assets/message-attchments/')}}/{{$res->message}}" type="audio/mpeg">
                            </audio>
                    @elseif (Str::contains($string, $array4))
                        
                            <video width="200" height="200" controls>
                                <source src="{{ asset('assets/message-attchments/')}}/{{$res->message}}" type="video/mp4">
                                <source src="{{ asset('assets/message-attchments/')}}/{{$res->message}}" type="video/ogg">
                            </video>
                    @else
                        {{ $string}}
                    @endif
                        
				@else
				    {{ $res->message}}
				@endif
		    </p>
		    <time>{{getMessageTime($res->created_at) }}</time>
		</li>
    @empty   
    @endforelse