@extends('user.layouts.main')

@section('content')


      <div class="landing-page text-center">
        <div class="container">
            <div class="row">
               <div class="col-sm-12">
                  <h3>Dan Morries is </h3>
                  <h1>Available</h1>
                  <h2>Less than 30 hrs a week</h2>
               </div>
            </div>
            <div class="update-status">
               <button type="submit" class="btn btn-primary"  data-toggle="modal" data-target="#up-proj">Update Status</button>
            </div>
        </div>
        <p class="pos-erroe">
            <span class="error-msgs"> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> You need to complete the profile to apply for any jobs. </span>
        </p>
      </div>
      <div class="profile-info-btn">
         <div class="container">
            <div class="row">
               <div class="col-sm-12">
                <a href="landing-page.html" type="submit" class="btn btn-primary">Exit Edit Profile</a>
               </div>
            </div>
         </div>
      </div>
      <div class="profile-info">
      <div class="paddin-btms">
         <div class="container">
            <div>
            <div class="padding-ser">
                <div class="row">
                   <div class="col-xl-3 col-lg-4 col-md-5 col-sm-8 col-10 offset-md-0  offset-sm-2 offset-1">
                      <div class="inner-profile text-center">
                         <img src="{{ asset('assets/img/profile.jpg')}}">
                         <h3>Dan Morries</h3>
                         <h4>Front end developer</h4>
                         <h5> <span class="icon-location"><img src="{{ asset('assets/img/location.png')}}"></span>Austin, TX, USA</h5>
                      </div>
                   </div>
                   <div class="col-xl-9 col-lg-8 col-md-7">
                        <div class="inner-txt-cont profilrmrt">
                            <div class="accordion tabs-fll-w" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                      <h2 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                          Personal Info
                                        </button>
                                      </h2>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                      <div class="card-body">
                                        <div class="padding-srt">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label class="tbl-st"> Your title(s) </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-5">
                                                    <label class="tbl-st"> Primary title </label>
                                                </div>
                                                <div class="col-xl-7 inp">
                                                    <input type="email" class="form-control wd-309" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-5">
                                                    <label class="tbl-st"> Secondary title </label>
                                                </div>
                                            <div class="col-xl-7 inp">
                                                    <input type="email" class="form-control wd-309" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                                                </div>
                                            </div>
                                                <div class="row">
                                                <div class="col-md-12">
                                                    <label class="tbl-st"> Write a professional overview </label>
                                                </div>
                                                <div class="col-md-12">
                                                    <textarea class="form-control" rows="5" id="comment"></textarea>
                                                    <span class="chara-data"> 544 characters left</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="tbl-st">Your experience level? </label>
                                                </div>
                                                <div class="col-md-12">
                                                    <a class="left-side misc-field" href="javascript:void(0)">Entry Level</a><a class="left-side misc-field" href="javascript:void(0)">Advanced</a><a class="left-side misc-field" href="javascript:void(0)">Expert</a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="tbl-st">When did you start your career? </label>
                                                </div>
                                                <div class="col-lg-3 col-md-5">
                                                    <div class="dropdown drop-show-all small-custum-wd land-cust-drop">
                                                      <button class="btn dropdown-toggle btn-sel" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Year
                                                      </button>
                                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" >2018</a>
                                                        <a class="dropdown-item" >2019</a>
                                                        <a class="dropdown-item" >2020</a>
                                                      </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="row">
                                                <div class="col-md-12 p-0">
                                                    <div class="hr-bot-line"></div>
                                                    </div>
                                                    </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="tbl-st new-mt mt-15">Your Hourly Rate </label>
                                                </div>
                                                </div>
                                                
                                                <div class="row mb-2">
                                                <div class="col-lg-5">
                                                    <label class="tbl-st"> Hourly Rate </label>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="dropdown drop-show-all diff-drop">
                                                      <div class="input-group mb-0">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text dollar">
                                                                <img src="{{ asset('assets/img/dollar.png')}}">
                                                                </span>
                                                        </div>
                                                        <input type="rate" class="form-control rate" placeholder="00.00">
                                                    </div> 
                                                     </div>
                                                    <span class="main-sp">/hr</span>    
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-lg-5">
                                                    <label class="tbl-st"> 2.9% TheRisr Service Fee</label>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="dropdown drop-show-all diff-drop no-border">
                                                      <button class="btn dropdown-toggle btn-sel" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <p> 00.00</p>
                                                      </button>  
                                                     </div>
                                                    <span class="main-sp">/hr</span>    
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-lg-5">
                                                    <label class="tbl-st">You’ll Receive</label>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="dropdown drop-show-all diff-drop">
                                                      <div class="input-group mb-0">
                                                        <div class="input-group-prepend">
                                                        <span class="input-group-text dollar">
                                                            <img src="{{ asset('assets/img/dollar.png')}}">
                                                        </span>
                                                        </div>
                                                        <input type="rate" class="form-control rate" placeholder="00.00">
                                                    </div>   
                                                     </div>
                                                    <span class="main-sp">/hr</span>    
                                                </div>
                                            </div>
                                                <div class="row">
                                                <div class="col-md-12 p-0">
                                                    <div class="hr-bot-line"></div>
                                                    </div>
                                                    </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="tbl-st mt-15">Your English proficiency? </label>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="dropdown drop-show-all mb-3 wd-309 land-cust-drop">
                                                      <button class="btn dropdown-toggle btn-sel" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Select your proficiency
                                                      </button>
                                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="#">Native or Billingual</a>
                                                        <a class="dropdown-item" href="#">Fluent</a>
                                                        <a class="dropdown-item" href="#">Conversational</a>
                                                      </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="row">
                                                <div class="col-md-12 p-0">
                                                    <div class="hr-bot-line"></div>
                                                    </div>
                                                    </div>
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <label class="tbl-st new-mt">Where do you live?  </label>
                                                </div>
                                                </div>
                                                <div class="row">
                                                
                                                <div class="col-md-6">
                                                    <label class="tbl-st"> City </label>
                                                </div>
                                                <div class="col-md-6 inp">
                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                                                </div>
                                            </div>
                                            <div class="row bg-col-chng">
                                                
                                                <div class="col-md-6">
                                                    <label class="tbl-st"> Country </label>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="dropdown drop-show-all">
                                                      <button class="btn dropdown-toggle btn-sel" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        United States
                                                      </button>
                                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                      </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            </div> <p class="text-center mb-1">Need to change the country?<a class="color-green" href=""> Contact us</a></p>
                                            <div class="col-sm-12 p-0 save-btn-lg"><button type="submit" class="btn btn-primary">Save changes</button></div>
                                        </div>
                                      </div>
                                     
                                    </div>
                                
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                      <h2 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                          Professional Experience
                                        </button>
                                      </h2>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                      <div class="card-body">
                                        <div class="padding-srt">
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label class="tbl-st">What service(s) do you offer? </label>
                                                </div>
                                                <div class="col-md-12 inp">
                                                    <select class="form-control" name="reset-multiple" id="reset-multiple" multiple>
                                                        <option value="Choice 1" selected="">UI/UX Design</option>
                                                        <option value="Choice 2">Web Design</option>
                                                        <option value="Choice 3">Photo Editing</option>
                                                        <option value="Choice 4">App Design</option>
                                                        <option value="Choice 5">Social Media Marketing</option>
                                                        <option value="Choice 6">User Experience</option>
                                                        <option value="Choice 7">User Experience Design</option>
                                                        <option value="Choice 8">Universal Design</option>
                                                        <option value="Choice 9">User Interface </option>
                                                        <option value="Choice 0">User Interaction</option>
                                                    </select>
                                                </div>
                                            </div>  
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label class="tbl-st">Work skills do you have? </label>
                                                </div>
                                                <div class="col-md-12 inp">
                                                    <select class="form-control" name="reset-multiple" id="reset-multiple2" multiple>
                                                        <option value="Choice 1" selected="">Sketch</option>
                                                        <option value="Choice 2">Invision</option>
                                                    </select>
                                                </div>  
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label class="tbl-st">Clients you have worked with</label>
                                                </div>
                                                <div class="col-md-12 inp">
                                                    <select class="form-control" name="reset-multiple" id="reset-multiple3" multiple>
                                                        <option value="Choice 1" selected="">Ryerson Holding</option>
                                                        <option value="Choice 2">Facebook</option>
                                                    </select>
                                                </div>  
                                            </div>
                                        </div>
                                        <div class="col-sm-12 p-0 save-btn-lg"><button type="submit" class="btn btn-primary">Save changes</button></div>
                                      </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                      <h2 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Employment & Education
                                        </button>
                                      </h2>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                      <div class="card-body">
                                            <div class="padding-srt">
                                        <div class="row">
                                                <div class="col-md-12">
                                                    <label class="tbl-st">Work experience</label>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="border-upper"><div class="main-box">
                               <img src="{{ asset('assets/img/equal.png')}}">
                               <div class="main-lft">
                               <div class="main-my">
                                  <p class="designation color-black ui-ux-designer">UI/UX Designer</p>
                                  <p class="location mutual-mobile">Mutual Mobile Austin, TX, USA
                                  </p><p class="location may-2018-current mb-0">May 2018 - Current<br/>Austin, TX, USA
                                  </p> </div>
                                  <a href="" class="link">Edit</a>
                               </div>
                            </div>
                            
                            </div>
                                                        
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-12 p-0 save-btn-lg cont-bt"><button type="submit" class="btn btn-primary height-main">Add work experience</button></div><div class="row">
                                                <div class="col-md-12">
                                                    <label class="tbl-st">Schools attended</label>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="border-upper"><div class="main-box">
                               <img src="{{ asset('assets/img/equal.png')}}">
                               <div class="main-lft">
                               <div class="main-my">
                                  <p class="designation color-black ui-ux-designer">Graphic Design/Illustration</p>
                                 <p class="location may-2018-current mb-0">California State University, Fullerton<br/>Attended 2012 - 2015
                                  </p> </div>
                                  <a href="" class="link">Edit</a>
                               </div>
                            </div>
                            
                            </div>
                                                        
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-12 p-0 save-btn-lg cont-bt"><button type="submit" class="btn btn-primary height-main mb-0 mt-1">Add education</button></div>
                                            
                                            </div>
                                      </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingThree1">
                                      <h2 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree2" aria-expanded="false" aria-controls="collapseThree2">
                                        Social Links (optional)
                                        </button>
                                      </h2>
                                    </div>
                                    <div id="collapseThree2" class="collapse" aria-labelledby="headingThree1" data-parent="#accordionExample">
                                      <div class="card-body social-iv">
                                            <div class="padding-srt">
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="tbl-st"><img src="{{ asset('assets/img/icon-1.png')}}"><span class="img-txt">GitHub</span> </label>
                                                </div>
                                                <div class="col-md-6 inp">
                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Github Username">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="tbl-st"><img src="{{ asset('assets/img/medium.png')}}"><span class="img-txt">Medium</span> </label>
                                                </div>
                                                <div class="col-md-6 inp">
                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Medium Username">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="tbl-st"><img src="{{ asset('assets/img/icon-3.png')}}"><span class="img-txt">Codepen</span> </label>
                                                </div>
                                                <div class="col-md-6 inp">
                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Codepen Username">
                                                </div>
                                            </div><div class="row">
                                                <div class="col-md-6">
                                                    <label class="tbl-st"><img src="{{ asset('assets/img/behance.png')}}"><span class="img-txt">Behance</span> </label>
                                                </div>
                                                <div class="col-md-6 inp">
                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Behance Username">
                                                </div>
                                            </div><div class="row">
                                                <div class="col-md-6">
                                                    <label class="tbl-st"><img src="{{ asset('assets/img/icon-5.png')}}"><span class="img-txt">Dribbble</span> </label>
                                                </div>
                                                <div class="col-md-6 inp">
                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Dribbble Username">
                                                </div>
                                            </div><div class="row">
                                                <div class="col-md-6">
                                                    <label class="tbl-st"><img src="{{ asset('assets/img/icon-6.png')}}"><span class="img-txt">Youtube</span> </label>
                                                </div>
                                                <div class="col-md-6 inp">
                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="https://youtube.com/channel">
                                                </div>
                                            </div><div class="row">
                                                <div class="col-md-6">
                                                    <label class="tbl-st"><img src="{{ asset('assets/img/icon7.png')}}"><span class="img-txt">LinkedIn</span> </label>
                                                </div>
                                                <div class="col-md-6 inp">
                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="LinkedIn Username">
                                                </div>
                                            </div><div class="row">
                                                <div class="col-md-6">
                                                    <label class="tbl-st"><img src="{{ asset('assets/img/icon-8.png')}}"><span class="img-txt">Instagram</span> </label>
                                                </div>
                                                <div class="col-md-6 inp">
                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Instagram Username">
                                                </div>
                                            </div><div class="row">
                                                <div class="col-md-6">
                                                    <label class="tbl-st"><img src="{{ asset('assets/img/icon-9.png')}}"><span class="img-txt">Twitter</span> </label>
                                                </div>
                                                <div class="col-md-6 inp">
                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Twitter Username">
                                                </div>
                                            </div><div class="row">
                                                <div class="col-md-6">
                                                    <label class="tbl-st"><img src="{{ asset('assets/img/pin.png')}}"><span class="img-txt">Pinterest</span> </label>
                                                </div>
                                                <div class="col-md-6 inp">
                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Pinterest Username">
                                                </div>
                                            </div><div class="row">
                                                <div class="col-md-6">
                                                    <label class="tbl-st"><img src="{{ asset('assets/img/fb.png')}}"><span class="img-txt">Facebook</span> </label>
                                                </div>
                                                <div class="col-md-6 inp">
                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Facebook username">
                                                </div>
                                            </div><div class="row">
                                                <div class="col-md-6">
                                                    <label class="tbl-st"><img src="{{ asset('assets/img/earth-globe.png')}}"><span class="img-txt">Website</span> </label>
                                                </div>
                                                <div class="col-md-6 inp">
                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Yourwebsite.com">
                                                </div>
                                            </div>
                                            </div><div class="col-sm-12 p-0 save-btn-lg cont-bt"><button type="submit" class="btn btn-primary mb-0 mt-1">Save Social Links</button></div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
            </div>
         </div>
         </div>
         <div class="portfoli-sects">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="main-glt main-km">
                            Portfolio
                        </h3>
                        <div class="col-sm-12 p-0 save-btn-lg cont-bt ad-prj"><button type="submit" class="btn btn-primary mb-0 mt-1"  data-toggle="modal" data-target="#Fairymdl">Add Project</button></div>
                    </div>
                </div>
                <div class="grids-all">
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="box-portfoli">
                                <img src="{{ asset('assets/img/no-image.jpg')}}" class="img-alvs">
                                <h4 class="sc-ttl">
                                    <a href=""> Dribe - A new way of driving 
                                        <span class="sml-rx"> Adobe Photoshop, Adobe XD, Sketch </span>
                                    </a>
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="box-portfoli">
                                <img src="{{ asset('assets/img/no-image.jpg')}}" class="img-alvs">
                                <h4 class="sc-ttl">
                                    <a href=""> Project Name 
                                        <span class="sml-rx"> Skills use for this project </span>
                                    </a>
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="box-portfoli">
                                <img src="{{ asset('assets/img/no-image.jpg')}}" class="img-alvs">
                                <h4 class="sc-ttl">
                                    <a href=""> Project Name 
                                        <span class="sml-rx"> Skills use for this project </span>
                                    </a>
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="box-portfoli">
                                <img src="{{ asset('assets/img/no-image.jpg')}}" class="img-alvs">
                                <h4 class="sc-ttl">
                                    <a href=""> Dribe - A new way of driving 
                                        <span class="sml-rx"> Adobe Photoshop, Adobe XD, Sketch </span>
                                    </a>
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="box-portfoli">
                                <img src="{{ asset('assets/img/no-image.jpg')}}" class="img-alvs">
                                <h4 class="sc-ttl">
                                    <a href=""> Project Name 
                                        <span class="sml-rx"> Skills use for this project </span>
                                    </a>
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="box-portfoli">
                                <img src="{{ asset('assets/img/no-image.jpg')}}" class="img-alvs">
                                <h4 class="sc-ttl">
                                    <a href=""> Project Name 
                                        <span class="sml-rx"> Skills use for this project </span>
                                    </a>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
         <!--div class="main-cov border-none">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Work history</h1>
                        <p class="no-work"> No work history on TheRisr yet. </p>
                    </div>
                </div>
            </div> 
         </div-->
        </div>



