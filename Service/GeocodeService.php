<?php
/**
 * Created by PhpStorm
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 5/6/20
 * Time: 2:08 PM
 */

namespace App\Bundles\MapBox\Service;

use App\Bundles\MapBox\Repository\Interfaces\GeocodeRepositoryInterface;
use App\Bundles\MapBox\Service\Interfaces\GeocodeServiceInterface;

class GeocodeService implements GeocodeServiceInterface
{
    private $geocodeRepository;

    public function __construct(GeocodeRepositoryInterface $geocodeRepository)
    {
        $this->geocodeRepository = $geocodeRepository;
    }

    /**
     * @param string $address
     * @return array
     * @throws \Exception
     */
    public function getLocation(string $address)
    {
        try {
            $response = $this->geocodeRepository->getLocation($address);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
        if (property_exists(json_decode($response),'features')) {
            $features = json_decode($response)->features;
            return $this->formatGeocodeResponse($features);
        }
        return [];
    }

    /**
     * @param array $features
     * @return array
     */
    private function formatGeocodeResponse(array $features)
    {
        $locations = [];
        foreach ($features as $feature) {
            array_push($locations,[
                'placeName' => $feature->place_name,
                'geometry'  => [
                    'latitude'  => $feature->geometry->coordinates[0],
                    'longitude' => $feature->geometry->coordinates[1]
                ]
            ]);
        }
        return $locations;
    }
}