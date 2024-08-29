<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Trick;
use App\User;

class TrickController extends Controller
{
    public function trick($categoryname) {
        $categories = Category::all();
        $category = Category::where('name', $categoryname)->firstOrFail();
        $original_tricks = Trick::where('category_id', $category->id)->get();
        $tricks = [];
        $category_id = $category->id;

        foreach($original_tricks as $trick) {            
            $user = User::where('id', $trick->user_id)->firstOrFail();

            array_push($tricks, array(
                "name"=>$trick->name,
                "user"=>$user->name,
                "video"=>$trick->link,
                "description"=>$trick->description,
                "like"=>$trick->like,
                "dislike"=>$trick->dislike,
                "category"=>$categoryname,
                "id"=>$trick->id,
            ));

            $tricks = collect($tricks)->sortBy('like')->reverse()->toArray();
        }

        return view("trick")->with('tricks', $tricks)->with('category', $categoryname)->with('categories', $categories)->with('category_id', $category_id);
    }

    public function like($id, $like){           
        $trick = Trick::where('id', $id)->firstOrFail();
        if($like == 1){
            $likeUp = $trick->like + 1;
            $trick->like = $likeUp;
        }
        elseif($like == 0){
            $likedown = $trick->dislike + 1;
            $trick->dislike = $likedown;
        }                    
        $trick->save();   

        return redirect()->back();
    } 

    public function destroy($id) {
        trick::find($id)->delete();
        return redirect()->back();
    }
       
    public function store(Request $request) {
        $trick = Trick::create([
            'name' => $request->input('name'),
            'link' => $request->input('link'),
            'description' => $request->input('description'),
            'like' => $request->input('like'),
            'dislike' => $request->input('like'),
            'category_id' => $request->input('category_id'),
            'user_id' => $request->input('user_id'),
        ]);                   
        return redirect()->back();
    }
}
