<?php

namespace Oliver\Book\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Oliver\Book\Book;

/**
 * Form to create an item.
 */
class CreateForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di)
    {
        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Details of the item",
            ],
            [
                "title" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                ],

                "author" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                ],

                "imageUrl" => [
                    "type" => "text",
                    // "validation" => ["not_empty"],
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Create item",
                    "class" => "button",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return bool true if okey, false if something went wrong.
     */
    public function callbackSubmit() : bool
    {
        $book = new Book();
        $book->setDb($this->di->get("dbqb"));
        $book->title  = $this->form->value("title");
        $book->author = $this->form->value("author");
        $book->imageUrl = $this->form->value("imageUrl");
        $book->save();
        return true;
    }



    /**
     * Callback what to do if the form was successfully submitted, this
     * happen when the submit callback method returns true. This method
     * can/should be implemented by the subclass for a different behaviour.
     */
    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("book")->send();
        return True;
    }


    /**
     * Callback what to do if the form was unsuccessfully submitted, this
     * happen when the submit callback method returns false or if validation
     * fails. This method can/should be implemented by the subclass for a
     * different behaviour.
     */
    public function callbackFail()
    {
        $this->di->get("response")->redirectSelf()->send();
    }


    public function setValues(string $title, string $author, string $imageUrl)
    {
        $this->form->getElement("title")["value"] = $title;
        $this->form->getElement("author")["value"] = $author;
        $this->form->getElement("imageUrl")["value"] = $imageUrl;
    }
}
