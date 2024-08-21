<?php

namespace App\Traits;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

trait PaginationTrait {
    public function paginate($items, $perPage = 15, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($items);
        $currentpage = $page;
        $offset = ($currentpage * $perPage) - $perPage ;
        $itemstoshow = array_slice($items , $offset , $perPage);
        $itemstoshow = new Collection($itemstoshow);
        return new LengthAwarePaginator($itemstoshow ,$total ,$perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
        ]);
    }
}