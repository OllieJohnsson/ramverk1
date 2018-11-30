<?php
namespace Oliver\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

use Oliver\Weather\Weather;
use Oliver\Weather\Exception\BadFormatException;
use Oliver\DarkSky\Exception\InvalidLocationException;
use Oliver\DarkSky\Exception\NoHistoryException;

/**
 *
 */
class WeatherController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $title = "Väder";
    private $description = "<p>Sök efter en plats och få en väderprognos för den kommande veckan eller historik 30 dagar tillbaka.";


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


    public function indexActionPost() : object
    {
        $request = $this->di->get("request");
        $response = $this->di->get("response");
        $page = $this->di->get("page");
        $session = $this->di->get("session");
        $darkSky = $this->di->get("darkSky");

        $coordinates = $request->getPost("coordinates");
        $option = $request->getPost("option");

        $page->add("weather/index", [
            "title" => $this->title,
            "description" => $this->description
        ]);

        try {
            $weather = new Weather($darkSky);
            $result = $weather->fetchWeather($coordinates, $option);
            $page->add("weather/$option", [
                "weather" => $result
            ]);
        } catch (BadFormatException | InvalidLocationException | NoHistoryException $e) {
            $session->set("flashmessage", $e->getMessage());
        }
        return $page->render([
            "title" => $this->title
        ]);
    }
}
