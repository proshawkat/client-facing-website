<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Section;
use App\Story;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class StoriesController extends Controller
{

    public function index(){
        $section = Section::all();
        return view('frontend.add_story')->with([
            'sections' => $section
        ]);
    }

    public function edit($id){
        $story = Story::with('tags')->findOrFail($id);
        $values = $story->tags;
        $tagsCom = "";

        foreach ($values as $value){
            $tagsCom != "" && $tagsCom .= ",";
            $tagsCom .= $value->name;
        }
//        dd($tagsCom);
        $section = Section::all();
        return view('frontend.edit_story')->with([
            'story'   => $story,
            'sections' => $section,
            'tags_values'=>$tagsCom
        ]);
    }

    public function store(Request $request){

        $request->validate([
            'title'     => 'required',
            'description'     => 'required',
            'image_caption'     => 'required',
        ]);

        $req_tags = explode(',', $request->tags);
        try {
            DB::beginTransaction();


            $story = new Story();

            $story->title                        = $request->title;
            $story->section_id                   = $request->section_id;
            $story->client_id                    = Auth::guard('client')->user()->id;
            $story->description                  = $request->description;
            $story->status                       = 0;
            $story->img_caption                  = $request->image_caption;

            if ($request->has('image')) {
                $image      = $request->file('image');
                $fileName   = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/stories', $fileName);
                $story->img                       = $fileName;
            }
            $story->save();

            foreach ($req_tags as $id){
                $tag = new Tag();
                $tag->name = $id;
                $tag->story_id = $story->id;
                $tag->save();
            }

            DB::commit();
            return redirect()->route('client.story')->with([
                'status'    => 'success',
                'message'      => 'Stories has been successfully added.'
            ]);

        }catch (Throwable $exception){
            DB::rollBack();
        }
        return redirect()->route('client.story')->with([
            'status'    => 'success',
            'message'      => 'Some thing wrong.'
        ]);
    }

    public function delete($id){

        $story = Tag::where('story_id', $id)->exists();

        if($story) {
            Tag::where([
                'story_id' => $id
            ])->delete();
            Story::where([
                'id' => $id
            ])->delete();
            return redirect()->back()->with([
                'status' => 'success',
                'message' => 'Successfully deleted story.'
            ]);
        }else {
            Story::where([
                'id' => $id
            ])->delete();
            return redirect()->back()->with([
                'status' => 'success',
                'message' => 'Successfully deleted story.'
            ]);
        }
    }

    public function update(Request $request, $id){
        $request->validate([
            'title'     => 'required',
            'description'     => 'required',
            'image_caption'     => 'required',
        ]);

        $req_tags = explode(',', $request->tags);

        try {
            DB::beginTransaction();

            $story = Story::find($id);

            $story->title                        = $request->title;
            $story->section_id                   = $request->section_id;
            $story->client_id                    = Auth::guard('client')->user()->id;
            $story->description                  = $request->description;
            $story->status                       = 0;
            $story->img_caption                  = $request->image_caption;

            if ($request->has('image')) {
                unlink(storage_path('app/public/stories/' . $story->img));
                $image      = $request->file('image');
                $fileName   = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/stories', $fileName);
                $story->img                       = $fileName;
            }
            $story->save();
            Tag::where('story_id', $id)->delete();

            foreach ($req_tags as $id){
                $tag = new Tag();
                $tag->name = $id;
                $tag->story_id = $story->id;
                $tag->save();
            }

            DB::commit();
            return redirect()->route('client.dashboard')->with([
                'status'    => 'success',
                'message'      => 'Stories has been successfully updated.'
            ]);

        }catch (Throwable $exception){
            DB::rollBack();
        }
        return redirect()->route('client.edit')->with([
            'status'    => 'success',
            'message'      => 'Some thing wrong.'
        ]);
    }
}
