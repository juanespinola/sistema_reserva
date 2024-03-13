<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sale\IndexSale;
use App\Http\Requests\Sale\StoreSale;
use App\Http\Requests\Sale\UpdateSale;
use App\Http\Requests\Sale\DestroySale;
use App\Models\Sale;
use App\Repositories\Sales;
use Illuminate\Http\Request;
use Savannabits\JetstreamInertiaGenerator\Helpers\ApiResponse;
use Savannabits\Pagetables\Column;
use Savannabits\Pagetables\Pagetables;
use Yajra\DataTables\DataTables;

class SaleController  extends Controller
{
    private ApiResponse $api;
    private Sales $repo;
    public function __construct(ApiResponse $apiResponse, Sales $repo)
    {
        $this->api = $apiResponse;
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource (paginated).
     * @return columnsToQuery \Illuminate\Http\JsonResponse
     */
    public function index(IndexSale $request)
    {
        $query = Sale::query(); // You can extend this however you want.
        $cols = [
            Column::name('id')->title('Id')->sort()->searchable(),
            Column::name('sale_date')->title('Sale Date')->sort()->searchable(),
            Column::name('sale_time')->title('Sale Time')->sort()->searchable(),
            Column::name('total_amount')->title('Total Amount')->sort()->searchable(),
            Column::name('updated_at')->title('Updated At')->sort()->searchable(),
            
            Column::name('actions')->title('')->raw()
        ];
        $data = Pagetables::of($query)->columns($cols)->make(true);
        return $this->api->success()->message("List of Sales")->payload($data)->send();
    }

    public function dt(Request $request) {
        $query = Sale::query()->select(Sale::getModel()->getTable().'.*'); // You can extend this however you want.
        return $this->repo::dt($query);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSale $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreSale $request)
    {
        try {
            $data = $request->sanitizedObject();
            $sale = $this->repo::store($data);
            return $this->api->success()->message('Sale Created')->payload($sale)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->payload([])->code(500)->send();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Sale $sale
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Sale $sale)
    {
        try {
            $payload = $this->repo::init($sale)->show($request);
            return $this->api->success()
                        ->message("Sale $sale->id")
                        ->payload($payload)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->send();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSale $request
     * @param {$modelBaseName} $sale
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateSale $request, Sale $sale)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($sale)->update($data);
            return $this->api->success()->message("Sale has been updated")->payload($res)->code(200)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->code(400)->message($exception->getMessage())->send();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Sale $sale
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(DestroySale $request, Sale $sale)
    {
        $res = $this->repo::init($sale)->destroy();
        return $this->api->success()->message("Sale has been deleted")->payload($res)->code(200)->send();
    }

}
