<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rating\IndexRating;
use App\Http\Requests\Rating\StoreRating;
use App\Http\Requests\Rating\UpdateRating;
use App\Http\Requests\Rating\DestroyRating;
use App\Models\Rating;
use App\Repositories\Ratings;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class RatingController  extends Controller
{
    private Ratings $repo;
    public function __construct(Ratings $repo)
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
        $this->authorize('viewAny', Rating::class);
        return Inertia::render('Ratings/Index',[
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', Rating::class),
                "create" => \Auth::user()->can('create', Rating::class),
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
        $this->authorize('create', Rating::class);
        return Inertia::render("Ratings/Create",[
            "can" => [
            "viewAny" => \Auth::user()->can('viewAny', Rating::class),
            "create" => \Auth::user()->can('create', Rating::class),
            ]
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param StoreRating $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function store(StoreRating $request)
    {
        try {
            $data = $request->sanitizedObject();
            $rating = $this->repo::store($data);
            return back()->with(['success' => "The Rating was created succesfully."]);
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
    * @param Rating $rating
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function show(Request $request, Rating $rating)
    {
        try {
            $this->authorize('view', $rating);
            $model = $this->repo::init($rating)->show($request);
            return Inertia::render("Ratings/Show", ["model" => $model]);
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
    * @param Rating $rating
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function edit(Request $request, Rating $rating)
    {
        try {
            $this->authorize('update', $rating);
            //Fetch relationships
            



        $rating->load([
            'customer',
            'reservationPlace',
        ]);
                        return Inertia::render("Ratings/Edit", ["model" => $rating]);
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
    * @param UpdateRating $request
    * @param {$modelBaseName} $rating
    * @return \Illuminate\Http\RedirectResponse
    */
    public function update(UpdateRating $request, Rating $rating)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($rating)->update($data);
            return back()->with(['success' => "The Rating was updated succesfully."]);
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
    * @param Rating $rating
    * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(DestroyRating $request, Rating $rating)
    {
        $res = $this->repo::init($rating)->destroy();
        if ($res) {
            return back()->with(['success' => "The Rating was deleted succesfully."]);
        }
        else {
            return back()->with(['error' => "The Rating could not be deleted."]);
        }
    }
}
