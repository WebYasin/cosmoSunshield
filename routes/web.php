<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLogin as AdminLogin;
use App\Http\Controllers\admin\Backend as Backend;
use App\Http\Controllers\admin\Setting as Setting;
use App\Http\Controllers\admin\Store as Store;
use App\Http\Controllers\admin\Home as Home;
use App\Http\Controllers\admin\Module as Module;
use App\Http\Controllers\admin\Solution as Solution;
use App\Http\Controllers\admin\About as About;
use App\Http\Controllers\admin\Career as Career;
use App\Http\Controllers\admin\Quality as Quality;
use App\Http\Controllers\admin\Sustainability as Sustainability;
use App\Http\Controllers\admin\Product as Product;
use App\Http\Controllers\admin\Gallery as Gallery;
use App\Http\Controllers\admin\Manufacturing as Manufacturing;
use App\Http\Controllers\admin\Dealer as Dealer;
use App\Http\Controllers\admin\Enquiry as Enquiry;

use App\Http\Controllers\Frontend;




use Illuminate\Http\Request;

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
// Frontend controller
Route::get('/', [Frontend::class,'index']);
Route::get('home', [Frontend::class,'index']);
Route::get('about-us', [Frontend::class,'aboutUs']);
Route::get('blogs', [Frontend::class,'blogs']);
Route::get('blog-details/{id}', [Frontend::class,'blogDetails']);
Route::get('contact-us', [Frontend::class,'contactUs']);
Route::get('leadership', [Frontend::class,'leaderShip']);
Route::get('life-at-cosmo-sunshield', [Frontend::class,'lifeAtCosmo']);
Route::get('openings', [Frontend::class,'openings']);
Route::get('job-details/{id}', [Frontend::class,'jobDetails']);
Route::get('manufacturing', [Frontend::class,'manufacturing']);
Route::get('quality-assurance', [Frontend::class,'qualityAssurance']);
Route::get('sustainability', [Frontend::class,'sustainability']);
Route::get('join-our-dealer-network', [Frontend::class,'joinDealerNetwork']);
Route::post('searchData', [Frontend::class,'searchData']);
Route::post('jobApplied', [Frontend::class,'jobApplied']);
Route::post('joinDealer', [Frontend::class,'joinDealer']);
Route::post('enquiry', [Frontend::class,'ContactEnquiry']);





//ADMIN CONTROLLER

// Admin Login controller
Route::get('/admin_console',[AdminLogin::class,'index']);
Route::post('admin_console/verify_',[AdminLogin::class,'verify']);

// backend controller
Route::get('admin', [Backend::class,'index'])->middleware('adminAuth');
Route::get('admin/dashboard', [Backend::class,'index'])->middleware('adminAuth');
Route::post('admin/dashboard', [Backend::class,'index'])->middleware('adminAuth');
Route::get('admin/logout', [Backend::class,'logout']);


// Setting controller
Route::get('admin/user_group',[Setting::class,'user_group']);
Route::match(['get', 'post'], 'admin/add_user_group', [Setting::class,'add_user_group']);
Route::match(['get', 'post'], 'admin/add_user_group/{id}', [Setting::class,'add_user_group']);
Route::post('admin/delete_user_group',[Setting::class,'delete_user_group']);


