<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/phpinfo', function() {
    return phpinfo();
});  


// php migrate
Route::get('/migrate', function() {
    $exitCode = Artisan::call('migrate');
    return '<h1>Migration Done!!</h1>';
});

// DB seed to add default data to tables
Route::get('/seed', function() {
    $exitCode = Artisan::call('db:seed');
    return '<h1>DB Seeded Done!!</h1>';
});
// DB seed to add default data to tables
Route::get('/settings_seed', function() {
    $exitCode = Artisan::call('db:seed --class=SettingsTableSeeder');
    return '<h1>DB Seeded Done!!</h1>';
});


//  rollback and re-run all of your migrations:
// Route::get('/migrateseed', function() {
//     $exitCode = Artisan::call('migrate:refresh --seed');
//     return '<h1>migrate:refresh --seed Done!!</h1>';
// });


Route::get('/', function () {
    return view('welcome');
});

// verify true to set route for verify email on signup
Auth::routes(['verify' => true]);

// after verify redirect
Route::get('afterVerifyRedirect', function () {
        $userid = json_decode(Auth::user())->id;
        $user = User::find($userid);
        if( $user->user_type == '1'){
            return redirect('editprofile');
        }else{
            return redirect('gen_settings');
        }
});

Route::get('/', 'User\UserController@index')->name('/')->middleware('verified');


Route::namespace('Auth')->name('user.')->group(function () {
      Route::post('login', 'LoginController@loginUser')->name('loginUser'); // check if email exist
      Route::get('login/{provider}', 'LoginController@redirectToProvider')->name('linkedin');
      Route::get('{provider}/callback', 'LoginController@handleProviderCallback');
});


//freelancer routes only 
 Route::middleware(['auth', 'dataGlobal', 'freelancer'])->namespace('User')->name('user.')->group(function () {

    //submit edit profile page first 2 forms and edit profile page open
    Route::match(['get', 'post'], 'editprofile', 'UserController@editprofile')->name('editprofile');
    //submit work exp
    Route::post('workExp', 'UserController@workExp')->name('workExp');
    Route::get('workExp_ajax', 'UserController@workExp_ajax')->name('workExp_ajax');
    Route::get('get_workExp/{id}', 'UserController@get_workExp')->name('get_workExp');
    Route::get('delete_workExp/{id}', 'UserController@delete_workExp')->name('delete_workExp');

    // education
    Route::post('education_sub', 'UserController@education_sub')->name('education_sub');
    Route::get('edu_ajax', 'UserController@edu_ajax')->name('edu_ajax');
    Route::get('get_education/{id}', 'UserController@get_education')->name('get_education');
    Route::get('delete_education/{id}', 'UserController@delete_education')->name('delete_education');

    //social links
    Route::post('social_sub', 'UserController@social_sub')->name('social_sub');
    Route::get('social_ajax', 'UserController@social_ajax')->name('social_ajax');
    Route::get('profile', 'UserController@profile')->name('profile');

    //portfolio
    Route::match(['get', 'post'], 'addproject', 'ProjectController@addproject')->name('addproject');
    Route::get( 'editproject/{id?}', 'ProjectController@editproject')->name('editproject');
    Route::get('portfolio_ajax', 'ProjectController@portfolio_ajax')->name('portfolio_ajax');
    Route::get('delete_portfolio/{id?}',  'ProjectController@delete_portfolio')->name('delete_portfolio');

    // update status available
    Route::post('updateAvailable', 'UserController@updateAvailable')->name('updateAvailable');

    //user profile update
    Route::post('user_profile', 'UserController@user_profile')->name('user_profile');
     // jobs
    Route::get('jobdetail', 'JobController@jobdetail')->name('jobdetail');
    Route::get('alljobs', 'JobController@alljobs')->name('alljobs');
    Route::get('likedjobs', 'JobController@likedjobs')->name('likedjobs');
    Route::get('appliedjobs', 'JobController@appliedjobs')->name('appliedjobs');
    Route::get('skippedjobs', 'JobController@skippedjobs')->name('skippedjobs');
    Route::get('offerjobs', 'JobController@offerjobs')->name('offerjobs');
    Route::get('get_job_ajax_frlncr/{page}', 'JobController@get_job_ajax_frlncr')->name('get_job_ajax_frlncr');
    Route::get('get_jobBasicF/{id}', 'JobController@get_jobBasicF')->name('get_jobBasicF');
    Route::get('job_likeskip/{type}/{id}', 'JobController@job_likeskip')->name('job_likeskip');
    Route::post('job_report', 'JobController@job_report')->name('job_report');
    //proposal
    Route::get('get_applypopup_content/{id}', 'ProposalController@get_applypopup_content')->name('get_applypopup_content');
    Route::post('job_apply', 'ProposalController@job_apply')->name('job_apply');
    Route::get('job_proposaldelete/{id}', 'ProposalController@job_proposaldelete')->name('job_proposaldelete');



   //jobs/contracts
    Route::get('myjobs', 'ContractController@myjobs')->name('myjobs');
    Route::get('activecontract', 'ContractController@activecontract')->name('activecontract');
    Route::get('archivedcontract', 'ContractController@archivedcontract')->name('archivedcontract');
    Route::get('endedcontract', 'ContractController@endedcontract')->name('endedcontract');
    Route::get('get_contract_area_ajaxfreelancer/{page}', 'ContractController@get_contract_area_ajaxfreelancer')->name('get_contract_area_ajaxfreelancer');


    
    Route::get('contract_area_ajax_F/{page}', 'ContractController@contract_area_ajax_F')->name('contract_area_ajax_F');
    Route::get('get_contractOfferBasicF/{id}', 'ContractController@get_contractOfferBasicF')->name('get_contractOfferBasicF');

   // filter routes 
    Route::match(['get', 'post'], 'filter_apply_free', 'FilterController@filter_apply_free')->name('filter_apply_free');   
});



