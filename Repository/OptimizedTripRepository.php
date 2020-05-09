<?php
/**
 * Created by PhpStorm
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 5/9/20
 * Time: 12:17 AM
 */

namespace App\Bundles\MapBox\Repository;

use App\Bundles\MapBox\Repository\Interfaces\OptimizedTripRepositoryInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class OptimizedTripRepository implements OptimizedTripRepositoryInterface
{
    private $client;
    private $uri;
    private $accessToken;

    public function __construct(Client $client, string $uri, string $accessToken)
    {
        $this->client = $client;
        $this->uri = $uri;
        $this->accessToken = $accessToken;
    }

    /**
     * @param array $locationOne
     * @param array $locationTwo
     * @return string
     * @throws \Exception
     */
    public function getOptimizedTrip(array $locationOne, array $locationTwo)
    {
        try {
            $response = $this->client->get(
                $this->uri.$locationOne[0].','.$locationOne[1].';'.$locationTwo[0].','.$locationTwo[1].'?access_token='.$this->accessToken);
        } catch (ClientException $exception) {
            throw new \Exception($exception->getResponse()->getBody());
        }

        return $response->getBody()->getContents();
    }
}