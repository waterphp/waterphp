<?php namespace core\base;

use core\utils\Request;
use core\utils\Session;

abstract class Controller
{
    private $model = null;

    function __construct($model = null)
    {
        $this->setModel($model);

        $token = Request::get('_token');
        if ($token) {
            if (Session::token() != trim($token)) {
                throw new \Exception('The given token is not a valid token! Perhaps the session time is over.');
            }
        }
    }

    abstract function index();

    private function setModel($model) {
        $this->model = $model;
    }

    protected final function model() {
        return $this->model;
    }
}