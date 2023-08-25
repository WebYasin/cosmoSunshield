<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SettingModel;



class Frontend extends Controller
{
    public function __construct()
    {
        $default_img = SettingModel::where('key', 'config_icon')->first();
        $this->noImage = $default_img->value;
    }
    function index()
    {

        $data['page_title']             = 'Home | Cosmo Sunshield';
        $data['home_banner']            = DB::table('home_banner')->where('status', 1)->first();
        $data['fetch_heading']          = DB::table('home_heading')->where('status', 1)->first();
        $data['all_home_why_cosmo']     = DB::table('home_why_cosmo')->where('status', 1)->orderBy('sort_order', 'ASC')->get();
        $data['all_blogs']              = DB::table('blogs')->where([['status', '=', 1], ['show_on_home', '=', 1]])->orderBy('publish_date', 'DESC')->get();
        $data['all_home_feature']       = DB::table('home_feature')->where([['status', '=', 1]])->orderBy('sort_order', 'ASC')->get();
        $data['all_product']            = DB::table('product_category')->where([['status', '=', 1], ['show_on_home', '=', 1]])->orderBy('sort_order', 'ASC')->get();
        $data['all_solution']           = DB::table('solution')->where('status', 1)->orderBy('sort_order', 'ASC')->get();
        $data['all_testimonial']        = DB::table('testimonial')->where('status', 1)->orderBy('sort_order', 'ASC')->get();
        $data['noImage']                = $this->noImage;

        return view('frontend.index', $data);
    }
    function aboutUs(Request $request)
    {
        $path = $request->path();
        $data['fetch_banner']           = DB::table('front_menu')->where([['status', 1], ['link', $path]])->first();
        $data['fetch_heading']          = DB::table('about_heading')->where([['status', 1]])->first();
        $data['all_value']              = DB::table('about_value')->where('status', 1)->orderBy('sort_order', 'ASC')->get();
        $data['all_about_shield']       = DB::table('about_shield')->where('status', 1)->orderBy('sort_order', 'ASC')->get();

        $data['page_title']             = $data['fetch_banner']->metaTitle;
        $data['metaTitle']                 = $data['fetch_banner']->metaTitle;
        $data['metaKeyword']             = $data['fetch_banner']->metaKeyword;
        $data['metaDescription']         = $data['fetch_banner']->metaDescription;
        $data['noImage']                = $this->noImage;

        return view('frontend.about-us', $data);
    }
    function blogs(Request $request)
    {
        $path = $request->path();
        $data['fetch_banner']           = DB::table('front_menu')->where([['status', 1], ['link', $path]])->first();
        $data['fetch_heading']          = DB::table('about_heading')->where([['status', 1]])->first();
        $data['all_feature_blog']       = DB::table('blogs')->where(array('status' => 1, 'featured' => 1))->orderBy('publish_date', 'DESC')->get();
        $data['all_blogs']              = DB::table('blogs')->join('blog_category', 'blog_category.id', '=', 'blogs.cat_id')->select('blogs.*', 'blog_category.name as category_name')->where('blogs.status', 1)->orderBy('blogs.publish_date', 'DESC')->paginate(9);

        $data['page_title']             = $data['fetch_banner']->metaTitle;
        $data['metaTitle']                 = $data['fetch_banner']->metaTitle;
        $data['metaKeyword']             = $data['fetch_banner']->metaKeyword;
        $data['metaDescription']         = $data['fetch_banner']->metaDescription;
        $data['noImage']                = $this->noImage;

        return view('frontend.blogs', $data);
    }

    function blogDetails(Request $request, $path)
    {

        $data['fetch_blog']             = DB::table('blogs')->where([['status', 1], ['slug', $path]])->first();
        $data['all_related_blog']       = DB::table('blogs')->join('blog_category', 'blog_category.id', '=', 'blogs.cat_id')->select('blogs.*', 'blog_category.name as category_name')->where('blogs.status', 1)->orderBy('blogs.publish_date', 'DESC')->limit(3)->get();
        $data['page_title']             = $data['fetch_blog']->meta_title;
        $data['metaTitle']                 = $data['fetch_blog']->meta_title;
        $data['metaKeyword']             = $data['fetch_blog']->meta_title;
        $data['metaDescription']         = $data['fetch_blog']->meta_title;
        $data['noImage']                = $this->noImage;

        return view('frontend.blog-detail', $data);
    }

