<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\IndexCustomer;
use App\Http\Requests\Customer\StoreCustomer;
use App\Http\Requests\Customer\UpdateCustomer;
use App\Http\Requests\Customer\DestroyCustomer;
use App\Models\Customer;
use App\Repositories\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class CustomerController  extends Controller
{
    private Customers $repo;
    public function __construct(Customers $repo)
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
        $this->authorize('viewAny', Customer::class);
        return Inertia::render('Customers/Index',[
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', Customer::class),
                "create" => \Auth::user()->can('create', Customer::class),
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
        $this->authorize('create', Customer::class);
        return Inertia::render("Customers/Create",[
            "can" => [
            "viewAny" => \Auth::user()->can('viewAny', Customer::class),
            "create" => \Auth::user()->can('create', Customer::class),
            ]
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param StoreCustomer $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function store(StoreCustomer $request)
    {
        try {
            $data = $request->sanitizedObject();
            $customer = $this->repo::store($data);
            return back()->with(['success' => "The Customer was created succesfully."]);
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
    * @param Customer $customer
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function show(Request $request, Customer $customer)
    {
        try {
            $this->authorize('view', $customer);
            $model = $this->repo::init($customer)->show($request);
            return Inertia::render("Customers/Show", ["model" => $model]);
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
    * @param Customer $customer
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function edit(Request $request, Customer $customer)
    {
        try {
            $this->authorize('update', $customer);
            //Fetch relationships
            

                        return Inertia::render("Customers/Edit", ["model" => $customer]);
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
    * @param UpdateCustomer $request
    * @param {$modelBaseName} $customer
    * @return \Illuminate\Http\RedirectResponse
    */
    public function update(UpdateCustomer $request, Customer $customer)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($customer)->update($data);
            return back()->with(['success' => "The Customer was updated succesfully."]);
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
    * @param Customer $customer
    * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(DestroyCustomer $request, Customer $customer)
    {
        $res = $this->repo::init($customer)->destroy();
        if ($res) {
            return back()->with(['success' => "The Customer was deleted succesfully."]);
        }
        else {
            return back()->with(['error' => "The Customer could not be deleted."]);
        }
    }
}
