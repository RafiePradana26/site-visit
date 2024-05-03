<?php

use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiteVisitController;
use App\Http\Controllers\WebsiteController;



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

Route::get('/login', function () {
    auth()->logout();
    return view('auth.login');
});


//Website Site Visit
Route::get('/', [SiteVisitController::class, 'indexSiteVisit'])->name('website.sitevisit');
Route::post('/site-visit/store', [SiteVisitController::class, 'store'])->name('site-visit.store');
Route::get('/site-visit-all/generate-pdf', [SiteVisitController::class, 'exportPDF'])->name('export.pdf');



//Admin Web Miracle


// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/site-visit-all', [SiteVisitController::class, 'showAllSiteVisit'])->name('sitevisit');
    Route::get('/site-visit-all/{id}', [SiteVisitController::class, 'showDetail'])->name('detail.sitevisit');
    Route::get('/site-visit-all/generate-pdf', [SiteVisitController::class, 'exportPDF'])->name('export.pdf');


    // Blog Routes
    Route::get('/blog', [AdminController::class, 'showBlog'])->name('blog');
    Route::get('/form_blog', [AdminController::class, 'showBlogForm'])->name('form_blog');
    Route::post('/blog/submit', [AdminController::class, 'submitNewBlog'])->name('blog.submit');
    Route::get('/blog/fetch', [AdminController::class, 'fetchBlogData'])->name('blog.fetch');
    Route::get('/blog/edit/{id}', [AdminController::class, 'showEditBlogForm'])->name('blog.edit');
    Route::post('/blog/edit/{id}', [AdminController::class, 'submitEditBlog'])->name('blog.edit.submit');


    // rms Route
    Route::get('/role_management', [AdminController::class, 'showRolemanagement'])->name('showRolemanagement');
    Route::get('/role_management_edit', [AdminController::class, 'editrms'])->name('editrms');
    Route::get('/role_management/fetch', [AdminController::class, 'fetchRoleManagementData'])->name('roleManagementData.fetch');
    Route::get('/role_management_detail/{id}', [AdminController::class, 'showRoleManagementDetail'])->name('showRoleManagementDetail');
    Route::post('/role_management/submit', [AdminController::class, 'submitRole'])->name('role.submit');
    Route::put('/users/{id}/update-role-akses', [AdminController::class, 'updateRoleAkses'])->name('updateRoleAkses');

    // user Management Route
    Route::get('/user_management', [AdminController::class, 'showUserManagement'])->name('showUserManagement');
    Route::get('/user_management_edit', [AdminController::class, 'editUserManagement'])->name('editUserManagement');
    Route::get('/user_management_detail/{id}', [AdminController::class, 'showUserManagementDetail'])->name('showUserManagementDetail');
    Route::get('/user_management/fetch', [AdminController::class, 'fetchUserManagementData'])->name('userManagementData.fetch');
    Route::put('/users/{id}/update-role', [AdminController::class, 'updateUserRole'])->name('updateUserRole');
});

// Writer Routes
Route::middleware(['auth', 'writer'])->group(function () {
    // Blog Routes accessible only to writer
    Route::get('/blog', [AdminController::class, 'showBlog'])->name('blog');
    Route::get('/form_blog', [AdminController::class, 'showBlogForm'])->name('form_blog');
    Route::post('/blog/submit', [AdminController::class, 'submitNewBlog'])->name('blog.submit');
    Route::get('/blog/fetch', [AdminController::class, 'fetchBlogData'])->name('blog.fetch');
});

// Ordal Routes
Route::middleware(['auth', 'ordal'])->group(function () {
    // Blog Routes accessible only to ordal
    Route::get('/blog', [AdminController::class, 'showBlog'])->name('blog');
    Route::get('/form_blog', [AdminController::class, 'showBlogForm'])->name('form_blog');
    Route::post('/blog/submit', [AdminController::class, 'submitNewBlog'])->name('blog.submit');
    Route::get('/blog/fetch', [AdminController::class, 'fetchBlogData'])->name('blog.fetch');
    Route::delete('/blog/delete/{id}', [AdminController::class, 'deleteBlog'])->name('blog.delete');


    // About Us Routes accessible only to ordal
    Route::get('/about_us', [AdminController::class, 'showAboutUs'])->name('about_us');
    Route::get('/form_about_us', [AdminController::class, 'showAboutUsForm'])->name('form_about_us');
});



//WEBSITE DEPAN
Route::post('/upload', [AdminController::class, 'upload']);
// Landing Page
Route::get('/blog/{id}', [WebsiteController::class, 'showBLog'])
    ->name('blog.showBlog');


