<?php


if (isset($_GET["start"]) && isset($_GET["end"])) {

    $between1 = $_GET["start"];
    $between2 = $_GET["end"];
} else {

    $between1 = date("Y-m-d", strtotime("-100000 day", strtotime(date("Y-m-d"))));
    $between2 = date("Y-m-d");
}

?>

<input type="hidden" id="between1" value="<?php echo $between1 ?>">
<input type="hidden" id="between2" value="<?php echo $between2 ?>">

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="pd-10 flex-grow-1">
                <a class="btn btn-dark btn-sm" href="/admins/new" onclick="createCorrelativo('admins')">New Admin</a>
            </div>
            <div class="pd-10">
                <button id="toggleReport" class="btn btn-primary btn-sm">Reportes</button>
            </div>
            <div class="pd-10">
                <button type="button" class="btn btn-teal btn-sm" id="daterange-btn">
                    <i class="far fa-calendar-alt mr-2"></i>
                    <?php if ($between1 < "2000") {
                        echo "Start";
                    } else {
                        echo $between1;
                    } ?> - <?php echo $between2 ?>
                    <i class="fas fa-caret-down ml-2"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- /.card-header -->
    <div class="card-body">
        <table id="adminsTable" class="table table-bordered table-striped tableAdmins">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Username</th>
                    <th>E-mail</th>
                    <th>Ciudad</th>
                    <th>Empresa</th>
                    <th>Rol</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>

        </table>
    </div>
    <!-- /.card-body -->
</div>


<script src="views/assets/custom/datatable/datatable.js"></script>