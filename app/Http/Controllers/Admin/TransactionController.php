<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\IndexTransaction;
use App\Http\Requests\Transaction\StoreTransaction;
use App\Http\Requests\Transaction\UpdateTransaction;
use App\Http\Requests\Transaction\DestroyTransaction;
use App\Models\Transaction;
use App\Repositories\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class TransactionController  extends Controller
{
    private Transactions $repo;
    public function __construct(Transactions $repo)
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
        $this->authorize('viewAny', Transaction::class);
        return Inertia::render('Transactions/Index',[
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', Transaction::class),
                "create" => \Auth::user()->can('create', Transaction::class),
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
        $this->authorize('create', Transaction::class);
        return Inertia::render("Transactions/Create",[
            "can" => [
            "viewAny" => \Auth::user()->can('viewAny', Transaction::class),
            "create" => \Auth::user()->can('create', Transaction::class),
            ]
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param StoreTransaction $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function store(StoreTransaction $request)
    {
        try {
            $data = $request->sanitizedObject();
            $transaction = $this->repo::store($data);
            return back()->with(['success' => "The Transaction was created succesfully."]);
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
    * @param Transaction $transaction
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function show(Request $request, Transaction $transaction)
    {
        try {
            $this->authorize('view', $transaction);
            $model = $this->repo::init($transaction)->show($request);
            return Inertia::render("Transactions/Show", ["model" => $model]);
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
    * @param Transaction $transaction
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function edit(Request $request, Transaction $transaction)
    {
        try {
            $this->authorize('update', $transaction);
            //Fetch relationships
            

                        return Inertia::render("Transactions/Edit", ["model" => $transaction]);
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
    * @param UpdateTransaction $request
    * @param {$modelBaseName} $transaction
    * @return \Illuminate\Http\RedirectResponse
    */
    public function update(UpdateTransaction $request, Transaction $transaction)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($transaction)->update($data);
            return back()->with(['success' => "The Transaction was updated succesfully."]);
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
    * @param Transaction $transaction
    * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(DestroyTransaction $request, Transaction $transaction)
    {
        $res = $this->repo::init($transaction)->destroy();
        if ($res) {
            return back()->with(['success' => "The Transaction was deleted succesfully."]);
        }
        else {
            return back()->with(['error' => "The Transaction could not be deleted."]);
        }
    }
}
