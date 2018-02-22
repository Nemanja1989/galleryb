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
        return Gallery::join('users', 'users.id', '=', 'galleries.author_id')
            ->with(['pictures'], function ($q) {
                return $q->whereNotNull('picture_url')->orderBy('order', 'asc');
            })
            ->orderBy('galleries.id', 'asc')
            ->paginate($request['selectCount']);
        /*
        return Gallery::join('users', 'users.id', '=', 'galleries.author_id')
                                -> with(['pictures'])
                                ->paginate($request['selectCount']);*/
        //return Gallery::with(['user', 'pictures'])->paginate($request['selectCount']);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function myGalleries(Request $request) {
        return Gallery::join('users', 'users.id', '=', 'galleries.author_id')
                            ->with('pictures')
                            ->where('author_id', $request['userId'])
                            ->paginate($request['selectCount']);
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
