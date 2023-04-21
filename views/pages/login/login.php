<div class="page">
    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-8 col-xs-10 card-sigin-main mx-auto my-auto py-4 justify-content-center">
                    <div class="card-sigin">
                        <!-- Demo content-->
                        <div class="main-card-signin d-md-flex">
                            <div class="wd-100p">
                                <div class="d-flex mb-4"><a href="index.html"><img src="views/assets/img/brand/favicon.png" class="sign-favicon ht-40" alt="logo"></a></div>
                                <div class="">
                                    <div class="main-signup-header">
                                        <h2>Welcome back!</h2>
                                        <h6 class="font-weight-semibold mb-4">Please sign in to continue.</h6>

                                        <form method="post" class="needs-validation" novalidate>

                                            <div class="panel panel-primary">
                                                <div class=" tab-menu-heading mb-2 border-bottom-0">
                                                    <div class="tabs-menu1">
                                                        <ul class="nav panel-tabs">
                                                            <li class="me-2"><a href="#tab5" class="active" data-bs-toggle="tab">Email</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="panel-body tabs-menu-body border-0 p-3">
                                                    <div class="tab-content">
                                                        <div class="tab-pane active" id="tab5">
                                                            <form action="#">
                                                                <div class="form-group">
                                                                    <label>Email</label>
                                                                    <input type="email" class="form-control" placeholder="Enter your email" name="loginEmail" onchange="validateJS(event, 'email')" required>

                                                                    <div class="valid-feedback">Valid.</div>
                                                                    <div class="invalid-feedback">Please fill out this field.</div>

                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Password</label> <input type="password" class="form-control" placeholder="Enter your password" name="loginPassword" required>

                                                                    <div class="valid-feedback">Valid.</div>
                                                                    <div class="invalid-feedback">Please fill out this field.</div>

                                                                </div>

                                                                <?php
                                                                require_once "controllers/admins.controller.php";

                                                                $login = new AdminsController();
                                                                $login->login();
                                                                ?>

                                                                <button class="btn btn-primary btn-block">Sign In</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="views/assets/custom/forms/forms.js"></script>