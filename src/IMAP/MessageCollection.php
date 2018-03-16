<?php
/*
* File:     ClientManager.php
* Category: Collection
* Author:   M. Goldenbaum
* Created:  16.03.18 03:13
* Updated:  -
*
* Description:
*  -
*/

namespace Webklex\IMAP;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;

/**
 * Class MessageCollection
 *
 * @package Webklex\IMAP
 */
class MessageCollection extends Collection {

    /**
     * Paginate the current collection.
     *
     * @param int    $perPage
     * @param null   $page
     * @param string $pageName
     *
     * @return LengthAwarePaginator
     */
    public function paginate($perPage = 15, $page = null, $pageName = 'page') {
        $page = $page ?: Paginator::resolveCurrentPage($pageName);

        $results = ($total = $this->count()) ? $this->forPage($page, $perPage) : $this->all();

        return $this->paginator($results, $total, $perPage, $page, [
            'path'      => Paginator::resolveCurrentPath(),
            'pageName'  => $pageName,
        ]);
    }

    /**
     * Create a new length-aware paginator instance.
     *
     * @param  array   $items
     * @param  int     $total
     * @param  int     $perPage
     * @param  int     $currentPage
     * @param  array   $options
     *
     * @return LengthAwarePaginator
     */
    protected function paginator($items, $total, $perPage, $currentPage, array $options) {
        return new LengthAwarePaginator($items, $total, $perPage, $currentPage, $options);
    }
}