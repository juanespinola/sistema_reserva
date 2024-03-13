<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\Supplier\IndexSupplier;
use App\Http\Requests\Supplier\StoreSupplier;
use App\Http\Requests\Supplier\UpdateSupplier;
use App\Http\Requests\Supplier\DestroySupplier;
use App\Models\Supplier;
use App\Repositories\Suppliers;
use Illuminate\Http\Request;
use Savannabits\JetstreamInertiaGenerator\Helpers\ApiResponse;
use Savannabits\Pagetables\Column;
use Savannabits\Pagetables\Pagetables;
use Yajra\DataTables\DataTables;

class SupplierController  extends Controller
{
    private ApiResponse $api;
    private Suppliers $repo;
    public function __construct(ApiResponse $apiResponse, Suppliers $repo)
    {
        $this->api = $apiResponse;
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource (paginated).
     * @return columnsToQuery \Illuminate\Http\JsonResponse
     */
    public function index(IndexSupplier $request)
    {
        $query = Supplier::query(); // You can extend this however you want.
        $cols = [
            Column::name('id')->title('Id')->sort()->searchable(),
            Column::name('description')->title('Description')->sort()->searchable(),
            Column::name('contact_name')->title('Contact Name')->sort()->searchable(),
            Column::name('phone_name')->title('Phone Name')->sort()->searchable(),
            Column::name('updated_at')->title('Updated At')->sort()->searchable(),
            
            Column::name('actions')->title('')->raw()
        ];
        $data = Pagetables::of($query)->columns($cols)->make(true);
        return $this->api->success()->message("List of Suppliers")->payload($data)->send();
    }

    public function dt(Request $request) {
        $query = Supplier::query()->select(Supplier::getModel()->getTable().'.*'); // You can extend this however you want.
        return $this->repo::dt($query);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSupplier $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreSupplier $request)
    {
        try {
            $data = $request->sanitizedObject();
            $supplier = $this->repo::store($data);
            return $this->api->success()->message('Supplier Created')->payload($supplier)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->payload([])->code(500)->send();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Supplier $supplier
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Supplier $supplier)
    {
        try {
            $payload = $this->repo::init($supplier)->show($request);
            return $this->api->success()
                        ->message("Supplier $supplier->id")
                        ->payload($payload)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->send();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSupplier $request
     * @param {$modelBaseName} $supplier
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateSupplier $request, Supplier $supplier)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($supplier)->update($data);
            return $this->api->success()->message("Supplier has been updated")->payload($res)->code(200)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->code(400)->message($exception->getMessage())->send();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Supplier $supplier
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(DestroySupplier $request, Supplier $supplier)
    {
        $res = $this->repo::init($supplier)->destroy();
        return $this->api->success()->message("Supplier has been deleted")->payload($res)->code(200)->send();
    }

}
