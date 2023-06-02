<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;

abstract class Repository
{
    /** @var string */
    const MODEL = null;

    public function where($column, $operator = null, $value = null, $boolean = 'and'): Builder
    {
        /** @var Builder $builder */
        $builder = call_user_func([$this::MODEL, 'query']);

        $columnTables = modelColumnConfig($this::MODEL);

        return $builder->where();
    }
}
