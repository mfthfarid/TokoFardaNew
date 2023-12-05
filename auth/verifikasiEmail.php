<?php
require '../koneksi.php';
require '../controller/lupaPasswordController.php';

$lupaPassword = new lupaPassword();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['Email'];
    $lupaPassword->findEmail($email);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Verifikasi Email | Toko Farda</title>

    <!-- Custom fonts for this template-->
    <link href="<?= 'http://localhost/SI/tokoFarda/' ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= 'http://localhost/SI/tokoFarda/' ?>css/sb-admin-2.min.css" rel="stylesheet">

    <!-- sweetalert -->
    <link rel="stylesheet" href="<?= 'http://localhost/SI/tokoFarda/'; ?>sweetalert2/sweetalert2.min.css">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                            and we'll send you a link to reset your password!</p>
                                    </div>
                                    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" class="user">
                                        <div class="form-group">
                                            <input type="email" name="Email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Verifikasi Email
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="../index.php">Sudah punya akun? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= 'http://localhost/SI/tokoFarda/' ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= 'http://localhost/SI/tokoFarda/' ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= 'http://localhost/SI/tokoFarda/' ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= 'http://localhost/SI/tokoFarda/' ?>js/sb-admin-2.min.js"></script>

    <!-- sweetalert2 -->
    <script src="<?= 'http://localhost/SI/tokoFarda/'; ?>sweetalert2/sweetalert2.min.js"></script>

    <script>
        <?php if (isset($_SESSION['success'])) : ?>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '<?= $_SESSION['success']; ?>',
                showConfirmButton: false,
                timer: 1500
            });
        <?php unset($_SESSION['success']);
        endif; ?>

        <?php if (isset($_SESSION['error'])) : ?>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: '<?= $_SESSION['error']; ?>',
                showConfirmButton: false,
                timer: 1500
            });
        <?php unset($_SESSION['error']);
        endif; ?>
    </script>

</body>
</html>