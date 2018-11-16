<?php

namespace Oliver\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

use Oliver\IpAddress\IpAddressLocation;
use Oliver\IpAddress\Exception\InvalidIpException;
use Oliver\IpAddress\Exception\NonExistentIpException;

/**
 * A sample JSON controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 */
class IpLocationJsonController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $db = "not active";

    private $myIp;
    private $ipAddress;

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

        $this->myIp = getHostByName(getHostName());
        $this->ipAddress = new IpAddressLocation($this->myIp);
    }

    public function getIp()
    {
        return $this->ipAddress;
    }

    public function getMyIp()
    {
        return $this->myIp;
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
        $title = "Lokalisera IP-adress (REST API)";
        $page = $this->di->get("page");

        $page->add("ip/input", [
            "title" => $title,
            "action" => "ip-location/rest-api/ip",
            "buttonTitle" => "Sök",
            "displayIp" => $this->myIp
            ]
        );
        $page->add("ip/test-routes", [
            "route" => "ip-location"
        ]);

        return $page->render([
            "title" => $title
        ]);
    }

    public function ipActionPost() : string
    {
        $ipAddress = $this->di->get("request")->getPost("ipAddress");

        $route = "ip-location/rest-api/ip/{$ipAddress}";
        $this->di->get("response")->redirect($route);
        return $route;
    }

    public function ipActionGet($ipAddress) : array
    {
        try {
            $this->ipAddress->validate($ipAddress);
            $this->ipAddress->locate($ipAddress);
        } catch (InvalidIpException | NonExistentIpException $e) {
            return [["error" => $e->getMessage()]];
        }
        return [$this->ipAddress->getIpJson()];
    }
}
