<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutValueModel;
use App\Models\AboutTeamModel;
use App\Models\CommonModel;
use App\Models\SettingModel;
use App\Models\AboutTeamHeadingModel;
use App\Models\AboutHeadingModel;
use App\Models\AboutShieldModel;





class About extends Controller
{
    public function __construct()
    {
        $this->AdminModel = new CommonModel();
        $default_img = SettingModel::where('key', 'config_icon')->first();
        $this->noImage = $default_img->value;
    }
    //Headings
    function about_heading(Request $request)
    {

        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $data['detail']      = AboutHeadingModel::get();
        $data['page_title']  = 'About Heading';
        $data['noImage']     = $this->noImage;

        return  view('admin.about.about_heading', $data);
    }

    function add_about_heading(Request $request, $id = false)
    {

        if (!empty($id)) {
            $data['page_title']         = 'Edit About Heading';
            $data['form_action']        = 'admin/add_about_heading/' . $id;
            $row                        =  AboutHeadingModel::firstWhere('id', $id);
            $data['heading1']           =  $row->heading1;
            $data['description1']       =  $row->description1;
            $data['image1']             =  $row->image1;
            $data['heading2']           =  $row->heading2;
            $data['description2']       =  $row->description2;
            $data['image2']             =  $row->image2;
            $data['short_description2'] =  $row->short_description2;
            $data['video2']             =  $row->video2;
            $data['video_thumbnail']    =  $row->video_thumbnail;
            $data['heading3']           =  $row->heading3;
            $data['description3']       =  $row->description3;
            $data['heading4']           =  $row->heading4;
            $data['description4']       =  $row->description4;
            $data['image4']             =  $row->image4;
            $data['heading5']           =  $row->heading5;
            $data['description5']       =  $row->description5;
            $data['image5']             =  $row->image5;
            $data['status']             =  $row->status;
        } else {
            $data['page_title']         = 'Add About Heading';
            $data['form_action']        = 'admin/add_about_heading';
            $data['heading1']           = '';
            $data['description1']       =  '';
            $data['image1']             =  '';
            $data['heading2']           =  '';
            $data['description2']       =  '';
            $data['image2']             =  '';
            $data['short_description2'] =  '';
            $data['video2']             =  '';
            $data['video_thumbnail']    =  '';
            $data['heading3']           =  '';
            $data['description3']       =  '';
            $data['heading4']           =  '';
            $data['description4']       =  '';
            $data['image4']             =  '';
            $data['heading5']           =  '';
            $data['description5']       =  '';
            $data['image5']             =  '';
            $data['status']             =  '';
        }
        if ($request->getMethod() == 'POST') {
            $rules = [
                'heading1'          => 'required',
                'description1'      => 'required',
                'image1'            => 'image|max:1024',
                'image2'            => 'image|max:1024',
                'video_thumbnail'   => 'image|max:1024',
                'video2'            => 'mimes:mp4|max:10240',
                'image4'            => 'image|max:1024',
                'image5'            => 'image|max:1024',
            ];
            $request->validate($rules);

            $save = array();
            $save['heading1']           =  $request->input('heading1');
            $save['description1']       =  $request->input('description1');
            $save['heading2']           =  $request->input('heading2');
            $save['short_description2'] =  $request->input('short_description2');
            $save['description2']       =  $request->input('description2');
            $save['heading3']           =  $request->input('heading3');
            $save['description3']       =  $request->input('description3');
            $save['heading4']           =  $request->input('heading4');
            $save['description4']       =  $request->input('description4');
            $save['heading5']           =  $request->input('heading5');
            $save['description5']       =  $request->input('description5');
            $save['status']             =  $request->input('status');

            if (!empty($request->image1)) {
                $imageName = time() . rand() . '.' . $request->image1->extension();
                $request->image1->move('uploads/images', $imageName);
                $save['image1'] = 'uploads/images/' . $imageName;
            }
            if (!empty($request->image2)) {
                $imageName = time() . rand() . '.' . $request->image2->extension();
                $request->image2->move('uploads/images', $imageName);
                $save['image2'] = 'uploads/images/' . $imageName;
            }
            if (!empty($request->video2)) {
                $imageName = time() . rand() . '.' . $request->video2->extension();
                $request->video2->move('uploads/images', $imageName);
                $save['video2'] = 'uploads/images/' . $imageName;
            }
            if (!empty($request->video_thumbnail)) {
                $imageName = time() . rand() . '.' . $request->video_thumbnail->extension();
                $request->video_thumbnail->move('uploads/images', $imageName);
                $save['video_thumbnail'] = 'uploads/images/' . $imageName;
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
                $result = AboutHeadingModel::where('id', $id)->update($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');

                $result =  AboutHeadingModel::insertGetId($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.about.add_about_heading', $data);
    }

    //Headings
    function about_team_heading(Request $request)
    {

        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $data['detail']      = AboutTeamHeadingModel::get();
        $data['page_title']  = 'Team Heading';
        $data['noImage']     = $this->noImage;

        return  view('admin.about.about_team_heading', $data);
    }

    function add_about_team_heading(Request $request, $id = false)
    {

        if (!empty($id)) {
            $data['page_title']         = 'Edit Team Heading';
            $data['form_action']        = 'admin/add_about_team_heading/' . $id;
            $row                        =  AboutTeamHeadingModel::firstWhere('id', $id);
            $data['heading1']           =  $row->heading1;
            $data['description1']       =  $row->description1;
            $data['name1']              =  $row->name1;
            $data['designation1']       =  $row->designation1;
            $data['image']             =  $row->image;
            $data['status']             =  $row->status;
        } else {
            $data['page_title']         = 'Add Team Heading';
            $data['form_action']        = 'admin/add_about_team_heading';
            $data['heading1']           = '';
            $data['description1']       = '';
            $data['name1']              = '';
            $data['designation1']       = '';
            $data['image']             = '';
            $data['status']             = '';
        }
        if ($request->getMethod() == 'POST') {
            $rules = [
                'heading1'          => 'required',
                'description1'      => 'required',
                'name1'             => 'required',
                'designation1'      => 'required',
            ];
            $request->validate($rules);

            $save = array();
            $save['heading1']           =  $request->input('heading1');
            $save['description1']       =  $request->input('description1');
            $save['name1']              =  $request->input('name1');
            $save['designation1']       =  $request->input('designation1');
            $save['status']             =  $request->input('status');

            if (!empty($request->image)) {
                $imageName = time() . rand() . '.' . $request->image->extension();
                $request->image->move('uploads/images', $imageName);
                $save['image'] = 'uploads/images/' . $imageName;
            }


            if ($id) {
                $save['modify_date'] =  date('Y-m-d');
                $result = AboutTeamHeadingModel::where('id', $id)->update($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');

                $result =  AboutTeamHeadingModel::insertGetId($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.about.add_about_team_heading', $data);
    }
    //

    function shield(Request $request)
    {

        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $data['detail']      = AboutShieldModel::get();
        $data['page_title']  = 'Shield List';
        $data['noImage']     = $this->noImage;

        return  view('admin.about.shield', $data);
    }

    function add_shield(Request $request, $id = false)
    {

        if (!empty($id)) {
            $data['page_title']         = 'Edit Shield';
            $data['form_action']        = 'admin/add_shield/' . $id;
            $row                        =  AboutShieldModel::firstWhere('id', $id);
            $data['title']               =  $row->title;
            $data['description']        =  $row->description;
            $data['sort_order']         =  $row->sort_order;
            $data['status']             =  $row->status;
        } else {
            $data['page_title']         = 'Add Shield';
            $data['form_action']        = 'admin/add_shield';
            $data['title']              = '';
            $data['description']        = '';
            $data['sort_order']         = '';
            $data['status']             = '';
        }
        if ($request->getMethod() == 'POST') {
            $rules = [
                'title'          => 'required',
                'description'   => 'required',
            ];
            $request->validate($rules);

            $save = array();
            $save['title']              =  $request->input('title');
            $save['description']        =  $request->input('description');
            $save['sort_order']         =  $request->input('sort_order');
            $save['status']             =  $request->input('status');




            if ($id) {
                $saveDetails['solution_id']      = $id;
                $save['modify_date'] =  date('Y-m-d');
                $result = AboutShieldModel::where('id', $id)->update($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');

                $result =  AboutShieldModel::insertGetId($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.about.add_shield', $data);
    }

    function delete_shield(Request $request)
    {
        $ids = $request->input('selected');
        if ($ids) {
            foreach ($ids as $value) {
                AboutShieldModel::where('id', $value)->delete();
            }
            return redirect()->back()->with('success', 'Record Delete successfully!');
        }
    }

    function values(Request $request)
    {

        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $data['detail']      = AboutValueModel::get();
        $data['page_title']  = 'Values List';
        $data['noImage']     = $this->noImage;

        return  view('admin.about.values', $data);
    }

    function add_value(Request $request, $id = false)
    {

        if (!empty($id)) {
            $data['page_title']         = 'Edit Value';
            $data['form_action']        = 'admin/add_value/' . $id;
            $row                        =  AboutValueModel::firstWhere('id', $id);
            $data['title']               =  $row->title;
            $data['description']        =  $row->description;
            $data['image']              =  $row->image;
            $data['sort_order']         =  $row->sort_order;
            $data['status']             =  $row->status;
        } else {
            $data['page_title']         = 'Add Value';
            $data['form_action']        = 'admin/add_value';
            $data['title']              = '';
            $data['description']        = '';
            $data['image']              = '';
            $data['sort_order']         = '';
            $data['status']             = '';
        }
        if ($request->getMethod() == 'POST') {
            $rules = [
                'title'          => 'required',
                'description'   => 'required',
                'image'          => 'image|max:1024'
            ];
            $request->validate($rules);

            $save = array();
            $save['title']              =  $request->input('title');
            $save['description']        =  $request->input('description');
            $save['sort_order']         =  $request->input('sort_order');
            $save['status']             =  $request->input('status');


            if (!empty($request->image)) {
                $imageName = time() . rand() . '.' . $request->image->extension();
                $request->image->move('uploads/images', $imageName);
                $save['image'] = 'uploads/images/' . $imageName;
            }



            if ($id) {
                $saveDetails['solution_id']      = $id;
                $save['modify_date'] =  date('Y-m-d');
                $result = AboutValueModel::where('id', $id)->update($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');

                $result =  AboutValueModel::insertGetId($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.about.add_value', $data);
    }

    function delete_value(Request $request)
    {
        $ids = $request->input('selected');
        if ($ids) {
            foreach ($ids as $value) {
                AboutValueModel::where('id', $value)->delete();
            }
            return redirect()->back()->with('success', 'Record Delete successfully!');
        }
    }


    //team

    function team(Request $request)
    {

        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $data['detail']      = AboutTeamModel::get();
        $data['page_title']  = 'Team List';
        $data['noImage']     = $this->noImage;

        return  view('admin.about.team', $data);
    }

    function add_team(Request $request, $id = false)
    {

        if (!empty($id)) {
            $data['page_title']         = 'Edit Value';
            $data['form_action']        = 'admin/add_team/' . $id;
            $row                        =  AboutTeamModel::firstWhere('id', $id);
            $data['title']              =  $row->title;
            $data['designation']        =  $row->designation;
            $data['description']        =  $row->description;
            $data['thumbnail']          =  $row->thumbnail;
            $data['image']              =  $row->image;
            $data['sort_order']         =  $row->sort_order;
            $data['status']             =  $row->status;
            $data['show_on_top']        =  $row->show_on_top;
        } else {
            $data['page_title']         = 'Add Value';
            $data['form_action']        = 'admin/add_team';
            $data['title']              = '';
            $data['designation']        = '';
            $data['description']        = '';
            $data['image']              = '';
            $data['thumbnail']          = '';
            $data['sort_order']         = '';
            $data['status']             = '';
            $data['show_on_top']        = '';
        }
        if ($request->getMethod() == 'POST') {
            $rules = [
                'title'          => 'required',
                'designation'    => 'required',
                'image'          => 'image|max:1024'
            ];
            $request->validate($rules);

            $save = array();
            $save['title']              =  $request->input('title');
            $save['designation']        =  $request->input('designation');
            $save['description']        =  $request->input('description');
            $save['sort_order']         =  $request->input('sort_order');
            $save['status']             =  $request->input('status');
            $save['show_on_top']        =  $request->input('show_on_top') ? $request->input('show_on_top') : 0;


            if (!empty($request->image)) {
                $imageName = time() . rand() . '.' . $request->image->extension();
                $request->image->move('uploads/images', $imageName);
                $save['image'] = 'uploads/images/' . $imageName;
            }
            if (!empty($request->thumbnail)) {
                $imageName = time() . rand() . '.' . $request->thumbnail->extension();
                $request->thumbnail->move('uploads/images', $imageName);
                $save['thumbnail'] = 'uploads/images/' . $imageName;
            }



            if ($id) {
                $saveDetails['solution_id']      = $id;
                $save['modify_date'] =  date('Y-m-d');
                $result = AboutTeamModel::where('id', $id)->update($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');

                $result =  AboutTeamModel::insertGetId($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.about.add_team', $data);
    }

    function delete_team(Request $request)
    {
        $ids = $request->input('selected');
        if ($ids) {
            foreach ($ids as $value) {
                AboutTeamModel::where('id', $value)->delete();
            }
            return redirect()->back()->with('success', 'Record Delete successfully!');
        }
    }
}
