<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CommonModel;
use App\Models\SettingModel;
use Illuminate\Support\Facades\DB;

class Enquiry extends Controller
{
    public function __construct()
    {
        $this->AdminModel = new CommonModel();
        $default_img = SettingModel::where('key', 'config_icon')->first();
        $this->noImage = $default_img->value;
    }
       //Headings
       function job_applied(Request $request)
       {

           if (empty($this->AdminModel->permission($request->segment(2)))) {
               return redirect('admin/permission-denied');
           }

           $data['detail']           = DB::table('job_applied')->orderBy('id','DESC')->paginate(10);
           $data['page_title']       = 'Job Enquiry';

           return  view('admin.enquiry.job_applied', $data);
       }
       function join_dealer(Request $request)
       {

           if (empty($this->AdminModel->permission($request->segment(2)))) {
               return redirect('admin/permission-denied');
           }

           $data['detail']           = DB::table('join_dealer')->orderBy('id','DESC')->paginate(10);
           $data['page_title']       = 'Dealer Enquiry';

           return  view('admin.enquiry.join_dealer', $data);
       }
       function Conactenquiry(Request $request)
       {

           if (empty($this->AdminModel->permission($request->segment(2)))) {
               return redirect('admin/permission-denied');
           }

           $data['detail']           = DB::table('enquiry')->orderBy('id','DESC')->paginate(10);
           $data['page_title']       = 'Contact Enquiry';

           return  view('admin.enquiry.contact_enquiry', $data);
       }
}
