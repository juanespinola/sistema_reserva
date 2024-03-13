<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\PurchasesDetail\IndexPurchasesDetail;
use App\Http\Requests\PurchasesDetail\StorePurchasesDetail;
use App\Http\Requests\PurchasesDetail\UpdatePurchasesDetail;
use App\Http\Requests\PurchasesDetail\DestroyPurchasesDetail;
use App\Models\PurchasesDetail;
use App\Repositories\PurchasesDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class PurchasesDetailController  extends Controller
{
    private PurchasesDetails $repo;
    public function __construct(PurchasesDetails $repo)
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
        $this->authorize('viewAny', PurchasesDetail::class);
        return Inertia::render('PurchasesDetails/Index',[
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', PurchasesDetail::class),
                "create" => \Auth::user()->can('create', PurchasesDetail::class),
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
        $this->authorize('create', PurchasesDetail::class);
        return Inertia::render("PurchasesDetails/Create",[
            "can" => [
            "viewAny" => \Auth::user()->can('viewAny', PurchasesDetail::class),
            "create" => \Auth::user()->can('create', PurchasesDetail::class),
            ]
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param StorePurchasesDetail $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function store(StorePurchasesDetail $request)
    {
        try {
            $data = $request->sanitizedObject();
            $purchasesDetail = $this->repo::store($data);
            return back()->with(['success' => "The Purchases Detail was created succesfully."]);
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
    * @param PurchasesDetail $purchasesDetail
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function show(Request $request, PurchasesDetail $purchasesDetail)
    {
        try {
            $this->authorize('view', $purchasesDetail);
            $model = $this->repo::init($purchasesDetail)->show($request);
            return Inertia::render("PurchasesDetails/Show", ["model" => $model]);
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
    * @param PurchasesDetail $purchasesDetail
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function edit(Request $request, PurchasesDetail $purchasesDetail)
    {
        try {
            $this->authorize('update', $purchasesDetail);
            //Fetch relationships
            



        $purchasesDetail->load([
            'product',
            'purchase',
        ]);
                        return Inertia::render("PurchasesDetails/Edit", ["model" => $purchasesDetail]);
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
    * @param UpdatePurchasesDetail $request
    * @param {$modelBaseName} $purchasesDetail
    * @return \Illuminate\Http\RedirectResponse
    */
    public function update(UpdatePurchasesDetail $request, PurchasesDetail $purchasesDetail)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($purchasesDetail)->update($data);
            return back()->with(['success' => "The PurchasesDetail was updated succesfully."]);
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
    * @param PurchasesDetail $purchasesDetail
    * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(DestroyPurchasesDetail $request, PurchasesDetail $purchasesDetail)
    {
        $res = $this->repo::init($purchasesDetail)->destroy();
        if ($res) {
            return back()->with(['success' => "The PurchasesDetail was deleted succesfully."]);
        }
        else {
            return back()->with(['error' => "The PurchasesDetail could not be deleted."]);
        }
    }
}
