<?php

class AdminsController
{

    //*Login
    public function login()
    {
        if (isset($_POST["loginEmail"])) {
            echo '<script>
                // matPreloader("on");
                // fncSweetAlert("loading", "Loading...", "");
            </script>';

            //*Validamos la sintaxis de los campos
            if (preg_match('/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["loginEmail"])) {

                $url = "users?login=true&suffix=user";
                $method = "POST";
                $fields = array(

                    "email_user" => $_POST["loginEmail"],
                    "password_user" => $_POST["loginPassword"]

                );
                $response = CurlController::request($url, $method, $fields);
                echo '<pre>';
                print_r($response);
                echo '</pre>';
            } else {

                echo '<script>
						// fncFormatInputs();
						// matPreloader("off");
						// fncSweetAlert("close", "", "");				
				</script> 

				 <div class="alert alert-danger">Field syntax error</div>';
            }
        }
    }
}
