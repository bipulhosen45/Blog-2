<?php

namespace App\Http\Controllers\Fronted;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PostCountController;
use App\Jobs\SendContactMail;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection\Distinct;
use Illuminate\Support\Facades\App;

class FrontedController extends Controller
{
    public function index()
    {
        $query = Post::with('category', 'sub_category', 'tags', 'user')->where('is_approved', 1)->where('status', 1);

        $posts = $query->latest()->take(5)->get();
        $slider_posts = $query->inRandomOrder()->take(6)->get();
        // $tags = Tag::where('status', 1)->get();
        return view('fronted.modules.index', compact('posts', 'slider_posts'));
    }
    public function all_post(){

        $posts = Post::with('category', 'sub_category', 'tags', 'user')->where('is_approved', 1)->where('status', 1)->latest()->paginate(10);
        $post_title = 'All Post';
        $sub_title = 'View All Post List';
        return view('fronted.modules.all_post', compact('posts', 'post_title','sub_title'));
    }
    public function search(Request $request){

        $posts = Post::with('category', 'sub_category', 'tags', 'user')
                ->where('is_approved', 1)
                ->where('status', 1)
                ->where('post_title', 'like', '%'.$request->input('search').'%')
                ->latest()
                ->paginate(10);
        $post_title = 'View Search Result';
        $sub_title = $request->input('search');
        return view('fronted.modules.all_post', compact('posts', 'post_title', 'sub_title'));

        // $query = 'SELECT * FROM posts where post_title like %%';
    }
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if ($category){
            $posts = Post::with('category', 'sub_category', 'tags', 'user')
            ->where('is_approved', 1)
            ->where('status', 1)
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(10);
        }
        $post_title = $category->name;
        $sub_title = 'Post By Category';
        return view('fronted.modules.all_post', compact('posts', 'post_title', 'sub_title'));
       
    }
    public function tag($slug)
    {
        $tags = Tag::where('slug', $slug)->first();

        $post_ids = DB::table('post_tag')->select('post_id')->where('tag_id', $tags->id)->get()->pluck('post_id');

        if ($tags){
            $posts = Post::with('category', 'sub_category', 'tags', 'user')
            ->where('is_approved', 1)
            ->where('status', 1)
            ->whereIn('id', $post_ids)
            ->latest()
            ->distinct()
            ->paginate(20);

        }
        $post_title = $tags->name;
        $sub_title = 'Post By Tag';
        return view('fronted.modules.all_post', compact('posts', 'post_title', 'sub_title'));
       
    }
    public function sub_category($slug, $sub_slug)
    {
        $sub_category = SubCategory::where('slug', $sub_slug)->first();
        if ($sub_category){
            $posts = Post::with('category', 'sub_category', 'tags', 'user')
            ->where('is_approved', 1)
            ->where('status', 1)
            ->where('sub_category_id', $sub_category->id)
            ->latest()
            ->paginate(10);
        }
        $post_title = $sub_category->name;
        $sub_title = 'Post By Sub-Category';
        return view('fronted.modules.all_post', compact('posts', 'post_title', 'sub_title'));
       
    }
    final public function single(string $slug)
    {
        $posts = Post::with('category', 'sub_category', 'tags', 'user', 'comment', 'comment.user', 'comment.reply', 'post_read_count')
        ->where('is_approved', 1)
        ->where('status', 1)
        ->where('slug', $slug)
        ->firstOrFail();

        // if(!$posts){
        //     abort(404);
        // }
        // $tags = Tag::where('status', 1)->get();
       
        return view('fronted.modules.single', compact('posts'));
    }
    final public function contact()
    {
        return view('fronted.modules.contact');
    }
    final public function postReadCount($post_id):void
    {
        // $postCount = new PostCountController($post_id);
        // $postCount->postReadCount();

        (new PostCountController($post_id))->postReadCount();
    }

    //contact form fronted part
    public function contactstore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

         $contact = Contact::create($request->all());
        toastr()->success('Message sent successfully!', 'Sent');

        SendContactMail::dispatch($contact->toArray());
        return redirect()->back();
       
    }
}
