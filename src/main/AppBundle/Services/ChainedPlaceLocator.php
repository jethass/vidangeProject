<?php
/**
 * Created by IntelliJ IDEA.
 * User: HLATAOUI
 * Date: 30/05/2017
 * Time: 14:48
 */

namespace main\AppBundle\Services;

class ChainedPlaceLocator implements PlaceLocatorInterface
{
    private $locators = [];

    public function addLocator(PlaceLocatorInterface $locator)
    {
        $this->locators[] = $locator;
    }

    public function searchByKeyword($query)
    {
        $results = [];
        // for each implementations...
        foreach($this->locators as $locator) {
            $results = array_merge($results, $locator->searchByKeyword($query));

        }

        return $results;
    }
}