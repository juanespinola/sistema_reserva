<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Plan\IndexPlan;
use App\Http\Requests\Plan\StorePlan;
use App\Http\Requests\Plan\UpdatePlan;
use App\Http\Requests\Plan\DestroyPlan;
use App\Models\Plan;
use App\Repositories\Plans;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class PlanController  extends Controller
{
    private Plans $repo;
    public function __construct(Plans $repo)
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
        $this->authorize('viewAny', Plan::class);
        return Inertia::render('Plans/Index',[
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', Plan::class),
                "create" => \Auth::user()->can('create', Plan::class),
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
        $this->authorize('create', Plan::class);
        return Inertia::render("Plans/Create",[
            "can" => [
            "viewAny" => \Auth::user()->can('viewAny', Plan::class),
            "create" => \Auth::user()->can('create', Plan::class),
            ]
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param StorePlan $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function store(StorePlan $request)
    {
        try {
            $data = $request->sanitizedObject();
            $plan = $this->repo::store($data);
            return back()->with(['success' => "The Plan was created succesfully."]);
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
    * @param Plan $plan
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function show(Request $request, Plan $plan)
    {
        try {
            $this->authorize('view', $plan);
            $model = $this->repo::init($plan)->show($request);
            return Inertia::render("Plans/Show", ["model" => $model]);
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
    * @param Plan $plan
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function edit(Request $request, Plan $plan)
    {
        try {
            $this->authorize('update', $plan);
            //Fetch relationships
            

                        return Inertia::render("Plans/Edit", ["model" => $plan]);
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
    * @param UpdatePlan $request
    * @param {$modelBaseName} $plan
    * @return \Illuminate\Http\RedirectResponse
    */
    public function update(UpdatePlan $request, Plan $plan)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($plan)->update($data);
            return back()->with(['success' => "The Plan was updated succesfully."]);
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
    * @param Plan $plan
    * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(DestroyPlan $request, Plan $plan)
    {
        $res = $this->repo::init($plan)->destroy();
        if ($res) {
            return back()->with(['success' => "The Plan was deleted succesfully."]);
        }
        else {
            return back()->with(['error' => "The Plan could not be deleted."]);
        }
    }
}