<!-- update status model -->
<div class="modal hiring-popup update-proj" id="up-proj">
    <div class="modal-dialog modal-md ">
        <div class="modal-content">
          <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title fairy-tale-in-the-wo text-center">Update Status</h4>
                <button type="button" class="close" data-dismiss="modal"><img src="{{ asset('assets/img/cross.png')}}"></button>
            </div>

          <!-- Modal body -->
            <div class="modal-body pb-0">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="left-hiring-txt">
                            <form>
                                <input type="hidden" name="available"
                                        id="available" value="available" />

                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle select-p" type="button" id="availableButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Available
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="availableButton" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item tt avail" href="#">Available</a>
                                        <a class="dropdown-item nt notavail" href="#">Not Available</a>
                                    </div>
                                </div>
                            </form>
                            <p class="text-center till">For</p>
                            <p class="text-center untill">Until</p>
                            <form class="till">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle select-p" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Less than 30 hrs/week
                                    </button>
      
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start">
                                        <a class="dropdown-item" href="#">Less than 40 hrs/week</a>
                                        <a class="dropdown-item" href="#">Less than 50 hrs/week</a>
                                        <a class="dropdown-item" href="#">Less than 60 hrs/week</a>
                                    </div>
                                </div> 
                            </form>
                            <form class="untill">
                                <div class="dropdown drop-mes-icon">
                                  <input type="text" value="DD/MM/YYYY" class="form-control"   id="untilDate"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="right-hiring-txt">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
         
        </div>
    </div>
