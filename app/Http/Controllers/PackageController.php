<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    
    public function subscription_package(){
        $page_data['packages'] = Package::get();
        return view('admin.package.index', $page_data);
    }
    public function subscription_create(){
        return view('admin.package.create');
    }

    public function subscription_store(Request $request){
        $request->validate([
            'title'         => 'required|string|max:255',    
            'package_type'  => 'required|in:paid,free',    
            'price'         => 'required_if:package_type,paid|numeric|min:0|nullable',
            'blog_count'    => 'required|integer|min:1',     
            'status'        => 'required|in:0,1',           
            ]);

        $data['title'] = $request->title;
        $data['period'] = $request->period;
        $data['price'] = $request->price;
        $data['short_description'] = $request->short_description;
        $data['blog_count'] = $request->blog_count;
        $data['package_type'] = $request->package_type;
        $data['status'] = $request->status;
         if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time(). '.'.$image->getClientOriginalName();
            $image->move(public_path('uploads/package/image/'), $imageName);
            $data['image'] = 'uploads/package/image/' . $imageName;
        }
        Package::insert($data);
        Session::flash('success', get_phrase('Package Create successfully!'));
        return redirect()->back();
      
    }

    public function subscription_edit($id){
        $page_data['edit'] = Package::where('id', $id)->first();
        return view('admin.package.edit', $page_data);
    }
    public function subscription_update(Request  $request , $id){
        $data['title'] = $request->title;
        $data['short_description'] = $request->short_description;
        $data['blog_count'] = $request->blog_count;
        $data['package_type'] = $request->package_type;
        $data['status'] = $request->status;
         if($request->package_type == 'paid'){
            $data['period'] = $request->period;
            $data['price']  = $request->price;
        } else {
            $data['period'] = NULL;
            $data['price']  = NULL;
        }
         
        Package::where('id', $id)->update($data);
        Session::flash('success', get_phrase('Package Update successfully!'));
        return redirect()->back();
    }
    public function subscription_delete($id){
        Package::find($id)->delete();
        Session::flash('success', get_phrase('Package Delete successfully!'));
        return redirect()->back();
    }


}
