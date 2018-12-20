<?php

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Oliver\Book\HTMLForm\DeleteForm;

/**
 *
 */
class DeleteFormTest extends TestCase
{
    protected $di;

    protected function setUp()
    {
        global $di;

        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        $di = $this->di;
    }

    public function testCallbackSubmit()
    {
        $form = new DeleteForm($this->di);
        $form->setSelected("title", "titel");
        $res = $form->callbackSubmit();
        $this->assertTrue($res);
    }
}
