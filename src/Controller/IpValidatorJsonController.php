<?php

namespace Oliver\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Oliver\Commons\ValidateIpTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample JSON controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 */
class IpValidatorJsonController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;
    use ValidateIpTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    public function initialize() : void
    {
        // Use to initialise member variables.
        $this->db = "active";
    }


    /**
     * This is the index method action, it handles:
     * GET METHOD mountpoint
     * GET METHOD mountpoint/
     * GET METHOD mountpoint/index
     *
     * @return object
     */
    public function indexAction() : object
    {
        $title = "Validera IP-adress (REST API)";
        $page = $this->di->get("page");

        $page->add("ip/input", [
            "title" => $title,
            "action" => "ip-validator/rest-api/ip",
            "buttonTitle" => "Validera"
            ]
        );

        $page->add("ip/test-routes", [
            "route" => "ip-validator"
        ]);

        return $page->render([
            "title" => $title
        ]);
    }

    public function ipActionPost() : string
    {
        $ipAddress = $this->di->get("request")->getPost("ipAddress") ?? null;
        $route = "ip-validator/rest-api/ip/{$ipAddress}";
        $this->di->get("response")->redirect($route);
        return $route;
    }

    public function ipActionGet($ipAddress) : array
    {
        $ipObject = $this->validateIP($ipAddress);
        $json = [
            "ip" => $ipObject->address,
            "type" => $ipObject->type,
            "host" => $ipObject->host
        ];
        return [$json];
    }


}
