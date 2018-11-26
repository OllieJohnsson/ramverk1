<?php
namespace Oliver\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Oliver\Weather\Weather;

use Oliver\Weather\Exception\BadFormatException;
use Oliver\Weather\Exception\InvalidLocationException;

/**
 *
 */
class WeatherJSONController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $weather;

    private $title = "Väder (REST API)";
    private $description = "<p>Sök efter en eller flera platser och få en väderprognos i JSON-format. Skriv in koordinater i formatet:</p>
    <code>latitud,longitud latitud,longitud latitud,longitud...</code>";


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



    public function indexActionPost()
    {
        $request = $this->di->get("request");
        $darkSky = $this->di->get("darkSky");

        $coordinates = $request->getPost("coordinates");

        try {
            $this->weather = new Weather($darkSky);
            return $this->weather->fetchWeather($coordinates, true);
        } catch (BadFormatException | InvalidLocationException $e) {
            return [["error" => $e->getMessage()]];
        }
    }
}
