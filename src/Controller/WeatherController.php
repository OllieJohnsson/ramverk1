<?php
namespace Oliver\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Oliver\Weather\Weather;

use Oliver\Weather\Exception\NotFloatException;
use Oliver\Weather\Exception\InvalidCoordinatesException;

/**
 *
 */
class WeatherController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $weather;
    private $message;


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
            $this->weather = new Weather($darkSky, $lat, $long);

            $page->add("weather/location", [
                "weather" => $this->weather->getData()
            ]);
        } catch (NotFloatException | InvalidCoordinatesException $e) {
            $this->message = $e->getMessage();
            $session->set("flashmessage", $this->message);
        }

        return $page->render([
            "title" => $title
        ]);
    }


    public function getWeather()
    {
        return $this->weather;
    }
    public function getMessage()
    {
        return $this->message;
    }
}
