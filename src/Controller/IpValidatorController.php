<?php

namespace Oliver\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Oliver\ValidateIpTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class IpValidatorController implements ContainerInjectableInterface
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
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function indexAction() : object
    {
        $title = "IP-Validator";
        // $ipAddress = $this->di->request->getPost("ipAddress") ?? null;
        $ipAddress = $this->di->get("request")->getPost("ipAddress") ?? null;

        $this->validateIP($ipAddress);
        $message = "";

        if (!$this->type) {
            $message = "<b>{$ipAddress}</b> är inte en giltig IP-adress.";
        } else {
            $message = "<b>{$this->type}-adress:</b> {$this->ipAddress}";
        }

        if ($this->host) {
            $message = "{$message}<br><b>Domännamn:</b> {$this->host}";
        }

        if ($ipAddress) {
            $this->di->session->set("flashmessage", $message);
        }

        $page = $this->di->get("page");
        $page->add("ip-validator/index", [
            "title" => $title,
            "action" => "ip-validator"
            ]
        );

        return $page->render([
            "title" => $title
        ]);
    }

}
