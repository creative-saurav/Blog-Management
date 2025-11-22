<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\Blog;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.index');
    }

    public function blog_category(){
        $page_data['categories'] = BlogCategory::get();
        return view('admin.blog_category.category', $page_data);
    }

    public function blog_category_create(){
        return view ('admin.blog_category.create');
    }

    public function blog_category_store(Request $request){

        $data['name'] = $request->name;
        BlogCategory::insert($data);
        Session::flash('success', get_phrase('Blog Category Create successfully!'));
        return redirect()->back();

    }
    public function blog_category_update(Request $request, $id){
        $categoryUpdate['name'] = $request->name;
        BlogCategory::where('id', $id)->update($categoryUpdate);
        Session::flash('success', get_phrase('Blog Category Update successfully!'));
        return redirect()->back();

    }
    public function blog_category_edit($id){
        $page_data['categories'] = BlogCategory::find($id)->first();
        return view('admin.blog_category.edit', $page_data);
    }
    public function blog_category_delete($id){
        BlogCategory::find($id)->delete();
        Session::flash('success', get_phrase('Blog Category Delete successfully!'));
        return redirect()->back();
    }


    public function blog(){
        $page_data['blogs'] = Blog::get();
        return view('admin.blog.index', $page_data);
    }
    public function blog_create(){
        return view('admin.blog.add_blog');
    }
    public function blog_store( Request $request ){
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'category' => 'required|max:255',
            'status' => 'required|max:255',
        ]);   
        $data['title'] = $request->title;
        $data['category_id'] = $request->category;
        $data['tags'] = $request->tags;
        $data['summary'] = $request->summary;
        $data['status'] = $request->status;
        $data['user_id'] = Auth::id();
        $data['description'] = $request->description;

        if($request->hasFile('thumbnail')){
            $image = $request->file('thumbnail');
            $imageName = time(). '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blog/thumbnail/'), $imageName);
            $data['thumbnail'] = 'uploads/blog/thumbnail/' . $imageName;
        }
        if($request->hasFile('banner_image')){
            $image = $request->file('banner_image');
            $imageName = time(). '.'.$image->getClientOriginalName();
            $image->move(public_path('uploads/blog/banner_image/'), $imageName);
            $data['banner_image'] = 'uploads/blog/banner_image/' . $imageName;
        }
        Blog::insert($data);
        Session::flash('success', get_phrase('Blog Create successfully!'));
        return redirect()->route('admin.blog');
        
    }

    public function blog_delete($id){
        $blog = Blog::find($id);
         if (!empty($blog->thumbnail) && file_exists(public_path($blog->thumbnail))) {
            @unlink(public_path($blog->thumbnail));
        }
        if (!empty($blog->banner_image) && file_exists(public_path($blog->banner_image))) {
            @unlink(public_path($blog->banner_image));
        }
        $blog->delete();

        Session::flash('success', get_phrase('Blog deleted successfully!'));
        return redirect()->back();
    }

    public function blog_edit($id){
        $page_data['editBlog'] = Blog::where('id', $id)->first();
        return view('admin.blog.edit_blog', $page_data);
    }
    public function blog_update(Request $request , $id){
        $updateData['title'] = $request->title;
        $updateData['category_id'] = $request->category;
        $updateData['status'] = $request->status;
        $updateData['tags'] = $request->tags;
        $updateData['summary'] = $request->summary;
        $updateData['description'] = $request->description;
        if($request->hasFile('thumbnail')){
            $image = $request->file('thumbnail');
            $imageName = time().'.'.$image->getClientOriginalName();
            $image->move(public_path('uploads/blog/thumbnail/'), $imageName );
            $updateData['thumbnail'] = 'uploads/blog/thumbnail/'.$imageName;
            $blog = Blog::where('id', $id)->first(); 
            if($blog && $blog->thumbnail && is_file(public_path('uploads/blog/thumbnail/'.$blog->thumbnail))){
                unlink(public_path('uploads/blog/thumbnail/'.$blog->thumbnail));
            }
        }
        if($request->hasFile('banner_image')){
            $image = $request->file('banner_image');
            $imageName = time().'.'.$image->getClientOriginalName();
            $image->move(public_path('uploads/blog/banner_image/'), $imageName );
            $updateData['banner_image'] = 'uploads/blog/banner_image/'.$imageName;
            $blog = Blog::where('id', $id)->first(); 
            if($blog && $blog->banner_image && is_file(public_path('uploads/blog/banner_image/'.$blog->banner_image))){
                unlink(public_path('uploads/blog/banner_image/'.$blog->banner_image));
            }
        }

        Blog::where('id', $id)->update($updateData);
        Session::flash('success', get_phrase('Blog Update successfully!'));
        return redirect()->route('admin.blog');
    }


}
