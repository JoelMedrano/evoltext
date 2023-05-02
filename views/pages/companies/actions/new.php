<?php
$codigo = TemplateController::codigoTabla("companies");
?>

<div class="card card-dark">
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        <div class="card-header">
            <?php
            // require_once "controllers/admins.controller.php";
            // $create = new AdminsController();
            // $create->create();
            ?>
            <div class="card-body form-group row">
                <div class="col-lg-12 row">

                    <!-- Codigo -->
                    <div class="col-lg-1 form-group mg-b-10">

                        <label>Código</label>

                        <input type="text" class="form-control" name="code_company" value="<?php echo $codigo ?>" required readonly>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!-- Tipo Documento -->
                    <div class="col-lg-3 form-group mg-b-10">
                        <label for="dis">Tipo Documento</label>
                        <?php
                        $dis = file_get_contents("views/assets/json/documentos_identidad_sunat.json");
                        $dis = json_decode($dis, true);
                        ?>
                        <select class="form-select select2" name="dis_company" id="dis_company" required>
                            <option value="">Seleccionar Documento</option>
                            <?php foreach ($dis as $key => $value) : ?>
                                <option value="<?= $value["code"] ?>"><?= $value["code"] . ' - ' . $value["description"] ?></option>
                            <?php endforeach ?>

                        </select>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <!-- Documentp -->
                    <div class="col-lg-2 form-group mg-b-10">

                        <label>Documento</label>
                        <input type="text" class="form-control" pattern="[.\\,\\0-9]{1,}" name="document_company" id="document_company" onchange="validateConsultaDocumento(event, 'numbers')" required>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <!-- Nombre o Razon Social -->
                    <div class="col-lg-6 form-group mg-b-10">

                        <label>Nombre o Razón Social</label>
                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" name="name_company" id="name_company" required>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <!-- Dirección -->
                    <div class="col-lg-6 form-group mg-b-10">

                        <label>Dirección</label>
                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" name="address_company" id="address_company" required>

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
                        <select class="form-select select2" name="postal_company" id="postal_company" required>
                            <option value="">Seleccionar Ubigeo</option>
                            <?php foreach ($postal as $key => $value) : ?>
                                <option value="<?php echo $value["inei"] ?>"><?php echo "{$value["inei"]} - {$value['departamento']} - {$value['provincia']} - {$value['distrito']}"; ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <!-- companyname -->
                    <div class="col-lg-3 form-group mg-b-10">

                        <label>Tradename</label>
                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" onchange="validateRepeat(event,'regex','companys','tradename_company')" name="tradename_company" id="tradename_company" required>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <!-- Contact -->
                    <div class="col-lg-3 form-group mg-b-10">

                        <label>Contact</label>
                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" onchange="validateJS(event,'pass')" name="contact_company" id="contact_company" required>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <!-- Email -->
                    <div class="col-lg-4 form-group">

                        <label>Email</label>

                        <input type="email" class="form-control" pattern="[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}" onchange="validateRepeat(event,'email','companys','email_company')" name="email_company" name="email_company" required>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!-- Plan -->
                    <div class="col-lg-2 form-group mg-b-10">
                        <label>Plan</label>
                        <?php
                        $plan = file_get_contents("views/assets/json/planes.json");
                        $plan = json_decode($plan, true);
                        $nombres = $plan["plans"];
                        ?>
                        <select class="form-select select2" name="rol_company" id="rol_company" required>
                            <option value="">Seleccionar Rol</option>
                            <?php foreach ($nombres as $key => $value) : ?>
                                <option value="<?php echo $value["code"] ?>"><?php echo $value["code"] . ' - ' . $value["name"] ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <!-- Telefono 1 -->
                    <div class="col-lg-3 form-group">

                        <label>Telefono 1</label>

                        <input type="text" class="form-control" pattern="[.\\,\\0-9]{1,}" onchange="validateJS(event,'phone')" name="phone1_company" id="phone1_company">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!-- Telefono 2 -->
                    <div class="col-lg-3 form-group">

                        <label>Telefono 2</label>

                        <input type="text" class="form-control" pattern="[.\\,\\0-9]{1,}" onchange="validateJS(event,'phone')" name="phone2_company" id="phone2_company">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

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

<script src="views/pages/companies/companies.js"></script>

<script>
    window.document.title = "Empresas - Nueva"
</script>