<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOprecRegistrationRequest;
use App\Models\OprecRegistration;
use App\Models\OprecSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OprecController extends Controller
{
    public function index(): View
    {
        $setting = OprecSetting::first();

        return view('pages.oprec', compact('setting'));
    }

    public function store(StoreOprecRegistrationRequest $request): RedirectResponse
    {
        OprecRegistration::create($request->validated());

        return redirect()->back()->with('success', 'Pendaftaran berhasil! Silakan tunggu info selanjutnya.');
    }
}
