<?php

namespace App\Models\Relations;

use Illuminate\Database\Eloquent\Builder;

trait WithAble
{
    public function scopeIncludes(Builder $query, QueryRelations $relations)
    {
        return $relations->apply($query);
    }

    public function including(QueryRelations $relations)
    {
        return $this->fresh($relations->withs());
    }
}
