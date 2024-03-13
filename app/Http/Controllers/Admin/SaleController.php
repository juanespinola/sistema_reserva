<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sale\IndexSale;
use App\Http\Requests\Sale\StoreSale;
use App\Http\Requests\Sale\UpdateSale;
use App\Http\Requests\Sale\DestroySale;
use App\Models\Sale;
use App\Repositories\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class SaleController  extends Controller
{
    private Sales $repo;
    public function __construct(Sales $repo)
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
        $this->authorize('viewAny', Sale::class);
        return Inertia::render('Sales/Index',[
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', Sale::class),
                "create" => \Auth::user()->can('create', Sale::class),
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
        $this->authorize('create', Sale::class);
        return Inertia::render("Sales/Create",[
            "can" => [
            "viewAny" => \Auth::user()->can('viewAny', Sale::class),
            "create" => \Auth::user()->can('create', Sale::class),
            ]
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param StoreSale $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function store(StoreSale $request)
    {
        try {
            $data = $request->sanitizedObject();
            $sale = $this->repo::store($data);
            return back()->with(['success' => "The Sale was created succesfully."]);
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
    * @param Sale $sale
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function show(Request $request, Sale $sale)
    {
        try {
            $this->authorize('view', $sale);
            $model = $this->repo::init($sale)->show($request);
            return Inertia::render("Sales/Show", ["model" => $model]);
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
    * @param Sale $sale
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function edit(Request $request, Sale $sale)
    {
        try {
            $this->authorize('update', $sale);
            //Fetch relationships
            

                        return Inertia::render("Sales/Edit", ["model" => $sale]);
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
    * @param UpdateSale $request
    * @param {$modelBaseName} $sale
    * @return \Illuminate\Http\RedirectResponse
    */
    public function update(UpdateSale $request, Sale $sale)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($sale)->update($data);
            return back()->with(['success' => "The Sale was updated succesfully."]);
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
    * @param Sale $sale
    * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(DestroySale $request, Sale $sale)
    {
        $res = $this->repo::init($sale)->destroy();
        if ($res) {
            return back()->with(['success' => "The Sale was deleted succesfully."]);
        }
        else {
            return back()->with(['error' => "The Sale could not be deleted."]);
        }
    }
}
