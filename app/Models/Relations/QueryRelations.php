<?php

namespace App\Models\Relations;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

abstract class QueryRelations
{
    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * The filter object.
     *
     * @var array
     */
    protected $filter;

    /**
     * The builder instance.
     *
     * @var Builder
     */
    protected $builder;

    /**
     * The Model instance.
     *
     * @var Model
     */
    protected $model;

    /**
     * Create a new QueryRelations instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->filter = collect($this->request->get('filter'));
    }

    /**
     * Apply the eager loads to the builder.
     *
     * @param  Builder $builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->withs() as $relation) {
            $this->builder->with($this->buildRelation($relation));
        }

        return $this->builder;
    }

    /**
     * Get the scope from either the model or the method.
     *
     * @param string $relation
     *
     * @return array
     */
    protected function buildRelation($relation)
    {
        if ($this->hasModelScope($relation)) {
            return $this->usingModelScope($relation);
        }

        return $this->usingMethodScope($relation);
    }

    /**
     * Determines if the relation has a model scope.
     *
     * @param string $relation
     *
     * @return bool
     */
    protected function hasModelScope($relation)
    {
        return Str::contains($relation, ':');
    }

    /**
     * Apply a query scope from the model.
     *
     * @param string $relation
     *
     * @return array
     */
    protected function usingModelScope($relation)
    {
        list($relation, $scopes) = explode(':', $relation);

        return [$relation => function ($query) use ($scopes) {
            foreach (explode(',', $scopes) as $scope) {
                $query->$scope();
            }
        }];
    }

    /**
     * Applies a method scope.
     *
     * @param $relation
     *
     * @return mixed
     */
    public function usingMethodScope($relation)
    {
        $name = Str::camel($relation);

        if (!method_exists($this, $name)) {
            // Return an empty scope
            return [$relation => function () {
                //
            }];
        }

        return [$relation => $this->$name()];
    }

    /**
     * Get all request eager load data.
     *
     * @return array
     */
    public function withs()
    {
        return $this->prioritizeNesting($this->request->get('with', []));
    }

    /**
     * Prioritize relations to avoid overwriting eager constraints.
     *
     * @param $withs
     *
     * @return array
     */
    protected function prioritizeNesting($withs)
    {
        return collect($withs)->sortBy(function ($with) {
            return Str::contains($with, ".") ? 0 : 1;
        })->toArray();
    }
}
