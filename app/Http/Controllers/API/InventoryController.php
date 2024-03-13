<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\IndexInventory;
use App\Http\Requests\Inventory\StoreInventory;
use App\Http\Requests\Inventory\UpdateInventory;
use App\Http\Requests\Inventory\DestroyInventory;
use App\Models\Inventory;
use App\Repositories\Inventories;
use Illuminate\Http\Request;
use Savannabits\JetstreamInertiaGenerator\Helpers\ApiResponse;
use Savannabits\Pagetables\Column;
use Savannabits\Pagetables\Pagetables;
use Yajra\DataTables\DataTables;

class InventoryController  extends Controller
{
    private ApiResponse $api;
    private Inventories $repo;
    public function __construct(ApiResponse $apiResponse, Inventories $repo)
    {
        $this->api = $apiResponse;
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource (paginated).
     * @return columnsToQuery \Illuminate\Http\JsonResponse
     */
    public function index(IndexInventory $request)
    {
        $query = Inventory::query(); // You can extend this however you want.
        $cols = [
            Column::name('id')->title('Id')->sort()->searchable(),
            Column::name('warehouse_location')->title('Warehouse Location')->sort()->searchable(),
            Column::name('entry_date')->title('Entry Date')->sort()->searchable(),
            Column::name('stock_quantity')->title('Stock Quantity')->sort()->searchable(),
            Column::name('min_allowed_quantity')->title('Min Allowed Quantity')->sort()->searchable(),
            Column::name('updated_at')->title('Updated At')->sort()->searchable(),
            
            Column::name('actions')->title('')->raw()
        ];
        $data = Pagetables::of($query)->columns($cols)->make(true);
        return $this->api->success()->message("List of Inventories")->payload($data)->send();
    }

    public function dt(Request $request) {
        $query = Inventory::query()->select(Inventory::getModel()->getTable().'.*'); // You can extend this however you want.
        return $this->repo::dt($query);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreInventory $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreInventory $request)
    {
        try {
            $data = $request->sanitizedObject();
            $inventory = $this->repo::store($data);
            return $this->api->success()->message('Inventory Created')->payload($inventory)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->payload([])->code(500)->send();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Inventory $inventory
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Inventory $inventory)
    {
        try {
            $payload = $this->repo::init($inventory)->show($request);
            return $this->api->success()
                        ->message("Inventory $inventory->id")
                        ->payload($payload)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->send();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateInventory $request
     * @param {$modelBaseName} $inventory
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateInventory $request, Inventory $inventory)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($inventory)->update($data);
            return $this->api->success()->message("Inventory has been updated")->payload($res)->code(200)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->code(400)->message($exception->getMessage())->send();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Inventory $inventory
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(DestroyInventory $request, Inventory $inventory)
    {
        $res = $this->repo::init($inventory)->destroy();
        return $this->api->success()->message("Inventory has been deleted")->payload($res)->code(200)->send();
    }

}
