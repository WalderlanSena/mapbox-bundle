<?php
/**
 * Created by PhpStorm
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 5/6/20
 * Time: 2:14 PM
 */

namespace App\Bundles\MapBox\Repository\Interfaces;

interface GeocodeRepositoryInterface
{
    /**
     * @param string $address
     * @return mixed
     */
    public function getLocation(string $address);
}