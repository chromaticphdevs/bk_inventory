<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $page['metaTitle'] ?? COMPANY_NAME?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="<?php echo _path_tmp('landing-tmp/assets/img/apple-icon.png')?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo _path_tmp('main-tmp/assets/img/favicon.ico')?>">

    <link rel="stylesheet" href="<?php echo _path_tmp('landing-tmp/assets/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?php echo _path_tmp('landing-tmp/assets/css/templatemo.css')?>">
    <link rel="stylesheet" href="<?php echo _path_tmp('landing-tmp/assets/css/custom.css')?>">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="<?php echo _path_tmp('landing-tmp/assets/css/fontawesome.min.css')?>">
    <?php produce('headers')?>
    <?php produce('styles')?>
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="<?php echo _route('home:index')?>">
            <?php echo COMPANY_NAME_ABBR?>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            
        </div>
    </nav>
    <?php if(!empty(whoIs())) :?>
        <div class="container">
            <p>Currently Logged in : <?php echo wLinkDefault(_route('user:show', whoIs('id')), whoIs(['firstname','lastname']))?></p>
        </div>
    <?php endif?>
    
    <!-- Close Header -->

    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo _route('home:shop')?>" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php produce('content') ?>
    <!-- Start Footer -->
    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo"><?php echo COMPANY_NAME?></h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            <i class="fas fa-map-marker-alt fa-fw"></i>
                            <?php echo COMPANY_ADDRESS?>
                        </li>
                        <li>
                            <i class="fa fa-phone fa-fw"></i>
                            <a class="text-decoration-none" href="tel:<?php echo COMPANY_TEL?>"><?php echo COMPANY_TEL?></a>
                        </li>
                        <li>
                            <i class="fa fa-envelope fa-fw"></i>
                            <a class="text-decoration-none" href="mailto:<?php echo COMPANY_EMAIL?>"><?php echo COMPANY_EMAIL?></a>
                        </li>
                    </ul>
                </div>


                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Further Info</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="<?php echo _route('home:index')?>">Home</a></li>
                        <li><a class="text-decoration-none" href="<?php echo _route('home:about')?>">About Us</a></li>
                        <li><a class="text-decoration-none" href="<?php echo _route('home:contact')?>">Contact</a></li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-left text-light">
                            Copyright &copy; <?php echo date('Y')?> <?php echo COMPANY_NAME_ABBR?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->

    <!-- Start Script -->
    <script src="<?php echo _path_tmp('landing-tmp/assets/js/jquery-1.11.0.min.js')?>"></script>
    <script src="<?php echo _path_tmp('landing-tmp/assets/js/jquery-migrate-1.2.1.min.js')?>"></script>
    <script src="<?php echo _path_tmp('landing-tmp/assets/js/bootstrap.bundle.min.js')?>"></script>
    <script src="<?php echo _path_tmp('landing-tmp/assets/js/templatemo.js')?>"></script>
    <script src="<?php echo _path_tmp('landing-tmp/assets/js/custom.js')?>"></script>
    <!-- End Script -->

    <?php produce('scripts') ?>
</body>

</html>