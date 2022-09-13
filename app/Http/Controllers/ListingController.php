<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    public function index(){
        $tag = request('tag');
        $search = request('search');
        // $listings = Listing::all();.get(
        $listings = Listing::latest()->filter(request(['tag', 'search']))->paginate(6);

        return view('listings.index',[
            'listings' => $listings
        ]);
    }

    public function show(Listing $listing){
        return view('listings.show',[
            'listing' => $listing
        ]);
    }

    public function create(){
        return view('listings.create');
    }

    public function store(Request $request){
       $request->merge(['status' => true]);

       $validated = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings','company')],
            'location' => 'required',
            'website' => ['required', 'URL'],
            'email' => ['required','email'],
            'tags' => ['required'],
            'description' => ['required'],
        ]);
        if($request->hasFile('logo')){
           $validated['logo'] = $request->file('logo')->store('logos','public');
        }

        $validated['user_id'] = auth()->id();

        $validated['status'] = true;

        // $request->file('logo')->store('logo','public') ;
        Listing::create($validated);

        return redirect('/')->with('success', 'Created A Posting Successfully!');

    }

    public function edit(Listing $listing){
        if($listing->user_id != auth()->id());{
            abort(403, 'Unauthorized!');
        }
        return view('listings.edit', ['listing' => $listing]);
    }



    public function destroy(Listing $listing){
        if($listing->user_id != auth()->id());{
            abort(403, 'Unauthorized!');
        }
        $listing->delete();
        return redirect('/')->with('success', 'Deleted Successfully');
    }

    public function update(Listing $listing, Request $request){

        if($listing->user_id != auth()->id());{
            abort(403, 'Unauthorized!');
        }
        $request->merge(['status' => true]);

        $validated = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => ['required', 'URL'],
            'email' => ['required','email'],
            'tags' => ['required'],
            'description' => ['required'],
        ]);
        if($request->hasFile('logo')){
            $validated['logo'] = $request->file('logo')->store('logos','public');
        }

        $validated['status'] = true;

        // $request->file('logo')->store('logo','public') ;
        $listing->update($validated);

        return back()->with('success', 'updated successfully');
    }

    public function manage(Request $request){
        $listings = auth()->user()->listings()->get();

        // dd(auth()->user()->id);
        return view('listings.manage',[
            'listings' => $listings
        ]);
    }

}
