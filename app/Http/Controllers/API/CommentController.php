<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\IndexComment;
use App\Http\Requests\Comment\StoreComment;
use App\Http\Requests\Comment\UpdateComment;
use App\Http\Requests\Comment\DestroyComment;
use App\Models\Comment;
use App\Repositories\Comments;
use Illuminate\Http\Request;
use Savannabits\JetstreamInertiaGenerator\Helpers\ApiResponse;
use Savannabits\Pagetables\Column;
use Savannabits\Pagetables\Pagetables;
use Yajra\DataTables\DataTables;

class CommentController  extends Controller
{
    private ApiResponse $api;
    private Comments $repo;
    public function __construct(ApiResponse $apiResponse, Comments $repo)
    {
        $this->api = $apiResponse;
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource (paginated).
     * @return columnsToQuery \Illuminate\Http\JsonResponse
     */
    public function index(IndexComment $request)
    {
        $query = Comment::query(); // You can extend this however you want.
        $cols = [
            Column::name('id')->title('Id')->sort()->searchable(),
            Column::name('updated_at')->title('Updated At')->sort()->searchable(),
            
            Column::name('actions')->title('')->raw()
        ];
        $data = Pagetables::of($query)->columns($cols)->make(true);
        return $this->api->success()->message("List of Comments")->payload($data)->send();
    }

    public function dt(Request $request) {
        $query = Comment::query()->select(Comment::getModel()->getTable().'.*'); // You can extend this however you want.
        return $this->repo::dt($query);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreComment $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreComment $request)
    {
        try {
            $data = $request->sanitizedObject();
            $comment = $this->repo::store($data);
            return $this->api->success()->message('Comment Created')->payload($comment)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->payload([])->code(500)->send();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Comment $comment)
    {
        try {
            $payload = $this->repo::init($comment)->show($request);
            return $this->api->success()
                        ->message("Comment $comment->id")
                        ->payload($payload)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->message($exception->getMessage())->send();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateComment $request
     * @param {$modelBaseName} $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateComment $request, Comment $comment)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($comment)->update($data);
            return $this->api->success()->message("Comment has been updated")->payload($res)->code(200)->send();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return $this->api->failed()->code(400)->message($exception->getMessage())->send();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(DestroyComment $request, Comment $comment)
    {
        $res = $this->repo::init($comment)->destroy();
        return $this->api->success()->message("Comment has been deleted")->payload($res)->code(200)->send();
    }

}
