<?php

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Oliver\Book\HTMLForm\UpdateForm;

/**
 *
 */
class UpdateFormTest extends TestCase
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
        $form = new UpdateForm($this->di, "1");
        $res = $form->callbackSubmit();
        $this->assertTrue($res);
    }
}
