<?php
/**
 * Created by IntelliJ IDEA.
 * User: HLATAOUI
 * Date: 30/05/2017
 * Time: 14:48
 */

namespace main\AppBundle\Services;

class GooglePlaceLocator implements PlaceLocatorInterface
{
    private $key;

    /**
     * @param string $key The google API key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    public function searchByKeyword($query){
            // url encode query
            $urlEncodedQuery = urlencode($query);

            // build query url
            $url = sprintf('https://maps.googleapis.com/maps/api/place/textsearch/json?sensor=true&key=%s&query=%s', $this->key, $urlEncodedQuery);

            // fetch and decode url
            $json = json_decode(file_get_contents($url), true);

            // transform every results into [name, address, source]
            return array_map(function($result) {
                return array(
                    'name'    => $result['name'],
                    'address' => $result['formatted_address'],
                    'source'  => 'Google',
                );
            }, $json['results']);

    }
}