<?php
namespace Oliver\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

use Oliver\IpAddress\IpAddressLocation;
use Oliver\IpAddress\Exception\InvalidIpException;
use Oliver\IpAddress\Exception\NonExistentIpException;


/**
 *
 */
class IpLocationController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $db = "not active";

    private $myIp;
    private $ipAddress;

    /**
     * @return void
     */
    public function initialize() : void
    {
        $this->db = "active";

        $this->myIp = getHostByName(getHostName());
        $this->ipAddress = new IpAddressLocation($this->myIp);
    }

    public function getIp()
    {
        return $this->ipAddress;
    }


    public function indexAction() : object
    {
        $title = "Lokalisera IP-adress";

        $page = $this->di->get("page");
        $response = $this->di->get("response");

        $ipAddress = $this->di->get("request")->getPost("ipAddress") ?? $this->myIp;

        $page->add("ip/input", [
            "title" => $title,
            "action" => "ip-location",
            "buttonTitle" => "Sök",
            "displayIp" => $ipAddress
            ]
        );

        try {
            $this->ipAddress->validate($ipAddress);
            $this->ipAddress->locate($ipAddress);

            $page->add("ip/location", [
                "ipAddress" => $this->ipAddress->getIp(),
                ]
            );
        } catch (InvalidIpException | NonExistentIpException $e) {
            $this->di->get("session")->set("flashmessage", $e->getMessage());
        }

        return $page->render([
            "title" => $title
        ]);
    }
}
