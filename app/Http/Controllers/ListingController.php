<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo'
        ]);
        // dd($filters);
        return inertia(
            'Listing/Index',
            [
                'filters' => $filters,
                'listings' => Listing::orderByDesc('created_at')
                    ->when(
                        $filters['priceFrom'] ?? false,
                        fn ($query, $value) => $query->where('price', '>=', $value)
                    )->when(
                        $filters['priceTo'] ?? false,
                        fn ($query, $value) => $query->where('price', '<=', $value)
                    )->when(
                        $filters['beds'] ?? false,
                        fn ($query, $value) => $query->where('beds', (int) $value < 6 ? '=' : '>=', $value)
                    )->when(
                        $filters['baths'] ?? false,
                        fn ($query, $value) => $query->where('baths', (int) $value < 6 ? '=' : '>=', $value)
                    )->when(
                        $filters['areaFrom'] ?? false,
                        fn ($query, $value) => $query->where('area', '>=', $value)
                    )->when(
                        $filters['areaTo'] ?? false,
                        fn ($query, $value) => $query->where('area', '<=', $value)
                    )->paginate(10)->withQueryString()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $this->authorize('create', Listing::class);
        return inertia(
            'Listing/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $listing =new Listing();
        // $listing->beds = $listing->beds;
        // dd($request->all());

        // Listing::create($request->all());
        $request->user()->listings()->create(
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:15|max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|integer|min:1|max:1000',
                'price' => 'required|integer|min:1|max:2000000',

            ])
        );
        return redirect()->route('listing.index')
            ->with('success', 'Listing was created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {
        // if (Auth::user()->can('view', $listing)) {
        //     abort(403);
        // }
        $this->authorize('view', $listing);
        return inertia(
            'Listing/Show',
            [
                'listing' => $listing
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Listing $listing)
    {
        return inertia(
            'Listing/Edit',
            [
                'listing' => $listing
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Listing $listing)
    {
        $listing->update(
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:15|max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|integer|min:1|max:1000',
                'price' => 'required|integer|min:1|max:2000000',

            ])
        );
        return redirect()->route('listing.index')
            ->with('success', 'Listing was updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        // dd($listing);
        $listing->delete();

        return redirect()->back()->with('success', 'listing was deleted!');
    }
}
