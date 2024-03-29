<?php

namespace App\Http\Controllers;

use App\Events\CreateActivityEvent;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoriesController extends Controller
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('categories.index', [
            'categories' => $this->categoryRepository->getAllCategoriesOrderedByType(),
            'titleRight' => 'Categorías',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $type
     *
     * @return View
     */
    public function create(string $type): View
    {
        return view('categories.form', [
            'method'     => 'POST',
            'route'      => route('categories.store'),
            'titleRight' => 'Nueva categoría',
            'type'       => $type,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $category = $this->categoryRepository->createCategory(
            $request->only([
                'color',
                'icon',
                'name',
                'type',
            ])
        );

        event(new CreateActivityEvent(
            $category,
            'category',
            'Categoría creada',
            'Se ha creado la categoría '.$category->name,
            route('categories.index')
        ));

        return redirect()->route('categories.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function edit(Category $category): View
    {
        return view('categories.form', [
            'category'   => $category,
            'method'     => 'PUT',
            'route'      => route('categories.update', $category),
            'titleRight' => 'Editar categoría'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCategoryRequest $request
     * @param  Category              $category
     *
     * @return RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $this->categoryRepository->updateCategory(
            $category,
            $request->only([
                'color',
                'icon',
                'name',
            ])
        );

        event(new CreateActivityEvent(
            $category,
            'category',
            'Categoría actualizada',
            'Se ha actualizado la cuenta '.$category->name,
            route('categories.index')
        ));

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     *
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        $this->categoryRepository->deleteCategory($category);

        event(new CreateActivityEvent(
            $category,
            'category',
            'Categoría eliminada',
            'Se ha eliminado la categoría '.$category->name,
            ''
        ));

        return redirect()->route('categories.index');
    }
}
