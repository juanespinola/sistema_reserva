<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\SalesDetail\IndexSalesDetail;
use App\Http\Requests\SalesDetail\StoreSalesDetail;
use App\Http\Requests\SalesDetail\UpdateSalesDetail;
use App\Http\Requests\SalesDetail\DestroySalesDetail;
use App\Models\SalesDetail;
use App\Repositories\SalesDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class SalesDetailController  extends Controller
{
    private SalesDetails $repo;
    public function __construct(SalesDetails $repo)
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
        $this->authorize('viewAny', SalesDetail::class);
        return Inertia::render('SalesDetails/Index',[
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', SalesDetail::class),
                "create" => \Auth::user()->can('create', SalesDetail::class),
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
        $this->authorize('create', SalesDetail::class);
        return Inertia::render("SalesDetails/Create",[
            "can" => [
            "viewAny" => \Auth::user()->can('viewAny', SalesDetail::class),
            "create" => \Auth::user()->can('create', SalesDetail::class),
            ]
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param StoreSalesDetail $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function store(StoreSalesDetail $request)
    {
        try {
            $data = $request->sanitizedObject();
            $salesDetail = $this->repo::store($data);
            return back()->with(['success' => "The Sales Detail was created succesfully."]);
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
    * @param SalesDetail $salesDetail
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function show(Request $request, SalesDetail $salesDetail)
    {
        try {
            $this->authorize('view', $salesDetail);
            $model = $this->repo::init($salesDetail)->show($request);
            return Inertia::render("SalesDetails/Show", ["model" => $model]);
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
    * @param SalesDetail $salesDetail
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function edit(Request $request, SalesDetail $salesDetail)
    {
        try {
            $this->authorize('update', $salesDetail);
            //Fetch relationships
            



        $salesDetail->load([
            'product',
            'sale',
        ]);
                        return Inertia::render("SalesDetails/Edit", ["model" => $salesDetail]);
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
    * @param UpdateSalesDetail $request
    * @param {$modelBaseName} $salesDetail
    * @return \Illuminate\Http\RedirectResponse
    */
    public function update(UpdateSalesDetail $request, SalesDetail $salesDetail)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($salesDetail)->update($data);
            return back()->with(['success' => "The SalesDetail was updated succesfully."]);
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
    * @param SalesDetail $salesDetail
    * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(DestroySalesDetail $request, SalesDetail $salesDetail)
    {
        $res = $this->repo::init($salesDetail)->destroy();
        if ($res) {
            return back()->with(['success' => "The SalesDetail was deleted succesfully."]);
        }
        else {
            return back()->with(['error' => "The SalesDetail could not be deleted."]);
        }
    }
}
