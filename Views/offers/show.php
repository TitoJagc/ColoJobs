<?php 

 use Utils\Utils as Utils;

ob_start() ?>

 <h3>Listat d'Ofertes</h3>
            
            <div class="row">


             <div class="col-md-12 col-sm-12 col-xs-12" >
                  <a href="<?php echo URL."offer/insert"; ?>" class="pull-right"><button type="button" class="btn btn-primary">Nova Oferta</button></a>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Llistat d'ofertes</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="table-responsive x_content">


                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>
                           <th><input type="checkbox" id="check-all" class="flat"></th>
                          </th>
                          <th>Empresa</th>
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
                          <td><?php echo $id = $oferta['name']?></td>
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
                          	<a href="<?php echo URL."offer/edit/".$id; ?>" ><i class="fa fa-pencil"></i></a> 
                          	<a href="<?php echo URL."offer/delete/".$id; ?>" onclick="return confirm('Segur que vols esborrrar aquesta oferta?');"><i class="fa fa-trash"></i></a>
                            	<?php if($_SESSION['rol'] == "Teacher"):?>
                          			<a href="<?php echo URL."offer/validate/".$id; ?>" onclick="return confirm('Segur que vols VALIDAR aquesta oferta? Automaticament s\'enviarà l\'oferta per correu a tots els alumnes!');"><i class="fa fa-check"></i></a>
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
                  <a href="<?php echo URL."offer/insert"; ?>" class="pull-right"><button type="button" class="btn btn-primary">Nova Oferta</button></a>
              </div>

            </div>


 <?php  $contenido = ob_get_clean() ?>
 <?php include 'Views/layout.php' ?>