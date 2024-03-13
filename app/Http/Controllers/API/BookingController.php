<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\IndexBooking;
use App\Http\Requests\Booking\StoreBooking;
use App\Http\Requests\Booking\UpdateBooking;
use App\Http\Requests\Booking\DestroyBooking;
use App\Models\Booking;
use App\Repositories\Bookings;
use Illuminate\Http\Request;
use Savannabits\JetstreamInertiaGenerator\Helpers\ApiResponse;
use Savannabits\Pagetables\Column;
use Savannabits\Pagetables\Pagetables;
use Yajra\DataTables\DataTables;

class BookingController  extends Controller
{
    private ApiResponse $api;
    private Bookings $repo;
    public function __construct(ApiResponse $apiResponse, Bookings $repo)
    {
        $this->api = $apiResponse;
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource (paginated).
     * @return columnsToQuery \Illuminate\Http\JsonResponse
     */
    public function index(IndexBooking $request)
    {
        $query = Booking::query(); // You can extend this however you want.
        $cols = [
            Column::name('id')->title('Id')->sort()->searchable(),
            Column::name('start_datetime_booking')->title('Start Datetime Booking')->sort()->searchable(),
            Column::name('end_datetime_booking')->title('End Datetime Booking')->sort()->searchable(),
            Column::name('updated_at')->title('Updated At')->sort()->searchable(),
            
            Column::name('actions')->title('')->raw()
        ];
        $data = Pagetables::of($query)->columns($cols)->make(true);
        return $this->api->success()->message("List of Bookings")->payload($data)->send();
    }

    public function dt(Request $request) {
        $query = Booking::query()->select(Booking::getModel()->getTable().'.*'); // You can extend this however you want.
        return $this->repo::dt($query);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBooking $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreBooking $request)
    {
        try {
            $data = $request->sanitizedObject();
            $booking = $this->repo::store($data);
            return $this->api->success()->message('Booking Created')->payload($booking)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->payload([])->code(500)->send();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Booking $booking
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Booking $booking)
    {
        try {
            $payload = $this->repo::init($booking)->show($request);
            return $this->api->success()
                        ->message("Booking $booking->id")
                        ->payload($payload)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->send();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBooking $request
     * @param {$modelBaseName} $booking
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateBooking $request, Booking $booking)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($booking)->update($data);
            return $this->api->success()->message("Booking has been updated")->payload($res)->code(200)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->code(400)->message($exception->getMessage())->send();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Booking $booking
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(DestroyBooking $request, Booking $booking)
    {
        $res = $this->repo::init($booking)->destroy();
        return $this->api->success()->message("Booking has been deleted")->payload($res)->code(200)->send();
    }

}
