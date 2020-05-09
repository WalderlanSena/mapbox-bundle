<h1 align="center">
  MapBox Bundle
</h1>

<p align="center">Abstraction api mapbox for symfony</p>

# Abstracted APIs

- Geolocation
- Optimidez Trips

# An example for Use

### Create a directory with name Bundle in you directory src

Clone the project and configure the service.yaml with you information

```yaml
    App\Bundles\MapBox\Repository\GeocodeRepository:
        arguments:
            - '@GuzzleHttp\Client'
            - '%env(MAPBOX_TOKEN)%'
            - 'https://api.mapbox.com/geocoding/v5/mapbox.places/'

    App\Bundles\MapBox\Repository\OptimizedTripRepository:
        arguments:
            - '@GuzzleHttp\Client'
            - 'https://api.mapbox.com/optimized-trips/v1/mapbox/driving/'
            - '%env(MAPBOX_TOKEN)%'
```

Remember of add the token in you file .env with name MAPBOX_TOKEN.

### Create a file with name mapbox.yaml in you routes and add this informations

```yaml

  mapbox_geocode:
    type: rest
    prefix: /map
    resource: App\Bundles\MapBox\Controller\GeocodeController
    trailing_slash_on_root: false
  
  mapbox_optimizedTrip:
    type: rest
    prefix: /map
    resource: App\Bundles\MapBox\Controller\OptimizedTripController
    trailing_slash_on_root: false

```

# Request example

**VERB POST**

Api of geolocation
```json
{
	"location": "Aldeota, Fortaleza"
}
```

**VERB POST**

Api of trips
```json
{
	"locationOne": [
      -38.559819,
      -3.775208
	],
	"locationTwo": [
      -38.552904,
      -3.76554
	]
}
```
