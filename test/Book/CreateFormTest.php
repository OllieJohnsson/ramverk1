<?php

// use Anax\DI\DIFactoryConfig;
// use PHPUnit\Framework\TestCase;
// use Oliver\Book\HTMLForm\CreateForm;
//
// /**
//  *
//  */
// class CreateFormTest extends TestCase
// {
//     protected $di;
//     protected $model;
//
//     protected function setUp()
//     {
//         global $di;
//
//         $this->di = new DIFactoryConfig();
//         $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");
//         // $this->di->loadServices(ANAX_INSTALL_PATH . "/test/config/di");
//
//         $di = $this->di;
//
//         // $darkSky = $this->di->get("darkSky");
//         $this->model = new CreateForm($di);
//     }
//
//     public function testCallbackSubmit()
//     {
//         $this->di->get("request")->setGlobals(["post" => [
//             "title" => "hej",
//             "author" => "hej hej"
//             ]]);
//         $res = $this->model->callbackSubmit();
//         $this->assertTrue($res);
//     }
//
//     public function callbackSuccess()
//     {
//         $res = $this->model->callbackSuccess();
//         $this->assertContains("jee", $res->getBody());
//     }
// }
