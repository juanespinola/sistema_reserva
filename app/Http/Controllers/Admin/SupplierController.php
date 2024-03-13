<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Supplier\IndexSupplier;
use App\Http\Requests\Supplier\StoreSupplier;
use App\Http\Requests\Supplier\UpdateSupplier;
use App\Http\Requests\Supplier\DestroySupplier;
use App\Models\Supplier;
use App\Repositories\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class SupplierController  extends Controller
{
    private Suppliers $repo;
    public function __construct(Suppliers $repo)
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
        $this->authorize('viewAny', Supplier::class);
        return Inertia::render('Suppliers/Index',[
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', Supplier::class),
                "create" => \Auth::user()->can('create', Supplier::class),
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
        $this->authorize('create', Supplier::class);
        return Inertia::render("Suppliers/Create",[
            "can" => [
            "viewAny" => \Auth::user()->can('viewAny', Supplier::class),
            "create" => \Auth::user()->can('create', Supplier::class),
            ]
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param StoreSupplier $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function store(StoreSupplier $request)
    {
        try {
            $data = $request->sanitizedObject();
            $supplier = $this->repo::store($data);
            return back()->with(['success' => "The Supplier was created succesfully."]);
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
    * @param Supplier $supplier
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function show(Request $request, Supplier $supplier)
    {
        try {
            $this->authorize('view', $supplier);
            $model = $this->repo::init($supplier)->show($request);
            return Inertia::render("Suppliers/Show", ["model" => $model]);
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
    * @param Supplier $supplier
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function edit(Request $request, Supplier $supplier)
    {
        try {
            $this->authorize('update', $supplier);
            //Fetch relationships
            

                        return Inertia::render("Suppliers/Edit", ["model" => $supplier]);
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
    * @param UpdateSupplier $request
    * @param {$modelBaseName} $supplier
    * @return \Illuminate\Http\RedirectResponse
    */
    public function update(UpdateSupplier $request, Supplier $supplier)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($supplier)->update($data);
            return back()->with(['success' => "The Supplier was updated succesfully."]);
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
    * @param Supplier $supplier
    * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(DestroySupplier $request, Supplier $supplier)
    {
        $res = $this->repo::init($supplier)->destroy();
        if ($res) {
            return back()->with(['success' => "The Supplier was deleted succesfully."]);
        }
        else {
            return back()->with(['error' => "The Supplier could not be deleted."]);
        }
    }
}
