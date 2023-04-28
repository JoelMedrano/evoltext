<?php

if (isset($routesArray[3])) {

    $security = explode("~", base64_decode($routesArray[3]));

    if ($security[1] == $_SESSION["user"]->token_user) {

        $select = "*";

        $url = "users?select=" . $select . "&linkTo=id_user&equalTo=" . $security[0];
        $method = "GET";
        $fields = array();

        $response = CurlController::request($url, $method, $fields);

        if ($response->status == 200) {

            $admin = $response->results[0];

            $dis = file_get_contents("views/assets/json/documentos_identidad_sunat.json");
            $dis = json_decode($dis, true);
            $dis_user = '';

            foreach ($dis as $key => $value) {
                if ($value["code"] == $admin->dis_user) {
                    $dis_user = "{$admin->dis_user} - {$value["description"]}";
                    break; // Salir del bucle una vez encontrado el valor correcto
                }
            }
        } else {

            echo '<script>

            window.location = "/admins";

            </script>';
        }
    } else {

        echo '<script>

        window.location = "/admins";

        </script>';
    }
}

?>

<div class="card card-dark">
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

        <input type="hidden" value="<?php echo $admin->id_user ?>" name="idAdmin">

        <div class="card-header">
            <?php
            require_once "controllers/admins.controller.php";
            $edit = new AdminsController();
            $edit->edit($admin->id_user);
            ?>
            <div class="card-body form-group row">
                <div class="col-lg-12 row">

                    <!-- Codigo -->
                    <div class="col-lg-1 form-group mg-b-10">

                        <label>Código</label>

                        <input type="text" class="form-control" name="code_user" value="<?php echo $admin->code_user ?>" required readonly>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!-- Tipo Documento -->
                    <div class="col-lg-3 form-group mg-b-10">
                        <label for="dis">Tipo Documento</label>

                        <input type="text" class="form-control" name="dis_user" value="<?php echo $dis_user ?>" required readonly>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>


                    <!-- Documentp -->
                    <div class="col-lg-2 form-group mg-b-10">

                        <label>Documento</label>
                        <input type="text" class="form-control" pattern="[.\\,\\0-9]{1,}" name="document_user" id="document_user" value="<?php echo $admin->document_user ?>" required readonly>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <!-- Nombre o Razon Social -->
                    <div class="col-lg-6 form-group mg-b-10">

                        <label>Nombre o Razón Social</label>
                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" name="name_user" id="name_user" value="<?php echo $admin->name_user ?>" required readonly>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <!-- Dirección -->
                    <div class="col-lg-6 form-group mg-b-10">

                        <label>Dirección</label>
                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" name="address_user" id="address_user" value="<?php echo $admin->address_user ?>" required>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <!-- Código postal -->
                    <div class="col-lg-6 form-group mg-b-10">
                        <label>Código postal</label>
                        <?php
                        $postal = file_get_contents("views/assets/json/ubigeos.json");
                        $postal = json_decode($postal, true);
                        ?>
                        <select class="form-select select2" name="postal_user" id="postal_user" required>
                            <option value="">Seleccionar Ubigeo</option>

                            <?php foreach ($postal as $key => $value) : ?>
                                <option value="<?= $value["inei"] ?>" <?= ($admin->postal_user == $value["inei"]) ? 'selected' : ''; ?>>
                                    <?= "{$value["inei"]} - {$value['departamento']} - {$value['provincia']} - {$value['distrito']}" ?>
                                </option>
                            <?php endforeach; ?>

                        </select>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <!-- Username -->
                    <div class="col-lg-3 form-group mg-b-10">

                        <label>Username</label>
                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" name="username_user" id="username_user" value="<?php echo $admin->username_user ?>" required readonly>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <!-- Password -->
                    <div class="col-lg-3 form-group mg-b-10">

                        <label>Password</label>
                        <input type="password" class="form-control" pattern="[#\\=\\$\\;\\*\\_\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-Z]{1,}" onchange="validateJS(event,'pass')" name="password_user" id="password_user" placeholder="*******">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <!-- Email -->
                    <div class="col-lg-4 form-group">

                        <label>Email</label>

                        <input type="email" class="form-control" pattern="[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}" onchange="validateRepeat(event,'email','users','email_user')" name="email_user" name="email_user" value="<?php echo $admin->email_user ?>" required readonly>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!-- ROL -->
                    <div class="col-lg-2 form-group mg-b-10">
                        <label>ROL</label>
                        <?php
                        $rol = file_get_contents("views/assets/json/roles.json");
                        $rol = json_decode($rol, true);
                        ?>
                        <select class="form-select select2" name="rol_user" id="rol_user" required>
                            <option value="">Seleccionar Rol</option>
                            <?php foreach ($rol as $key => $value) : ?>

                                <option value="<?= $value["code"] ?>" <?= ($admin->rol_user == $value["code"]) ? 'selected' : ''; ?>>
                                    <?= "{$value["code"]} - {$value['description']}" ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <!-- Telefono 1 -->
                    <div class="col-lg-3 form-group">

                        <label>Telefono 1</label>

                        <input type="text" class="form-control" pattern="[.\\,\\0-9]{1,}" onchange="validateJS(event,'phone')" name="phone1_user" id="phone1_user" value="<?php echo $admin->phone1_user ?>">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!-- Telefono 2 -->
                    <div class="col-lg-3 form-group">

                        <label>Telefono 2</label>

                        <input type="text" class="form-control" pattern="[.\\,\\0-9]{1,}" onchange="validateJS(event,'phone')" name="phone2_user" id="phone2_user" value="<?php echo $admin->phone2_user ?>">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!-- Empresa -->
                    <div class="col-lg-6 form-group mg-b-10">

                        <?php

                        $url = "companies?select=*&linkTo=state_company&equalTo=1";
                        $method = "GET";
                        $fields = array();

                        $company = CurlController::request($url, $method, $fields)->results;

                        ?>
                        <label>Empresa</label>

                        <select class="form-select select2" name="company_user" id="company_user" required>

                            <option value="">Seleccionar Empresa</option>

                            <?php foreach ($company as $key => $value) : ?>

                                <option value="<?= $value->id_company ?>" <?= ($admin->id_company_user == $value->id_company) ? 'selected' : ''; ?>>
                                    <?= "{$value->document_company} - {$value->name_company}" ?>
                                </option>

                            <?php endforeach ?>

                        </select>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <!-- Imagen -->
                    <div class="col-lg-6 form-group mg-b-10">
                        <label>Foto</label>

                        <label for="customFile" class="d-flex justify-content-center">

                            <figure class="text-center py-3">

                                <img src="<?php echo TemplateController::returnImg($admin->id_user, $admin->picture_user, 'direct') ?>" class="img-fluid rounded-circle changePicture" style="width:150px">

                            </figure>

                        </label>

                        <div class="custom-file">

                            <input type="file" id="customFile" class="custom-file-input" accept="image/*" onchange="validateImageJS(event,'changePicture')" name="picture">

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>

                            <label for="customFile" class="custom-file-label">Choose file</label>

                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="card-footer">

            <div class="d-flex flex-row justify-content-around  border p-3 br-5">
                <div class="pd-10">
                    <a href="/admins" class="btn btn-danger border text-left">Back</a>
                </div>
                <div class="pd-10">
                </div>
                <div class="pd-10">
                    <button type="submit" class="btn btn-dark float-right">Save</button>
                </div>
            </div>

        </div>
    </form>
</div>


<script src="views/pages/admins/admins.js"></script>

<script>
    window.document.title = "Admins - Editar"
</script>