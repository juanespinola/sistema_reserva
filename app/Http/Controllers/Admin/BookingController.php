<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\IndexBooking;
use App\Http\Requests\Booking\StoreBooking;
use App\Http\Requests\Booking\UpdateBooking;
use App\Http\Requests\Booking\DestroyBooking;
use App\Models\Booking;
use App\Repositories\Bookings;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class BookingController  extends Controller
{
    private Bookings $repo;
    public function __construct(Bookings $repo)
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
        $this->authorize('viewAny', Booking::class);
        return Inertia::render('Bookings/Index',[
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', Booking::class),
                "create" => \Auth::user()->can('create', Booking::class),
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
        $this->authorize('create', Booking::class);
        return Inertia::render("Bookings/Create",[
            "can" => [
            "viewAny" => \Auth::user()->can('viewAny', Booking::class),
            "create" => \Auth::user()->can('create', Booking::class),
            ]
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param StoreBooking $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function store(StoreBooking $request)
    {
        try {
            $data = $request->sanitizedObject();
            $booking = $this->repo::store($data);
            return back()->with(['success' => "The Booking was created succesfully."]);
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
    * @param Booking $booking
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function show(Request $request, Booking $booking)
    {
        try {
            $this->authorize('view', $booking);
            $model = $this->repo::init($booking)->show($request);
            return Inertia::render("Bookings/Show", ["model" => $model]);
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
    * @param Booking $booking
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function edit(Request $request, Booking $booking)
    {
        try {
            $this->authorize('update', $booking);
            //Fetch relationships
            



        $booking->load([
            'customer',
            'reservationPlace',
        ]);
                        return Inertia::render("Bookings/Edit", ["model" => $booking]);
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
    * @param UpdateBooking $request
    * @param {$modelBaseName} $booking
    * @return \Illuminate\Http\RedirectResponse
    */
    public function update(UpdateBooking $request, Booking $booking)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($booking)->update($data);
            return back()->with(['success' => "The Booking was updated succesfully."]);
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
    * @param Booking $booking
    * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(DestroyBooking $request, Booking $booking)
    {
        $res = $this->repo::init($booking)->destroy();
        if ($res) {
            return back()->with(['success' => "The Booking was deleted succesfully."]);
        }
        else {
            return back()->with(['error' => "The Booking could not be deleted."]);
        }
    }
}
