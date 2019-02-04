<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class FiltersAbstract
{
    protected $request;
    protected $filters = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    public function filter(Builder $builder)
    {
        foreach ($this->getFilters() as $filter => $key) {
            $this->resolveFilter($filter)->filter($builder, $key);
        }
        return $builder;
    }
    
    public function addFilters($filters)
    {
        $this->filters = array_merge($this->filters, $filters);
        return $this;
    }

    protected function resolveFilter($filter)
    {
        return new $this->filters[$filter];
    }
    
    protected function getFilters()
    {
        return $this->filterFilters();
    }
    
    protected function filterFilters()
    {
        return array_filter($this->request->only(array_keys($this->filters)));
    }
}
