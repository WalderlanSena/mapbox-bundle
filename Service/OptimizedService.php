<?php
/**
 * Created by PhpStorm
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 5/9/20
 * Time: 12:24 AM
 */

namespace App\Bundles\MapBox\Service;

use App\Bundles\MapBox\Repository\Interfaces\OptimizedTripRepositoryInterface;
use App\Bundles\MapBox\Service\Interfaces\OptimizedServiceInterface;

class OptimizedService implements OptimizedServiceInterface
{
    private $optimizedTripRepository;

    public function __construct(OptimizedTripRepositoryInterface $optimizedTripRepository)
    {
        $this->optimizedTripRepository = $optimizedTripRepository;
    }

    public function getOptimizedTrip(array $request)
    {
        try {
            $response = $this->optimizedTripRepository->getOptimizedTrip($request['locationOne'], $request['locationTwo']);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        $trip = json_decode($response);

        if (property_exists($trip, 'code')) {
            return [
              'locationOne' => [
                  'name' => $trip->waypoints[0]->name,
                  'location' => $trip->waypoints[0]->location
              ],
              'locationTwo' => [
                'name'     => $trip->waypoints[1]->name,
                'location' => $trip->waypoints[1]->location
              ],
              'trips' => [
                  'duration' => number_format($trip->trips[0]->duration/60,0).' min'
              ]
            ];
        }

        return [];
    }
}