// common routes for freelancer and employer
Route::middleware(['auth', 'dataGlobal'])->namespace('User')->name('user.')->group(function () {
 
   // save timezone
    Route::post('ajax/set_current_time_zone',function () {
         $input = $_POST;
        if(!empty($input)){
            $current_time_zone = $_POST['curent_zone'];
            Session::put('current_time_zone',  $current_time_zone);
        }
    });

    // stripe
    Route::post('stripe_connect', 'PaymentController@stripe_connect')->name('stripe_connect');

    // job reports
    Route::get('jobreports', 'ContractController@jobreports')->name('jobreports');
    Route::get('get_job_report_area_ajax/{page}', 'ContractController@get_job_report_area_ajax')->name('get_job_report_area_ajax');

    // end contract
    Route::get('end_contract/{id?}', 'ContractController@end_contract')->name('end_contract');
    Route::post('endContractSubmit', 'ContractController@endContractSubmit')->name('endContractSubmit');
    
    //messages 
    Route::get('messages/{jobid?}', 'MessagesController@messages')->name('messages');
    Route::get('getChatSidebar/{chat_id?}', 'MessagesController@getChatSidebar')->name('getChatSidebar');
    Route::get('getFullChat/{chat_id}', 'MessagesController@getFullChat')->name('getFullChat');
    Route::post('sendMessage', 'MessagesController@sendMessage')->name('sendMessage');
    Route::post('uploadAttachment', 'MessagesController@uploadAttachment')->name('uploadAttachment');
    Route::get('initiateChat/{jobid}/{freelancerid}/{clientid}', 'MessagesController@initiateChat')->name('initiateChat');
    Route::get('getNewMessages/{chat_id}/{lastMessageId?}', 'MessagesController@getNewMessages')->name('getNewMessages');
    Route::get('loadOldMessages/{chat_id}/{latestMessageId?}', 'MessagesController@loadOldMessages')->name('loadOldMessages');
    
    //global counter header bar
    Route::get('getGlobalMessageUnreadCount', 'MessagesController@getGlobalMessageUnreadCount');

    // notifications get 
    Route::get('getNotifications', 'MessagesController@getNotifications');
    Route::get('loadOldNotifications/{latestId?}', 'MessagesController@loadOldNotifications')->name('loadOldNotifications');
    Route::get('deleteNotification/{id?}', 'MessagesController@deleteNotification')->name('deleteNotification');
  
   // profile settings
    Route::get('gen_settings', 'SettingController@gen_settings')->name('gen_settings');
    Route::get('pay_settings', 'SettingController@pay_settings')->name('pay_settings');
    Route::get('pass_settings', 'SettingController@pass_settings')->name('pass_settings');
    Route::get('not_settings', 'SettingController@not_settings')->name('not_settings');

   //profile settings update links
    Route::post('gen_update/{id}', 'SettingController@gen_update')->name('gen_update');
    Route::post('pass_update/{id}', 'SettingController@pass_update')->name('pass_update');
    Route::post('not_update/{id}', 'SettingController@not_update')->name('not_update');

    // get portfolio popup view (in freelancer and in employer also)
    Route::get('get_portfolio/{id?}', 'ProjectController@get_portfolio')->name('get_portfolio'); 
   
    // change contract status
    Route::get('statuschange_contract/{type}/{id}', 'ContractController@statuschange_contract')->name('statuschange_contract');
   
   // get milestones area 
    Route::get('get_timesheets/{id}', 'ContractController@get_timesheets')->name('get_timesheets');
    Route::get('get_milestones/{id}', 'ContractController@get_milestones')->name('get_milestones');
    Route::get('get_payments/{id}', 'ContractController@get_payments')->name('get_payments');
    Route::get('get_feedbacks/{id}', 'ContractController@get_feedbacks')->name('get_feedbacks');
    Route::post('saveMilestones/{id}','ContractController@saveMilestones')->name('saveMilestones');
    Route::get('delete_milestone/{id}','ContractController@delete_milestone')->name('delete_milestone');
    
    Route::post('saveTimesheets/{id}','ContractController@saveTimesheets')->name('saveTimesheets');
    Route::get('delete_timesheet/{id}','ContractController@delete_timesheet')->name('delete_timesheet');

    // get contract view area with milestone and timesheet
    Route::get('get_contractBasic/{id}', 'ContractController@get_contractBasic')->name('get_contractBasic');

   // single job view
    Route::get('job/{id}', 'JobController@job')->name('job');
    // single contract view
    Route::get('contract/{id}', 'ContractController@contract')->name('contract');

    // work experience
    Route::get('f_workhistory_ajax/{id}/{page?}', 'ContractController@f_workhistory_ajax')->name('f_workhistory_ajax');

    // saved searched
    Route::get('getSavedSearches', 'FilterController@getSavedSearches')->name('getSavedSearches');
    Route::get('editSavedSearch/{type}/{id}', 'FilterController@editSavedSearch')->name('editSavedSearch'); 

});


