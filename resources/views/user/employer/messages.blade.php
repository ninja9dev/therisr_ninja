
@extends('user.layouts.main')

@section('content')

<div id="frame">
			<div id="sidepanel">
				<div id="profile">
					<div class="wrap">
						<h1 class="inbox">Inbox	<span class="msg">(98 messages)</span></h1>
						<div class="dropdown drop-show-all mb-3 ">
							<button class="btn dropdown-toggle btn-sel" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All Recent</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<a class="dropdown-item" href="#">Something else here</a>
							</div>
						</div>
						
					</div>
				</div>
				
				<div id="contacts">
					<ul>
						<li class="contact">
							<div class="wrap">
								<span class="contact-status online"></span>
								<img src="{{ asset('assets/img/Shape-6.png')}}" alt="" />
							</div>
							<div class="meta">
								<p class="name">System Notifictaions</p>
								<p class="preview">You just got LITT up, Mike.</p>
							</div>
							<div class="time">
								<p class="name">2m</p>
								<p class="badge">2</p>
							</div>
						</li>
						<li class="contact active">
							<div class="wrap">
								<span class="contact-status online"></span>
								<img src="http://emilcarlsson.se/assets/louislitt.png')}}" alt="" />
							</div>
							<div class="meta">
								<p class="name">Charlie Wilson</p>
								<p class="preview">You just got LITT up, Mike.</p>
							</div>
							<div class="time">
								<p class="name">2m</p>
								<p class="badge">2</p>
							</div>
						</li>
						
						<li class="contact">
							<div class="wrap">
								<span class="contact-status online"></span>
								<img src="http://emilcarlsson.se/assets/louislitt.png')}}" alt="" />
							</div>
							<div class="meta">
								<p class="name">Daniel Stephens</p>
								<p class="preview">You just got LITT up, Mike.</p>
							</div>
							<div class="time">
								<p class="name">2m</p>
								<p class="badge">3</p>
							</div>
						</li>
						<li class="contact">
							<div class="wrap">
								<span class="contact-status online"></span>
								<img src="http://emilcarlsson.se/assets/louislitt.png')}}" alt="" />
							</div>
							<div class="meta">
								<p class="name">Victoria Owens</p>
								<p class="preview">You just got LITT up, Mike.</p>
							</div>
							<div class="time">
								<p class="name">2m</p>
								<p class="badge">1</p>
							</div>
						</li>
					
					</ul>
				</div>
				
			</div>
			<div class="content">
				<div class="contact-profile">
					<img src="http://emilcarlsson.se/assets/harveyspecter.png')}}" alt="" />
					<div class="person-info">
						<h1 class="person-name">Daniel Stephens</h1>
						<p class="status">Online</p>
					</div>
					
				</div>
				<div class="messages">
					<ul>
						<li class="sent">
							<p>Yeah, your iconset are very awesome and usefull for my web app. Great job! 👏🏽.</p>
						</li>
						<li class="sent">
							<p>By the way, can you please show me the preview of your new product?</p>
							<time>12:46 PM</time>
						</li>
						<li class="replies">
							<p>When you're backed against the wall, break the god damn thing down.</p>
						</li>
						<li class="replies">
							<p>Excuses don't win championships.</p>
						</li>
						<li class="sent">
							<p>Oh yeah, did Michael Jordan tell you that?</p>
						</li>
						<li class="replies">
							<p>No, I told him that.</p>
						</li>
						<li class="replies">
							<p>What are your choices when someone puts a gun to your head?</p>
						</li>
						<li class="sent">
							<p>What are you talking about? You do what they say or they shoot you.</p>
						</li>
						<li class="replies time-set">
							<p class="reply-img-bg">Sure 😃 <span><img class="mesg-img" src="{{ asset('assets/img/message1.png')}}" alt="">
							<img class="mesg-img" src="{{ asset('assets/img/message2.png')}}" alt=""></span></p>
                            <time>12:48 PM <img src="{{ asset('assets/img/double-check.png')}}" alt=""></time>							
						</li>
						<li class="new-message">
							<h3>New Message</h3>
						</li>
						<li class="editnew-message">
							<p>What are you talking about? You do what they say or they shoot you.</p>
							 <time>08:26 AM 								<div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle select-p" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ asset('assets/img/setting-icon.png')}}" alt="">
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item editmesge" href="#">Edit Message</a>
                                    <a class="dropdown-item messgedelete" href="#">Delete Message</a>
                                  </div>
                                </div></time>	
						</li>												
					</ul>
				</div>
				<div class="message-input">
					<div class="wrap">
						<textarea type="text" placeholder="Type a message..." class="msg-box" ></textarea>
						<i class="fa fa-paperclip attachment" aria-hidden="true"></i>
						<i class="fa fa-smile-o smile-icon" aria-hidden="true"></i>
						<button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>


@endsection


 

@section('footer') 
<script src="{{ asset('assets/js/chat.js')}}"></script>
<script >$(".messages").animate({ scrollTop: $(document).height() }, "fast");

$("#profile-img").click(function() {
	$("#status-options").toggleClass("active");
});

$(".expand-button").click(function() {
  $("#profile").toggleClass("expanded");
	$("#contacts").toggleClass("expanded");
});

$("#status-options ul li").click(function() {
	$("#profile-img").removeClass();
	$("#status-online").removeClass("active");
	$("#status-away").removeClass("active");
	$("#status-busy").removeClass("active");
	$("#status-offline").removeClass("active");
	$(this).addClass("active");
	
	if($("#status-online").hasClass("active")) {
		$("#profile-img").addClass("online");
	} else if ($("#status-away").hasClass("active")) {
		$("#profile-img").addClass("away");
	} else if ($("#status-busy").hasClass("active")) {
		$("#profile-img").addClass("busy");
	} else if ($("#status-offline").hasClass("active")) {
		$("#profile-img").addClass("offline");
	} else {
		$("#profile-img").removeClass();
	};
	
	$("#status-options").removeClass("active");
});

function newMessage() {
	message = $(".message-input input").val();
	if($.trim(message) == '') {
		return false;
	}
	$('<li class="sent"><img src="http://emilcarlsson.se/assets/mikeross.png')}}" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul'));
	$('.message-input input').val(null);
	$('.contact.active .preview').html('<span>You: </span>' + message);
	$(".messages").animate({ scrollTop: $(document).height() }, "fast");
};

$('.submit').click(function() {
  newMessage();
});

$(window).on('keydown', function(e) {
  if (e.which == 13) {
    newMessage();
    return false;
  }
});
//# sourceURL=pen.js
</script>

@endsection