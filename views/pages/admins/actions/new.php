<div class="card card-dark">
    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        <div class="card-header">
            <div class="col-md-8 offset-md-2">

                <div class="form-group mt-2 row">
                    <!-- Nombre y apellido -->
                    <div class="col-lg-3 form-group">

                        <label>Nombre</label>

                        <input type="text" class="form-control" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}" onchange="validateJS(event,'text')" name="displayname" required>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>
                </div>

            </div>
        </div>
    </form>
</div>