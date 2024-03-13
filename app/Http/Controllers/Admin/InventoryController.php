<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\IndexInventory;
use App\Http\Requests\Inventory\StoreInventory;
use App\Http\Requests\Inventory\UpdateInventory;
use App\Http\Requests\Inventory\DestroyInventory;
use App\Models\Inventory;
use App\Repositories\Inventories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class InventoryController  extends Controller
{
    private Inventories $repo;
    public function __construct(Inventories $repo)
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
        $this->authorize('viewAny', Inventory::class);
        return Inertia::render('Inventories/Index',[
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', Inventory::class),
                "create" => \Auth::user()->can('create', Inventory::class),
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
        $this->authorize('create', Inventory::class);
        return Inertia::render("Inventories/Create",[
            "can" => [
            "viewAny" => \Auth::user()->can('viewAny', Inventory::class),
            "create" => \Auth::user()->can('create', Inventory::class),
            ]
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param StoreInventory $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function store(StoreInventory $request)
    {
        try {
            $data = $request->sanitizedObject();
            $inventory = $this->repo::store($data);
            return back()->with(['success' => "The Inventory was created succesfully."]);
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
    * @param Inventory $inventory
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function show(Request $request, Inventory $inventory)
    {
        try {
            $this->authorize('view', $inventory);
            $model = $this->repo::init($inventory)->show($request);
            return Inertia::render("Inventories/Show", ["model" => $model]);
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
    * @param Inventory $inventory
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function edit(Request $request, Inventory $inventory)
    {
        try {
            $this->authorize('update', $inventory);
            //Fetch relationships
            



        $inventory->load([
            'product',
        ]);
                        return Inertia::render("Inventories/Edit", ["model" => $inventory]);
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
    * @param UpdateInventory $request
    * @param {$modelBaseName} $inventory
    * @return \Illuminate\Http\RedirectResponse
    */
    public function update(UpdateInventory $request, Inventory $inventory)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($inventory)->update($data);
            return back()->with(['success' => "The Inventory was updated succesfully."]);
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
    * @param Inventory $inventory
    * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(DestroyInventory $request, Inventory $inventory)
    {
        $res = $this->repo::init($inventory)->destroy();
        if ($res) {
            return back()->with(['success' => "The Inventory was deleted succesfully."]);
        }
        else {
            return back()->with(['error' => "The Inventory could not be deleted."]);
        }
    }
}
