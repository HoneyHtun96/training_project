<?php

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

// Frontend
Route::get('/','FrontendController@index')->name('frontend.index');
Route::get('allcourses','FrontendController@courses')->name('frontend.courses');
Route::get('csr','FrontendController@csr')->name('frontend.csr');
Route::get('contact','FrontendController@contact')->name('frontend.contact');

// Frontend V2
Route::get('blogs','FrontendController@blogs')->name('frontend.blogs');
Route::get('blog_detail/{id}','FrontendController@blog_detail')->name('frontend.blog_detail');



//Honey Htun
Route::get('inquire_no','FrontendController@inquire_no')->name('frontend.inquire_no');

//Yathaw
Route::get('phpbootcamp', 'FrontendController@phpbootcamp_reg');
Route::get('japanitbootcamp', 'FrontendController@japanitbootcamp_reg');
Route::get('androidbootcamp', 'FrontendController@androidbootcamp_reg');
Route::get('hradmin', 'FrontendController@hradmin_reg');
Route::get('fundamental', 'FrontendController@fundamental_reg');
Route::get('python', 'FrontendController@python_reg');
Route::get('ios', 'FrontendController@ios_reg');
Route::get('japanese', 'FrontendController@japanese_reg');

Route::get('student_register','FrontendController@studentRegister')->name('frontend.student.register');


Route::get('course_detail/{id}','FrontendController@course_detail')->name('course_detail');

Route::get('course_detail_bycodeno/{codeno}','FrontendController@course_detail_bycodeno')->name('course_detail_bycodeno');

Route::post('getBatches','InquireController@getBatches')->name('get.batches');

Route::get('dashboard',function (){
  return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::resource('courses','CourseController')->middleware('role:Admin');

Route::resource('batches','BatchController');

Route::resource('mentors','MentorController');

Route::resource('subjects','SubjectController');
Route::post('subject_course','SubjectController@subject_course');


Route::resource('roles','RoleController')->middleware('role:Admin');

Route::resource('students','StudentController');

Route::resource('units','UnitController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('getBatchesByCourse','BatchController@getBatchesByCourse')->name('course.batches');

// For Mentors

Route::get('/creategroup', 'BackendController@createGroup')->name('students.group.create');

Route::post('/getstudentformembers','BackendController@getstudentformembers')->name('getstudentformembers');

Route::resource('groups','GroupController');

Route::get('grading_form/{id}','GradingController@form')->name('grading_form');

Route::get('grading_pdf/{id}','GradingController@pdf')->name('grading_pdf');

Route::resource('grading','GradingController');

Route::get('/export/{id}', 'ExportController@export')->name('export');

// nyiyelin

Route::resource('staffs','StaffController');

Route::post('changepassword/{id}','StaffController@changepassword')->name('changepassword');

Route::post('all_staff','StaffController@all_staff')->name('all_staff');

Route::post('status_change/{id}','StaffController@status_change')->name('status_change')->middleware('role:Admin');

Route::post('show_mentor','MentorController@show_mentor')->name('show_mentor');

Route::post('show_batch','BatchController@show_batch')->name('show_batch');

Route::resource('teacher','TeacherController')->middleware('role:Admin');

//Income
Route::resource('/incomes','IncomeController');

//Expense
Route::resource('/expenses','ExpenseController');

///Honey
Route::resource('inquires','InquireController');

Route::post('installment','InquireController@preinstallment')->name('installment.store');
Route::post('full_installment','InquireController@fullinstallment')->name('fullinstallment.store');

//Monthly Report
Route::get('/export/{month}/{year}', 'ExportController@monthlyreport')->name('monthlyreport');
Route::get('/report', 'ReportController@report')->name('report');
Route::post('/detailsearch','ReportController@detailsearch')->name('detailsearch');

//Attendance
Route::resource('/attendances','AttendanceController');
Route::get('/attendances_search/action', 'AttendanceController@action')->name('attendances_search.action');
Route::get('/absence','AttendanceController@absence')->name('absence');
Route::get('/absencesearch/action','AttendanceController@absencesearch')->name('absencesearch.action');
Route::get('absence/{id}/print/{date}','PrintController@absence')->name('absenceprint');

// Grade Print
Route::resource('grades','GradingController');
Route::get('grade_print/{id}','PrintController@grade');

/*Route::get('/attendances/collection', 'AttendanceController@attendanceCollect')->name('attendances.collect');
Route::get('/attendances/reports', 'AttendanceController@attendanceReport')->name('attendances.reports');
Route::get('/attendances/export/{section_id}','AttendanceController@Export');*/




// Version(2.0)
Route::resource('lessons','LessonController');
Route::resource('topics','TopicController');
Route::resource('posts','PostController');
Route::resource('projecttypes','ProjecttypeController');
Route::resource('projects','ProjectController');
Route::resource('journals','JournalController');
Route::resource('feedbacks','FeedbackController');

// Student Dashboard
Route::get('panel','PanelController@index')->name('panel');




