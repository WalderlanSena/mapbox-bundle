<?php
/**
 * Created by PhpStorm
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 5/9/20
 * Time: 12:11 AM
 */

namespace App\Bundles\MapBox\Controller;

use App\Bundles\MapBox\Service\Interfaces\OptimizedServiceInterface;
use App\Infrastructure\Response\HttpResponseJson;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;

class OptimizedTripController extends AbstractFOSRestController
{
    private $optimizedService;

    public function __construct(OptimizedServiceInterface $optimizedService)
    {
        $this->optimizedService = $optimizedService;
    }

    public function postTripAction(Request $request)
    {
        $request = $request->request->all();

        try {
            $response = $this->optimizedService->getOptimizedTrip($request ?? []);
        } catch (\Exception $exception) {
            return HttpResponseJson::error('Could not found trips', [json_decode($exception->getMessage())]);
        }

        return HttpResponseJson::success('Distance Found.', $response);
    }
}