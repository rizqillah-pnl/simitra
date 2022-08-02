   <!-- ============================================================== -->
   <!-- End Container fluid  -->
   <!-- ============================================================== -->
   <!-- ============================================================== -->
   <!-- footer -->
   <!-- ============================================================== -->
   <footer class="footer text-end d-flex flex-row-reverse">
       <div class="row">
           <div class="col-md-3"></div>
           <div class="col-md-auto">&COPY; <a href="../">Simitra</a> 2022
           </div>
       </div>
   </footer>
   <!-- ============================================================== -->
   <!-- End footer -->
   <!-- ============================================================== -->
   </div>
   <!-- ============================================================== -->
   <!-- End Page wrapper  -->
   <!-- ============================================================== -->
   </div>
   <!-- ============================================================== -->
   <!-- End Wrapper -->
   <!-- ============================================================== -->
   <!-- ============================================================== -->

   <!-- All Jquery -->
   <!-- ============================================================== -->


   <!-- Modal Logout -->
   <div class="modal fade " id="Logout" tabindex="-1" aria-labelledby="LogoutLabel" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="LogoutLabel">Logout</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   Anda yakin ingin keluar?
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                   <a href="../logout.php?change=akun" class="btn btn-warning text-white">Ganti Akun</a>
                   <a href="../logout.php" class="btn btn-danger text-white">Keluar</a>
               </div>
           </div>
       </div>
   </div>


   <script>
       window.onscroll = function() {
           myFunction()
       };

       var widget = document.getElementById('navbar');
       var sticky = widget.offsetTop;


       function myFunction() {
           if (window.pageYOffset >= sticky) {
               widget.classList.add("sticky")
           } else {
               widget.classList.remove("sticky");
           }
       }
   </script>
   <script src="../public/assets/libs/jquery/dist/jquery.min.js"></script>

   <script src="../public/js/script.js"></script>
   <!-- Bootstrap tether Core JavaScript -->
   <script src="../public/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
   <script src="../public/js/app-style-switcher.js"></script>
   <!--Wave Effects -->
   <script src="../public/js/waves.js"></script>
   <!--Menu sidebar -->
   <script src="../public/js/sidebarmenu.js"></script>
   <!--Custom JavaScript -->
   <script src="../public/js/custom.js"></script>
   <!--This page JavaScript -->
   <!--chartis chart-->
   <script src="../public/assets/libs/chartist/dist/chartist.min.js"></script>
   <script src="../public/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
   <script src="../public/js/pages/dashboards/dashboard1.js"></script>


   </body>

   </html>