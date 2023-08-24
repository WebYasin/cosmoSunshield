<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeBannerModel;
use App\Models\HomeWhyCosmoModel;
use App\Models\CommonModel;
use App\Models\HomeHeadingModel;
use Illuminate\Support\Facades\session;
use App\Models\SettingModel;
use App\Models\HomeFeatureModel;




class Home extends Controller
{
    public function __construct()
    {
        $this->AdminModel = new CommonModel();
        $default_img = SettingModel::where('key', 'config_icon')->first();
        $this->noImage = $default_img->value;
    }

    //Headings
    function home_heading(Request $request)
    {

        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $data['detail']      = HomeHeadingModel::get();
        $data['page_title']  = 'Home Heading';
        $data['noImage']     = $this->noImage;

        return  view('admin.home.home_heading', $data);
    }

    function add_home_heading(Request $request, $id = false)
    {

        if (!empty($id)) {
            $data['page_title']         = 'Edit Home Heading';
            $data['form_action']        = 'admin/add_home_heading/' . $id;
            $row                        =  HomeHeadingModel::firstWhere('id', $id);
            $data['heading1']           =  $row->heading1;
            $data['description1']       =  $row->description1;
            $data['heading2']           =  $row->heading2;
            $data['description2']       =  $row->description2;
            $data['heading3']           =  $row->heading3;
            $data['heading4']           =  $row->heading4;
            $data['description4']       =  $row->description4;
            $data['image4']             =  $row->image4;
            $data['image4_1']           =  $row->image4_1;
            $data['btn_link4']          =  $row->btn_link4;
            $data['heading5']           =  $row->heading5;
            $data['description5']       =  $row->description5;
            $data['image5']             =  $row->image5;
            $data['btn_link5_1']        =  $row->btn_link5_1;
            $data['btn_link5_2']        =  $row->btn_link5_2;
            $data['heading6']           =  $row->heading6;
            $data['description6']       =  $row->description6;
            $data['heading7']           =  $row->heading7;
            $data['status']             =  $row->status;
        } else {
            $data['page_title']         = 'Add Home Heading';
            $data['form_action']        = 'admin/add_home_heading';
            $data['heading1']           = '';
            $data['description1']       =  '';
            $data['heading2']           = '';
            $data['description2']       =  '';
            $data['heading3']           =  '';
            $data['heading4']           =  '';
            $data['description4']       =  '';
            $data['image4']             =  '';
            $data['image4_1']           =  '';
            $data['btn_link4']          = '';
            $data['heading5']           =  '';
            $data['description5']       =  '';
            $data['image5']             =  '';
            $data['btn_link5_1']        =  '';
            $data['btn_link5_2']        =  '';
            $data['heading6']           =  '';
            $data['description6']       =  '';
            $data['heading7']           =  '';
            $data['status']             =  '';
        }
        if ($request->getMethod() == 'POST') {
            $rules = [
                'heading1'          => 'required',
                'description1'      => 'required',
                'image4'            => 'image|max:1024',
                'image4_1'          => 'image|max:1024',
                'image5'            => 'image|max:1024',
            ];
            $request->validate($rules);

            $save = array();
            $save['heading1']           =  $request->input('heading1');
            $save['description1']       =  $request->input('description1');
            $save['heading2']           =  $request->input('heading2');
            $save['description2']       =  $request->input('description2');
            $save['heading3']           =  $request->input('heading3');
            $save['heading4']           =  $request->input('heading4');
            $save['description4']       =  $request->input('description4');
            $save['btn_link4']          =  $request->input('btn_link4');
            $save['heading5']           =  $request->input('heading5');
            $save['description5']       =  $request->input('description5');
            $save['btn_link5_1']        =  $request->input('btn_link5_1');
            $save['btn_link5_2']        =  $request->input('btn_link5_2');
            $save['heading6']           =  $request->input('heading6');
            $save['description6']       =  $request->input('description6');
            $save['heading7']           =  $request->input('heading7');
            $save['status']             =  $request->input('status');

            if (!empty($request->image4_1)) {
                $imageName = time() . rand() . '.' . $request->image4_1->extension();
                $request->image4_1->move('uploads/images', $imageName);
                $save['image4_1'] = 'uploads/images/' . $imageName;
            }
            if (!empty($request->image4)) {
                $imageName = time() . rand() . '.' . $request->image4->extension();
                $request->image4->move('uploads/images', $imageName);
                $save['image4'] = 'uploads/images/' . $imageName;
            }
            if (!empty($request->image5)) {
                $imageName = time() . rand() . '.' . $request->image5->extension();
                $request->image5->move('uploads/images', $imageName);
                $save['image5'] = 'uploads/images/' . $imageName;
            }

            if ($id) {
                $save['modify_date'] =  date('Y-m-d');
                $result = HomeHeadingModel::where('id', $id)->update($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');

                $result =  HomeHeadingModel::insertGetId($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.home.add_home_heading', $data);
    }

    function home_feature(Request $request)
    {

        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $data['detail']      = HomeFeatureModel::get();
        $data['page_title']  = 'Home Feature List';
        $data['noImage']     = $this->noImage;

        return  view('admin.home.home_feature', $data);
    }

    function add_home_feature(Request $request, $id = false)
    {

        if (!empty($id)) {
            $data['page_title']         = 'Edit Home Feature';
            $data['form_action']        = 'admin/add_home_feature/' . $id;
            $row                        =  HomeFeatureModel::firstWhere('id', $id);
            $data['title']              =  $row->title;
            $data['image']              =  $row->image;
            $data['sort_order']         =  $row->sort_order;
            $data['status']             =  $row->status;
        } else {
            $data['page_title']         = 'Add Home Feature';
            $data['form_action']        = 'admin/add_home_feature';
            $data['title']              = '';
            $data['image']              = '';
            $data['sort_order']         = '';
            $data['status']             = '';
        }
        if ($request->getMethod() == 'POST') {
            $rules = [
                'title'          => 'required',
                'image'          => 'image|max:1024'
            ];
            $request->validate($rules);

            $save = array();
            $save['title']              =  $request->input('title');
            $save['sort_order']         =  $request->input('sort_order');
            $save['status']             =  $request->input('status');


            if (!empty($request->image)) {
                $imageName = time() . rand() . '.' . $request->image->extension();
                $request->image->move('uploads/images', $imageName);
                $save['image'] = 'uploads/images/' . $imageName;
            }



            if ($id) {
                $save['modify_date'] =  date('Y-m-d');
                $result = HomeFeatureModel::where('id', $id)->update($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');

                $result =  HomeFeatureModel::insertGetId($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.home.add_home_feature', $data);
    }

    function delete_home_feature(Request $request)
    {
        $ids = $request->input('selected');
        if ($ids) {
            foreach ($ids as $value) {
                HomeFeatureModel::where('id', $value)->delete();
            }
            return redirect()->back()->with('success', 'Record Delete successfully!');
        }
    }

    function banner(Request $request)
    {

        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $data['detail']      = HomeBannerModel::get();
        $data['page_title']  = 'Banner List';
        return  view('admin.home.banner', $data);
    }

    function add_banner(Request $request, $id = false)
    {
        if (!empty($id)) {
            $data['page_title']     = 'Edit Banner';
            $data['form_action']    = 'admin/add_banner/' . $id;
            $row =  HomeBannerModel::firstWhere('id', $id);
            $data['title']      =  $row->title;
            $data['content']    =  $row->content;
            $data['video']      =  $row->video;
            $data['btn_name']   =  $row->btn_name;
            $data['btn_link']   =  $row->btn_link;
            $data['status']     =  $row->status;
        } else {
            $data['page_title']     = 'Add Banner';
            $data['form_action']    = 'admin/add_banner';
            $data['title']          = '';
            $data['content']        = '';
            $data['video']          = '';
            $data['btn_name']       = '';
            $data['btn_link']       = '';
            $data['status']         = '';
        }
        if ($request->getMethod() == 'POST') {
            $rules = [
                'title' => 'required',
                'content' => 'required',
            ];
            $request->validate($rules);

            $save = array();
            $save['title']        =  $request->input('title');
            $save['content']      =  $request->input('content');
            $save['btn_link']     =  $request->input('btn_link');
            $save['btn_name']     =  $request->input('btn_name');
            $save['status']       =  $request->input('status');


            if (!empty($request->video)) {
                $imageName = time() . '.' . $request->video->extension();
                $request->video->move('uploads/images', $imageName);
                $save['video'] = 'uploads/images/' . $imageName;
            }

            if ($id) {

                $save['modify_date'] =  date('Y-m-d');
                $result = HomeBannerModel::where('id', $id)->update($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');
                // print_r($save);exit();
                $result = HomeBannerModel::create($save);
                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.home.add_banner', $data);
    }

    function home_why_cosmo(Request $request)
    {

        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $data['detail']      = HomeWhyCosmoModel::get();
        $data['page_title']  = 'Why Cosmo Sunshield';
        return  view('admin.home.home_why_cosmo', $data);
    }

    function add_home_why_cosmo(Request $request, $id = false)
    {
        if (!empty($id)) {
            $data['page_title']     = 'Edit Why Cosmo Sunshield';
            $data['form_action']    = 'admin/add_home_why_cosmo/' . $id;
            $row =  HomeWhyCosmoModel::firstWhere('id', $id);
            $data['title']      =  $row->title;
            $data['content']    =  $row->content;
            $data['image']      =  $row->image;
            $data['icon']       =  $row->icon;
            $data['sort_order'] =  $row->sort_order;
            $data['status']     =  $row->status;
        } else {
            $data['page_title']     = 'Add Why Cosmo Sunshield';
            $data['form_action']    = 'admin/add_home_why_cosmo';
            $data['title']          = '';
            $data['content']        = '';
            $data['image']          = '';
            $data['icon']           = '';
            $data['sort_order']     = '';
            $data['status']         = '';
        }
        if ($request->getMethod() == 'POST') {
            $rules = [
                'title' => 'required',
                'content' => 'required',
            ];
            $request->validate($rules);

            $save = array();
            $save['title']        =  $request->input('title');
            $save['content']      =  $request->input('content');
            $save['sort_order']   =  $request->input('sort_order');
            $save['status']       =  $request->input('status');


            if (!empty($request->image)) {
                $imageName = time() .rand(). '.' . $request->image->extension();
                $request->image->move('uploads/images', $imageName);
                $save['image'] = 'uploads/images/' . $imageName;
            }
            if (!empty($request->icon)) {
                $imageName = time() .rand(). '.' . $request->icon->extension();
                $request->icon->move('uploads/images', $imageName);
                $save['icon'] = 'uploads/images/' . $imageName;
            }

            if ($id) {

                $save['modify_date'] =  date('Y-m-d');
                $result = HomeWhyCosmoModel::where('id', $id)->update($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');
                // print_r($save);exit();
                $result = HomeWhyCosmoModel::create($save);
                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.home.add_home_why_cosmo', $data);
    }

    function delete_home_why_cosmo(Request $request){
        $ids = $request->input('selected');
        if($ids){
        foreach($ids as $value){
            HomeWhyCosmoModel::where('id',$value)->delete();
        }
        return redirect()->back()->with('success', 'Record Delete successfully!');
       }

     }
    //conteoller end here
}
