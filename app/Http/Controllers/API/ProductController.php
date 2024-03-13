<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\IndexProduct;
use App\Http\Requests\Product\StoreProduct;
use App\Http\Requests\Product\UpdateProduct;
use App\Http\Requests\Product\DestroyProduct;
use App\Models\Product;
use App\Repositories\Products;
use Illuminate\Http\Request;
use Savannabits\JetstreamInertiaGenerator\Helpers\ApiResponse;
use Savannabits\Pagetables\Column;
use Savannabits\Pagetables\Pagetables;
use Yajra\DataTables\DataTables;

class ProductController  extends Controller
{
    private ApiResponse $api;
    private Products $repo;
    public function __construct(ApiResponse $apiResponse, Products $repo)
    {
        $this->api = $apiResponse;
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource (paginated).
     * @return columnsToQuery \Illuminate\Http\JsonResponse
     */
    public function index(IndexProduct $request)
    {
        $query = Product::query(); // You can extend this however you want.
        $cols = [
            Column::name('id')->title('Id')->sort()->searchable(),
            Column::name('name')->title('Name')->sort()->searchable(),
            Column::name('barcode')->title('Barcode')->sort()->searchable(),
            Column::name('price')->title('Price')->sort()->searchable(),
            Column::name('updated_at')->title('Updated At')->sort()->searchable(),
            
            Column::name('actions')->title('')->raw()
        ];
        $data = Pagetables::of($query)->columns($cols)->make(true);
        return $this->api->success()->message("List of Products")->payload($data)->send();
    }

    public function dt(Request $request) {
        $query = Product::query()->select(Product::getModel()->getTable().'.*'); // You can extend this however you want.
        return $this->repo::dt($query);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProduct $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreProduct $request)
    {
        try {
            $data = $request->sanitizedObject();
            $product = $this->repo::store($data);
            return $this->api->success()->message('Product Created')->payload($product)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->payload([])->code(500)->send();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Product $product)
    {
        try {
            $payload = $this->repo::init($product)->show($request);
            return $this->api->success()
                        ->message("Product $product->id")
                        ->payload($payload)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->send();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProduct $request
     * @param {$modelBaseName} $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProduct $request, Product $product)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($product)->update($data);
            return $this->api->success()->message("Product has been updated")->payload($res)->code(200)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->code(400)->message($exception->getMessage())->send();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(DestroyProduct $request, Product $product)
    {
        $res = $this->repo::init($product)->destroy();
        return $this->api->success()->message("Product has been deleted")->payload($res)->code(200)->send();
    }

}