Route::get('/website/landingpage', [WebsiteController::class, 'indexlandingPage'])->name('website.landingpage');
Route::get('/website/aktivitas', [WebsiteController::class, 'indexAktivitas'])->name('website.aktivitas');
Route::get('/website/kelas', [WebsiteController::class, 'indexKelas'])->name('website.kelas');
Route::get('/website/testimoni', [WebsiteController::class, 'indexTestimoni'])->name('website.testimoni');
Route::get('/website/blog', [WebsiteController::class, 'indexBlog'])->name('website.blog');
Route::get('/website/aboutus', [WebsiteController::class, 'indexAboutUs'])->name('website.aboutus');










Auth::routes();

// Route::get('auth/dashboard', [DashboardController::class, 'dashboard'])->name('auth.dashboard')->middleware('auth');
Route::resource('auth/posts', PostController::class);


// Route::get('/refresh-table', [DashboardController::class, 'refreshTable'])->name('refresh.table');
// Route::get('/refresh-table-progress', [DashboardController::class, 'refreshTableProgress'])->name('refresh.table_progress');
// Route::get('/refresh-table-pending', [DashboardController::class, 'refreshTablePending'])->name('refresh.table_pending');
// Route::get('/refresh-table-solved', [DashboardController::class, 'refreshTableSolved'])->name('refresh.table_solved');
// Route::get('/refresh-table-tech-person', [DashboarTechController::class, 'refreshTableTechPerson'])
//     ->name('refresh.table_tech_person');
// Route::get('/refresh-ticket-counts', [DashboardController::class, 'refreshTicketCounts'])->name('refresh.ticket_counts');
// Route::get('/refresh-table-user-tech', 'DashboardController@refreshTableUserTech')->name('refresh.table_user_tech');
// Route::get('/refresh-table-user', [DashboardUserController::class, 'refreshTableUser'])
//     ->name('refresh.table_user');
// Route::get('/refresh-table-onhold', [DashboardController::class, 'refreshTableonhold'])
//     ->name('refresh.table_onhold');



//Admin
// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('auth/dashboard', [DashboardController::class, 'index'])->name('auth.dashboard');
//     Route::resource('detail_ticket-admin', DashboardController::class);
//     Route::get('admin_ticket_detail/{id}/edit', [DashboardController::class, 'edit'])->name('admin_ticket_detail.edit');
//     Route::put('/assign-ticket/{ticket}', [TicketController::class, 'assign'])->name('assign.ticket');
//     Route::get('/refresh-assigned-table/{ticket}', [DashboardController::class, 'refreshAssignedTable'])->name('refresh.assigned.table');
// });

//User
// Route::group(['middleware' => 'user'], function () {
//     // Your custom routes go here
//     Route::get('/my_ticket', [DashboardUserController::class, 'myTickets'])->name('my_ticket');
//     Route::get('/my_ticket/detail_ticket_user/{id}/edit', [DashboardUserController::class, 'edit'])->name('detail_ticket_user.edit');
//     Route::get('/new_ticket/{user}', [DashboardUserController::class, 'showNewTicketForm'])->name('new_ticket');
//     Route::post('/submit_ticket', [DashboardUserController::class, 'submitTicket'])->name('submit_ticket');
//     Route::get('/profile/update', [DashboardUserController::class, 'updateProfile'])->name('user.profile.update');
//     Route::post('/profile/update-password', [DashboardUserController::class, 'updatePassword'])->name('user.update.password');
//     Route::post('/profile/redeem', [DashboardUserController::class, 'redeemCode'])->name('user.redeem_code');
//     // Then add the resourceful route
//     //Route::resource('dashboard-user', DashboardUserController::class);
// });


// Route::resource('dashboard-user', DashboardUserController::class);
//Route::get('/detail_ticket_user', [DashboardUserController::class, 'show'])->name('detail_ticket_user');
//Route::get('/my_ticket', [DashboardUserController::class, 'create'])->name('my_ticket');

//Route::get('/new_ticket', [DashboardUserController::class, 'show'])->name('new_ticket');

//Admin

// Route::get('auth/dashboard', [DashboardController::class, 'index'])->name('auth.dashboard')->middleware('auth');
// Route::resource('detail_ticket-admin', DashboardController::class);
// Route::get('admin_ticket_detail/{id}/edit', [DashboardController::class, 'edit'])->name('admin_ticket_detail.edit');
// Route::put('/assign-ticket/{ticket}', [TicketController::class, 'assign'])->name('assign.ticket');

// // Route to load chat messages
// Route::get('/chat/{ticketId}', [ChatController::class, 'index'])->name('chat.index');

// // Route to send chat messages
// Route::post('/chat/{ticketId}', [ChatController::class, 'store'])->name('chat.store');
