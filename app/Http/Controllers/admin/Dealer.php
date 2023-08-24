<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CommonModel;
use App\Models\SettingModel;
use App\Models\DealerHeadingModel;


class Dealer extends Controller
{
    public function __construct()
    {
        $this->AdminModel = new CommonModel();
        $default_img = SettingModel::where('key', 'config_icon')->first();
        $this->noImage = $default_img->value;
    }
    //Headings
    function dealer_network_heading(Request $request)
    {

        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $data['detail']      = DealerHeadingModel::get();
        $data['page_title']  = 'Heading';
        $data['noImage']     = $this->noImage;

        return  view('admin.dealer.dealer_network_heading', $data);
    }

    function add_dealer_network_heading(Request $request, $id = false)
    {

        if (!empty($id)) {
            $data['page_title']         = 'Edit Heading';
            $data['form_action']        = 'admin/add_dealer_network_heading/' . $id;
            $row                        =  DealerHeadingModel::firstWhere('id', $id);
            $data['description1']       =  $row->description1;
            $data['description2']       =  $row->description2;
            $data['status']             =  $row->status;

        } else {
            $data['page_title']         = 'Add Heading';
            $data['form_action']        = 'admin/add_dealer_network_heading';
            $data['description1']       = '';
            $data['description2']       = '';
            $data['status']             = '';
        }
        if ($request->getMethod() == 'POST') {
            $rules = [
                'description1'      => 'required',
                'description2'      => 'required',
                'status'            => 'required',
            ];
            $request->validate($rules);

            $save = array();
            $save['description1']       =  $request->input('description1');
            $save['description2']       =  $request->input('description2');
            $save['status']             =  $request->input('status');

            if ($id) {
                $save['modify_date'] =  date('Y-m-d');
                $result = DealerHeadingModel::where('id', $id)->update($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');

                $result =  DealerHeadingModel::insertGetId($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.dealer.add_dealer_network_heading', $data);
    }
}
