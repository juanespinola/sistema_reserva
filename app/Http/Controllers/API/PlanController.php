<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\Plan\IndexPlan;
use App\Http\Requests\Plan\StorePlan;
use App\Http\Requests\Plan\UpdatePlan;
use App\Http\Requests\Plan\DestroyPlan;
use App\Models\Plan;
use App\Repositories\Plans;
use Illuminate\Http\Request;
use Savannabits\JetstreamInertiaGenerator\Helpers\ApiResponse;
use Savannabits\Pagetables\Column;
use Savannabits\Pagetables\Pagetables;
use Yajra\DataTables\DataTables;

class PlanController  extends Controller
{
    private ApiResponse $api;
    private Plans $repo;
    public function __construct(ApiResponse $apiResponse, Plans $repo)
    {
        $this->api = $apiResponse;
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource (paginated).
     * @return columnsToQuery \Illuminate\Http\JsonResponse
     */
    public function index(IndexPlan $request)
    {
        $query = Plan::query(); // You can extend this however you want.
        $cols = [
            Column::name('id')->title('Id')->sort()->searchable(),
            Column::name('description')->title('Description')->sort()->searchable(),
            Column::name('plan_name')->title('Plan Name')->sort()->searchable(),
            Column::name('updated_at')->title('Updated At')->sort()->searchable(),
            
            Column::name('actions')->title('')->raw()
        ];
        $data = Pagetables::of($query)->columns($cols)->make(true);
        return $this->api->success()->message("List of Plans")->payload($data)->send();
    }

    public function dt(Request $request) {
        $query = Plan::query()->select(Plan::getModel()->getTable().'.*'); // You can extend this however you want.
        return $this->repo::dt($query);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param StorePlan $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePlan $request)
    {
        try {
            $data = $request->sanitizedObject();
            $plan = $this->repo::store($data);
            return $this->api->success()->message('Plan Created')->payload($plan)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->payload([])->code(500)->send();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Plan $plan
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Plan $plan)
    {
        try {
            $payload = $this->repo::init($plan)->show($request);
            return $this->api->success()
                        ->message("Plan $plan->id")
                        ->payload($payload)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->send();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePlan $request
     * @param {$modelBaseName} $plan
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePlan $request, Plan $plan)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($plan)->update($data);
            return $this->api->success()->message("Plan has been updated")->payload($res)->code(200)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->code(400)->message($exception->getMessage())->send();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Plan $plan
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(DestroyPlan $request, Plan $plan)
    {
        $res = $this->repo::init($plan)->destroy();
        return $this->api->success()->message("Plan has been deleted")->payload($res)->code(200)->send();
    }

}
