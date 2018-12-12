<?php

use PHPUnit\Framework\TestCase;
use Anax\DI\DIFactoryConfig;
use Oliver\Book\BookController;

/**
 * Test the SampleController.
 */
class BookControllerTest extends TestCase
{

    // Create the di container.
    protected $di;
    protected $controller;

    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        // Setup di
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        // $this->di->loadServices(ANAX_INSTALL_PATH . "/test/config/di");

        // View helpers uses the global $di so it needs its value
        $di = $this->di;

        // Setup the controller
        $this->controller = new BookController();
        $this->controller->setDI($this->di);
        // $this->controller->initialize();
    }


    /**
     * Test the route "index" with GET.
     */
    public function testIndexActionGet()
    {
        $res = $this->controller->indexActionGet();
        $this->assertContains("View all items", $res->getBody());
    }

    /**
     * Test the route "create".
     */
    public function testCreateAction()
    {
        $res = $this->controller->createAction();
        $this->assertContains("Create", $res->getBody());
    }

    /**
     * Test the route "delete".
     */
    public function testDeleteAction()
    {
        $res = $this->controller->deleteAction();
        $this->assertContains("Delete", $res->getBody());
    }

    /**
     * Test the route "update".
     */
    public function testUpdateAction()
    {
        $res = $this->controller->updateAction("1");
        $this->assertContains("Update", $res->getBody());
    }


}
