<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationPlace\IndexReservationPlace;
use App\Http\Requests\ReservationPlace\StoreReservationPlace;
use App\Http\Requests\ReservationPlace\UpdateReservationPlace;
use App\Http\Requests\ReservationPlace\DestroyReservationPlace;
use App\Models\ReservationPlace;
use App\Repositories\ReservationPlaces;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class ReservationPlaceController  extends Controller
{
    private ReservationPlaces $repo;
    public function __construct(ReservationPlaces $repo)
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
        $this->authorize('viewAny', ReservationPlace::class);
        return Inertia::render('ReservationPlaces/Index',[
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', ReservationPlace::class),
                "create" => \Auth::user()->can('create', ReservationPlace::class),
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
        $this->authorize('create', ReservationPlace::class);
        return Inertia::render("ReservationPlaces/Create",[
            "can" => [
            "viewAny" => \Auth::user()->can('viewAny', ReservationPlace::class),
            "create" => \Auth::user()->can('create', ReservationPlace::class),
            ]
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param StoreReservationPlace $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function store(StoreReservationPlace $request)
    {
        try {
            $data = $request->sanitizedObject();
            $reservationPlace = $this->repo::store($data);
            return back()->with(['success' => "The Reservation Place was created succesfully."]);
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
    * @param ReservationPlace $reservationPlace
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function show(Request $request, ReservationPlace $reservationPlace)
    {
        try {
            $this->authorize('view', $reservationPlace);
            $model = $this->repo::init($reservationPlace)->show($request);
            return Inertia::render("ReservationPlaces/Show", ["model" => $model]);
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
    * @param ReservationPlace $reservationPlace
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function edit(Request $request, ReservationPlace $reservationPlace)
    {
        try {
            $this->authorize('update', $reservationPlace);
            //Fetch relationships
            

                        return Inertia::render("ReservationPlaces/Edit", ["model" => $reservationPlace]);
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
    * @param UpdateReservationPlace $request
    * @param {$modelBaseName} $reservationPlace
    * @return \Illuminate\Http\RedirectResponse
    */
    public function update(UpdateReservationPlace $request, ReservationPlace $reservationPlace)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($reservationPlace)->update($data);
            return back()->with(['success' => "The ReservationPlace was updated succesfully."]);
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
    * @param ReservationPlace $reservationPlace
    * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(DestroyReservationPlace $request, ReservationPlace $reservationPlace)
    {
        $res = $this->repo::init($reservationPlace)->destroy();
        if ($res) {
            return back()->with(['success' => "The ReservationPlace was deleted succesfully."]);
        }
        else {
            return back()->with(['error' => "The ReservationPlace could not be deleted."]);
        }
    }
}
