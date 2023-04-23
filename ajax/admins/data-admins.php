<?php

require_once "../../controllers/curl.controller.php";
require_once "../../controllers/template.controller.php";

class DatatableController
{
    public function data()
    {
        if (!empty($_POST)) {

            /*=============================================
            Capturando y organizando las variables POST de DT
            =============================================*/
            $draw = $_POST["draw"]; //Contador utilizado por DataTables para garantizar que los retornos de Ajax de las solicitudes de procesamiento del lado del servidor sean dibujados en secuencia por DataTables 

            $orderByColumnIndex = $_POST['order'][0]['column']; //Índice de la columna de clasificación (0 basado en el índice, es decir, 0 es el primer registro)

            $orderBy = $_POST['columns'][$orderByColumnIndex]["data"]; //Obtener el nombre de la columna de clasificación de su índice

            $orderType = $_POST['order'][0]['dir']; // Obtener el orden ASC o DESC

            $start  = $_POST["start"]; //Indicador de primer registro de paginación.

            $length = $_POST['length']; //Indicador de la longitud de la paginación.

            /*=============================================
            El total de registros de la data
            =============================================*/
            $url = "users?select=id_user&linkTo=date_created_user&between1=" . $_GET["between1"] . "&between2=" . $_GET["between2"] . "";

            $method = "GET";
            $fields = array();

            $response = CurlController::request($url, $method, $fields);

            if ($response->status == 200) {

                $totalData = $response->total;
            } else {

                echo '{"data": []}';

                return;
            }

            /*=============================================
           	Búsqueda de datos
            =============================================*/

            $select = "*";

            if (!empty($_POST['search']['value'])) {

                if (preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/', $_POST['search']['value'])) {

                    $linkTo = ["name_user", "username_user", "email_user"];

                    $search = str_replace(" ", "_", $_POST['search']['value']);

                    foreach ($linkTo as $key => $value) {

                        $urlTotal = "users?select=" . $select . "&linkTo=" . $value . "&search=" . $search . "&orderBy=" . $orderBy . "&orderMode=" . $orderType;

                        $dataTotal = CurlController::request($urlTotal, $method, $fields)->results;

                        $url = "users?select=" . $select . "&linkTo=" . $value . "&search=" . $search . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;

                        $data = CurlController::request($url, $method, $fields)->results;

                        if ($data  == "Not Found") {

                            $data = array();
                            $recordsFiltered = count($data);
                        } else {

                            $data = $data;
                            $totalData = count($dataTotal);
                            $recordsFiltered = count($dataTotal);

                            break;
                        }
                    }
                } else {

                    echo '{"data": []}';

                    return;
                }
            } else {

                /*=============================================
                Seleccionar datos
                =============================================*/
                $url = "users?select=" . $select . "&linkTo=date_created_user&between1=" . $_GET["between1"] . "&between2=" . $_GET["between2"] . "&orderBy=" . $orderBy . "&orderMode=" . $orderType . "&startAt=" . $start . "&endAt=" . $length;

                $data = CurlController::request($url, $method, $fields)->results;

                $recordsFiltered = $totalData;
            }

            /*=============================================
            Cuando la data viene vacía
            =============================================*/

            if (empty($data)) {

                echo '{"data": []}';

                return;
            }

            /*=============================================
            Construimos el dato JSON a regresar
            =============================================*/

            $dataJson = '{

            	"Draw": ' . intval($draw) . ',
            	"recordsTotal": ' . $totalData . ',
            	"recordsFiltered": ' . $recordsFiltered . ',
            	"data": [';

            /*=============================================
            Recorremos la data
            =============================================*/

            foreach ($data as $key => $value) {

                if ($_GET["text"] == "flat") {

                    $picture_user = $value->picture_user;
                    $actions = "";
                } else {


                    $picture_user = "<img src='" . TemplateController::returnImg($value->id_user, $value->picture_user, $value->method_user) . "' class='img-circle' style='width:30px'>";

                    $actions = "<a href='/admins/edit/" . base64_encode($value->id_user . "~" . $_GET["token"]) . "' class='btn btn-warning btn-sm mg-r-5 rounded-circle'>
                        <i class='fas fa-pencil-alt'></i>
                    </a>

                    <a class='btn btn-danger btn-sm rounded-circle removeItem' idItem='" . base64_encode($value->id_user . "~" . $_GET["token"]) . "' table='users' suffix='user' deleteFile='users/" . $value->id_user . "/" . $value->picture_user . "' page='admins'>
                        <i class='fas fa-trash'></i>
                    </a>";

                    $actions = TemplateController::htmlClean($actions);
                }


                $name_user = $value->name_user;
                $username_user = $value->username_user;
                $email_user = $value->email_user;
                $postal_user = $value->postal_user;
                $id_company_user = $value->id_company_user;
                $rol_user = $value->rol_user;
                $date_created_user = $value->date_created_user;

                $dataJson .= '{ 

            		"id_user":"'            . ($start + $key + 1) . '",
            		"picture_user":"'       . $picture_user . '",
            		"name_user":"'          . $name_user . '",
            		"username_user":"'      . $username_user . '",
            		"email_user":"'         . $email_user . '",
            		"postal_user":"'        . $postal_user . '",
                    "id_company_user":"'    . $id_company_user . '",
                    "rol_user":"'           . $rol_user . '",
            		"date_created_user":"'  . $date_created_user . '",
            		"actions":"'            . $actions . '"

            	},';
            }

            $dataJson = substr($dataJson, 0, -1); // este substr quita el último caracter de la cadena, que es una coma, para impedir que rompa la tabla

            $dataJson .= ']}';

            echo $dataJson;
        }
    }
}

/*=============================================
Activar función DataTable
=============================================*/
$data = new DatatableController();
$data->data();