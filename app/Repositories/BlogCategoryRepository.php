<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BlogCategoryRepository
 * @package App\Repositories
 */

class BlogCategoryRepository extends CoreRepository
{
    /**
     * @param $id
     * Возвращает для редактирования нужные поля записи.
     *
     * Получить модель для редактирования в админке.
     * @return mixed
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }


    /**
     * @return Collection
     * Возвращает все записи категорий для списка
     */
    public function getForComboBox()
    {
      //  return $this->startConditions()->all();
        $columns = implode(', ', [
            'id',
            'CONCAT (id, ". ", title) AS id_title',
        ]);
        /*
        $result[] = $this->startConditions()->all();
        $result[] = $this
            ->startConditions()
            ->select('blog_categories.*',
            \DB::raw('CONCAT(id, '. ', title) AS id_title'))
            ->toBase()
            ->get();
        */
        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();

        return $result;
    }

    public function getAllWithPaginate($perpage = null)
    {
        $columns =
            [
                'id',
                'title',
                'parent_id',
            ];
        $result = $this
            ->startConditions()
            ->select($columns)
            ->paginate($perpage);

        return $result;
    }

    /**
     * Получить модель для редактирования в админке.
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}
