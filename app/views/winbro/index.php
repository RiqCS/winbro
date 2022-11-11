<?php
$cek = $this->model('Login_model')->cekUser();

if ($cek == NULL) {
    $this->model('Login_model')->userBaru();
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

    <title>33Winbro Indonesia</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="icon" href="<?= BASEURL ?>img/iconWB.png" type="image/x-icon" />
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

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
                            <div class="col-lg-6 d-none d-lg-block" style="background:url('<?= BASEURL ?>img/winbro00.jpg');background-position:center;background-size:cover">
                                <!-- <img src="<?= BASEURL ?>img/winbro00.jpg" alt=""> -->
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="namaUser" aria-describedby="emailHelp" placeholder="Enter User Name...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="sandi" placeholder="Enter Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck" onclick="myFunction()">Show Password</label>
                                            </div>
                                        </div>
                                        <button type="button" id="login" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?php
        if(! isset($_SESSION['pesan']))
        { 
            $pesan = '';
        } else {
            $pesan = $_SESSION['pesan'];
        }
        $this->view('/pesan/pesan');
    ?>

    <input type="hidden" id="objek">
    <input type="hidden" id="pesan" value="<?= $pesan; ?>">


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script>
        function myFunction() {
            var x = document.getElementById("sandi");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

    <script src="<?= BASEURL; ?>js/jquery_combo.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            
            let ps = $('#pesan').val();
            dp = ps.split("|");
            if (ps != '') {
                tampilPesan(dp[0], dp[1]);
                $('#objek').val(dp[2]);
            }
            function tampilPesan(judul, icon) {
                $('.pesan').show();
                $('.judulpesan').html(judul);
                $('#icon').attr("src", "<?=BASEURL; ?>img/icon/" + icon);
                $('#tblOk').focus();
            }
            $('#tblOk').click(function() {
                let ob = $('#objek').val();
                $('.pesan').hide();

                if (ob == 'namaUser') {
                    $('#namaUser').focus();
                }
                if (ob == 'sandi') {
                    $('#sandi').focus();
                } 
                if(ob=='loginAdmin') {
                    window.location.href='<?=BASEURL?>'
                }
            });

            $('#login').click(function(){
                let nu = $('#namaUser').val();
                let sd = $('#sandi').val();

                if(nu=='')
                {
                    tampilPesan("User Name Can't Be Empty !","salah.png");
                    $('#objek').val('namaUser');
                    exit();
                }
                if(sd=='')
                {
                    tampilPesan("Password Can't Be Empty !","salah.png");
                    $('#objek').val('sandi');
                    exit();
                }

                $.ajax({
                    url : '<?=BASEURL?>Proses/cekLoginAdmin',
                    type : 'POST',
                    data : {
                        'namaUser' : nu,
                        'sandi' : sd
                    },
                    success : function(data){
                        alert(data);

                        if(data=='ok'){
                            window.location.href = '<?=BASEURL?>Master/admin/beranda';
                            exit();
                        } else {
                            tampilPesan('Incorrect username and password !','salah.png');
                            exit();
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>