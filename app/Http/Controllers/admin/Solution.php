<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SolutionModel;
use App\Models\SolutionDetailsModel;
use App\Models\SolutionHeadingModel;
use App\Models\CommonModel;
use App\Models\SettingModel;


class Solution extends Controller
{
    public function __construct()
    {
        $this->AdminModel = new CommonModel();
        $default_img = SettingModel::where('key','config_icon')->first();
        $this->noImage = $default_img->value;

    }
    //Headings
    function solution_heading(Request $request)
    {

        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $data['detail']      = SolutionHeadingModel::get();
        $data['page_title']  = 'Solutions Heading';
        $data['noImage']     = $this->noImage;

        return  view('admin.solution.solution_heading', $data);
    }

    function add_solution_heading(Request $request, $id = false)
    {
        $model                          = new SolutionDetailsModel();
        if (!empty($id)) {
            $data['page_title']         = 'Edit Solution Heading';
            $data['form_action']        = 'admin/add_solution_heading/' . $id;
            $row                        =  SolutionHeadingModel::firstWhere('id', $id);
            $data['heading1']           =  $row->heading1;
            $data['description1']       =  $row->description1;
            $data['status']             =  $row->status;
            $data['all_details']        =  SolutionDetailsModel::where('solution_id',$id)->get();

        } else {
            $data['page_title']         = 'Add Solution Heading';
            $data['form_action']        = 'admin/add_solution_heading';
            $data['heading1']           = '';
            $data['description1']       = '';
            $data['status']             = '';
            $data['all_details']        = array();
        }
        if ($request->getMethod() == 'POST') {
            $rules = [
                'heading1'          => 'required',
                'description1'   => 'required',
            ];
            $request->validate($rules);

            $save = array();
            $save['heading1']           =  $request->input('heading1');
            $save['description1']       =  $request->input('description1');
            $save['status']             =  $request->input('status');



            if ($id) {
                $save['modify_date'] =  date('Y-m-d');
                $result = SolutionHeadingModel::where('id', $id)->update($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');

                $result =  SolutionHeadingModel::insertGetId($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.solution.add_solution_heading', $data);
    }


    function solution(Request $request)
    {

        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $data['detail']      = SolutionModel::get();
        $data['page_title']  = 'Solutions List';
        $data['noImage']     = $this->noImage;

        return  view('admin.solution.solution', $data);
    }

    function add_solution(Request $request, $id = false)
    {
        $model                          = new SolutionDetailsModel();
        if (!empty($id)) {
            $data['page_title']         = 'Edit Solution';
            $data['form_action']        = 'admin/add_solution/' . $id;
            $row                        =  SolutionModel::firstWhere('id', $id);
            $data['title']               =  $row->title;
            $data['description']        =  $row->description;
            $data['image']              =  $row->image;
            $data['short_description']  =  $row->short_description;
            $data['sort_order']         =  $row->sort_order;
            $data['status']             =  $row->status;
            $data['all_details']        =  SolutionDetailsModel::where('solution_id',$id)->get();

        } else {
            $data['page_title']         = 'Add Solution';
            $data['form_action']        = 'admin/add_solution';
            $data['title']               = '';
            $data['description']        = '';
            $data['image']              = '';
            $data['short_description']  = '';
            $data['sort_order']         = '';
            $data['status']             = '';
            $data['all_details']        = array();
        }
        if ($request->getMethod() == 'POST') {
            $rules = [
                'title'          => 'required',
                'short_description'   => 'required',
                'description'   => 'required',
            ];
            $request->validate($rules);

            $save = array();
            $save['title']              =  $request->input('title');
            $save['short_description']  =  $request->input('short_description');
            $save['description']        =  $request->input('description');
            $save['sort_order']         =  $request->input('sort_order');
            $save['status']             =  $request->input('status');


            if (!empty($request->image)) {
                $imageName = time() .rand(). '.' . $request->image->extension();
                $request->image->move('uploads/images', $imageName);
                $save['image'] = 'uploads/images/' . $imageName;
            }

            $images = array();
            if (!empty($request->ing_image)) {
                $files  = $request->ing_image;
                foreach($files as $file){
                    $imageName1 = time() .rand(). '.' . $file->getClientOriginalName();
                    $file->move('uploads/images',$imageName1);
                    $images[]= 'uploads/images/' . $imageName1;
                }
            }
            $saveDetails['image']       = @$images;
            $saveDetails['sort_order']  = $request->input('ing_sort_order');
            $saveDetails['title']       = $request->input('ing_title');
            $saveDetails['old_image']   = $request->input('old_ing_image');
            $saveDetails['status']      = $request->input('ing_status');

            if ($id) {
                $saveDetails['solution_id']      = $id ;
                $save['modify_date'] =  date('Y-m-d');
                 SolutionModel::where('id', $id)->update($save);

                 $result = $model->save_data($saveDetails);
                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');

                $lastInsertId =  SolutionModel::insertGetId($save);
                $saveDetails['solution_id']      = $lastInsertId ;
                $result = $model->save_data($saveDetails);
                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.solution.add_solution', $data);
    }

    function delete_solution(Request $request){
        $ids = $request->input('selected');
        if($ids){
        foreach($ids as $value){
            SolutionModel::where('id',$value)->delete();
        }
        return redirect()->back()->with('success', 'Record Delete successfully!');
       }

     }

}
