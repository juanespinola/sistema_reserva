<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\IndexCustomer;
use App\Http\Requests\Customer\StoreCustomer;
use App\Http\Requests\Customer\UpdateCustomer;
use App\Http\Requests\Customer\DestroyCustomer;
use App\Models\Customer;
use App\Repositories\Customers;
use Illuminate\Http\Request;
use Savannabits\JetstreamInertiaGenerator\Helpers\ApiResponse;
use Savannabits\Pagetables\Column;
use Savannabits\Pagetables\Pagetables;
use Yajra\DataTables\DataTables;

class CustomerController  extends Controller
{
    private ApiResponse $api;
    private Customers $repo;
    public function __construct(ApiResponse $apiResponse, Customers $repo)
    {
        $this->api = $apiResponse;
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource (paginated).
     * @return columnsToQuery \Illuminate\Http\JsonResponse
     */
    public function index(IndexCustomer $request)
    {
        $query = Customer::query(); // You can extend this however you want.
        $cols = [
            Column::name('id')->title('Id')->sort()->searchable(),
            Column::name('name')->title('Name')->sort()->searchable(),
            Column::name('email')->title('Email')->sort()->searchable(),
            Column::name('phone')->title('Phone')->sort()->searchable(),
            Column::name('updated_at')->title('Updated At')->sort()->searchable(),
            
            Column::name('actions')->title('')->raw()
        ];
        $data = Pagetables::of($query)->columns($cols)->make(true);
        return $this->api->success()->message("List of Customers")->payload($data)->send();
    }

    public function dt(Request $request) {
        $query = Customer::query()->select(Customer::getModel()->getTable().'.*'); // You can extend this however you want.
        return $this->repo::dt($query);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCustomer $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCustomer $request)
    {
        try {
            $data = $request->sanitizedObject();
            $customer = $this->repo::store($data);
            return $this->api->success()->message('Customer Created')->payload($customer)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->payload([])->code(500)->send();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Customer $customer
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Customer $customer)
    {
        try {
            $payload = $this->repo::init($customer)->show($request);
            return $this->api->success()
                        ->message("Customer $customer->id")
                        ->payload($payload)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->send();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCustomer $request
     * @param {$modelBaseName} $customer
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCustomer $request, Customer $customer)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($customer)->update($data);
            return $this->api->success()->message("Customer has been updated")->payload($res)->code(200)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->code(400)->message($exception->getMessage())->send();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(DestroyCustomer $request, Customer $customer)
    {
        $res = $this->repo::init($customer)->destroy();
        return $this->api->success()->message("Customer has been deleted")->payload($res)->code(200)->send();
    }

}
