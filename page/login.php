<?php
include '../controller/config.php';
session_start();

if (isset($_SESSION['id'])) {
    header("Location: ../page/index.php");
}
?>

<html lang="en" class="h-100">

<head>
    <title>Login | Simitra</title>
    <?php include 'meta.php'; ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body class="h-100">

    <div class="d-flex align-items-center justify-content-center footer-custom-before">
        <div class="pt-5 mt-4">
            <a href="../" class="text-center text-dark text-decoration-none">
                <div class="mt-4 pb-3">
                    <img src="../public/logo.png" alt="LOGO" height="128px">
                </div>
                <h1 class="text-center mt-1 pb-2">Simitra</h1>
            </a>

            <!-- Alert -->
            <?php if (isset($_SESSION['pesan'])) : ?>
                <?php $pesan = $_SESSION['pesan']; ?>
                <?php if ($pesan == "gagal") : ?>
                    <script>
                        swal("Gagal Membuat Akun!", "Username Sudah Digunakan", "warning");
                    </script>

                <?php elseif ($pesan == "berhasil") : ?>
                    <script>
                        let nama = "<?= $_SESSION['username']; ?>";

                        swal("Berhasil!", "Akun Dengan Username " + nama + " Berhasil Dibuat", "success");
                    </script>

                <?php elseif ($pesan == "error") : ?>
                    <script>
                        swal("Gagal Membuat Akun!", "Proses Register Gagal Dilakukan", "warning");
                    </script>

                <?php elseif ($pesan == "unauthorized") : ?>
                    <script>
                        swal("Gagal Login!", "Username / Password Salah", "warning");
                    </script>
                <?php endif; ?>
            <?php endif;
            unset($_SESSION['pesan']);
            ?>


            <!-- Form Login -->
            <div class="card" style=" padding-top: 30px; padding-bottom: 10px; width: 26rem;">
                <div class="pt-4 pb-5 mx-auto">
                    <form method="POST" style="width: 350px;" action="../model/login.php" class="mx-auto">
                        <label for="floatingUsername" class="form-label">Username</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon3"><i class="mdi mdi-account"></i></span>
                            <input type="text" class="form-control" id="floatingUsername" placeholder="Username" name="username" maxlength="25" required oninput="this.value = this.value.toLowerCase()" value="<?= isset($_SESSION['username']) ? $_SESSION['username'] : '' ?>" onfocus="var temp_value=this.value; this.value=''; this.value=temp_value" autofocus>
                        </div>
                        <label for="floatingPassword" class="form-label">Password</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon3"><i class="mdi mdi-key"></i></span>
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" maxlength="50" required>
                        </div>
                        <div class="mb-4">
                            <input type="checkbox" onclick="cek()" id="check" style="margin-right: 5px; margin-left: 5px">
                            <label for="check">Show Password
                            </label>
                        </div>

                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-block btn-primary text-center" disabled name="submit" id="login"><i class="mdi mdi-login"></i> Login</button>
                        </div>
                        <div class="d-grid gap-2 mx-auto">
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#Registrasi"><i class="mdi mdi-file-document-box"></i> Registrasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#floatingUsername').on('keyup', function() {
                let username = document.getElementById('floatingUsername').value;
                let password = document.getElementById('floatingPassword').value;
                let login = document.getElementById('login');


                if (username == "" || password == "") {
                    login.disabled = true;
                } else {
                    login.disabled = false;
                }
            })

            $('#floatingPassword').on('keyup', function() {
                let username = document.getElementById('floatingUsername').value;
                let password = document.getElementById('floatingPassword').value;
                let login = document.getElementById('login');


                if (username == "" || password == "") {
                    login.disabled = true;
                } else {
                    login.disabled = false;
                }
            })
        });

        function cek() {
            let nilai = document.getElementById("floatingPassword");

            if (nilai.type == "password") {
                nilai.type = "text";
            } else {
                nilai.type = "password";
            }
        }
    </script>

    <!-- Footer -->
    <div id="footer" class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-5 px-4 px-xl-5">
        <div class="text-center text-dark">
            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#Registrasi">Registrasi</button>
            <div class="d-inline-block mx-2">·</div><button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#About">Tentang</button>
        </div>
    </div>

    <!-- -- Modal Registrasi -- -->
    <div class="modal fade" id="Registrasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="RegistrasiLabel">Registrasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../model/tambah-user.php" class="mx-auto">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="Nama" placeholder="name@example.com" name="nama" required maxlength="25" oninput="this.value = this.value.toLowerCase()">
                            <label for="Nama">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" placeholder="Password" name="password" maxlength="50">
                            <label for="password">Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="passkon" placeholder="Password" aria-describedby="validationServer03Feedback" required maxlength="50">
                            <label for="passkon">Konfirmasi Password</label>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                Password tidak sama
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <input type="checkbox" name="check2" id="check2" class="mx-2" onclick="myFunction()">
                            <label for="check2" class="text-dark">Show Password</label>
                        </div>
                        <script>
                            function myFunction() {
                                let x = document.getElementById("password");
                                let y = document.getElementById("passkon");

                                if (x.type == "password" || y.type == "password") {
                                    x.type = "text";
                                    y.type = "text";
                                } else {
                                    x.type = "password";
                                    y.type = "password";
                                }
                            }
                        </script>

                        <div class="d-grid gap-2">
                            <button type="submit" name="register" class="btn btn-primary"><i class="mdi mdi-file-document-box"></i> Daftar</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#passkon').on('keyup', function() {
                let pass = $('#password').val();
                let passkon = $('#passkon').val();

                if (passkon != pass) {
                    $('#passkon').addClass("is-invalid");
                } else {
                    $('#passkon').removeClass("is-invalid");
                }

            });
            $('#password').on('keyup', function() {
                let pass = $('#password').val();
                let passkon = $('#passkon').val();

                if (passkon != "") {
                    if (passkon != pass) {
                        $('#passkon').addClass("is-invalid");
                    } else {
                        $('#passkon').removeClass("is-invalid");
                    }
                }

            });
        });
    </script>

    <!-- Modal About -->
    <div class="modal fade" id="About" tabindex="-1" aria-labelledby="AboutLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AboutLabel">Tentang Kami</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        Badan Pusat Statistik atau yang biasanya disingkat dengan BPS adalah sebuah lembaga pemerintahan non kementrian yang memiliki program kerja periodik, salah satu program kerja yang sedang berlangsung saat ini adalah sensus penduduk.
                    </p>
                    <p>
                        Sensus penduduk adalah suatu kegiatan pendataan tiap-tiap keluarga rumah tangga yang berletakan diseluruh penjuru indonesia, mulai dari sabang sampai merauke. Tahap awal pendataan yang dilakukan adalah melakukan pemutakhiran data awal dengan data terbaru yang lebih aktual. Data-data tersebut didapatkan langsung setelah terjun ke seluruh dusun-dusun yang terletak di tiap-tiap desa di indonesia. Kegiatan pemutakhiran sensus penduduk yang dilakukan meliputi mendata jumlah keluarga dari tiap bangunan, serta memperbarui letak geografis pemetaan bangunan tempat tinggal sebuah keluarga.
                    </p>
                    <p>
                        Geografis pemetaan adalah sebuah hal yang cukup lazim dilakukan pada zaman modern, geografis pemetaan berguna untuk mengetahui data dari tata letak tiap-tiap rumah penduduk di suatu negara, pemetaan tersebut juga berguna untuk membantu petugas BPS (Badan Pusat Statistik) agar dapat lebih mudah melakukan pencacahan/pendataan data keluarga. Peta yang digunakan oleh petugas BPS untuk pemutakhiran adalah peta wilkerstat yang bersumber dari kantor pusat di jakarta.
                    </p>
                    <p>
                        Peta wilkerstat(wilayah kerja statistik) adalah sebuah peta geografis yang secara private dipakai oleh petugas BPS (Badan Pusat Statistik). Peta wilkerstat hanya dapat diakses oleh petugas BPS yang bertujuan melakukan pendataan ketika melakukan sensus penduduk di lapangan. Kekurangan dari peta tersebut adalah terdapat permasalahan ketika melakukan pemutakhiran data tata letak rumah, yaitu peta yang disediakan hanyalah sebuah peta yang berukuran kertas A3, tentu saja hal tersebut membuat penggambaran dari tata letak bangunan menjadi susah dibaca.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
    </script>
</body>

</html>