<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\SaveRequest;
use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): Factory|View
    {
        $categories = Category::paginate(1);

        return view('admin.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function create(): Factory|View
    {
        return view('admin.categories.create');
    }

    public function store(SaveRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        return redirect()->route('admin.categories.index')
            ->with('success', __('Category created successfully.'));
    }

    public function edit(Category $category): Factory|View
    {
        return view('admin.categories.edit', ['category' => $category]);
    }

    public function update(Category $category, SaveRequest $request): RedirectResponse
    {
        $category->update($request->validated());

        return redirect()->route('admin.categories.index')
            ->with('success', __('Category updated successfully.'));
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', __('Category deleted successfully.'));
    }
}