Route::get('admin/menu',[Setting::class,'menu'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_menu', [Setting::class,'add_menu']);
Route::match(['get', 'post'], 'admin/add_menu/{id}', [Setting::class,'add_menu']);
Route::post('admin/delete_menu',[Setting::class,'delete_menu'])->middleware('adminAuth');

Route::get('admin/front_menu',[Setting::class,'front_menu'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_front_menu', [Setting::class,'add_front_menu']);
Route::match(['get', 'post'], 'admin/add_front_menu/{id}', [Setting::class,'add_front_menu']);
Route::post('admin/delete_front_menu',[Setting::class,'delete_front_menu'])->middleware('adminAuth');

//SETTING
Route::get('admin/store',[Store::class,'store'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_store', [Store::class,'add_store']);
//UPDATE ADMIN PROFILE
Route::get('admin/profile',[Backend::class,'profile'])->middleware('adminAuth');
Route::post('admin/profile',[Backend::class,'profile'])->middleware('adminAuth');
//ADMIN USER
Route::get('admin/users',[Setting::class,'users']);
Route::match(['get', 'post'], 'admin/add_user', [Setting::class,'add_user']);
Route::match(['get', 'post'], 'admin/add_user/{id}', [Setting::class,'add_user']);
Route::post('admin/delete_users',[Setting::class,'delete_users']);

//HOME HEADING
Route::get('admin/home_heading',[Home::class,'home_heading'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_home_heading', [Home::class,'add_home_heading']);
Route::match(['get', 'post'], 'admin/add_home_heading/{id}', [Home::class,'add_home_heading']);
//HOME BANNER
Route::get('admin/banner',[Home::class,'banner'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_banner', [Home::class,'add_banner']);
Route::match(['get', 'post'], 'admin/add_banner/{id}', [Home::class,'add_banner']);
//home_feature
Route::get('admin/home_feature',[Home::class,'home_feature'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_home_feature', [Home::class,'add_home_feature']);
Route::match(['get', 'post'], 'admin/add_home_feature/{id}', [Home::class,'add_home_feature']);
Route::post('admin/delete_home_feature',[Home::class,'delete_home_feature'])->middleware('adminAuth');

//HOME WHY COSMO SUNSHIELD
Route::get('admin/home_why_cosmo',[Home::class,'home_why_cosmo'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_home_why_cosmo', [Home::class,'add_home_why_cosmo']);
Route::match(['get', 'post'], 'admin/add_home_why_cosmo/{id}', [Home::class,'add_home_why_cosmo']);
Route::post('admin/delete_home_why_cosmo',[Home::class,'delete_home_why_cosmo'])->middleware('adminAuth');

//TESTIMONIAL
Route::get('admin/testimonial',[Module::class,'testimonial'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_testimonial', [Module::class,'add_testimonial']);
Route::match(['get', 'post'], 'admin/add_testimonial/{id}', [Module::class,'add_testimonial']);
Route::post('admin/delete_testimonial',[Module::class,'delete_testimonial'])->middleware('adminAuth');

//BLOG CATEGORY
Route::get('admin/blog_category',[Module::class,'blog_category'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_blog_category', [Module::class,'add_blog_category']);
Route::match(['get', 'post'], 'admin/add_blog_category/{id}', [Module::class,'add_blog_category']);
//BLOGS
Route::get('admin/blogs',[Module::class,'blog'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_blog', [Module::class,'add_blog']);
Route::match(['get', 'post'], 'admin/add_blog/{id}', [Module::class,'add_blog']);
Route::post('admin/delete_blog',[Module::class,'delete_blog'])->middleware('adminAuth');

//SOLUTIONS HEADING
Route::get('admin/solution_heading',[Solution::class,'solution_heading'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_solution_heading', [Solution::class,'add_solution_heading']);
Route::match(['get', 'post'], 'admin/add_solution_heading/{id}', [Solution::class,'add_solution_heading']);
//SOLUTIONS
Route::get('admin/solution',[Solution::class,'solution'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_solution', [Solution::class,'add_solution']);
Route::match(['get', 'post'], 'admin/add_solution/{id}', [Solution::class,'add_solution']);
Route::post('admin/delete_solution',[Solution::class,'delete_solution'])->middleware('adminAuth');


//ABOUT HEADINGS
Route::get('admin/about_heading',[About::class,'about_heading'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_about_heading', [About::class,'add_about_heading']);
Route::match(['get', 'post'], 'admin/add_about_heading/{id}', [About::class,'add_about_heading']);

//ABOUT OUR VALUES
Route::get('admin/values',[About::class,'values'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_value', [About::class,'add_value']);
Route::match(['get', 'post'], 'admin/add_value/{id}', [About::class,'add_value']);
Route::post('admin/delete_value',[About::class,'delete_value'])->middleware('adminAuth');

//ABOUT SHIELD
Route::get('admin/shield',[About::class,'shield'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_shield', [About::class,'add_shield']);
Route::match(['get', 'post'], 'admin/add_shield/{id}', [About::class,'add_shield']);
Route::post('admin/delete_shield',[About::class,'delete_shield'])->middleware('adminAuth');


//ABOUT TEAM HEADINGS
Route::get('admin/about_team_heading',[About::class,'about_team_heading'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_about_team_heading', [About::class,'add_about_team_heading']);
Route::match(['get', 'post'], 'admin/add_about_team_heading/{id}', [About::class,'add_about_team_heading']);

//ABOUT TEAM
Route::get('admin/team',[About::class,'team'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_team', [About::class,'add_team']);
Route::match(['get', 'post'], 'admin/add_team/{id}', [About::class,'add_team']);
Route::post('admin/delete_team',[About::class,'delete_team'])->middleware('adminAuth');


//CAREER HEADING
Route::get('admin/career_heading',[Career::class,'career_heading'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_career_heading', [Career::class,'add_career_heading']);
Route::match(['get', 'post'], 'admin/add_career_heading/{id}', [Career::class,'add_career_heading']);

//CAREER CATEGORY
Route::get('admin/career_category',[Career::class,'career_category'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_career_category', [Career::class,'add_career_category']);
Route::match(['get', 'post'], 'admin/add_career_category/{id}', [Career::class,'add_career_category']);

//CAREER
Route::get('admin/career',[Career::class,'career'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_career', [Career::class,'add_career']);
Route::match(['get', 'post'], 'admin/add_career/{id}', [Career::class,'add_career']);

//CAREER GALLERY
Route::get('admin/career_gallery',[Career::class,'career_gallery'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_career_gallery', [Career::class,'add_career_gallery']);
Route::match(['get', 'post'], 'admin/add_career_gallery/{id}', [Career::class,'add_career_gallery']);
Route::post('admin/delete_career_gallery',[Career::class,'delete_career_gallery'])->middleware('adminAuth');

//Quality
Route::get('admin/quality',[Quality::class,'quality'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_quality', [Quality::class,'add_quality']);
Route::match(['get', 'post'], 'admin/add_quality/{id}', [Quality::class,'add_quality']);
Route::post('admin/delete_quality',[Quality::class,'delete_quality'])->middleware('adminAuth');
//Quality HEADING
Route::get('admin/quality_heading',[Quality::class,'quality_heading'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_quality_heading', [Quality::class,'add_quality_heading']);
Route::match(['get', 'post'], 'admin/add_quality_heading/{id}', [Quality::class,'add_quality_heading']);

//Quality Industry Associations
Route::get('admin/quality_industry_association',[Quality::class,'quality_industry_association'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_quality_industry_association', [Quality::class,'add_quality_industry_association']);
Route::match(['get', 'post'], 'admin/add_quality_industry_association/{id}', [Quality::class,'add_quality_industry_association']);
Route::post('admin/delete_quality_industry_association',[Quality::class,'delete_quality_industry_association'])->middleware('adminAuth');

//Sustainability HEADING
Route::get('admin/sustainability_heading ',[Sustainability::class,'sustainability_heading'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_sustainability_heading', [Sustainability::class,'add_sustainability_heading']);
Route::match(['get', 'post'], 'admin/add_sustainability_heading/{id}', [Sustainability::class,'add_sustainability_heading']);

//Sustainability
Route::get('admin/sustainability ',[Sustainability::class,'sustainability'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_sustainability', [Sustainability::class,'add_sustainability']);
Route::match(['get', 'post'], 'admin/add_sustainability/{id}', [Sustainability::class,'add_sustainability']);
Route::post('admin/delete_sustainability',[Sustainability::class,'delete_sustainability'])->middleware('adminAuth');

//Sustainability Goal
Route::get('admin/sustainability_goal ',[Sustainability::class,'sustainability_goal'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_sustainability_goal', [Sustainability::class,'add_sustainability_goal']);
Route::match(['get', 'post'], 'admin/add_sustainability_goal/{id}', [Sustainability::class,'add_sustainability_goal']);
Route::post('admin/delete_sustainability_goal',[Sustainability::class,'delete_sustainability_goal'])->middleware('adminAuth');

//PRODUCT CATEGORY
Route::get('admin/product_category ',[Product::class,'product_category'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_product_category', [Product::class,'add_product_category']);
Route::match(['get', 'post'], 'admin/add_product_category/{id}', [Product::class,'add_product_category']);

//Gallery
Route::get('admin/gallery ',[Gallery::class,'gallery'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_gallery', [Gallery::class,'add_gallery']);
Route::match(['get', 'post'], 'admin/add_gallery/{id}', [Gallery::class,'add_gallery']);
Route::post('admin/delete_gallery',[Gallery::class,'delete_gallery'])->middleware('adminAuth');

Route::get('admin/video_gallery ',[Gallery::class,'video_gallery'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_video_gallery', [Gallery::class,'add_video_gallery']);
Route::match(['get', 'post'], 'admin/add_video_gallery/{id}', [Gallery::class,'add_video_gallery']);
Route::post('admin/delete_video_gallery',[Gallery::class,'delete_video_gallery'])->middleware('adminAuth');

//Manufacturing
Route::get('admin/manufacturing ',[Manufacturing::class,'manufacturing'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_manufacturing', [Manufacturing::class,'add_manufacturing']);
Route::match(['get', 'post'], 'admin/add_manufacturing/{id}', [Manufacturing::class,'add_manufacturing']);
Route::post('admin/delete_manufacturing',[Manufacturing::class,'delete_manufacturing'])->middleware('adminAuth');

//Manufacturing Heading
Route::get('admin/manufacturing_heading ',[Manufacturing::class,'manufacturing_heading'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_manufacturing_heading', [Manufacturing::class,'add_manufacturing_heading']);
Route::match(['get', 'post'], 'admin/add_manufacturing_heading/{id}', [Manufacturing::class,'add_manufacturing_heading']);

//Dealer Heading
Route::get('admin/dealer_network_heading ',[Dealer::class,'dealer_network_heading'])->middleware('adminAuth');
Route::match(['get', 'post'], 'admin/add_dealer_network_heading', [Dealer::class,'add_dealer_network_heading']);
Route::match(['get', 'post'], 'admin/add_dealer_network_heading/{id}', [Dealer::class,'add_dealer_network_heading']);

//ENQUIRY
Route::get('admin/job_applied ',[Enquiry::class,'job_applied'])->middleware('adminAuth');
Route::get('admin/join_dealer ',[Enquiry::class,'join_dealer'])->middleware('adminAuth');
Route::get('admin/enquiry ',[Enquiry::class,'Conactenquiry'])->middleware('adminAuth');
