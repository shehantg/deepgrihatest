<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Tag;
use Illuminate\Support\Facades\Validator;
use App\Photo;
use Input;
class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();

        

        

        return view('blogsindex',['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {   

        $allTags = DB::table('tags')->pluck('name');
        return view('blogcreate',['allTags' => $allTags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        
        $validation = Validator::make($request->all(), [
        'title'  => 'required',
        
        'introduction'  => 'required',
        
        'body'  => 'required',
        'video' => 'required'

        
      ]);

      

        $photos = count($request->photos);
        foreach(range(0, $photos) as $index) {
            $rules['photos.' . $index] = 'image|mimes:jpeg,bmp,png';
        }


         $newStory = new Blog;

        
        

         $newStory->title = $request->title;
         $newStory->introduction = $request->introduction;
         $newStory->body = $request->body;
         
         $newStory->video = $request->video;
         $newStory->user_id = Auth::id();

         $newStory->save();



         foreach ($request->photos as $photo) {
            $filename = $photo->store('public/photos');


          
            Photo::create([
                'blog_id' => $newStory->id,
                'filename' => $filename
            ]);
        }


         $tags = $request->tags;

         foreach($tags as $tag){

            $currentTag = DB::table('tags')->where('name', $tag)->value('id');

            DB::table('blog_tag')->insert([

                'blog_id' => $newStory->id, 
                'tag_id' => $currentTag

                ]);




            
         }

}

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)


    {   

       $images = DB::table('photos')->where('blog_id',$blog->id)->pluck('filename');
       
        
        return view('blogdisplay',['blog' => $blog,'images' =>  $images]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