    function contactUs(Request $request)
    {
        $path = $request->path();
        $data['fetch_banner']           = DB::table('front_menu')->where([['status', 1], ['link', $path]])->first();
        $data['fetch_heading']          = DB::table('about_heading')->where([['status', 1]])->first();
        $data['wconfig']                = websetting();

        $data['page_title']             = $data['fetch_banner']->metaTitle;
        $data['metaTitle']                 = $data['fetch_banner']->metaTitle;
        $data['metaKeyword']             = $data['fetch_banner']->metaKeyword;
        $data['metaDescription']         = $data['fetch_banner']->metaDescription;
        $data['noImage']                = $this->noImage;

        return view('frontend.contact-us', $data);
    }


    function joinDealerNetwork(Request $request)
    {
        $path = $request->path();
        $data['fetch_banner']           = DB::table('front_menu')->where([['status', 1], ['link', $path]])->first();
        $data['fetch_heading']          = DB::table('dealer_network_heading')->where([['status', 1]])->first();
        $data['wconfig']                = websetting();

        $data['page_title']             = $data['fetch_banner']->metaTitle;
        $data['metaTitle']                 = $data['fetch_banner']->metaTitle;
        $data['metaKeyword']             = $data['fetch_banner']->metaKeyword;
        $data['metaDescription']         = $data['fetch_banner']->metaDescription;
        $data['noImage']                = $this->noImage;

        return view('frontend.join-our-dealer-network', $data);
    }

    function leaderShip(Request $request)
    {
        $path = $request->path();
        $data['fetch_banner']           = DB::table('front_menu')->where([['status', 1], ['link', $path]])->first();
        $data['fetch_heading']          = DB::table('about_team_heading')->where([['status', 1]])->first();
        $data['all_team']               = DB::table('about_team')->where(array('status' => 1))->orderBy('sort_order', 'ASC')->get();
        $data['page_title']             = $data['fetch_banner']->metaTitle;
        $data['metaTitle']                 = $data['fetch_banner']->metaTitle;
        $data['metaKeyword']             = $data['fetch_banner']->metaKeyword;
        $data['metaDescription']         = $data['fetch_banner']->metaDescription;
        $data['noImage']                = $this->noImage;

        return view('frontend.leadership', $data);
    }

    function lifeAtCosmo(Request $request)
    {
        $path = $request->path();
        $data['fetch_banner']           = DB::table('front_menu')->where([['status', 1], ['link', $path]])->first();
        $data['fetch_heading']          = DB::table('career_heading')->where([['status', 1]])->first();
        $data['all_gallery']            = DB::table('careergalleries')->where(array('status' => 1))->orderBy('sort_order', 'ASC')->get();
        $data['all_jobs']               = DB::table('careers')->where(array('status' => 1, 'show_in_career' => 1))->orderBy('sort_order', 'ASC')->get();
        $data['page_title']             = $data['fetch_banner']->metaTitle;
        $data['metaTitle']                 = $data['fetch_banner']->metaTitle;
        $data['metaKeyword']             = $data['fetch_banner']->metaKeyword;
        $data['metaDescription']         = $data['fetch_banner']->metaDescription;
        $data['noImage']                = $this->noImage;

        return view('frontend.life-at-cosmo-sunsheild', $data);
    }
    function openings(Request $request)
    {
        $path                           = $request->path();
        $data['fetch_banner']           = DB::table('front_menu')->where([['status', 1], ['link', $path]])->first();
        $data['all_jobs']               = DB::table('careers')->where(array('status' => 1))->orderBy('sort_order', 'ASC')->get();
        $data['page_title']             = $data['fetch_banner']->metaTitle;
        $data['metaTitle']                 = $data['fetch_banner']->metaTitle;
        $data['metaKeyword']             = $data['fetch_banner']->metaKeyword;
        $data['metaDescription']         = $data['fetch_banner']->metaDescription;
        $data['noImage']                = $this->noImage;

        return view('frontend.openings', $data);
    }

    function jobDetails(Request $request, $path)
    {

        $data['fetch_blog']             = DB::table('careers')->join('career_category', 'career_category.id', '=', 'careers.cat_id')->select('careers.*', 'career_category.name as category_name')->where([['careers.status', 1], ['careers.slug', $path]])->first();
        $data['page_title']             = $data['fetch_blog']->metaTitle;
        $data['metaTitle']                 = $data['fetch_blog']->metaTitle;
        $data['metaKeyword']             = $data['fetch_blog']->metaKeyword;
        $data['metaDescription']         = $data['fetch_blog']->metaDescription;
        $data['noImage']                = $this->noImage;

        return view('frontend.job-detail', $data);
    }
    function manufacturing(Request $request)
    {
        $path                           = $request->path();
        $data['fetch_banner']           = DB::table('front_menu')->where([['status', 1], ['link', $path]])->first();
        $data['fetch_heading']          = DB::table('manufacturing_heading')->where([['status', 1]])->first();
        $data['all_manufacturing']      = DB::table('manufacturing')->where(array('status' => 1))->orderBy('sort_order', 'ASC')->get();
        $data['page_title']             = $data['fetch_banner']->metaTitle;
        $data['metaTitle']                 = $data['fetch_banner']->metaTitle;
        $data['metaKeyword']             = $data['fetch_banner']->metaKeyword;
        $data['metaDescription']         = $data['fetch_banner']->metaDescription;
        $data['noImage']                = $this->noImage;

        return view('frontend.manufacturing', $data);
    }