//employer routes only 
 Route::middleware(['auth', 'dataGlobal', 'employer'])->namespace('User')->name('user.')->group(function () {
    // employee jobs
    Route::get('e_myjobs', 'JobController@e_myjobs')
    ->name('e_myjobs');
    Route::get('draftjobs', 'JobController@draftjobs')
    ->name('draftjobs'); 
    Route::get('archivedjobs', 'JobController@archivedjobs')
    ->name('archivedjobs');

   // employee contarcts
    Route::get('allcontracts', 'ContractController@allcontracts')->name('allcontracts');
    Route::get('archivedcontracts', 'ContractController@archivedcontracts')->name('archivedcontracts');
    Route::get('activecontracts', 'ContractController@activecontracts')->name('activecontracts'); 
    Route::get('e_endedcontract', 'ContractController@e_endedcontract')->name('e_endedcontract');
    Route::get('get_contract_area_ajax/{page}', 'ContractController@get_contract_area_ajax')->name('get_contract_area_ajax');


    // post and edit job
    Route::match(['get', 'post'], 'jobpost', 'JobController@jobpost')->name('jobpost');
    Route::get('editjob/{id}', 'JobController@editjob')->name('editjob');

    // get job proposals
    Route::get('get_proposals_area_ajax/{page}/{jid}', 'ProposalController@get_proposals_area_ajax')->name('get_proposals_area_ajax');
    
    Route::get('get_proposal_content/{id}', 'ProposalController@get_proposal_content')->name('get_proposal_content');
    Route::get('statuschange_proposal/{type}/{id}', 'ProposalController@statuschange_proposal')->name('statuschange_proposal');

    Route::get('get_jobBasic/{id}', 'JobController@get_jobBasic')->name('get_jobBasic');
    Route::get('statuschange_job/{type}/{id}', 'JobController@statuschange_job')->name('statuschange_job');

    Route::get('get_job_area_ajax/{page}', 'JobController@get_job_area_ajax')->name('get_job_area_ajax');

     //freelancer public profile
    Route::get('f_profile/{id}', 'ProposalController@f_profile')->name('f_profile');
    Route::get('f_portfolio_ajax/{id}', 'ProposalController@f_portfolio_ajax')->name('f_portfolio_ajax');

    // get hire freelancer popup
    Route::get('get_hirePopup/{uid}/{pid}/{jid}', 'HireController@get_hirePopup')->name('get_hirePopup');
    // submit hire popup form
    Route::post('job_hire', 'HireController@job_hire')->name('job_hire'); 
    // to get job details on change jobs dropdown in hire popup
    Route::get('job_hire_jobBasic/{jid}/{uid}', 'HireController@job_hire_jobBasic')->name('job_hire_jobBasic'); 
    // undo job hire
    Route::get('job_hiredelete/{id}', 'HireController@job_hiredelete')->name('job_hiredelete');
    // contract view
    Route::get('get_contractView/{id}', 'HireController@get_contractView')->name('get_contractView');

    // all proposals
    Route::get('allproposals', 'ProposalController@allproposals')->name('allproposals');
    Route::get('get_alljobs_proposals_area_ajax/{page}', 'ProposalController@get_alljobs_proposals_area_ajax')->name('get_alljobs_proposals_area_ajax');

    // all offers sent 
    Route::get('alloffers', 'HireController@alloffers')->name('alloffers');
    Route::get('get_alloffer_area_ajax/{page}', 'HireController@get_alloffer_area_ajax')->name('get_alloffer_area_ajax');
    Route::get('get_offerBasic/{id}', 'HireController@get_offerBasic')->name('get_offerBasic');

    // filter routes 
    Route::match(['get', 'post'], 'filter_apply_emp', 'FilterController@filter_apply_emp')->name('filter_apply_emp');
    Route::post('filter_result', 'FilterController@filter_result')->name('filter_result');
    Route::get('freelancer_status/{status}/{id}',  'FilterController@freelancer_status')->name('freelancer_status');
   
     // My freelancers listing
    Route::get('myfreelancer', 'FilterController@myfreelancer')->name('myfreelancer');
    Route::get('get_myfreelancers_area_ajax/{page}', 'FilterController@get_myfreelancers_area_ajax')->name('get_myfreelancers_area_ajax');
    Route::get('get_freelancer_content/{id}', 'FilterController@get_freelancer_content')->name('get_freelancer_content');



 });


