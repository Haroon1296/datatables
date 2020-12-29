<?php

namespace App\Http\Controllers\admin;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Validator;

class CategoryController extends Controller
{
    //
    public function index(Request $request){
        //
        if ($request->ajax()) {
            $data = Category::get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){

                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></a>';

                        return $btn;
                    })
                    ->addColumn('icon', function($data){

                        if(!empty($data->icon)){
                            $img = " <a href='".url('public/admin/img/category/icon/', $data->icon)."' target='blank'> <img src='".url('public/admin/img/category/icon', $data->icon)."' width='50px' height='40px' /> </a>";
                       }else{
                           $img = " <a href='".url('public/admin/img/logo.png')."' target='blank'> <img src='".url('public/admin/img/logo.png')."' width='50px' height='40px' /> </a>";
                        } 
                        return $img;
                    })
                    ->addColumn('banner', function($data){

                        if(!empty($data->banner)){
                            $img = " <a href='".url('public/admin/img/banner/icon', $data->banner)."' target='blank'> <img src='".url('public/admin/img/category/banner/', $data->banner)."' width='50px' height='40px' /> </a>";
                        }else{
                            $img = " <a href='".url('public/admin/img/logo.png')."' target='blank'> <img src='".url('public/admin/img/logo.png')."' width='50px' height='40px' /> </a>";
                        } 
                        return $img;
                    })
                    ->addColumn('featured', function($data){
                       $featured = $data->featured == 1 ? 'checked' : "";
                           return '
                            <div class="custom-control custom-switch">
                                <input type="checkbox" '.$featured.' class="custom-control-input featured" id="'.$data->id.'" value="'.$data->featured.'" >
                                <label class="custom-control-label" '.$featured.' for="'.$data->id.'" ></label>
                            </div>
                           ';
                    })
                    ->rawColumns(['action', 'icon', 'banner', 'featured'])
                    ->make(true);
        }
        return view('admin.category.index');
    }

    public function featured($id)
    {
        $category_featured = Category::find($id);
        $featured= $category_featured->featured == 0 ? 1 : 0;
        Category::where('id',$id)->update(['featured'=>$featured]);
        return response()->json(); 
    }
    
    public function edit($id)
    {
        $category = Category::findorfail($id);
        return response()->json($category);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Category::getValidationRules() );
        
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $category = Category::updateOrCreate([   
                'id' => $request->cat_id
            ],
            [
                'name' => $request->name, 
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description 
        ]);

        if($request->hasFile('icon')){
            $icon = $category->id.'.'.$request->icon->getClientOriginalExtension();
            Category::whereId($category->id)->update(['icon' => $icon]);
            $request->icon->move(public_path('admin/img/category/icon'), $icon);
        }

        if($request->hasFile('banner')){
            $banner = $category->id.'.'.$request->banner->getClientOriginalExtension();
            Category::whereId($category->id)->update(['banner' => $banner]);
            $request->banner->move(public_path('admin/img/category/banner'), $banner);
        }

        if(!empty($request->cat_id) && $request->cat_id != ''){
            //
            return response()->json(['success' => 'Category successfully updated!']);
        }else{
            return response()->json(['success' => 'Category successfully added!']);
        }
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        return response()->json();
    }

}
