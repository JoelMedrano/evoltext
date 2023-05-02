//* Función para validar datos del proveedor
function validateConsultaDocumento(event, type) {
    clearAdminsFields();

    validateRepeat(event, type, "companies", "document_company");

    const dis_company = document.getElementById("dis_company").value;

    if (dis_company === "1" || dis_company === "6") {
        setTimeout(function () {
            const document_company =
                document.getElementById("document_company").value;

            if (document_company !== "") {
                const validLength = dis_company === "1" ? 8 : 11;

                if (document_company.length === validLength) {
                    fetchAdminsData(document_company, dis_company, event);
                } else {
                    handleInvalidDocumentLength(event, validLength);
                }
            }
        }, 100);
    }
}

function clearAdminsFields() {
    $("#name_company, #address_company, #postal_company").val("");
    $("#postal_company").select2();
}

function fetchAdminsData(document_company, dis_company, event) {
    matPreloader("on");
    fncSweetAlert("loading", "Loading...", "");

    const data = new FormData();
    data.append("documento", document_company);
    data.append("tipo", dis_company);

    $.ajax({
        url: "ajax/ajax-validate.php",
        method: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            if (response !== "error") {
                updateAdminsFields(JSON.parse(response).data, dis_company);
            } else {
                fncNotie(3, "No se encontro el documento");
            }
            matPreloader("off");
            fncSweetAlert("close", "", "");
        },
    });
}

function updateAdminsFields(data, dis_company) {
    // Actualizar campos del formulario
    $("#name_company")
        .val(data["nombre_o_razon_social"])
        .parent()
        .addClass("was-validated");
    $("#address_company")
        .val(data["direccion"])
        .parent()
        .addClass("was-validated");
    $("#postal_company")
        .val(data["ubigeo"][2])
        .select2()
        .parent()
        .addClass("was-validated");
}

function handleInvalidDocumentLength(event, validLength) {
    event.target.value = "";
    $(event.target).parent().addClass("was-validated");
    const errorMsg =
        validLength === 8
            ? "El DNI debe tener 8 dígitos"
            : "El RUC debe tener 11 dígitos";
    $(event.target).parent().children(".invalid-feedback").html(errorMsg);
}
