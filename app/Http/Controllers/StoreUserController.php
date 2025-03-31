<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserStoreRequest;
use App\Http\Requests\StoreUserUpdateRequest;
use App\Models\StoreUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StoreUserController extends Controller
{
    public function index(Request $request): View
    {
        $storeUsers = StoreUser::all();

        return view('storeUser.index', [
            'storeUsers' => $storeUsers,
        ]);
    }

    public function create(Request $request): View
    {
        return view('storeUser.create');
    }

    public function store(StoreUserStoreRequest $request): RedirectResponse
    {
        $storeUser = StoreUser::create($request->validated());

        $request->session()->flash('storeUser.id', $storeUser->id);

        return redirect()->route('storeUsers.index');
    }

    public function show(Request $request, StoreUser $storeUser): View
    {
        return view('storeUser.show', [
            'storeUser' => $storeUser,
        ]);
    }

    public function edit(Request $request, StoreUser $storeUser): View
    {
        return view('storeUser.edit', [
            'storeUser' => $storeUser,
        ]);
    }

    public function update(StoreUserUpdateRequest $request, StoreUser $storeUser): RedirectResponse
    {
        $storeUser->update($request->validated());

        $request->session()->flash('storeUser.id', $storeUser->id);

        return redirect()->route('storeUsers.index');
    }

    public function destroy(Request $request, StoreUser $storeUser): RedirectResponse
    {
        $storeUser->delete();

        return redirect()->route('storeUsers.index');
    }
}
