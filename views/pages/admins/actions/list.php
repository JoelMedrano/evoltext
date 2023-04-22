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
    <div class="card-header row d-flex justify-content-between align-items-center">
        <h3 class="card-title">
            <a class="btn btn-dark btn-sm" href="/admins/new">New Admin</a>
        </h3>
        <div class="card-tools">
            <div class="d-flex align-items-center">
                <div class="form-check form-switch" style="transform: scale(1);">
                    <input class="form-check-input" type="checkbox" id="customSwitch" name="my-checkbox" onchange="reportActive(event)">
                    <label class="form-check-label" for="customSwitch">Reports</label>
                </div>
                <div class="input-group">
                    <button type="button" class="btn" id="daterange-btn">
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
    </div>

    <!-- /.card-header -->
    <div class="card-body">
        <table id="adminsTable" class="table table-bordered table-striped tableAdmins">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>

        </table>
    </div>
    <!-- /.card-body -->
</div>


<script src="views/assets/custom/datatable/datatable.js"></script>