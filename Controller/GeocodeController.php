<?php
/**
 * Created by PhpStorm
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 5/6/20
 * Time: 8:15 PM
 */

namespace App\Bundles\MapBox\Controller;

use App\Bundles\MapBox\Service\Interfaces\GeocodeServiceInterface;
use App\Infrastructure\Response\HttpResponseJson;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;

class GeocodeController extends AbstractFOSRestController
{
    private $geocodeService;

    public function __construct(GeocodeServiceInterface $geocodeService)
    {
        $this->geocodeService = $geocodeService;
    }

    public function postGeocodeAction(Request $request)
    {
        $request = $request->request->all();

        try {
            $response = $this->geocodeService->getLocation($request['location'] ?? '');
        } catch (\Exception $exception) {
            return HttpResponseJson::error('Could not found locations', [json_decode($exception->getMessage())]);
        }

        return HttpResponseJson::success('Founds locations', $response);
    }
}