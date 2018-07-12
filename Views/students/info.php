<?php 

use Utils\Utils as Utils;

ob_start() ?>

<h3>Estudiants</h3>


           <div class="clearfix"></div>
             <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Informació Estudiant </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>

                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" method="POST" action="<?php echo UR."company/edit/".$datos["id"]; ?>" enctype="multipart/form-data">

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id">NIF 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="id" class="form-control col-md-7 col-xs-12"  name="id" required="required" type="text" value="<?php echo $datos["id"]; ?>" readonly>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12"  name="name"  required="required" type="text" value="<?php echo $datos["name"]; ?>" readonly>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $datos["email"]; ?>" readonly>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Telèfon 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="tel" id="telephone" name="telephone" required="required" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12" value="<?php echo $datos["telephone"]; ?>" readonly>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">Adreça</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="address" class="form-control col-md-7 col-xs-12" type="text" name="address" value="<?php echo $datos["addressStreet"]; ?>" readonly>
                        </div>
                      </div>                      

                      <div class="item form-group">
                        <label for="municipality" class="control-label col-md-3 col-sm-3 col-xs-12">Municipi</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="municipality" class="form-control col-md-7 col-xs-12" type="text" name="municipality" value="<?php echo $datos["municipality"]; ?>" readonly>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label for="postalCode" class="control-label col-md-3 col-sm-3 col-xs-12">C.P.</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="image" class="form-control col-md-7 col-xs-12" type="text" name="postalCode" value="<?php echo $datos["postalCode"]; ?>" readonly>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Aniversari 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="tel" id="telephone" name="telephone" required="required" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12" value="<?php echo Utils::mysqlToDate($datos["dateOfBirth"]); ?>" readonly>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label for="wantsToReceiveOffers" class="control-label col-md-3 col-sm-3 col-xs-12">Rebre Ofertes</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php if($datos['wantsToReceiveOffers']):?>
                                <input style="margin-top: 10px;" type="checkbox" checked disabled>
                            <?php else:?>
                                <input style="margin-top: 10px;" type="checkbox"  disabled>
                            <?php endif;?>
                        </div>
                      </div>


                      <div class="item form-group">
                        <label for="image" class="control-label col-md-3 col-sm-3 col-xs-12">Imatge</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                          <img src="<?php echo URL."Views/template/".$datos["image"];?>" style="height: 100px; margin:0 5px 3px 0;" id="imagen">


                        </div>
                      </div>



                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">

                          <a href="<?php echo URL; ?>student/show">
                            <button type="button" class="btn btn-success pull-right">Tornar</button>
                          </a>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <script type="text/javascript">

            //Control validacio de pass correcte.
            var password = document.getElementById("pwd"), confirm_password = document.getElementById("pwd2");

            function validatePassword(){
              if(password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Passwords no coincideixen.");
              } else {
                confirm_password.setCustomValidity('');
              }
            }

            password.onchange = validatePassword;
            confirm_password.onkeyup = validatePassword;

            
            //Esborrar imatge d'usuari
            function img_del(){
              var img = document.getElementById("imagen");
              var url = img.src;
              var array_url = url.split("/");
              array_url[array_url.length-1] = "user.png";

              img.src = array_url.join("/");

              document.getElementById("image_hide").value="";
              //alert(img.src);
            }

          </script>
 <?php  $contenido = ob_get_clean() ?>
 <?php include 'Views/layout.php' ?>