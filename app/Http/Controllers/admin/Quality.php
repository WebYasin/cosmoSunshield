<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CommonModel;
use App\Models\SettingModel;
use App\Models\QualityAssuranceModel;
use App\Models\QualityAssuranceHeadingModel;
use App\Models\QualityIndustryAssociationModel;


use Illuminate\Http\Request;

class Quality extends Controller
{
    public function __construct()
    {
        $this->AdminModel = new CommonModel();
        $default_img = SettingModel::where('key', 'config_icon')->first();
        $this->noImage = $default_img->value;
    }
    //Headings
    function quality_heading(Request $request)
    {

        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $data['detail']      = QualityAssuranceHeadingModel::get();
        $data['page_title']  = 'Quality Heading';
        $data['noImage']     = $this->noImage;

        return  view('admin.quality.quality_heading', $data);
    }

    function add_quality_heading(Request $request, $id = false)
    {

        if (!empty($id)) {
            $data['page_title']         = 'Edit Quality Heading';
            $data['form_action']        = 'admin/add_quality_heading/' . $id;
            $row                        =  QualityAssuranceHeadingModel::firstWhere('id', $id);
            $data['heading1']           =  $row->heading1;
            $data['description1']       =  $row->description1;
            $data['heading2']           =  $row->heading2;
            $data['description2']       =  $row->description2;
            $data['status']             =  $row->status;
        } else {
            $data['page_title']         = 'Add Quality Heading';
            $data['form_action']        = 'admin/add_quality_heading';
            $data['heading1']           = '';
            $data['description1']       =  '';
            $data['heading2']           =  '';
            $data['description2']       =  '';
            $data['status']             =  '';
        }
        if ($request->getMethod() == 'POST') {
            $rules = [
                'heading1'          => 'required',
                'description1'      => 'required',
            ];
            $request->validate($rules);

            $save = array();
            $save['heading1']           =  $request->input('heading1');
            $save['description1']       =  $request->input('description1');
            $save['heading2']           =  $request->input('heading2');
            $save['description2']       =  $request->input('description2');
            $save['status']             =  $request->input('status');


            if ($id) {
                $save['modify_date'] =  date('Y-m-d');
                $result = QualityAssuranceHeadingModel::where('id', $id)->update($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');

                $result =  QualityAssuranceHeadingModel::insertGetId($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.quality.add_quality_heading', $data);
    }

    function quality(Request $request)
    {

        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $data['detail']      = QualityAssuranceModel::get();
        $data['page_title']  = 'Quality List';
        $data['noImage']     = $this->noImage;

        return  view('admin.quality.quality', $data);
    }

    function add_quality(Request $request, $id = false)
    {

        if (!empty($id)) {
            $data['page_title']         = 'Edit Quality';
            $data['form_action']        = 'admin/add_quality/' . $id;
            $row                        =  QualityAssuranceModel::firstWhere('id', $id);
            $data['title']              =  $row->title;
            $data['description']        =  $row->description;
            $data['image']              =  $row->image;
            $data['sort_order']         =  $row->sort_order;
            $data['status']             =  $row->status;
        } else {
            $data['page_title']         = 'Add Quality';
            $data['form_action']        = 'admin/add_quality';
            $data['title']              = '';
            $data['description']        = '';
            $data['image']              = '';
            $data['sort_order']         = '';
            $data['status']             = '';
        }
        if ($request->getMethod() == 'POST') {
            $rules = [
                'title'          => 'required',
                'description'    => 'required',
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
                $save['modify_date'] =  date('Y-m-d');
                $result = QualityAssuranceModel::where('id', $id)->update($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');

                $result =  QualityAssuranceModel::insertGetId($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.quality.add_quality', $data);
    }

    function delete_quality(Request $request)
    {
        $ids = $request->input('selected');
        if ($ids) {
            foreach ($ids as $value) {
                QualityAssuranceModel::where('id', $value)->delete();
            }
            return redirect()->back()->with('success', 'Record Delete successfully!');
        }
    }
    function quality_industry_association(Request $request)
    {

        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $data['detail']      = QualityIndustryAssociationModel::get();
        $data['page_title']  = 'Industry Associations List';
        $data['noImage']     = $this->noImage;

        return  view('admin.quality.quality_industry_association', $data);
    }

    function add_quality_industry_association(Request $request, $id = false)
    {

        if (!empty($id)) {
            $data['page_title']         = 'Edit Industry Associations';
            $data['form_action']        = 'admin/add_quality_industry_association/' . $id;
            $row                        =  QualityIndustryAssociationModel::firstWhere('id', $id);
            $data['name']               =  $row->name;
            $data['image']              =  $row->image;
            $data['sort_order']         =  $row->sort_order;
            $data['status']             =  $row->status;
        } else {
            $data['page_title']         = 'Add Industry Associations';
            $data['form_action']        = 'admin/add_quality_industry_association';
            $data['name']              = '';
            $data['image']              = '';
            $data['sort_order']         = '';
            $data['status']             = '';
        }
        if ($request->getMethod() == 'POST') {
            $rules = [
                'name'          => 'required',
                'image'          => 'image|max:1024'
            ];
            $request->validate($rules);

            $save = array();
            $save['name']               =  $request->input('name');
            $save['sort_order']         =  $request->input('sort_order');
            $save['status']             =  $request->input('status');


            if (!empty($request->image)) {
                $imageName = time() . rand() . '.' . $request->image->extension();
                $request->image->move('uploads/images', $imageName);
                $save['image'] = 'uploads/images/' . $imageName;
            }

            if ($id) {
                $save['modify_date'] =  date('Y-m-d');
                $result = QualityIndustryAssociationModel::where('id', $id)->update($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');

                $result =  QualityIndustryAssociationModel::insertGetId($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.quality.add_quality_industry_association', $data);
    }

    function delete_quality_industry_association(Request $request)
    {
        $ids = $request->input('selected');
        if ($ids) {
            foreach ($ids as $value) {
                QualityIndustryAssociationModel::where('id', $value)->delete();
            }
            return redirect()->back()->with('success', 'Record Delete successfully!');
        }
    }
}
