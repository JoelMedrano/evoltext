<?php

class AdminsController
{

    //* Login
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

                        echo '<script>
                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");                
                        </script>
                        
                        <div class="alert alert-danger">You do not have permissions to access</div>';
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

    //* Registro
    public function create()
    {
        if (isset($_POST["code_user"])) {
            echo '<script>
                matPreloader("on");
                fncSweetAlert("loading", "Loading...", "");
            </script>';

            //* Validar la sintaxis de los campos
            if (
                preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}$/', $_POST["name_user"]) &&
                preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}$/', $_POST["username_user"]) &&
                preg_match('/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["email_user"]) &&
                preg_match('/^[#\\=\\$\\;\\*\\_\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-Z]{1,}$/', $_POST["password_user"])
            ) {
                // Agrupar la información
                $pcreg_user = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                $usreg_user = $_SESSION["user"]->username_user;

                $data = array(
                    "code_user"         => trim($_POST["code_user"]),
                    "dis_user"          => trim($_POST["dis_user"]),
                    "document_user"     => trim($_POST["document_user"]),
                    "name_user"         => trim(templateController::capitalize($_POST["name_user"])),
                    "address_user"      => trim(strtoupper($_POST["address_user"])),
                    "postal_user"       => trim($_POST["postal_user"]),
                    "username_user"     => trim(strtolower($_POST["username_user"])),
                    "password_user"     => trim($_POST["password_user"]),
                    "email_user"        => trim(strtolower($_POST["email_user"])),
                    "rol_user"          => trim($_POST["rol_user"]),
                    "phone1_user"       => trim($_POST["phone1_user"]),
                    "phone2_user"       => trim($_POST["phone2_user"]),
                    "id_company_user"   => trim($_POST["company_user"]),
                    "pcreg_user"        =>  $pcreg_user,
                    "usreg_user"        =>  $usreg_user,
                    "date_created_user" => date("Y-m-d")
                );

                // Solicitud a la API
                $url = "users?register=true&suffix=user";
                $method = "POST";
                $fields = $data;

                $response = CurlController::request($url, $method, $fields);

                // Respuesta de la API
                if ($response->status == 200) {

                    // Tomar el ID
                    $id = $response->results->lastId;

                    // Validar y crear la imagen en el servidor
                    if (isset($_FILES["picture"]["tmp_name"]) && !empty($_FILES["picture"]["tmp_name"])) {

                        $image = $_FILES["picture"]["tmp_name"];
                        $type = $_FILES["picture"]["type"];
                        $folder = "img/users/" . $id;
                        $name = $id;
                        $width = 300;
                        $height = 300;

                        $picture = TemplateController::saveImage($image, $folder, $type, $width, $height, $name);

                        // Solicitud a la API
                        $url = "users?id=" . $id . "&nameId=id_user&token=" . $_SESSION["user"]->token_user . "&table=users&suffix=user";
                        $method = "PUT";
                        $fields = 'picture_user=' . $picture;

                        $response = CurlController::request($url, $method, $fields);

                        if ($response->status == 200) {

                            echo '<script>
                                fncFormatInputs();
                                matPreloader("off");
                                fncSweetAlert("close", "", "");
                                fncSweetAlert("success", "Your records were created successfully", "/admins");
                            </script>';
                        } else {
                            echo '<script>
                                matPreloader("off");
                                fncSweetAlert("error", "There was an error while uploading the image", "");
                            </script>';
                        }
                    } else {
                        echo '<script>
                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncSweetAlert("success", "Your records were created successfully", "/admins");
                        </script>';
                    }
                } else {
                    echo '<script>
                        matPreloader("off");
                        fncSweetAlert("error", "There was an error while creating the user", "");
                    </script>';
                }
            } else {
                echo '<script>
                    matPreloader("off");
                    fncSweetAlert("error", "Invalid input syntax", "");
                </script>';
            }
        }
    }

    //* Editar
    public function edit($id)
    {
        if (isset($_POST["idAdmin"])) {
            echo '<script>
                matPreloader("on");
                fncSweetAlert("loading", "Loading...", "");
            </script>';

            if ($id == $_POST["idAdmin"]) {

                $select = "password_user,picture_user";
                $url = "users?select={$select}&linkTo=id_user&equalTo={$id}";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if ($response->status == 200) {

                    //* Validamos la sintaxis de los campos
                    if (
                        preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}$/', $_POST["name_user"]) &&
                        preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}$/', $_POST["username_user"]) &&
                        preg_match('/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["email_user"])
                    ) {

                        //* Validar cambio contraseña
                        if (!empty($_POST["password_user"])) {
                            $password = crypt(trim($_POST["password_user"]), '$2a$07$azybxcags23425sdg23sdfhsd$');
                        } else {
                            $password = $response->results[0]->password_user;
                        }

                        //* Validar cambio imagen
                        if (isset($_FILES["picture"]["tmp_name"]) && !empty($_FILES["picture"]["tmp_name"])) {
                            $image = $_FILES["picture"]["tmp_name"];
                            $type = $_FILES["picture"]["type"];
                            $folder = "img/users/{$id}";
                            $name = $id;
                            $width = 300;
                            $height = 300;

                            $picture = TemplateController::saveImage($image, $folder, $type, $width, $height, $name);
                        } else {
                            $picture = $response->results[0]->picture_user;
                        }

                        //* Agrupamos la información 
                        $pcmod_user = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                        $usmod_user = $_SESSION["user"]->username_user;

                        $data =
                            "address_user=" . trim(strtoupper($_POST["address_user"])) .
                            "&postal_user=" . trim($_POST["postal_user"]) .
                            "&password_user=" . $password .
                            "&rol_user=" . trim($_POST["rol_user"]) .
                            "&phone1_user=" . trim($_POST["phone1_user"]) .
                            "&phone2_user=" . trim($_POST["phone2_user"]) .
                            "&id_company_user=" . trim($_POST["company_user"]) .
                            "&picture_user=" . $picture .
                            "&pcmod_user=" . $pcmod_user .
                            "&usmod_user=" . $usmod_user;

                        //* Solicitud a la API
                        $url = "users?id={$id}&nameId=id_user&token={$_SESSION['user']->token_user}&table=users&suffix=user";
                        $method = "PUT";
                        $fields = $data;

                        $response = CurlController::request($url, $method, $fields);

                        //* Respuesta de la API
                        if ($response->status == 200) {
                            echo '<script>
                                fncFormatInputs();
                                matPreloader("off");
                                fncSweetAlert("close", "", "");
                                fncSweetAlert("success", "Your records were created successfully", "/admins");
                            </script>';
                        } else {
                            echo '<script>
                                fncFormatInputs();
                                matPreloader("off");
                                fncSweetAlert("close", "", "");
                                fncNotie(3, "Error editing the registry");
                            </script>';
                        }
                    } else {
                        echo '<script>
                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncNotie(3, "Field syntax error");
                        </script>';
                    }
                } else {
                    echo '<script>
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncNotie(3, "Error editing the registry");
                    </script>';
                }
            } else {
                echo '<script>
                    fncFormatInputs();
                    matPreloader("off");
                    fncSweetAlert("close", "", "");
                    fncNotie(3, "Error editing the registry");
                </script>';
            }
        }
    }
}
