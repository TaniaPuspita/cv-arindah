<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class HomepageServiceController extends Controller
{
    public function index()
    {
        $services = HomepageService::orderBy('sort_order')
            ->orderBy('id')
            ->paginate(10);

        return view('admin.homepage-services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.homepage-services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150', 'unique:homepage_services,name'],
            'description' => ['required', 'string'],
            'icon' => ['nullable', 'string', 'max:100'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'sort_order' => ['required', 'integer', 'min:1'],
            'is_active' => ['required', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('homepage-services', 'public');
        }

        HomepageService::create($validated);

        return redirect()
            ->route('admin.homepage-services.index')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(HomepageService $homepageService)
    {
        return view(
            'admin.homepage-services.edit',
            compact('homepageService')
        );
    }

    public function update(Request $request, HomepageService $homepageService)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:150',
                Rule::unique('homepage_services', 'name')
                    ->ignore($homepageService->id),
            ],
            'description' => ['required', 'string'],
            'icon' => ['nullable', 'string', 'max:100'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'sort_order' => ['required', 'integer', 'min:1'],
            'is_active' => ['required', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $newImage = $request->file('image')
                ->store('homepage-services', 'public');

            if ($homepageService->image) {
                Storage::disk('public')->delete($homepageService->image);
            }

            $validated['image'] = $newImage;
        } else {
            unset($validated['image']);
        }

        $homepageService->update($validated);

        return redirect()
            ->route('admin.homepage-services.index')
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(HomepageService $homepageService)
    {
        if ($homepageService->image) {
            Storage::disk('public')->delete($homepageService->image);
        }

        $homepageService->delete();

        return redirect()
            ->route('admin.homepage-services.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }
}
