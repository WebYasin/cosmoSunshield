<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CommonModel;
use App\Models\SettingModel;
use App\Models\GalleryModel;

class Gallery extends Controller
{
    public function __construct()
    {
        $this->AdminModel = new CommonModel();
        $default_img = SettingModel::where('key', 'config_icon')->first();
        $this->noImage = $default_img->value;
    }

    function gallery(Request $request)
    {

        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $data['detail']      = GalleryModel::where('type',1)->paginate(20);
        $data['page_title']  = 'Gallery List';
        $data['noImage']     = $this->noImage;

        return  view('admin.gallery.gallery', $data);
    }

    function add_gallery(Request $request, $id = false)
    {

        if (!empty($id)) {
            $data['page_title']         = 'Edit Gallery';
            $data['form_action']        = 'admin/add_gallery/' . $id;
            $row                        =  GalleryModel::firstWhere('id', $id);
            $data['image']              =  $row->image;
            $data['sort_order']         =  $row->sort_order;
            $data['status']             =  $row->status;
        } else {
            $data['page_title']         = 'Add Gallery';
            $data['form_action']        = 'admin/add_gallery';
            $data['image']              = '';
            $data['sort_order']         = '';
            $data['status']             = '';
        }
        if ($request->getMethod() == 'POST') {
            $rules = [
                'image'          => 'image|max:1024',
                'sort_order'     => 'required',
                'status'         => 'required',
            ];
            $request->validate($rules);

            $save = array();
            $save['sort_order']         =  $request->input('sort_order');
            $save['status']             =  $request->input('status');
            $save['type']              =  1;


            if (!empty($request->image)) {
                $imageName = time() . rand() . '.' . $request->image->extension();
                $request->image->move('uploads/images', $imageName);
                $save['image'] = 'uploads/images/' . $imageName;
            }

            if ($id) {
                $save['modify_date'] =  date('Y-m-d');
                $result = GalleryModel::where('id', $id)->update($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');

                $result =  GalleryModel::insertGetId($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.gallery.add_gallery', $data);
    }

    function delete_gallery(Request $request)
    {
        $ids = $request->input('selected');
        if ($ids) {
            foreach ($ids as $value) {
                GalleryModel::where('id', $value)->delete();
            }
            return redirect()->back()->with('success', 'Record Delete successfully!');
        }
    }
    function video_gallery(Request $request)
    {

        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $data['detail']      = GalleryModel::where('type',2)->paginate(20);
        $data['page_title']  = 'Video Gallery List';
        $data['noImage']     = $this->noImage;

        return  view('admin.gallery.video_gallery', $data);
    }

    function add_video_gallery(Request $request, $id = false)
    {

        if (!empty($id)) {
            $data['page_title']         = 'Edit Gallery';
            $data['form_action']        = 'admin/add_video_gallery/' . $id;
            $row                        =  GalleryModel::firstWhere('id', $id);
            $data['image']              =  $row->image;
            $data['sort_order']         =  $row->sort_order;
            $data['status']             =  $row->status;
        } else {
            $data['page_title']         = 'Add Gallery';
            $data['form_action']        = 'admin/add_video_gallery';
            $data['image']              = '';
            $data['sort_order']         = '';
            $data['status']             = '';
        }
        if ($request->getMethod() == 'POST') {
            $rules = [
                'image'          => 'image|max:1024',
                'sort_order'     => 'required',
                'status'         => 'required',
            ];
            $request->validate($rules);

            $save = array();
            $save['sort_order']         =  $request->input('sort_order');
            $save['status']             =  $request->input('status');
            $save['type']               =  2;


            if (!empty($request->image)) {
                $imageName = time() . rand() . '.' . $request->image->extension();
                $request->image->move('uploads/images', $imageName);
                $save['image'] = 'uploads/images/' . $imageName;
            }

            if ($id) {
                $save['modify_date'] =  date('Y-m-d');
                $result = GalleryModel::where('id', $id)->update($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');

                $result =  GalleryModel::insertGetId($save);

                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.gallery.add_video_gallery', $data);
    }

    function delete_video_gallery(Request $request)
    {
        $ids = $request->input('selected');
        if ($ids) {
            foreach ($ids as $value) {
                GalleryModel::where('id', $value)->delete();
            }
            return redirect()->back()->with('success', 'Record Delete successfully!');
        }
    }

}
