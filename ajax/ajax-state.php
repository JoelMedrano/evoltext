<?php

require_once "../controllers/curl.controller.php";

class StateController
{

    public $state;
    public $table;
    public $id;
    public $nameId;
    public $field;
    public $token;

    public function dataState()
    {

        $url = "{$this->table}?id={$this->id}&nameId={$this->nameId}&token={$this->token}&table=users&suffix=user";
        $method = "PUT";
        $fields = "{$this->field}={$this->state}";

        $response = CurlController::request($url, $method, $fields)->status;

        echo json_encode($response);
    }
}

if (isset($_POST["state"])) {
    $state = new StateController();
    $state->state = $_POST["state"];
    $state->table = $_POST["table"];
    $state->id = $_POST["id"];
    $state->nameId = $_POST["nameId"];
    $state->field = $_POST["field"];
    $state->token = $_POST["token"];
    $state->dataState();
}
