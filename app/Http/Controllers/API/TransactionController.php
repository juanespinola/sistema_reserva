<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\IndexTransaction;
use App\Http\Requests\Transaction\StoreTransaction;
use App\Http\Requests\Transaction\UpdateTransaction;
use App\Http\Requests\Transaction\DestroyTransaction;
use App\Models\Transaction;
use App\Repositories\Transactions;
use Illuminate\Http\Request;
use Savannabits\JetstreamInertiaGenerator\Helpers\ApiResponse;
use Savannabits\Pagetables\Column;
use Savannabits\Pagetables\Pagetables;
use Yajra\DataTables\DataTables;

class TransactionController  extends Controller
{
    private ApiResponse $api;
    private Transactions $repo;
    public function __construct(ApiResponse $apiResponse, Transactions $repo)
    {
        $this->api = $apiResponse;
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource (paginated).
     * @return columnsToQuery \Illuminate\Http\JsonResponse
     */
    public function index(IndexTransaction $request)
    {
        $query = Transaction::query(); // You can extend this however you want.
        $cols = [
            
            Column::name('actions')->title('')->raw()
        ];
        $data = Pagetables::of($query)->columns($cols)->make(true);
        return $this->api->success()->message("List of Transactions")->payload($data)->send();
    }

    public function dt(Request $request) {
        $query = Transaction::query()->select(Transaction::getModel()->getTable().'.*'); // You can extend this however you want.
        return $this->repo::dt($query);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTransaction $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTransaction $request)
    {
        try {
            $data = $request->sanitizedObject();
            $transaction = $this->repo::store($data);
            return $this->api->success()->message('Transaction Created')->payload($transaction)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->payload([])->code(500)->send();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Transaction $transaction
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Transaction $transaction)
    {
        try {
            $payload = $this->repo::init($transaction)->show($request);
            return $this->api->success()
                        ->message("Transaction $transaction->id")
                        ->payload($payload)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->send();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTransaction $request
     * @param {$modelBaseName} $transaction
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateTransaction $request, Transaction $transaction)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($transaction)->update($data);
            return $this->api->success()->message("Transaction has been updated")->payload($res)->code(200)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->code(400)->message($exception->getMessage())->send();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Transaction $transaction
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(DestroyTransaction $request, Transaction $transaction)
    {
        $res = $this->repo::init($transaction)->destroy();
        return $this->api->success()->message("Transaction has been deleted")->payload($res)->code(200)->send();
    }

}
