<?php
/**
 * Created by PhpStorm
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 5/6/20
 * Time: 2:11 PM
 */

namespace App\Bundles\MapBox\Repository;

use App\Bundles\MapBox\Repository\Interfaces\GeocodeRepositoryInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class GeocodeRepository implements GeocodeRepositoryInterface
{
    private $client;
    private $accessToken;
    private $uriDefault;

    public function __construct(Client $client, string $accessToken, string $uriDefault)
    {
        $this->client      = $client;
        $this->accessToken = $accessToken;
        $this->uriDefault  = $uriDefault;
    }

    /**
     * @param string $address
     * @return string
     * @throws \Exception
     */
    public function getLocation(string $address)
    {
        $address = urlencode($address);
        try {
            $response = $this->client->get($this->uriDefault.$address.'.json'.'?access_token='.$this->accessToken);
        } catch (ClientException $exception) {
            throw new \Exception($exception->getResponse()->getBody());
        }

        return $response->getBody()->getContents();
    }
}