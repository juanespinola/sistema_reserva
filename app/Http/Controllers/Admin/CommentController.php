<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\IndexComment;
use App\Http\Requests\Comment\StoreComment;
use App\Http\Requests\Comment\UpdateComment;
use App\Http\Requests\Comment\DestroyComment;
use App\Models\Comment;
use App\Repositories\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class CommentController  extends Controller
{
    private Comments $repo;
    public function __construct(Comments $repo)
    {
        $this->repo = $repo;
    }

    /**
    * Display a listing of the resource.
    *
    * @param Request $request
    * @return  \Inertia\Response
    * @throws \Illuminate\Auth\Access\AuthorizationException
    */
    public function index(Request $request): \Inertia\Response
    {
        $this->authorize('viewAny', Comment::class);
        return Inertia::render('Comments/Index',[
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', Comment::class),
                "create" => \Auth::user()->can('create', Comment::class),
            ],
            "columns" => $this->repo::dtColumns(),
        ]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Inertia\Response
    */
    public function create()
    {
        $this->authorize('create', Comment::class);
        return Inertia::render("Comments/Create",[
            "can" => [
            "viewAny" => \Auth::user()->can('viewAny', Comment::class),
            "create" => \Auth::user()->can('create', Comment::class),
            ]
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param StoreComment $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function store(StoreComment $request)
    {
        try {
            $data = $request->sanitizedObject();
            $comment = $this->repo::store($data);
            return back()->with(['success' => "The Comment was created succesfully."]);
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return back()->with([
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
    * Display the specified resource.
    *
    * @param Request $request
    * @param Comment $comment
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function show(Request $request, Comment $comment)
    {
        try {
            $this->authorize('view', $comment);
            $model = $this->repo::init($comment)->show($request);
            return Inertia::render("Comments/Show", ["model" => $model]);
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return back()->with([
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
    * Show Edit Form for the specified resource.
    *
    * @param Request $request
    * @param Comment $comment
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function edit(Request $request, Comment $comment)
    {
        try {
            $this->authorize('update', $comment);
            //Fetch relationships
            



        $comment->load([
            'customer',
            'reservationPlace',
        ]);
                        return Inertia::render("Comments/Edit", ["model" => $comment]);
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return back()->with([
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
    * Update the specified resource in storage.
    *
    * @param UpdateComment $request
    * @param {$modelBaseName} $comment
    * @return \Illuminate\Http\RedirectResponse
    */
    public function update(UpdateComment $request, Comment $comment)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($comment)->update($data);
            return back()->with(['success' => "The Comment was updated succesfully."]);
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return back()->with([
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param Comment $comment
    * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(DestroyComment $request, Comment $comment)
    {
        $res = $this->repo::init($comment)->destroy();
        if ($res) {
            return back()->with(['success' => "The Comment was deleted succesfully."]);
        }
        else {
            return back()->with(['error' => "The Comment could not be deleted."]);
        }
    }
}
