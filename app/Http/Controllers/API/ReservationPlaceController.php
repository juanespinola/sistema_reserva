<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationPlace\IndexReservationPlace;
use App\Http\Requests\ReservationPlace\StoreReservationPlace;
use App\Http\Requests\ReservationPlace\UpdateReservationPlace;
use App\Http\Requests\ReservationPlace\DestroyReservationPlace;
use App\Models\ReservationPlace;
use App\Repositories\ReservationPlaces;
use Illuminate\Http\Request;
use Savannabits\JetstreamInertiaGenerator\Helpers\ApiResponse;
use Savannabits\Pagetables\Column;
use Savannabits\Pagetables\Pagetables;
use Yajra\DataTables\DataTables;

class ReservationPlaceController  extends Controller
{
    private ApiResponse $api;
    private ReservationPlaces $repo;
    public function __construct(ApiResponse $apiResponse, ReservationPlaces $repo)
    {
        $this->api = $apiResponse;
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource (paginated).
     * @return columnsToQuery \Illuminate\Http\JsonResponse
     */
    public function index(IndexReservationPlace $request)
    {
        $query = ReservationPlace::query(); // You can extend this however you want.
        $cols = [
            Column::name('id')->title('Id')->sort()->searchable(),
            Column::name('description')->title('Description')->sort()->searchable(),
            Column::name('location')->title('Location')->sort()->searchable(),
            Column::name('capacity')->title('Capacity')->sort()->searchable(),
            Column::name('updated_at')->title('Updated At')->sort()->searchable(),
            
            Column::name('actions')->title('')->raw()
        ];
        $data = Pagetables::of($query)->columns($cols)->make(true);
        return $this->api->success()->message("List of ReservationPlaces")->payload($data)->send();
    }

    public function dt(Request $request) {
        $query = ReservationPlace::query()->select(ReservationPlace::getModel()->getTable().'.*'); // You can extend this however you want.
        return $this->repo::dt($query);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreReservationPlace $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreReservationPlace $request)
    {
        try {
            $data = $request->sanitizedObject();
            $reservationPlace = $this->repo::store($data);
            return $this->api->success()->message('Reservation Place Created')->payload($reservationPlace)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->payload([])->code(500)->send();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param ReservationPlace $reservationPlace
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, ReservationPlace $reservationPlace)
    {
        try {
            $payload = $this->repo::init($reservationPlace)->show($request);
            return $this->api->success()
                        ->message("Reservation Place $reservationPlace->id")
                        ->payload($payload)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->send();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateReservationPlace $request
     * @param {$modelBaseName} $reservationPlace
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateReservationPlace $request, ReservationPlace $reservationPlace)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($reservationPlace)->update($data);
            return $this->api->success()->message("Reservation Place has been updated")->payload($res)->code(200)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->code(400)->message($exception->getMessage())->send();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ReservationPlace $reservationPlace
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(DestroyReservationPlace $request, ReservationPlace $reservationPlace)
    {
        $res = $this->repo::init($reservationPlace)->destroy();
        return $this->api->success()->message("Reservation Place has been deleted")->payload($res)->code(200)->send();
    }

}
