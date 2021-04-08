 <div class="freelancing-landing-page text-center pos-rel">
        <div class="container-fluid">
            <div class="row">
               <div class="col-lg-7 col-md-7 col-sm-6 srch-bord-res">
                    <form class="form-inline md-form form-sm form-news">
                        <img src="{{ asset('assets/img/search.jpg')}}">
                        <input class="form-control form-control-sm" id="tags" type="text" placeholder="Enter a keyword.." aria-label="Search" />
                        
                    </form>
               </div> 
               <div class="col-lg-5 col-md-5 col-sm-6"> 
                <div class="button-right text-right">
                  <span class="toogls-srs"> 
                    <button type="submit" class="btn btn-primary btn-svts btn-save">Save</button>
                    <div class="bg-box-rs" style="display:none">
                        <input type="text" placeholder="Filter Name" class="inpt-flt">
                        <div class="main-tab">
                            <span>
                                <label class="cont">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>    
                            </span>
                            <p>
                                Send me an alert when new jobs match this filter.<span> All alerts will send out weekly. </span>
                            </p>

                        </div>
                        <a href="#" class="btn-stra"> Save Filter </a>
                    </div>  
                  </span>
                  <span class="toogls-srs"> 
                    <button type="submit" class="btn btn-primary filtr-shoes no-border gray-bg">Filters</button>
                  </span>
                  <span class="toogls-srs">     
                        <button type="submit" class="btn btn-primary sved-tgld no-border gray-bg">Saved search</button>
                        <div class="fltr-joins" style="display:none">
                            <ul class="fltr-alrts">
                                <li> Filter </li>
                                <li> <i class="fa fa-trash-o"></i> </li>
                                <li> Alert </li>
                            </ul>   
                            <ul class="fltr-alrts list-icns">
                                <li> Development Job    </li>
                                <li> <a href="#"> <img src="{{ asset('assets/img/close.svg')}}" class="img-close"> </a> </li>
                                <li> 
                                    <div class="main-tab">
                                        <span>
                                            <label class="cont">
                                                <input type="checkbox" checked="">
                                                <span class="checkmark"></span>
                                            </label>    
                                        </span>
                                    </div>
                                </li>
                                
                            </ul>
                            <ul class="fltr-alrts list-icns">
                                <li> 123 weekly roundup     </li>
                                <li> <a href="#"> <img src="{{ asset('assets/img/close.svg')}}" class="img-close"> </a> </li>
                                <li> 
                                    <div class="main-tab">
                                        <span>
                                            <label class="cont">
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>    
                                        </span>
                                    </div>
                                </li>
                                
                            </ul>
                        </div>
                    </span>
                  </div>
               </div>
            </div>
        </div>
        <div class="filtr-all-flds" style="display:none">
            <div class="container-fluid pl-4 pr-4">
            <div class="row">
                <div class="col-md col-sm-6 col-wdth">
                    <div class="width-ttl">
                        <h4 class="tlds">  Job type </h4>
                        <ul class="checkall">
                            <li>
                                <div class="main-tab">
                                    <span>
                                        <label class="cont">
                                            <input type="checkbox">
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
                                            <input type="checkbox">
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
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>    
                                    </span>
                                    <p> Fixed price </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md col-sm-6 col-wdth">
                    <div class="width-ttl">
                        <h4 class="tlds">  Experience level </h4>
                        <ul class="checkall">
                            <li>
                                <div class="main-tab">
                                    <span>
                                        <label class="cont">
                                            <input type="checkbox">
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
                                            <input type="checkbox">
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
                                            <input type="checkbox">
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
                                            <input type="checkbox">
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
                                            <input type="checkbox">
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
                                            <input type="checkbox">
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
                                            <input type="checkbox">
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
                                            <input type="checkbox">
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
                                            <input type="checkbox">
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
                                            <input type="checkbox">
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
                                            <input type="checkbox">
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
                                            <input type="checkbox">
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
                                            <input type="checkbox">
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
                                            <input type="checkbox">
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
                                            <input type="checkbox">
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
                                            <input type="checkbox">
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
                                            <input type="checkbox">
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
                <div class="col-md-12 text-center ">
                    <a href="#" class="btn-cntrs"> Close Filters </a>
                </div>
            </div>  
            </div>
        </div>
      </div>