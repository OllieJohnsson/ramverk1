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
class WeatherController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $weather;
    private $message;

    private $title = "Väder";
    private $description = "<p>Sök efter en eller flera platser och få en väderprognos för den kommande veckan";


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
        $response = $this->di->get("response");
        $page = $this->di->get("page");
        $session = $this->di->get("session");
        $darkSky = $this->di->get("darkSky");

        $coordinates = $request->getPost("coordinates");

        $page->add("weather/index", [
            "title" => $this->title,
            "description" => $this->description
        ]);


        try {
            $this->weather = new Weather($darkSky);

            $page->add("weather/location", [
                "weather" => $this->weather->fetchWeather($coordinates)
            ]);
        } catch (BadFormatException | InvalidLocationException $e) {
            $this->message = $e->getMessage();
            $session->set("flashmessage", $this->message);
        }

        return $page->render([
            "title" => $this->title
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
