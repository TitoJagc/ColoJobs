<?php 

use Utils\Utils as Utils;

ob_start() ?>

<h3>Professors</h3>


           <div class="clearfix"></div>
             <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Editar Professor </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" method="POST" action="<?php echo URL."teacher/edit/".$datos["id"]; ?>" enctype="multipart/form-data">

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id">NIF <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="id" class="form-control col-md-7 col-xs-12"  name="id" required="required" type="text" value="<?php echo $datos["id"]; ?>" readonly>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12"  name="name"  required="required" type="text" value="<?php echo $datos["name"]; ?>">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $datos["email"]; ?>">
                        </div>
                      </div>


                      <div class="item form-group">
                        <label for="pwd" class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="pwd" type="password" name="pwd" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" placeholder="Omplir només en cas de canvi.">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label for="pwd2" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="pwd2" type="password" name="pwd2" data-validate-linked="pwd" class="form-control col-md-7 col-xs-12" placeholder="Omplir només en cas de canvi." >
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Telèfon <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="tel" id="telephone" name="telephone" required="required" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12" value="<?php echo $datos["telephone"]; ?>">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">Adreça</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="address" class="form-control col-md-7 col-xs-12" type="text" name="address" value="<?php echo $datos["addressStreet"]; ?>">
                        </div>
                      </div>                      

                      <div class="item form-group">
                        <label for="municipality" class="control-label col-md-3 col-sm-3 col-xs-12">Municipi</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                           <select class="form-control col-md-7 col-xs-12" name="municipality">

                              <?php foreach ($municipalities as $municipality) :?>
                                  <?php if($municipality['name'] == $datos["municipality"]):?>
                                      <option selected><?php echo $municipality['name']?></option>
                                  <?php else:?>
                                      <option><?php echo $municipality['name']?></option>
                                  <?php endif;?>                       
                              <?php endforeach; ?>
                            </select>

                        </div>
                      </div>

                      <div class="item form-group">
                        <label for="postalCode" class="control-label col-md-3 col-sm-3 col-xs-12">C.P.</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="image" class="form-control col-md-7 col-xs-12" type="text" name="postalCode" value="<?php echo $datos["postalCode"]; ?>">
                        </div>
                      </div>


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="naixement">Data de Naixement <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <!--<input type="text" id="naixement" name="naixement" required="required"  class="form-control col-md-7 col-xs-12">-->
                          <fieldset>
                          <div class="control-group">
                            <div class="controls">
                              <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                <input type="text" name="naixement" class="form-control has-feedback-left" id="single_cal1" placeholder="dd/mm/aaaa" aria-describedby="inputSuccess2Status" value="<?php echo Utils::mysqlToDate($datos["dateOfBirth"]); ?>" required>
                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                <span id="inputSuccess2Status" class="sr-only">(success)</span>
                              </div>
                            </div>
                          </div>
                        </fieldset>
                        </div>
                      </div>  

                      <div class="item form-group">
                        <label for="isValidator" class="control-label col-md-3 col-sm-3 col-xs-12">Valida Ofertes</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php if($datos['isValidator']):?>
                                <input name="validator" style="margin-top: 10px;" type="checkbox" checked>
                            <?php else:?>
                                <input name="validator" style="margin-top: 10px;" type="checkbox">
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label for="image" class="control-label col-md-3 col-sm-3 col-xs-12">Imatge</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                          <img src="<?php echo URL."Views/template/".$datos["image"];?>" style="height: 100px; margin:0 5px 3px 0;" id="imagen"> <i class="fa fa-trash fa-2x" onclick="return confirm('Segur que vols esborrar l\'imatge?')?img_del():'';"></i>

                          <input id="image_hide" class="form-control col-md-7 col-xs-12" type="hidden" name="image_hide" value="<?php echo $datos["image"];?>">             

                          <input id="image" class="form-control col-md-7 col-xs-12" type="file" name="image">
                        </div>
                      </div>


                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button class="btn btn-primary" type="submit">Enviar</button>
                          <a href="<?php echo URL; ?>teacher/show">
                            <button type="button" class="btn btn-success">Cancel·lar</button>
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