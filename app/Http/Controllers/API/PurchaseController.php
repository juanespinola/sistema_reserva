<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\Purchase\IndexPurchase;
use App\Http\Requests\Purchase\StorePurchase;
use App\Http\Requests\Purchase\UpdatePurchase;
use App\Http\Requests\Purchase\DestroyPurchase;
use App\Models\Purchase;
use App\Repositories\Purchases;
use Illuminate\Http\Request;
use Savannabits\JetstreamInertiaGenerator\Helpers\ApiResponse;
use Savannabits\Pagetables\Column;
use Savannabits\Pagetables\Pagetables;
use Yajra\DataTables\DataTables;

class PurchaseController  extends Controller
{
    private ApiResponse $api;
    private Purchases $repo;
    public function __construct(ApiResponse $apiResponse, Purchases $repo)
    {
        $this->api = $apiResponse;
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource (paginated).
     * @return columnsToQuery \Illuminate\Http\JsonResponse
     */
    public function index(IndexPurchase $request)
    {
        $query = Purchase::query(); // You can extend this however you want.
        $cols = [
            Column::name('id')->title('Id')->sort()->searchable(),
            Column::name('purchase_date')->title('Purchase Date')->sort()->searchable(),
            Column::name('purchase_time')->title('Purchase Time')->sort()->searchable(),
            Column::name('total_amount')->title('Total Amount')->sort()->searchable(),
            Column::name('updated_at')->title('Updated At')->sort()->searchable(),
            
            Column::name('actions')->title('')->raw()
        ];
        $data = Pagetables::of($query)->columns($cols)->make(true);
        return $this->api->success()->message("List of Purchases")->payload($data)->send();
    }

    public function dt(Request $request) {
        $query = Purchase::query()->select(Purchase::getModel()->getTable().'.*'); // You can extend this however you want.
        return $this->repo::dt($query);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param StorePurchase $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePurchase $request)
    {
        try {
            $data = $request->sanitizedObject();
            $purchase = $this->repo::store($data);
            return $this->api->success()->message('Purchase Created')->payload($purchase)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->payload([])->code(500)->send();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Purchase $purchase
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Purchase $purchase)
    {
        try {
            $payload = $this->repo::init($purchase)->show($request);
            return $this->api->success()
                        ->message("Purchase $purchase->id")
                        ->payload($payload)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->send();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePurchase $request
     * @param {$modelBaseName} $purchase
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePurchase $request, Purchase $purchase)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($purchase)->update($data);
            return $this->api->success()->message("Purchase has been updated")->payload($res)->code(200)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->code(400)->message($exception->getMessage())->send();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Purchase $purchase
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(DestroyPurchase $request, Purchase $purchase)
    {
        $res = $this->repo::init($purchase)->destroy();
        return $this->api->success()->message("Purchase has been deleted")->payload($res)->code(200)->send();
    }

}
