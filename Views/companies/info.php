<?php 

 use Utils\Utils as Utils;

ob_start() ?>

<h3>Empreses</h3>


           <div class="clearfix"></div>
             <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Informació Empresa </h2>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Website URL 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="url" id="website" name="website" required="required" placeholder="http://www.website.com" class="form-control col-md-7 col-xs-12" value="<?php echo $datos["web"]; ?>" readonly>
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
                        <label for="image" class="control-label col-md-3 col-sm-3 col-xs-12">Imatge</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                          <img src="<?php echo URL."Views/template/".$datos["image"];?>" style="height: 100px; margin:0 5px 3px 0;" id="imagen">


                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Descripció <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="description" required="required" name="description" class="form-control col-md-7 col-xs-12" readonly><?php echo $datos["description"]; ?></textarea>
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">

                          <a href="<?php echo URL; ?>company/show">
                            <button type="button" class="btn btn-success pull-right">Tornar</button>
                          </a>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

           <div class="clearfix"></div>

 <h3>Listat d'Ofertes</h3>
            
            <div class="row">


             <div class="col-md-12 col-sm-12 col-xs-12" >
                  <a href="<?php echo URL."offer/insert/".$datos["id"]; ?>" class="pull-right"><button type="button" class="btn btn-primary">Nova Oferta</button></a>
              </div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Llistat d'ofertes</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="table-responsive x_content">
                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>
                           <th><input type="checkbox" id="check-all" class="flat"></th>
                          </th>
                          <th>Número</th>
                          <th>Descripció</th>
                          <th>Inici</th>
                          <th>Fi</th>
                          <th>Validació</th>
                          <th>Accions</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($ofertas as $oferta) :?>
                        <tr>
                          <td><th><input type="checkbox" id="check-all" class="flat"></th></td>  
                          <td><?php echo $id = $oferta['num']?></td>
                          <td>



                          <!-- Large modal -->
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg<?php echo $id?>">+</button>

                          <div class="modal fade bs-example-modal-lg<?php echo $id?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">

                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                  </button>
                                  <h4 class="modal-title" id="myModalLabel">Oferta</h4>
                                </div>
                                <div class="modal-body">
                                  <h4>Descripció</h4>
                                  <?php echo html_entity_decode(html_entity_decode($oferta['description']))?>
                                  <br>
                                  <h4>Competències</h4>
                                  <?php 
                                  $comps = "";
                                  foreach ($oferta["competences"] as $competencia) {
                                    if ($comps) {
                                      $comps .= ", ".$competencia;

                                    }else{
                                      $comps = $competencia;   
                                    }
                                  }

                                  if ($comps) {
                                      echo $comps;
                                  }else{
                                      echo "No s'han establert competències per aquesta oferta.";
                                  }
                                  ?>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>

                              </div>
                            </div>
                          </div>


                          <?php echo substr(html_entity_decode(html_entity_decode($oferta['description'])), 0,40)."...";?>

                          </td> 
                          <td><?php echo Utils::mysqlToDate($oferta['dateStart'])?></td>                          
                          <td><?php echo Utils::mysqlToDate($oferta['dateEnd'])?></td>
                          <td><?php echo $oferta['validatedBy']?></td>
                          <td style="text-align: center;">

                          <a href="<?php echo URL."company/info/".$id; ?>" data-toggle="modal" data-target=".bs-example-modal-lg<?php echo $id = $oferta['num']?>"><i class="fa fa-eye"></i></a> 
                   
                          <?php if($oferta['validatedBy'] == ""):?>
                            <a href="<?php echo URL."offer/edit/".$id."/".$datos["id"]; ?>" ><i class="fa fa-pencil"></i></a> 
                            <a href="<?php echo URL."offer/delete/".$id."/".$datos["id"]; ?>" onclick="return confirm('Segur que vols esborrrar aquesta oferta? ');"><i class="fa fa-trash"></i></a>
                            <?php if($_SESSION['rol'] == "Teacher"):?>

                              <a href="<?php echo URL."offer/validate/".$id."/".$datos["id"]; ?>" onclick="return confirm('Segur que vols VALIDAR aquesta oferta? Automaticament s\'enviarà l\'oferta per correu a tots els alumne!');"><i class="fa fa-check"></i></a>
                             <?php endif;?> 
                           <?php endif;?> 

                          </td>                          
                        </tr>
                        <?php endforeach; ?>
                      </tbody>


                    </table>                                        
                  </div>
                </div>
              </div>




              <div class="col-md-12 col-sm-12 col-xs-12" >
                  <a href="<?php echo URL."offer/insert/".$datos["id"]; ?>" class="pull-right"><button type="button" class="btn btn-primary">Nova Oferta</button></a>
              </div>

            </div>


 <?php  $contenido = ob_get_clean() ?>
 <?php include 'Views/layout.php' ?>