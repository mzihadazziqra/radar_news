<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use App\Http\Requests\StoreNewsRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $allNews = News::with('user', 'category')->whereNotNull('published_at')->latest('published_at')->paginate(9);

        // return view('news.index', compact('allNews'));

        $latestNewsForHero = News::with('user', 'category')
            ->whereNotNull('published_at')
            ->whereNotNull('image_path')
            ->latest('published_at')
            ->take(4)
            ->get();

        $heroMainNews = null;
        $heroSideNews = collect();

        if ($latestNewsForHero->count() > 0) {
            $heroMainNews = $latestNewsForHero->first();
            $heroSideNews = $latestNewsForHero->slice(1);
        }

        $featuredIds = $latestNewsForHero->pluck('id')->toArray();

        $allNews = News::with('user', 'category')
            ->whereNotNull('published_at')
            ->whereNotIn('id', $featuredIds)
            ->latest('published_at')
            ->paginate(6);

        return view('news.index', compact('allNews', 'heroMainNews', 'heroSideNews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request)
    {
        $validatedData = $request->validated();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news_images', 'public');
        }

        $slug = Str::slug($validatedData['title'], '-' . uniqid());

        $dataToSave = [
            'user_id' => Auth::id(),
            'category_id' => $validatedData['category_id'],
            'title' => $validatedData['title'],
            'slug' => $slug,
            'content' => $validatedData['content'],
            'image_path' => $imagePath,
            'published_at' => now(),
        ];

        News::create($dataToSave);

        return redirect()->route('news.create')->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        Gate::authorize('update', $news);

        $categories = Category::orderBy('name')->get();

        return view('news.edit', compact('news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreNewsRequest $request, News $news)
    {
        Gate::authorize('update', $news);

        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            if ($news->image_path && Storage::disk('public')->exists($news->image_path)) {
                Storage::disk('public')->delete($news->image_path);
            }
            $validatedData['image_path'] = $request->file('image')->store('news_images', 'public');
        }

        if ($news->title !== $validatedData['title']) {
            $validatedData['slug'] = Str::slug($validatedData['title'], '-') . '-' . uniqid();
        } else {
            $validatedData['slug'] = $news->slug;
        }

        $news->update($validatedData);

        return redirect()->route('news.show', $news->slug)->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        Gate::authorize('delete', $news);

        if ($news->image_path && Storage::disk('public')->exists($news->image_path)) {
            Storage::disk('public')->delete($news->image_path);
        }

        $news->delete();

        return redirect()->route('news.index')->with('success', 'Berita berhasil dihapus!');
    }
}
