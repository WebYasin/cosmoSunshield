<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\CommonModel;
use App\Models\SettingModel;
use App\Models\ProductCategoryModel;
use App\Models\ProductCategoryFeatureModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use App\Models\SolutionModel;

use Illuminate\Support\Str;


class Product extends Controller
{
    public function __construct()
    {
        $this->AdminModel = new CommonModel();
        $default_img = SettingModel::where('key', 'config_icon')->first();
        $this->noImage = $default_img->value;
    }

    //Product Catgory
    function product_category(Request $request)
    {
        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $data['detail']      = ProductCategoryModel::get();
        $data['page_title']  = 'Product Category';
        return  view('admin.product.product_category', $data);
    }

    function add_product_category(Request $request, $id = false)
    {
        $model = new ProductCategoryFeatureModel();
        if (!empty($id)) {
            $data['page_title']     = 'Edit Product Category';
            $data['form_action']    = 'admin/add_product_category/' . $id;
            $row =  ProductCategoryModel::firstWhere('id', $id);
            $data['name']           =  $row->name;
            $data['description']    =  $row->description;
            $data['short_description']         =  $row->short_description;
            $data['slug']           =  $row->slug;
            $data['thumbnail']      =  $row->thumbnail;
            $data['image']          =  $row->image;
            $data['banner_image']   =  $row->banner_image;
            $data['video']          =  $row->video;
            $data['video_image']    =  $row->video_image;
            $data['before_image']   =  $row->before_image;
            $data['after_image']    =  $row->after_image;
            $data['meta_title']     =  $row->meta_title;
            $data['meta_keyword']   =  $row->meta_keyword;
            $data['meta_description']         =  $row->meta_description;
            $data['show_on_home']   =  $row->show_on_home;
            $data['sort_order']     =  $row->sort_order;
            $data['heading1']       =  $row->heading1;
            $data['description1']   =  $row->description1;
            $data['image1']         =  $row->image1;
            $data['heading2']       =  $row->heading2;
            $data['description2']   =  $row->description2;
            $data['heading3']       =  $row->heading3;
            $data['image3']         =  $row->image3;
            $data['heading4']       =  $row->heading4;
            $data['description4']   =  $row->description4;
            $data['heading5']       =  $row->heading5;
            $data['link5']          =  $row->link5;
            $data['catalog']        =  $row->catalog;
            $data['status']         =  $row->status;
            $data['all_details']    =  ProductCategoryFeatureModel::where('category_id',$id)->get();

        } else {
            $data['page_title']     = 'Add Product Category';
            $data['form_action']    = 'admin/add_product_category';
            $data['name']           =  '';
            $data['description']    =  '';
            $data['short_description']         =  '';
            $data['slug']           =  '';
            $data['thumbnail']      =  '';
            $data['image']          =  '';
            $data['banner_image']   =  '';
            $data['video']          =  '';
            $data['video_image']    =  '';
            $data['before_image']   =  '';
            $data['after_image']    =  '';
            $data['meta_title']     =   '';
            $data['meta_keyword']   =   '';
            $data['meta_description'] =   '';
            $data['show_on_home']   = '';
            $data['sort_order']     = '';
            $data['heading1']       = '';
            $data['description1']   = '';
            $data['image1']         = '';
            $data['heading2']       = '';
            $data['description2']   = '';
            $data['heading3']       = '';
            $data['image3']         = '';
            $data['heading4']       = '';
            $data['description4']   = '';
            $data['heading5']       = '';
            $data['link5']          = '';
            $data['catalog']        = '';
            $data['status']         =  '';
            $data['all_details']    = array();
        }
        if ($request->getMethod() == 'POST') {
            $rules = [
                'name'              => 'required',
                'short_description' => 'required',
                'description'       => 'required',
                'status'            => 'required',
                'heading1'          => 'required',
                'description1'      => 'required',
                'heading2'          => 'required',
                'description2'      => 'required',
                'heading3'          => 'required',
                'heading4'          => 'required',
                'description4'      => 'required',
                'heading5'          => 'required',
                'link5'             => 'required',
                'image1'            => 'image|max:1024',
                'image3'            => 'image|max:1024',
                'thumbnail'         => 'image|max:1024',
                'image'             => 'image|max:1024',
                'banner_image'      => 'image|max:1024',
                'video'             => 'mimes:mp4|max:10240',
                'video_image'       => 'image|max:1024',
                'before_image'      => 'image|max:1024',
                'after_image'       => 'image|max:1024',
            ];

            $request->validate($rules);

            $save = array();
            $save['name']               =  $request->input('name');
            $save['short_description']  =  $request->input('short_description');
            $save['sort_order']         =  $request->input('sort_order');
            $save['description']        =  $request->input('description');
            $save['meta_title']         =  $request->input('meta_title');
            $save['meta_keyword']       =  $request->input('meta_keyword');
            $save['meta_description']   =  $request->input('meta_description');
            $save['show_on_home']       =  $request->input('show_on_home');
            $save['heading1']           =  $request->input('heading1');
            $save['description1']       =  $request->input('description1');
            $save['heading2']           =  $request->input('heading2');
            $save['description2']       =  $request->input('description2');
            $save['heading3']           =  $request->input('heading3');
            $save['heading4']           =  $request->input('heading4');
            $save['description4']       =  $request->input('description4');
            $save['heading5']           =  $request->input('heading5');
            $save['link5']              =  $request->input('link5');
            $save['status']             =  $request->input('status');


            if($request->input('slug')){
                $save['slug']               =  $request->input('slug');
                }else{
                    $slug = Str::slug($request->input('name'), '-');
                    $save['slug']               =  $slug;
                }
                if (!empty($request->catalog)) {
                    $imageName = time() .rand(). '.' . $request->catalog->extension();
                    $request->catalog->move('uploads/images', $imageName);
                    $save['catalog'] = 'uploads/images/' . $imageName;
                }
                if (!empty($request->image1)) {
                    $imageName = time() .rand(). '.' . $request->image1->extension();
                    $request->image1->move('uploads/images', $imageName);
                    $save['image1'] = 'uploads/images/' . $imageName;
                }
                if (!empty($request->image3)) {
                    $imageName = time() .rand(). '.' . $request->image3->extension();
                    $request->image3->move('uploads/images', $imageName);
                    $save['image3'] = 'uploads/images/' . $imageName;
                }

                if (!empty($request->image)) {
                    $imageName = time() .rand(). '.' . $request->image->extension();
                    $request->image->move('uploads/images', $imageName);
                    $save['image'] = 'uploads/images/' . $imageName;
                }
                if (!empty($request->thumbnail)) {
                    $imageName = time() .rand(). '.' . $request->thumbnail->extension();
                    $request->thumbnail->move('uploads/images', $imageName);
                    $save['thumbnail'] = 'uploads/images/' . $imageName;
                }
                if (!empty($request->banner_image)) {
                    $imageName = time() .rand(). '.' . $request->banner_image->extension();
                    $request->banner_image->move('uploads/images', $imageName);
                    $save['banner_image'] = 'uploads/images/' . $imageName;
                }
                if (!empty($request->video)) {
                    $imageName = time() .rand(). '.' . $request->video->extension();
                    $request->video->move('uploads/images', $imageName);
                    $save['video'] = 'uploads/images/' . $imageName;
                }
                if (!empty($request->video_image)) {
                    $imageName = time() .rand(). '.' . $request->video_image->extension();
                    $request->video_image->move('uploads/images', $imageName);
                    $save['video_image'] = 'uploads/images/' . $imageName;
                }
                if (!empty($request->before_image)) {
                    $imageName = time() .rand(). '.' . $request->before_image->extension();
                    $request->before_image->move('uploads/images', $imageName);
                    $save['before_image'] = 'uploads/images/' . $imageName;
                }
                if (!empty($request->after_image)) {
                    $imageName = time() .rand(). '.' . $request->after_image->extension();
                    $request->after_image->move('uploads/images', $imageName);
                    $save['after_image'] = 'uploads/images/' . $imageName;
                }

                $saveDetails['sort_order']  = $request->input('ing_sort_order');
                $saveDetails['title']       = $request->input('ing_title');
                $saveDetails['status']      = $request->input('ing_status');

            if ($id) {
                $saveDetails['category_id']      = $id ;
                $save['modify_date'] =  date('Y-m-d');
                 ProductCategoryModel::where('id', $id)->update($save);
                $result = $model->save_data($saveDetails);
                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');

                $lastInsertId = ProductCategoryModel::insertGetId($save);
                $saveDetails['category_id']      = $lastInsertId ;
                $result = $model->save_data($saveDetails);
                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.product.add_product_category', $data);
    }
    function product(Request $request)
    {
        if (empty($this->AdminModel->permission($request->segment(2)))) {
            return redirect('admin/permission-denied');
        }
        $data['detail']      = ProductModel::get();
        $data['page_title']  = 'Product List';
        return  view('admin.product.product', $data);
    }

    function add_product(Request $request, $id = false)
    {
        $data['all_category'] = ProductCategoryModel::where(array('status'=>1))->get();
        $data['all_solution'] = SolutionModel::where(array('status'=>1))->get();
        if (!empty($id)) {
            $data['page_title']     = 'Edit Product ';
            $data['form_action']    = 'admin/add_product/' . $id;
            $row =  ProductModel::firstWhere('id', $id);
            $data['name']           =  $row->name;
            $data['category_id']    =  $row->category_id;
            $data['solution_id']    =  $row->solution_id;
            $data['image']          =  $row->image;
            $data['sort_order']     =  $row->sort_order;
            $data['status']         =  $row->status;

        } else {
            $data['page_title']     = 'Add Product ';
            $data['form_action']    = 'admin/add_product';
            $data['name']           =  '';
            $data['category_id']    =  '';
            $data['solution_id']    =  '';
            $data['image']          =  '';
            $data['sort_order']     = '';
            $data['status']         =  '';

        }
        if ($request->getMethod() == 'POST') {
            $rules = [
                'name'              => 'required',
                'category_id'       => 'required',
                'status'            => 'required',
                'solution_id'       => 'required',
                'sort_order'        => 'required',
                'image'             => 'image|max:1024',
            ];

            $request->validate($rules);

            $save = array();
            $save['name']               =  $request->input('name');
            $save['category_id']       =  $request->input('category_id');
            $save['sort_order']         =  $request->input('sort_order');
            $save['solution_id']       =  $request->input('solution_id');
            $save['status']             =  $request->input('status');



                if (!empty($request->image)) {
                    $imageName = time() .rand(). '.' . $request->image->extension();
                    $request->image->move('uploads/images', $imageName);
                    $save['image'] = 'uploads/images/' . $imageName;
                }


            if ($id) {

                $save['modify_date'] =  date('Y-m-d');
                $result = ProductModel::where('id', $id)->update($save);
                if ($result) {
                    return redirect()->back()->with('success', 'Record Update successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not update! Please Make Some Changes');
                }
            } else {
                $save['create_date'] =  date('Y-m-d');
                $save['modify_date'] =  date('Y-m-d');

                $result = ProductModel::create($save);
                if ($result) {
                    return redirect()->back()->with('success', 'Record insert successfully!');
                } else {
                    return redirect()->back()->with('error', 'Record not insert!');
                }
            }
        }

        return view('admin.product.add_product', $data);
    }
}
