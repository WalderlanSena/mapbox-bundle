<?php
/**
 * Created by PhpStorm
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 5/6/20
 * Time: 2:09 PM
 */

namespace App\Bundles\MapBox\Service\Interfaces;

interface GeocodeServiceInterface
{
    public function getLocation(string $address);
}