</div>

<!-- update status model end -->



<!-- Add project model -->
<div class="modal hiring-popup" id="Fairymdl">
  <div class="modal-dialog modal-lg ">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title fairy-tale-in-the-wo">Fairy Tale in the Woods</h4>
        <button type="button" class="close" data-dismiss="modal"><img src="{{ asset('assets/img/cross.png')}}"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <div class="row mb-3">
       <div class="col-sm-6">
       <div class="left-hiring-txt">
       <img src="{{ asset('assets/img/man.png')}}"><span class="man-name">by Dan Morries</span>
       </div>
         </div>
       
       <div class="col-sm-6">
        <div class="right-hiring-txt">
       <button type="submit" class="btn btn-primary">Hire Me</button>
       </div></div>
       </div>
       <div class="main-in">
       <div class="row">
        <div class="col-sm-12 p-0">
        <img src="{{ asset('assets/img/processing.png')}}">
        </div>
       </div>
        <div class="row">
        <div class="col-sm-12 p-0">
        <img class="double-img" src="{{ asset('assets/img/double-img.jpg')}}">
        </div>
       </div>
       </div>
       <div class="main-mrg">
       <div class="row">
       <div class="col-sm-6">
       <p class="sed-ut-perspiciatis">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
       </div>
       <div class="col-sm-6">
       <div class="row">
       <div class="col-sm-3 pr-0"><img src="{{ asset('assets/img/sys.jpg')}}"><span>Role</span></div>
       <div class="col-sm-9 pl-0"><p class="grap">Graphic Designer</p></div>
       </div> <div class="row">
       <div class="col-sm-3 pr-0"><img src="{{ asset('assets/img/mind.png')}}"><span>Skills</span></div>
       <div class="col-sm-9 pl-0"><div class="tags"><span class="badge badge-primary">Web Design</span><span class="badge badge-primary">CSS</span><span class="badge badge-primary">Front-end Developmen</span></div></div>
       </div>
        <div class="row">
       <div class="col-sm-3 pr-0"><img src="{{ asset('assets/img/link.png')}}"><span>Link</span></div>
       <div class="col-sm-9 pl-0"><p class="grap">Graphic Designer</p></div>
       </div>
       </div>
      </div>
       </div>
      </div>

     
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
      <p>Wait a sec! Are you sure you want to delete your [project name] project? </p>
       </div>
         </div>  
       </div>         
      </div>
        <div class="modal-footer">
            <div class="right-hiring-txt">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Delete</button>
                <button type="submit" class="btn btn-primary">Cancel</button>
            </div>
       </div>
     
    </div>
  </div>
