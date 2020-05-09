<?php
/**
 * Created by PhpStorm
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 5/9/20
 * Time: 12:23 AM
 */

namespace App\Bundles\MapBox\Service\Interfaces;

interface OptimizedServiceInterface
{
    public function getOptimizedTrip(array $request);
}