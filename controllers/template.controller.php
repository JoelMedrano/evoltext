<?php
class TemplateController
{
    /*=============================================
	Traemos la Vista Principal de la plantilla
	=============================================*/
    public function index()
    {
        include "views/template.php";
    }

    /*=============================================
	Ruta del sistema administrativo
	=============================================*/
    static public function path()
    {
        return "http://evoltext.cv/";
    }

    /*=============================================
	Ruta para las imágenes del sistema
	=============================================*/
    static public function srcImg()
    {
        return "http://evoltext.cv/";
    }

    /*=============================================
	Devolver la imagen del MP
	=============================================*/
    static public function returnImg($id, $picture, $method)
    {

        if ($method == "direct") {

            if ($picture != null) {

                return TemplateController::srcImg() . "views/assets/img/users/" . $id . "/" . $picture;
            } else {

                return TemplateController::srcImg() . "views/assets/img/users/default/default.png";
            }
        } else {

            return $picture;
        }
    }

    /*=============================================
	Función Limpiar HTML
	=============================================*/

    static public function htmlClean($code)
    {

        $search = array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s');

        $replace = array('>', '<', '\\1');

        $code = preg_replace($search, $replace, $code);

        $code = str_replace("> <", "><", $code);

        return $code;
    }

    /*=============================================
	Función para mayúscula inicial
	=============================================*/
    static public function capitalize($value)
    {

        $value = mb_convert_case($value, MB_CASE_TITLE, "UTF-8");
        return $value;
    }
    /*=============================================
	Función para almacenar imágenes
	=============================================*/
    static public function saveImage($image, $folder, $type, $width, $height, $name)
    {

        if (isset($image) && !empty($image)) {

            /*=============================================
			Configuramos la ruta del directorio donde se guardará la imagen
			=============================================*/

            $directory = strtolower("views/assets/" . $folder);

            /*=============================================
			Preguntamos primero si no existe el directorio, para crearlo
			=============================================*/

            if (!file_exists($directory)) {

                mkdir($directory, 0755);
            }

            /*=============================================
			Eliminar todos los archivos que existan en ese directorio
			=============================================*/

            if ($folder != "img/products" && $folder != "img/stores") {

                $files = glob($directory . "/*");

                foreach ($files as $file) {

                    unlink($file);
                }
            }

            /*=============================================
			Capturar ancho y alto original de la imagen
			=============================================*/

            list($lastWidth, $lastHeight) = getimagesize($image);

            /*=============================================
			De acuerdo al tipo de imagen aplicamos las funciones por defecto
			=============================================*/

            if ($type == "image/jpeg") {

                //definimos nombre del archivo
                $newName  = $name . '.jpg';

                //definimos el destino donde queremos guardar el archivo
                $folderPath = $directory . '/' . $newName;

                if (isset($image["mode"]) && $image["mode"] == "base64") {

                    file_put_contents($folderPath, file_get_contents($image));
                } else {

                    //Crear una copia de la imagen
                    $start = imagecreatefromjpeg($image);

                    //Instrucciones para aplicar a la imagen definitiva
                    $end = imagecreatetruecolor($width, $height);

                    imagecopyresized($end, $start, 0, 0, 0, 0, $width, $height, $lastWidth, $lastHeight);

                    imagejpeg($end, $folderPath);
                }
            }

            if ($type == "image/png") {

                //definimos nombre del archivo
                $newName  = $name . '.png';

                //definimos el destino donde queremos guardar el archivo
                $folderPath = $directory . '/' . $newName;

                if (isset($image["mode"]) && $image["mode"] == "base64") {

                    file_put_contents($folderPath, file_get_contents($image));
                } else {

                    //Crear una copia de la imagen
                    $start = imagecreatefrompng($image);

                    //Instrucciones para aplicar a la imagen definitiva
                    $end = imagecreatetruecolor($width, $height);

                    imagealphablending($end, FALSE);

                    imagesavealpha($end, TRUE);

                    imagecopyresampled($end, $start, 0, 0, 0, 0, $width, $height, $lastWidth, $lastHeight);

                    imagepng($end, $folderPath);
                }
            }

            return $newName;
        } else {

            return "error";
        }
    }

    /*=============================================
	Función para buscar por RUC y DNI
	=============================================*/
    static public function consultaDatos($tipo, $documento)
    {
        if ($tipo == "DNI") {
            $response = CurlController::consultaDNI($documento);
        } else {
            $response = CurlController::consultaRUC($documento);
        }
    }

    //* Sacar el codigo para la tabla
    static public function codigoTabla($tabla)
    {
        //* Definir variables
        $select = "actual_correlative";
        $tamaño = 5;

        //* Construir URL de solicitud
        $url = "correlatives?select=id_correlative,{$select}&linkTo=code_correlative&equalTo={$tabla}";
        $method = "GET";
        $fields = array();

        //* Realizar solicitud cURL y almacenar respuesta
        $response = CurlController::request($url, $method, $fields);
        //* Procesar respuesta y establecer $maxCode
        if ($response->status == 200) {
            $code = $response->results[0];
            $maxCode = str_pad($code->actual_correlative, $tamaño, '0', STR_PAD_LEFT);
        } else {
            $maxCode = str_pad('1', $tamaño, '0', STR_PAD_LEFT);
        }

        return $maxCode;
    }

    //* obtener localicaion del usuario
    static public function getLocationInfo($ip, $apiKey)
    {
        $url = "https://api.ipgeolocation.io/ipgeo?apiKey={$apiKey}&ip={$ip}";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        return $data;
    }

    static public function getUserIP()
    {
        if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            return $_SERVER["HTTP_CLIENT_IP"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED"])) {
            return $_SERVER["HTTP_X_FORWARDED"];
        } elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])) {
            return $_SERVER["HTTP_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_FORWARDED"])) {
            return $_SERVER["HTTP_FORWARDED"];
        } else {
            return $_SERVER["REMOTE_ADDR"];
        }
    }
}
