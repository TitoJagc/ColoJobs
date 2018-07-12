 <?php 

  use Utils\Utils as Utils;

 ob_start() ?>

            <div class="page-title">
              <div class="title_left">
                <h3>Estudiants</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                              <button class="btn btn-default" type="button">Go!</button>
                          </span>
                  </div>
                </div>
              </div>
            </div>



        <div class="col-md-12 col-sm-12 col-xs-12" >
            <a href="<?php echo URL; ?>student/insert" class="pull-right"><button type="button" class="btn btn-primary">Nou Estudiant</button></a>
        </div>



              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Llistat d'estudiants</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="table-responsive x_content">
                    <p class="text-muted font-13 m-b-30">
                      DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                    </p>
                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>
               <th><input type="checkbox" id="check-all" class="flat"></th>
              </th>
                          <th>DNI</th>
                          <th>Nom</th>
                          <th>Email</th>
                          <th>Aniversari</th>
                          <th>Telèfon</th>
                          <th>Ofertes</th>
                          <th>Accions</th>
                        </tr>
                      </thead>


                      <tbody>
            <?php foreach ($datos as $student) :?>
                        <tr>
                          <td>
               <th><input type="checkbox" id="check-all" class="flat"></th>
              </td>
                          <td><?php echo $id = $student['id']?></td>
                          <td><?php echo $student['name']?></td>
                          <td><?php echo $student['email']?></td>
                          <td><?php echo Utils::mysqlToDate($student['dateOfBirth'])?></td>
                          <td><?php echo $student['telephone']?></td>
                          <td style="text-align: center;">
                                  <?php if($student['wantsToReceiveOffers']):?>
                                      <input type="checkbox" value="" checked disabled>
                                  <?php else:?>
                                      <input type="checkbox" value=""  disabled>
                                  <?php endif;?>                            
                          </td>
                          <td style="text-align: center;">

                          <a href="<?php echo URL."student/info/".$id; ?>" ><i class="fa fa-eye"></i></a> 
                          <a href="<?php echo URL."student/edit/".$id; ?>" ><i class="fa fa-pencil"></i></a> 
                          <a href="<?php echo URL."student/delete/".$id; ?>" onclick="return confirm('Segur que vols esborrrar aquest estudiant? Esborrar un estudiant implica esborrar també les dades del seu curriculum');"><i class="fa fa-trash"></i></a>
                          <a href="<?php echo URL."resume/show/".$id; ?>" ><i class="fa fa-folder-open"></i></a> 
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
        <!--
        <div class="col-md-12 col-sm-12 col-xs-12" >
            <a href="<?php //echo URL; ?>student/insert" class="pull-right"><button type="button" class="btn btn-primary">Nou Estudiant</button></a>
        </div>
        -->

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Alta massiva d'estudiants</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      Format Fitxer:(Alumne per línea)<br> dni, nom_alumne, data_naixament(dd/mm/aaa), adreça(sense comes), email, telèfon<br><a href="<?php echo URL; ?>Examples/alumnes.txt">Descarrega Exemple</a>
                    </p>
                    <form class="form-horizontal" method="POST" action="<?php echo URL; ?>student/masive" enctype="multipart/form-data">
                      <div class="item form-group">
                        <label for="fitxer" class="control-label col-md-3 col-sm-6 col-xs-12">Puja el teu fitxer d'alumnes</label>
                        <div class="col-md-9 col-sm-6 col-xs-12">
                          <input id="fitxer" class="form-control col-md-7 col-xs-12" type="file" name="fitxer">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                          <button class="btn btn-sm btn-success pull-right" type="submit">Afegir</button> 
                        </div>
                      </div> 
                    </form>  
                  </div>
                </div>
              </div>


 <?php  $contenido = ob_get_clean() ?>
 <?php include 'Views/layout.php' ?>
 