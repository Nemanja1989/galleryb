<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loadGalleries(Request $request) {
        $query = Gallery::query();
        $query->with(['user']);

        // check is author_id set
        if (!empty($request['author_id'])) {
            $query->where('author_id', '=', $request['author_id']);
        }

        if (!empty($request['search_term'])) {
            $term = $request['search_term'];
            $query->where(function($q) use ($term) {
                $q->where('title', 'like', '%' . $term . '%')
                    ->orWhere('description', 'like', '%' . $term . '%')
                    ->orWhereHas('user', function($q) use ($term) {
                        $q->where('first_name', 'like', '%' . $term . '%')
                            ->orWhere('last_name', 'like', '%' . $term . '%');
                    });
            });
        }
        // load ordered pictures
        $query->with(['pictures'], function ($q) {
            return $q->whereNotNull('picture_url')->orderBy('order', 'asc');
        });

        $count = $query->count();
        $galleries = $query->take($request['selectCount'])
            ->orderBy('created_at', 'desc')
            ->get();

        return compact('count', 'galleries');
    }

    /*
     *  area:"all"
        author_id:"0"
        search_term:"test"
        selectCount:"10"
     */

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function myGalleries(Request $request) {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return Gallery::with(['pictures', 'user', 'comments'])
                        ->where('galleries.id', $request['galleryId'])
                        ->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $gallery = Gallery::find($id);

        $gallery->delete();

        return ['success' => true];
    }
}
