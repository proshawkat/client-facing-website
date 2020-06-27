<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Section;
use App\Story;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::get();
        return view('backend/section')->with('sections', $sections);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend/section_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required'
        ]);

        $section = new Section();

        $section->title                        = $request->title;

        if($section->save()){
            return redirect()->back()->with([
                'success' => 'success',
                'message' => 'Section has been successfully added'
            ]);
        }

        return redirect()->back()->with('error', 'Something wrong!');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $section = Section::where('id', $request->id)->first();
        return response()->json($section);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'title'     => 'required'
        ]);

        $section = Section::find($request->id);

        $section->title     = $request->title;

        if($section->save()){
            return redirect()->back()->with([
                'success' => 'success',
                'message' => 'Section has been successfully update'
            ]);
        }

        return redirect()->back()->with('error', 'Something wrong!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = Story::where('section_id', $id)->exists();
        if($check == true){
            return redirect()->back()->with([
                'success' => 'success',
                'message' => 'You can not delete this. This section already assigned!'
            ]);
        } else {
            Section::where([
                'id' => $id
            ])->delete();
            return redirect()->back()->with([
                'status' => 'success',
                'message' => 'Successfully deleted.'
            ]);
        }
    }
}
