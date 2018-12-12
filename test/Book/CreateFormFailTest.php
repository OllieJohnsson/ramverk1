<?php

// use Anax\DI\DIFactoryConfig;
// use PHPUnit\Framework\TestCase;
// use Oliver\Book\HTMLForm\CreateForm;
//
// /**
//  *
//  */
// class CreateFormFailTest extends TestCase
// {
//     protected $di;
//     protected $model;
//
//     protected function setUp()
//     {
//         global $di;
//         $this->di = new DIFactoryConfig();
//         $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");
//
//         $di = $this->di;
//         $this->model = new CreateForm($di);
//     }
//
//     public function testCallbackSubmit()
//     {
//         $this->model->form->initElements([
//             "title" => "hej",
//             "author" => "hej",
//             "imageUrl" => "hej"
//         ]);
//         echo "hej";
//         // die();
//         // $this->form->value("author") = "Kalle Anka";
//         // $this->form->value("imageUrl") = "http://lalala.se";
//
//         $res = $this->model->callbackSubmit();
//         // $res = $this->model->getHTML();
//         $this->assertTrue($res);
//     }
//
//     // public function testCallbackSuccess()
//     // {
//     //     $res = $this->form->check();
//     //     $this->assertTrue($res);
//     // }
//
//
//     /**
//      * Test
//      */
// //     public function testCreate1()
// //     {
// //         // $this->form->create();
// //
// //         $res = $this->form->getHTML();
// //         $exp = <<<EOD
// // <label for='form-element-title'>Title:</label><br>\n
// // <input id='form-element-title' type='text' name='title'/>
// // EOD;
// //         $this->assertContains($exp, $exp);
// //     }
// }
