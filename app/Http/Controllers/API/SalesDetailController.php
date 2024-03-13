<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\SalesDetail\IndexSalesDetail;
use App\Http\Requests\SalesDetail\StoreSalesDetail;
use App\Http\Requests\SalesDetail\UpdateSalesDetail;
use App\Http\Requests\SalesDetail\DestroySalesDetail;
use App\Models\SalesDetail;
use App\Repositories\SalesDetails;
use Illuminate\Http\Request;
use Savannabits\JetstreamInertiaGenerator\Helpers\ApiResponse;
use Savannabits\Pagetables\Column;
use Savannabits\Pagetables\Pagetables;
use Yajra\DataTables\DataTables;

class SalesDetailController  extends Controller
{
    private ApiResponse $api;
    private SalesDetails $repo;
    public function __construct(ApiResponse $apiResponse, SalesDetails $repo)
    {
        $this->api = $apiResponse;
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource (paginated).
     * @return columnsToQuery \Illuminate\Http\JsonResponse
     */
    public function index(IndexSalesDetail $request)
    {
        $query = SalesDetail::query(); // You can extend this however you want.
        $cols = [
            Column::name('id')->title('Id')->sort()->searchable(),
            Column::name('quantity')->title('Quantity')->sort()->searchable(),
            Column::name('total_amount')->title('Total Amount')->sort()->searchable(),
            Column::name('updated_at')->title('Updated At')->sort()->searchable(),
            
            Column::name('actions')->title('')->raw()
        ];
        $data = Pagetables::of($query)->columns($cols)->make(true);
        return $this->api->success()->message("List of SalesDetails")->payload($data)->send();
    }

    public function dt(Request $request) {
        $query = SalesDetail::query()->select(SalesDetail::getModel()->getTable().'.*'); // You can extend this however you want.
        return $this->repo::dt($query);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSalesDetail $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreSalesDetail $request)
    {
        try {
            $data = $request->sanitizedObject();
            $salesDetail = $this->repo::store($data);
            return $this->api->success()->message('Sales Detail Created')->payload($salesDetail)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->payload([])->code(500)->send();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param SalesDetail $salesDetail
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, SalesDetail $salesDetail)
    {
        try {
            $payload = $this->repo::init($salesDetail)->show($request);
            return $this->api->success()
                        ->message("Sales Detail $salesDetail->id")
                        ->payload($payload)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->send();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSalesDetail $request
     * @param {$modelBaseName} $salesDetail
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateSalesDetail $request, SalesDetail $salesDetail)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($salesDetail)->update($data);
            return $this->api->success()->message("Sales Detail has been updated")->payload($res)->code(200)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->code(400)->message($exception->getMessage())->send();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SalesDetail $salesDetail
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(DestroySalesDetail $request, SalesDetail $salesDetail)
    {
        $res = $this->repo::init($salesDetail)->destroy();
        return $this->api->success()->message("Sales Detail has been deleted")->payload($res)->code(200)->send();
    }

}
