<?php

namespace App\Http\Controllers;

use App\Pharmacy;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drugs = Pharmacy::orderBy('created_at', 'desc')->paginate(12);
        $searchKey = '';
        return view('admin/pharmacy/index')->with('drugs', $drugs)->with('searchKey', $searchKey);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/pharmacy/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'description' => ['required'],
            'price' => ['required', 'numeric'],
        ]);

        Pharmacy::Create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect('admin/pharmacy')->with('success', 'Drug added to Pharmacy successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function show(Pharmacy $pharmacy)
    {
        return view('admin/pharmacy/view')->with('drug', $pharmacy);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function edit(Pharmacy $pharmacy)
    {
        return view('admin/pharmacy/edit')->with('drug', $pharmacy);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pharmacy $pharmacy)
    {
        $this->validate($request, [
            'name' => ['required'],
            'description' => ['required'],
            'price' => ['required', 'numeric'],
        ]);

        $pharmacy->name = $request->name;
        $pharmacy->description = $request->description;
        $pharmacy->price = $request->price;
        $pharmacy->save();

        return redirect('admin/pharmacy')->with('success', 'Drug updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pharmacy $pharmacy)
    {
        $pharmacy->delete();
        return redirect('admin/pharmacy')->with('success', 'Drug, removed successfully');
    }
}
