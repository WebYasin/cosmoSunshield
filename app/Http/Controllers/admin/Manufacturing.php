<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CommonModel;
use App\Models\SettingModel;
use App\Models\ManufacturingModel;
use App\Models\ManufacturingHeadingModel;



class Manufacturing extends Controller
{
    public function __construct()
    {
        $this->AdminModel = new CommonModel();
        $default_img = SettingModel::where('key', 'config_icon')->first();
        $this->noImage = $default_img->value;
    }
        //Headings
        function manufacturing_heading(Request $request)
        {

            if (empty($this->AdminModel->permission($request->segment(2)))) {
                return redirect('admin/permission-denied');
            }
            $data['detail']      = ManufacturingHeadingModel::get();
            $data['page_title']  = 'Heading';
            $data['noImage']     = $this->noImage;

            return  view('admin.manufacturing.manufacturing_heading', $data);
        }

        function add_manufacturing_heading(Request $request, $id = false)
        {

            if (!empty($id)) {
                $data['page_title']         = 'Edit Heading';
                $data['form_action']        = 'admin/add_manufacturing_heading/' . $id;
                $row                        =  ManufacturingHeadingModel::firstWhere('id', $id);
                $data['heading1']           =  $row->heading1;
                $data['description1']       =  $row->description1;
                $data['heading2']           =  $row->heading2;
                $data['description2']       =  $row->description2;
                $data['status']             =  $row->status;

            } else {
                $data['page_title']         = 'Add Heading';
                $data['form_action']        = 'admin/add_manufacturing_heading';
                $data['heading1']           = '';
                $data['description1']       = '';
                $data['heading2']           = '';
                $data['description2']       = '';
                $data['status']             = '';
            }
            if ($request->getMethod() == 'POST') {
                $rules = [
                    'heading1'          => 'required',
                    'description1'      => 'required',
                    'heading2'          => 'required',
                    'description2'      => 'required',
                    'status'            => 'required',
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
                    $result = ManufacturingHeadingModel::where('id', $id)->update($save);

                    if ($result) {
                        return redirect()->back()->with('success', 'Record Update successfully!');
                    } else {
                        return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                    }
                } else {
                    $save['create_date'] =  date('Y-m-d');
                    $save['modify_date'] =  date('Y-m-d');

                    $result =  ManufacturingHeadingModel::insertGetId($save);

                    if ($result) {
                        return redirect()->back()->with('success', 'Record insert successfully!');
                    } else {
                        return redirect()->back()->with('error', 'Record not insert!');
                    }
                }
            }

            return view('admin.manufacturing.add_manufacturing_heading', $data);
        }


    function manufacturing(Request $request)
    {

        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $data['detail']      = ManufacturingModel::get();
        $data['page_title']  = 'Manufacturing List';
        $data['noImage']     = $this->noImage;

        return  view('admin.manufacturing.manufacturing', $data);
    }

    function add_manufacturing(Request $request, $id = false)
    {

        if (!empty($id)) {
            $data['page_title']         = 'Edit Manufacturing';
            $data['form_action']        = 'admin/add_manufacturing/' . $id;
            $row                        =  ManufacturingModel::firstWhere('id', $id);
            $data['name']               =  $row->name;
            $data['location']           =  $row->location;
            $data['address']            =  $row->address;
            $data['contact']            =  $row->contact;
            $data['image']              =  $row->image;
            $data['sort_order']         =  $row->sort_order;
            $data['status']             =  $row->status;
        } else {
            $data['page_title']         = 'Add Manufacturing';
            $data['form_action']        = 'admin/add_manufacturing';
            $data['name']               = '';
            $data['location']           = '';
            $data['address']            = '';
            $data['contact']            = '';
            $data['image']              = '';
            $data['sort_order']         = '';
            $data['status']             = '';
        }
        if ($request->getMethod() == 'POST') {
            $rules = [
                'name'          => 'required',
                'address'       => 'required',
                'contact'       => 'required',
                'location'      => 'required',
                'status'        => 'required',
                'image'         => 'image|max:1024'
            ];
            $request->validate($rules);

            $save = array();
            $save['name']               =  $request->input('name');
            $save['location']           =  $request->input('location');
            $save['address']            =  $request->input('address');
            $save['contact']            =  $request->input('contact');
            $save['sort_order']         =  $request->input('sort_order');
            $save['status']             =  $request->input('status');


            if (!empty($request->image)) {
                $imageName = time() . rand() . '.' . $request->image->extension();
                $request->image->move('uploads/images', $imageName);
                $save['image'] = 'uploads/images/' . $imageName;
            }

            if ($id) {
                $save['modify_date'] =  date('Y-m-d');
                $result = ManufacturingModel::where('id', $id)->update($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');

                $result =  ManufacturingModel::insertGetId($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.manufacturing.add_manufacturing', $data);
    }

    function delete_manufacturing(Request $request)
    {
        $ids = $request->input('selected');
        if ($ids) {
            foreach ($ids as $value) {
                ManufacturingModel::where('id', $value)->delete();
            }
            return redirect()->back()->with('success', 'Record Delete successfully!');
        }
    }
}
