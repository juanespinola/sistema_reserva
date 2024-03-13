<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rating\IndexRating;
use App\Http\Requests\Rating\StoreRating;
use App\Http\Requests\Rating\UpdateRating;
use App\Http\Requests\Rating\DestroyRating;
use App\Models\Rating;
use App\Repositories\Ratings;
use Illuminate\Http\Request;
use Savannabits\JetstreamInertiaGenerator\Helpers\ApiResponse;
use Savannabits\Pagetables\Column;
use Savannabits\Pagetables\Pagetables;
use Yajra\DataTables\DataTables;

class RatingController  extends Controller
{
    private ApiResponse $api;
    private Ratings $repo;
    public function __construct(ApiResponse $apiResponse, Ratings $repo)
    {
        $this->api = $apiResponse;
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource (paginated).
     * @return columnsToQuery \Illuminate\Http\JsonResponse
     */
    public function index(IndexRating $request)
    {
        $query = Rating::query(); // You can extend this however you want.
        $cols = [
            Column::name('id')->title('Id')->sort()->searchable(),
            Column::name('rating_value')->title('Rating Value')->sort()->searchable(),
            Column::name('updated_at')->title('Updated At')->sort()->searchable(),
            
            Column::name('actions')->title('')->raw()
        ];
        $data = Pagetables::of($query)->columns($cols)->make(true);
        return $this->api->success()->message("List of Ratings")->payload($data)->send();
    }

    public function dt(Request $request) {
        $query = Rating::query()->select(Rating::getModel()->getTable().'.*'); // You can extend this however you want.
        return $this->repo::dt($query);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRating $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRating $request)
    {
        try {
            $data = $request->sanitizedObject();
            $rating = $this->repo::store($data);
            return $this->api->success()->message('Rating Created')->payload($rating)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->payload([])->code(500)->send();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Rating $rating
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Rating $rating)
    {
        try {
            $payload = $this->repo::init($rating)->show($request);
            return $this->api->success()
                        ->message("Rating $rating->id")
                        ->payload($payload)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->send();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRating $request
     * @param {$modelBaseName} $rating
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRating $request, Rating $rating)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($rating)->update($data);
            return $this->api->success()->message("Rating has been updated")->payload($res)->code(200)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->code(400)->message($exception->getMessage())->send();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Rating $rating
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(DestroyRating $request, Rating $rating)
    {
        $res = $this->repo::init($rating)->destroy();
        return $this->api->success()->message("Rating has been deleted")->payload($res)->code(200)->send();
    }

}
