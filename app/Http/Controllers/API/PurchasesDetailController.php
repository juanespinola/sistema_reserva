<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\PurchasesDetail\IndexPurchasesDetail;
use App\Http\Requests\PurchasesDetail\StorePurchasesDetail;
use App\Http\Requests\PurchasesDetail\UpdatePurchasesDetail;
use App\Http\Requests\PurchasesDetail\DestroyPurchasesDetail;
use App\Models\PurchasesDetail;
use App\Repositories\PurchasesDetails;
use Illuminate\Http\Request;
use Savannabits\JetstreamInertiaGenerator\Helpers\ApiResponse;
use Savannabits\Pagetables\Column;
use Savannabits\Pagetables\Pagetables;
use Yajra\DataTables\DataTables;

class PurchasesDetailController  extends Controller
{
    private ApiResponse $api;
    private PurchasesDetails $repo;
    public function __construct(ApiResponse $apiResponse, PurchasesDetails $repo)
    {
        $this->api = $apiResponse;
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource (paginated).
     * @return columnsToQuery \Illuminate\Http\JsonResponse
     */
    public function index(IndexPurchasesDetail $request)
    {
        $query = PurchasesDetail::query(); // You can extend this however you want.
        $cols = [
            Column::name('id')->title('Id')->sort()->searchable(),
            Column::name('quantity')->title('Quantity')->sort()->searchable(),
            Column::name('total_amount')->title('Total Amount')->sort()->searchable(),
            Column::name('updated_at')->title('Updated At')->sort()->searchable(),
            
            Column::name('actions')->title('')->raw()
        ];
        $data = Pagetables::of($query)->columns($cols)->make(true);
        return $this->api->success()->message("List of PurchasesDetails")->payload($data)->send();
    }

    public function dt(Request $request) {
        $query = PurchasesDetail::query()->select(PurchasesDetail::getModel()->getTable().'.*'); // You can extend this however you want.
        return $this->repo::dt($query);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param StorePurchasesDetail $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePurchasesDetail $request)
    {
        try {
            $data = $request->sanitizedObject();
            $purchasesDetail = $this->repo::store($data);
            return $this->api->success()->message('Purchases Detail Created')->payload($purchasesDetail)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->payload([])->code(500)->send();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param PurchasesDetail $purchasesDetail
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, PurchasesDetail $purchasesDetail)
    {
        try {
            $payload = $this->repo::init($purchasesDetail)->show($request);
            return $this->api->success()
                        ->message("Purchases Detail $purchasesDetail->id")
                        ->payload($payload)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->send();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePurchasesDetail $request
     * @param {$modelBaseName} $purchasesDetail
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePurchasesDetail $request, PurchasesDetail $purchasesDetail)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($purchasesDetail)->update($data);
            return $this->api->success()->message("Purchases Detail has been updated")->payload($res)->code(200)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->code(400)->message($exception->getMessage())->send();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PurchasesDetail $purchasesDetail
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(DestroyPurchasesDetail $request, PurchasesDetail $purchasesDetail)
    {
        $res = $this->repo::init($purchasesDetail)->destroy();
        return $this->api->success()->message("Purchases Detail has been deleted")->payload($res)->code(200)->send();
    }

}
