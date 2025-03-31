<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\StoreUpdateRequest;
use App\Models\Store;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StoreController extends Controller
{
    public function index(Request $request): View
    {
        $stores = Store::all();

        return view('store.index', [
            'stores' => $stores,
        ]);
    }

    public function create(Request $request): View
    {
        return view('store.create');
    }

    public function store(StoreStoreRequest $request): RedirectResponse
    {
        $store = Store::create($request->validated());

        $request->session()->flash('store.id', $store->id);

        return redirect()->route('stores.index');
    }

    public function show(Request $request, Store $store): View
    {
        return view('store.show', [
            'store' => $store,
        ]);
    }

    public function edit(Request $request, Store $store): View
    {
        return view('store.edit', [
            'store' => $store,
        ]);
    }

    public function update(StoreUpdateRequest $request, Store $store): RedirectResponse
    {
        $store->update($request->validated());

        $request->session()->flash('store.id', $store->id);

        return redirect()->route('stores.index');
    }

    public function destroy(Request $request, Store $store): RedirectResponse
    {
        $store->delete();

        return redirect()->route('stores.index');
    }
}
