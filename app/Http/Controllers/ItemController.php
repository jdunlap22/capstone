<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class ItemController extends Controller
{
    //authentication added
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::orderBy('title','ASC')->paginate(10);
        return view('items.index')->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->sortBy('name');
        return view('items.create')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        //dd(storage_path());;
        //validate the data
        // if fails, defaults to create() passing errors
        $this->validate($request, ['title'=>'required|string|max:255',
                                   'category_id'=>'required|integer|min:0',
                                   'description'=>'required|string',
                                   'price'=>'required|numeric',
                                   'quantity'=>'required|integer',
                                   'sku'=>'required|string|max:100',
                                   'picture' => 'required|image']); 

        //send to DB (use ELOQUENT)
        $item = new Item;
        $item->title = $request->title;
        $item->category_id = $request->category_id;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->quantity = $request->quantity;
        $item->sku = $request->sku;

        //saving image
        if ($request->hasFile('picture')) {
            $image = $request->file('picture');
        
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location ='images/items/' . $filename;
        
            $image = Image::make($image);
            Storage::disk('public')->put($location, (string) $image->encode());
            $item->picture = $filename;
        
            // resize thumbnail image
            $image = Image::make(public_path('storage/' . $location));
            $image->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('storage/images/items/tn_' . $filename));

            // resize large image
            $image = Image::make(public_path('storage/' . $location));
            $image->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('storage/images/items/lrg_' . $filename));
        }

        Session::flash('success','The item has been added');

        //redirect
        return redirect()->route('items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        $categories = Category::all()->sortBy('name');
        return view('items.edit')->with('item',$item)->with('categories',$categories);
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
        //validate the data
        // if fails, defaults to create() passing errors
        $item = Item::find($id);
        $this->validate($request, ['title'=>'required|string|max:255',
                                   'category_id'=>'required|integer|min:0',
                                   'description'=>'required|string',
                                   'price'=>'required|numeric',
                                   'quantity'=>'required|integer',
                                   'sku'=>'required|string|max:100',
                                   'picture' => 'sometimes|image']);             

        //send to DB (use ELOQUENT)
        $item->title = $request->title;
        $item->category_id = $request->category_id;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->quantity = $request->quantity;
        $item->sku = $request->sku;

        //save image
        if ($request->hasFile('picture')) {
            $image = $request->file('picture');

            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location ='images/items/' . $filename;

            $image = Image::make($image);
            Storage::disk('public')->put($location, (string) $image->encode());

            if (isset($item->picture)) {
                $oldFilename = $item->picture;
                Storage::delete('public/images/items/'.$oldFilename);                
            }

            $item->picture = $filename;
        }

        $item->save(); //saves to DB

        Session::flash('success','The item has been updated');

        //redirect
        return redirect()->route('items.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find item by ID
        $item = Item::find($id);
        // check item existance
        if ($item) {
            //if item has picture delete it
        if (isset($item->picture)) {
            Storage::delete('public/images/items/'. $item->picture);                
        }
        //delete
        $item->delete();
        //message for message showing successful deletion
        Session::flash('success','The item has been deleted');
    } else {
        //failed message
        Session::flash('error', 'The item does not exist.');
    }
        return redirect()->route('items.index');

    }
}
