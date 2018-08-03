<?php

namespace App\Http\Controllers;

use App\model\Permission;
use App\model\Shop;
use App\model\ShopCategory;
use App\model\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopCategoriesController extends Controller
{




    //显示分类
    public function index(){
        Permission::set_permission('查看分类');//设置权限
        $shops=Shop::where('status','=',0);
        $shop_categories=ShopCategory::paginate(5);
        return view('/shop_category/index',['shop_categories'=>$shop_categories,'shops'=>$shops]);
    }
    //添加
    public function create(){
        Permission::set_permission('分类操作');//设置权限
        return view('/shop_category/create');
    }
    public function store(Request $request){
        Permission::set_permission('分类操作');//设置权限
        $this->validate($request, [
            'name' => 'required|max:50',
            'img' => 'required',
        ],[
            'name.required'=>'请输入分类名',
            'name.max'=>'分类名过长',
            'img.required'=>'请上传一张对应的图片',
        ]);
        if (!$request->status){
            $request->status=0;
        }
        ShopCategory::create([
            'name'=>$request->name,
            'status'=>$request->status,
            'img'=>$request->img,
        ]);
        session()->flash('success','添加成功');
        return redirect()->route('shop_categories.index');

    }
    //删除
    public function destroy(ShopCategory $shop_category){
        Permission::set_permission('分类操作');//设置权限
        if(Shop::where('shop_category_id','=',$shop_category->id)->first()){
            return back()->with('danger','此分类下存在商家,不能删除');
        };
        $shop_category->delete();
        session()->flash('success','删除成功');
        return redirect()->route('shop_categories.index');
    }
    //修改
    public function edit(ShopCategory $shop_category){
        Permission::set_permission('分类操作');//设置权限
        return view('/shop_category/edit',['shop_category'=>$shop_category]);
    }
    public function update(Request $request,ShopCategory $shop_category){
        Permission::set_permission('分类操作');//设置权限
        $this->validate($request, [
            'name' => 'required|max:50',
        ],[
            'name.required'=>'请输入分类名',
            'name.max'=>'分类名过长',
        ]);
        if (!$request->status){
            $request->status=0;
        }
        $update=['name'=>$request->name,'status'=>$request->status];
        if ($request->img){
            $update['img']=$request->img;
        }
        $shop_category->update($update);
        session()->flash('success','修改成功');
        return redirect()->route('shop_categories.index');

    }


}
