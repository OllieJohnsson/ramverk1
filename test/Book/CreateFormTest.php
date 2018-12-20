<?php

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Oliver\Book\HTMLForm\CreateForm;

/**
 *
 */
class CreateFormTest extends TestCase
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
        $form = new CreateForm($this->di);
        $form->setValues("titel", "kalle", "bild");
        $res = $form->callbackSubmit();
        $form->check();
        $this->assertTrue($res);
    }
}
