<?php

class AdminsController
{

    //*Login
    public function login()
    {
        if (isset($_POST["loginEmail"])) {
            echo '<script>
                matPreloader("on");
                fncSweetAlert("loading", "Loading...", "");
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

                if ($response->status == 200) {

                    //*Validamos que este activo
                    if ($response->results[0]->state_user != "46") {

                        echo ' <div class="alert alert-danger">You do not have permissions to access</div>';
                        return;
                    }

                    //*Creamos las variables de session
                    $_SESSION["user"] = $response->results[0];

                    echo '<script>
                        fncFormatInputs();
                        localStorage.setItem("token_user", "' . $response->results[0]->token_user . '");
                        window.location = "' . $_SERVER["REQUEST_URI"] . '"
					</script>';
                } else {

                    echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");                
                    </script> 

                    <div class="alert alert-danger">' . $response->results . '</div>';
                }
            } else {

                echo '<script>
						fncFormatInputs();
						matPreloader("off");
						fncSweetAlert("close", "", "");				
				</script> 

				 <div class="alert alert-danger">Field syntax error</div>';
            }
        }
    }
}
