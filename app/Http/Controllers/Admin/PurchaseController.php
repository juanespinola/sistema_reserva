<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Purchase\IndexPurchase;
use App\Http\Requests\Purchase\StorePurchase;
use App\Http\Requests\Purchase\UpdatePurchase;
use App\Http\Requests\Purchase\DestroyPurchase;
use App\Models\Purchase;
use App\Repositories\Purchases;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class PurchaseController  extends Controller
{
    private Purchases $repo;
    public function __construct(Purchases $repo)
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
        $this->authorize('viewAny', Purchase::class);
        return Inertia::render('Purchases/Index',[
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', Purchase::class),
                "create" => \Auth::user()->can('create', Purchase::class),
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
        $this->authorize('create', Purchase::class);
        return Inertia::render("Purchases/Create",[
            "can" => [
            "viewAny" => \Auth::user()->can('viewAny', Purchase::class),
            "create" => \Auth::user()->can('create', Purchase::class),
            ]
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param StorePurchase $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function store(StorePurchase $request)
    {
        try {
            $data = $request->sanitizedObject();
            $purchase = $this->repo::store($data);
            return back()->with(['success' => "The Purchase was created succesfully."]);
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
    * @param Purchase $purchase
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function show(Request $request, Purchase $purchase)
    {
        try {
            $this->authorize('view', $purchase);
            $model = $this->repo::init($purchase)->show($request);
            return Inertia::render("Purchases/Show", ["model" => $model]);
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
    * @param Purchase $purchase
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function edit(Request $request, Purchase $purchase)
    {
        try {
            $this->authorize('update', $purchase);
            //Fetch relationships
            

                        return Inertia::render("Purchases/Edit", ["model" => $purchase]);
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
    * @param UpdatePurchase $request
    * @param {$modelBaseName} $purchase
    * @return \Illuminate\Http\RedirectResponse
    */
    public function update(UpdatePurchase $request, Purchase $purchase)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($purchase)->update($data);
            return back()->with(['success' => "The Purchase was updated succesfully."]);
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
    * @param Purchase $purchase
    * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(DestroyPurchase $request, Purchase $purchase)
    {
        $res = $this->repo::init($purchase)->destroy();
        if ($res) {
            return back()->with(['success' => "The Purchase was deleted succesfully."]);
        }
        else {
            return back()->with(['error' => "The Purchase could not be deleted."]);
        }
    }
}