//admin routes
Route::prefix('admin')->namespace('Auth\Admin')->name('admin.')->group(function () {
    Route::get('login', 'LoginController@login')->name('auth.login');
    Route::post('login', 'LoginController@loginAdmin')->name('auth.loginAdmin');
    Route::post('logout', 'LoginController@logout')->name('auth.logout');
});
 Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
  Route::get('/', 'AdminController@index')->name('/');

  // dashboard page 
  Route::get('dashboard', 'AdminController@index')->name('dashboard');
  Route::match(array('GET', 'POST'),'get_stats', 'AdminController@get_stats')->name('get_stats'); 

  // users listing
  Route::get('users/{type?}', 'UserController@users')->name('users');
  Route::match(array('GET', 'POST'),'get_users', 'UserController@get_users')->name('get_users');  
  // reports listing
  Route::get('job_reports', 'JobController@job_reports')->name('job_reports');
  Route::match(array('GET', 'POST'),'get_reports', 'JobController@get_reports')->name('get_reports');
  // transactions listing
  Route::get('transactions', 'TransactionController@transactions')->name('transactions');
  Route::match(array('GET', 'POST'),'get_tran', 'TransactionController@get_tran')->name('get_tran');
  // settings 
  Route::get('settings/{type?}', 'AdminController@settings')->name('settings');
  Route::post('pass_update', 'AdminController@pass_update')->name('pass_update');
  Route::post('updateprofile', 'AdminController@updateprofile')->name('updateprofile');
  Route::post('update_settings', 'AdminController@update_settings')->name('update_settings');

});

