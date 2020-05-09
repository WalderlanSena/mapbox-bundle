<?php
/**
 * Created by PhpStorm
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 5/9/20
 * Time: 12:16 AM
 */

namespace App\Bundles\MapBox\Repository\Interfaces;

interface OptimizedTripRepositoryInterface
{
    public function getOptimizedTrip(array $locationOne, array $locationTwo);
}