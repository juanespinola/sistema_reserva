<?php
namespace App\Repositories;

use App\Models\SalesDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Column;

class SalesDetails
{
    private SalesDetail $model;
    public static function init(SalesDetail $model): SalesDetails
    {
        $instance = new self;
        $instance->model = $model;
        return $instance;
    }

    public static function store(object $data): SalesDetail
    {
        $model = new SalesDetail((array) $data);
                // Save Relationships
            

        if (isset($data->product)) {
            $model->product()
                ->associate($data->product->id);
        }
        if (isset($data->sale)) {
            $model->sale()
                ->associate($data->sale->id);
        }
                    

        $model->saveOrFail();
        return $model;
    }

    public function show(Request $request): SalesDetail {
        //Fetch relationships
                $this->model->load([
            'product',
            'sale',
        ]);
    return $this->model;
    }
    public function update(object $data): SalesDetail
    {
        $this->model->update((array) $data);
        
        // Save Relationships
                

        if (isset($data->product)) {
            $this->model->product()
                ->associate($data->product->id);
        }


        if (isset($data->sale)) {
            $this->model->sale()
                ->associate($data->sale->id);
        }
                

        $this->model->saveOrFail();
        return $this->model;
    }

    public function destroy(): bool
    {
        return !!$this->model->delete();
    }
    public static function dtColumns() {
        $columns = [
            Column::make('id')->title('ID')->className('all text-right'),
            Column::make("quantity")->className('min-desktop-lg'),
            Column::make("total_amount")->className('min-desktop-lg'),
            Column::make("created_at")->className('min-tv'),
            Column::make("updated_at")->className('min-tv'),
            Column::make('actions')->className('min-desktop text-right')->orderable(false)->searchable(false),
        ];
        return $columns;
    }
    public static function dt($query) {
        return DataTables::of($query)
            ->editColumn('actions', function (SalesDetail $model) {
                $actions = '';
                if (\Auth::user()->can('view',$model)) $actions .= '<button class="bg-primary hover:bg-primary-600 p-2 px-3 focus:ring-0 focus:outline-none text-white action-button" title="View Details" data-action="show-model" data-tag="button" data-id="'.$model->id.'"><i class="fas fa-eye"></i></button>';
                if (\Auth::user()->can('update',$model)) $actions .= '<button class="bg-secondary hover:bg-secondary-600 p-2 px-3 focus:ring-0 focus:outline-none action-button" title="Edit Record" data-action="edit-model" data-tag="button" data-id="'.$model->id.'"><i class="fas fa-edit"></i></button>';
                if (\Auth::user()->can('delete',$model)) $actions .= '<button class="bg-danger hover:bg-danger-600 p-2 px-3 text-white focus:ring-0 focus:outline-none action-button" title="Delete Record" data-action="delete-model" data-tag="button" data-id="'.$model->id.'"><i class="fas fa-trash"></i></button>';
                return "<div class='gap-x-1 flex w-full justify-end'>".$actions."</div>";
            })
            ->rawColumns(['actions'])
            ->make();
    }
}