    function qualityAssurance(Request $request)
    {
        $path                           = $request->path();
        $data['fetch_banner']           = DB::table('front_menu')->where([['status', 1], ['link', $path]])->first();
        $data['fetch_heading']          = DB::table('quality_assurance_heading')->where([['status', 1]])->first();
        $data['all_quality_assurance']  = DB::table('quality_assurance')->where(array('status' => 1))->orderBy('sort_order', 'ASC')->get();
        $data['all_quality_industry_association']  = DB::table('quality_industry_association')->where(array('status' => 1))->orderBy('sort_order', 'ASC')->get();
        $data['page_title']             = $data['fetch_banner']->metaTitle;
        $data['metaTitle']                 = $data['fetch_banner']->metaTitle;
        $data['metaKeyword']             = $data['fetch_banner']->metaKeyword;
        $data['metaDescription']         = $data['fetch_banner']->metaDescription;
        $data['noImage']                = $this->noImage;

        return view('frontend.quality-assurance', $data);
    }

    function sustainability(Request $request)
    {
        $path                           = $request->path();
        $data['fetch_banner']           = DB::table('front_menu')->where([['status', 1], ['link', $path]])->first();
        $data['fetch_heading']          = DB::table('sustainability_heading')->where([['status', 1]])->first();
        $data['all_sustainability']     = DB::table('sustainability')->where(array('status' => 1))->orderBy('sort_order', 'ASC')->get();
        $data['all_sustainability_goals']  = DB::table('sustainability_goals')->where(array('status' => 1))->orderBy('sort_order', 'ASC')->get();
        $data['page_title']             = $data['fetch_banner']->metaTitle;
        $data['metaTitle']                 = $data['fetch_banner']->metaTitle;
        $data['metaKeyword']             = $data['fetch_banner']->metaKeyword;
        $data['metaDescription']         = $data['fetch_banner']->metaDescription;
        $data['noImage']                = $this->noImage;

        return view('frontend.sustainability', $data);
    }
    function searchData()
    {
        if ($_POST['search']) {

            $all_blogs      = DB::table('blogs')
                ->where('status', '=', 1)
                ->where('name', 'like', '%' . $_POST['search'] . '%')
                ->orderBy('publish_date', 'DESC')->get();

            if ($all_blogs) {
                foreach ($all_blogs as  $blogs) {

                    $link = url('blog-details/' . $blogs->slug);
                    echo '<li><a href="' . $link . '">' . $blogs->title . '</span></a></li>';
                }
            }
        } else {
            echo '<li>No record found</li>';
        }
    }
    function jobApplied(Request $request)
    {

        if ($request->getMethod() == 'POST') {
            $rules = [
                'name'          => 'required',
                'email'         => 'required',
                'number'        => 'required',
                'applied_for'   => 'required',
            ];
            $request->validate($rules);
            $save = array();
            $save['name']               =  $request->input('name');
            $save['email']              =  $request->input('email');
            $save['number']             =  $request->input('number');
            $save['applied_for']        =  $request->input('applied_for');
            $save['create_date']        =  date('Y-m-d');
            $save['modify_date']        =  date('Y-m-d');

            $result                     = DB::table('job_applied')->insert($save);
            if ($result) {
                return redirect()->back()->with('success', 'Enquiry sent successfully!');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        }

    }

    function joinDealer(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $rules = [
                'first_name'    => 'required',
                'last_name'     => 'required',
                'number'        => 'required',
                'email'         => 'required',
            ];
            $request->validate($rules);
            $save = array();
            $save['first_name']               =  $request->input('first_name');
            $save['last_name']                =  $request->input('last_name');
            $save['number']                   =  $request->input('number');
            $save['email']                    =  $request->input('email');
            $save['business_name']            =  $request->input('business_name');
            $save['business_address']         =  $request->input('business_address');
            $save['business_experience']      =  $request->input('business_experience');
            $save['city']                     =  $request->input('city');
            $save['interest_in']              =  json_encode($request->input('interest_in'));
            $save['create_date']              =  date('Y-m-d');
            $save['modify_date']              =  date('Y-m-d');

            $result                           = DB::table('join_dealer')->insert($save);
            if ($result) {
                return redirect()->back()->with('success', 'Enquiry sent successfully!');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        }
    }
}
