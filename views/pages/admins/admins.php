<section class="content-header">
    <div class="main-container container-fluid">

        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <span class="main-content-title mg-b-0 mg-b-lg-1">Admins</span>
            </div>
            <div class="justify-content-center mt-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item tx-15"><a href="/">Dashboard</a></li>

                    <?php

                    if (isset($routesArray[2])) {

                        if ($routesArray[2] == "new" || $routesArray[2] == "edit") {

                            echo '<li class="breadcrumb-item"><a href="/admins">Admins</a></li>';
                            echo '<li class="breadcrumb-item active">' . $routesArray[2] . '</li>';
                        }
                    } else {

                        echo '<li class="breadcrumb-item active">Admins</li>';
                    }

                    ?>

                </ol>
            </div>
        </div>

    </div>
</section>

<section class="content-header">
    <div class="main-container container-fluid">
        <?php

        if (isset($routesArray[2])) {

            if ($routesArray[2] == "new" || $routesArray[2] == "edit") {

                include "actions/new.php";
            }
        } else {

            include "actions/list.php";
        }

        ?>
    </div>
</section>