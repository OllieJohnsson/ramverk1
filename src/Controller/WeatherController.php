<?php
namespace Oliver\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Oliver\Weather\Weather;

/**
 *
 */
class WeatherController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;



    public function indexActionGet() : object
    {
        $title = "Väder";
        $page = $this->di->get("page");

        $page->add("weather/index", [
            "title" => $title
        ]);
        return $page->render([
            "title" => $title
        ]);
    }

    public function indexActionPost()
    {
        $title = "Väder";
        $request = $this->di->get("request");
        $response = $this->di->get("response");
        $page = $this->di->get("page");
        $session = $this->di->get("session");
        $darkSky = $this->di->get("darkSky");

        $lat = $request->getPost("lat");
        $long = $request->getPost("long");
        $time = $request->getPost("time");


        $page->add("weather/index", [
            "title" => $title
        ]);


        try {
            $weather = new Weather($darkSky, $lat, $long);

            $page->add("weather/location", [
                "weather" => $weather->getWeather()
            ]);
        } catch (\Oliver\Weather\Exception\NotFloatException $e) {
            $session->set("flashmessage", $e->getMessage());
        } catch (\Oliver\Weather\Exception\InvalidCoordinatesException $e) {
            $this->di->get("session")->set("flashmessage", $e->getMessage());
        }

        return $page->render([
            "title" => $title
        ]);
    }
}
