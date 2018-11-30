<?php
namespace Oliver\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Oliver\Weather\Weather;

use Oliver\Weather\Exception\BadFormatException;
use Oliver\Weather\Exception\InvalidLocationException;
use Oliver\Weather\Exception\NoHistoryException;

/**
 *
 */
class WeatherJsonController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $title = "Väder (REST API)";
    private $description = "<p>Sök efter en plats och få en väderprognos för den kommande veckan eller historik 30 dagar tillbaka i JSON-format.";


    public function indexActionGet() : object
    {
        $page = $this->di->get("page");
        $page->add("weather/index", [
            "title" => $this->title,
            "description" => $this->description
        ]);
        return $page->render([
            "title" => $this->title
        ]);
    }

    public function indexActionPost() : string
    {
        $request = $this->di->get("request");
        $response = $this->di->get("response");
        $coordinates = $request->getPost("coordinates");
        $option = $request->getPost("option");

        $route = "weather/api/$option/{$coordinates}";
        $response->redirect($route);
        return $route;
    }

    public function historyActionGet($coordinates) : array
    {
        try {
            $darkSky = $this->di->get("darkSky");
            $weather = new Weather($darkSky);
            $result = $weather->fetchWeather($coordinates, "history");
            return [$result];
        } catch (BadFormatException | InvalidLocationException | NoHistoryException $e) {
            return [["error" => $e->getMessage()]];
        }
    }

    public function forecastActionGet($coordinates) : array
    {
        try {
            $darkSky = $this->di->get("darkSky");
            $weather = new Weather($darkSky);
            $result = $weather->fetchWeather($coordinates, "forecast");
            return [$result];
        } catch (BadFormatException | InvalidLocationException $e) {
            return [["error" => $e->getMessage()]];
        }
    }
}
