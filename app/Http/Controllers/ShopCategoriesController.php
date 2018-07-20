<?php

namespace App\Http\Controllers;

use App\model\Shop;
use App\model\ShopCategory;
use App\model\ShopUser;
use Illuminate\Http\Request;

class ShopCategoriesController extends Controller
{
    //显示分类
    public function index(){
        $shops=Shop::where('status','=',0);
        $shop_categories=ShopCategory::paginate(5);
        return view('/shop_category/index',['shop_categories'=>$shop_categories,'shops'=>$shops]);
    }
    //添加
    public function create(){
        return view('/shop_category/create');
    }
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|max:50',
            'img' => 'required',
        ],[
            'name.required'=>'请输入分类名',
            'name.max'=>'分类名过长',
            'img.required'=>'请上传一张对应的图片',
        ]);
        $img=$request->img->store('public/shop_category');
        $img=url(\Illuminate\Support\Facades\Storage::url($img));
        if (!$request->status){
            $request->status=0;
        }
        ShopCategory::create([
            'name'=>$request->name,
            'status'=>$request->status,
            'img'=>$img,
        ]);
        session()->flash('success','添加成功');
        return redirect()->route('shop_categories.index');

    }
    //删除
    public function destroy(ShopCategory $shop_category){
        $shop_category->delete();
        session()->flash('success','删除成功');
        return redirect()->route('shop_categories.index');
    }
    //修改
    public function edit(ShopCategory $shop_category){
        return view('/shop_category/edit',['shop_category'=>$shop_category]);
    }
    public function update(Request $request,ShopCategory $shop_category){
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
            $update['img']=url(\Illuminate\Support\Facades\Storage::url($request->img->store('public/shop_category')));
        }
        $shop_category->update($update);
        session()->flash('success','修改成功');
        return redirect()->route('shop_categories.index');

    }


}