</div>
<!-- delete project model end-->



<!--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>-->
@endsection


 

@section('footer') 
<script>
    $( function() {
            $( "#untilDate" ).datepicker();
    });
    $(document).ready(function(){
        $(".notavail").click(function(){
            $('#available').val('notavailable');
            $('#availableButton').html($(".notavail").html());
            $(".till").hide();
            $(".untill").show();
        });
        $(".avail").click(function(){
            $('#available').val('available');
            $('#availableButton').html($(".avail").html());
            $(".untill").hide();
            $(".till").show();
        });
    });

        document.addEventListener('DOMContentLoaded', function() {
            var resetMultiple = new Choices('#reset-multiple', {
            removeItemButton: true,
            editItems: true,
          });
        });
        document.addEventListener('DOMContentLoaded', function() {
          var resetMultiple = new Choices('#reset-multiple2', {
            removeItemButton: true,
            editItems: true,
          });
        });
        document.addEventListener('DOMContentLoaded', function() {
          var resetMultiple = new Choices('#reset-multiple3', {
            removeItemButton: true,
            editItems: true,
          });
        });

      $( function() {
        var availableTags = [
          "User Experience Design",
          "University Professor"
        ];
        $( "#tags" ).autocomplete({
          source: availableTags
        });
      } );
</script>

@endsection