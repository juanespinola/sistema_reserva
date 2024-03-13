<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\IndexProduct;
use App\Http\Requests\Product\StoreProduct;
use App\Http\Requests\Product\UpdateProduct;
use App\Http\Requests\Product\DestroyProduct;
use App\Models\Product;
use App\Repositories\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class ProductController  extends Controller
{
    private Products $repo;
    public function __construct(Products $repo)
    {
        $this->repo = $repo;
    }

    /**
    * Display a listing of the resource.
    *
    * @param Request $request
    * @return  \Inertia\Response
    * @throws \Illuminate\Auth\Access\AuthorizationException
    */
    public function index(Request $request): \Inertia\Response
    {
        $this->authorize('viewAny', Product::class);
        return Inertia::render('Products/Index',[
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', Product::class),
                "create" => \Auth::user()->can('create', Product::class),
            ],
            "columns" => $this->repo::dtColumns(),
        ]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Inertia\Response
    */
    public function create()
    {
        $this->authorize('create', Product::class);
        return Inertia::render("Products/Create",[
            "can" => [
            "viewAny" => \Auth::user()->can('viewAny', Product::class),
            "create" => \Auth::user()->can('create', Product::class),
            ]
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param StoreProduct $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function store(StoreProduct $request)
    {
        try {
            $data = $request->sanitizedObject();
            $product = $this->repo::store($data);
            return back()->with(['success' => "The Product was created succesfully."]);
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return back()->with([
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
    * Display the specified resource.
    *
    * @param Request $request
    * @param Product $product
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function show(Request $request, Product $product)
    {
        try {
            $this->authorize('view', $product);
            $model = $this->repo::init($product)->show($request);
            return Inertia::render("Products/Show", ["model" => $model]);
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return back()->with([
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
    * Show Edit Form for the specified resource.
    *
    * @param Request $request
    * @param Product $product
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function edit(Request $request, Product $product)
    {
        try {
            $this->authorize('update', $product);
            //Fetch relationships
            



        $product->load([
            'supplier',
        ]);
                        return Inertia::render("Products/Edit", ["model" => $product]);
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return back()->with([
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
    * Update the specified resource in storage.
    *
    * @param UpdateProduct $request
    * @param {$modelBaseName} $product
    * @return \Illuminate\Http\RedirectResponse
    */
    public function update(UpdateProduct $request, Product $product)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($product)->update($data);
            return back()->with(['success' => "The Product was updated succesfully."]);
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return back()->with([
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param Product $product
    * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(DestroyProduct $request, Product $product)
    {
        $res = $this->repo::init($product)->destroy();
        if ($res) {
            return back()->with(['success' => "The Product was deleted succesfully."]);
        }
        else {
            return back()->with(['error' => "The Product could not be deleted."]);
        }
    }
}
