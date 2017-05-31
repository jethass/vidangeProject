<?php
/**
 * Created by IntelliJ IDEA.
 * User: HLATAOUI
 * Date: 30/05/2017
 * Time: 14:45
 */

namespace main\AppBundle\Services;


interface PlaceLocatorInterface
{
    /**
     * Searches places given a query.
     *
     * @param string $query
     *
     * @return array
     */
    public function searchByKeyword($query);
}