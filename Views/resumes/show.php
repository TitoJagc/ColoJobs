 <?php 

  use Utils\Utils as Utils;

 ob_start() ?>

          <div class="page-title">
              <div class="title_left">
                <h3>Curriculum</h3>
              </div>

          </div>

            <div class="clearfix"></div>



<div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12" >
            <a href="<?php echo URL."resume/generatePdf/".$id_student;?>" class="pull-right" target="_blank"><button type="button" class="btn btn-primary">Genera PDF</button></a>
        </div>


         <div class="col-md-12 col-sm-12 col-xs-12">
           <div class="x_panel">

            <div class="x_title">
              <h2>Cicles Formatius</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
               
              </ul>
              <div class="clearfix"></div>
            </div> <!-- x_title -->
            
            <div class="x_content">

            <div class="table-responsive">
              <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                <thead>
                  <tr>
                     <!-- <th><input type="checkbox" id="check-all" class="flat"></th>-->
                    <th>Nom</th>
                    <th>Promoció</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      $id=1000;
                      $cicles = $curriculum->get("cicles");
                      foreach ($cicles as $cicle) :
                          $sn64 = base64_encode($cicle['name']);
                          $id++;
                  ?>  
                  <tr>
                    <!-- <td><input type="checkbox" id="check-all" class="flat"></td> -->
                    <td>
                        <div id="t<?=$id?>" style="display: inline-block;">
                          <?=$cicle['name']?>
                        </div>

                    </td>
                    <td>
                      <?=$cicle['class']?>
                    </td>
                    <td style="text-align: center;"> <!-- edit -->
                      <a href="<?php echo URL."resume/deleteCicle/".base64_encode(addslashes($cicle['name']))."/".$id_student; ?>" onclick="return confirm('Segur que vols esborrrar aquesta cicle del teu curriculum?');">
                        <i class="fa fa-trash"></i> <!-- delete -->
                      </a>
                    </td>
                  </tr>
                  <?php endforeach; ?>      
                </tbody>
              </table> 
            </div>

              <form class="form-horizontal" method="POST" action="<?php echo URL."resume/insertCicle/".$id_student; ?>" enctype="multipart/form-data">

                <div class="form-group">
                  <div class="col-md-7 col-sm-7 col-xs-12">
                            <select class="form-control col-md-7 col-xs-12" name="id_cicle">
                            <?php foreach ($tots_cicles as $cicle) :?>
                              <option value="<?php echo base64_encode(addslashes($cicle['name'])) ?>"><?php echo $cicle['name']?></option>
                            <?php endforeach; ?>
                            </select>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                            <select class="form-control col-md-7 col-xs-12" name="promocio">
                            <?php for($i=2000;$i<2100;$i++){?>
                              <option value="<?php echo $i ?>"><?php echo $i?></option>
                            <?php } ?>
                            </select>
                  </div>
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    <button class="btn btn-sm btn-success" type="submit">Afegir nou</button> 
                  </div>
                </div> 
              </form>  

            </div> <!-- x-content -->
          </div> <!-- x-pannel -->
        </div> <!-- bootstrap -->
<div class="clearfix"></div>

        <div id="formacio" class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Altre Formació</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
               
              </ul>
              <div class="clearfix"></div>
            </div> <!-- x_title -->
            
            <div class="x_content">
              <!-- 
              <p class="text-muted font-13 m-b-30">
              DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
              </p>
              -->
             <div class="table-responsive">
              <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                <thead>
                  <tr>
                     <!-- <th><input type="checkbox" id="check-all" class="flat"></th>-->
                    <th>Centre</th>
                    <th>Títol</th>
                    <th>D. Inici</th>
                    <th>D. Fi</th>
                    <th>Descripció/Capacitats</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      $altres = $curriculum->get("otherEducation");
                      foreach ($altres as $estudis) :
                  ?>  
                  <tr>
                    <td>
                        <?=$estudis['organization']?>
                    </td>
                    <td>
                        <?=$estudis['title']?>
                    </td>
                    <td>
                        <?=Utils::mysqlToDate($estudis['startDate'])?>
                    </td>
                    <td>
                        <?=Utils::mysqlToDate($estudis['endDate'])?>
                    </td>
                    <td>
                        <?=$estudis['mainLearnedCapacities']?>
                    </td>                    
                    <td style="text-align: center;"> <!-- edit -->
                      <a href="<?php echo URL."resume/deleteEducation/".$estudis['num']."/".$id_student; ?>" onclick="return confirm('Segur que vols esborrrar aquests estudis del teu curriculum?');">
                        <i class="fa fa-trash"></i> <!-- delete -->
                      </a>
                    </td>
                  </tr>
                  <?php endforeach; ?>      
                </tbody>

              </table> 
            </div>
              <form class="form-horizontal" id="education" method="POST" action="<?php echo URL."resume/insertEducation/".$id_student; ?>">

                 <div class="form-group">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                      <input id="organization" class="form-control input-sm" name="organization" required="required" type="text" placeholder="Centre de Formació (IES Sa Colomina)">
                    </div>
                
                    <div class="col-md-3 col-sm-3 col-xs-12">
                      <input id="title" class="form-control input-sm" name="title" required="required" type="text" placeholder="Títol (Batxillerat)">
                    </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">                 
                                <fieldset>
                                <div class="control-group">
                                  <div class="controls">
                                    <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                      <input type="text" name="startDate" class="form-control has-feedback-left" id="single_cal2" placeholder="dd/mm/aaaa" aria-describedby="inputSuccess2Status" required>
                                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                      <span id="inputSuccess2Status" class="sr-only">(success)</span>
                                    </div>
                                  </div>
                                </div>
                              </fieldset>
                  </div>


                  <div class="col-md-3 col-sm-3 col-xs-12">
                      <fieldset>
                                <div class="control-group">
                                  <div class="controls">
                                    <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                      <input type="text" name="endDate" class="form-control has-feedback-left" id="single_cal1" placeholder="dd/mm/aaaa" aria-describedby="inputSuccess2Status"  required>
                                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                      <span id="inputSuccess2Status" class="sr-only">(success)</span>
                                    </div>
                                  </div>
                                </div>
                        </fieldset>
                    </div>
                  </div>

                  <div class="form-group">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <input id="specialtyId" class="form-control input-sm" name="capacities" required="required" type="text" placeholder="Descripció / Capacitats">
                  </div>
                  </div>
                <div class="form-group">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <button class="btn btn-sm btn-success" type="submit">Afegir nou</button> 
                  </div>
                </div> 
              </form>  

            </div> <!-- x-content -->
          </div> <!-- x-pannel -->
        </div> <!-- bootstrap -->
<div class="clearfix"></div>

        <div id="experiencia" class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Experiència Laboral</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
               
              </ul>
              <div class="clearfix"></div>
            </div> <!-- x_title -->
            
            <div class="x_content">
              <!-- 
              <p class="text-muted font-13 m-b-30">
              DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
              </p>
              -->
              <div class="table-responsive">
              <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                <thead>
                  <tr>
                     <!-- <th><input type="checkbox" id="check-all" class="flat"></th>-->
                    <th>Sector</th>
                    <th>Empresa</th>
                    <th>Càrrec</th>
                    <th>D. Inici</th>
                    <th>D. Fi</th>
                    <th>Principals Activitats</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      $experiencies = $curriculum->get("experience");
                      foreach ($experiencies as $experiencia) :
                  ?>  
                  <tr>
                    <td>
                        <?=$experiencia['sector']?>
                    </td>
                    <td>
                        <?=$experiencia['employer']?>
                    </td>
                    <td>
                        <?=$experiencia['position']?>
                    </td>
                    <td>
                        <?=Utils::mysqlToDate($experiencia['startDate'])?>
                    </td>
                    <td>
                        <?=Utils::mysqlToDate($experiencia['endDate'])?>
                    </td>
                    <td>
                        <?=$experiencia['mainActivities']?>
                    </td>                    
                    <td style="text-align: center;"> <!-- edit -->
                      <a href="<?php echo URL."resume/deleteExperience/".$experiencia['num']."/".$id_student; ?>" onclick="return confirm('Segur que vols esborrrar aquesta experiència del teu curriculum?');">
                        <i class="fa fa-trash"></i> <!-- delete -->
                      </a>
                    </td>
                  </tr>
                  <?php endforeach; ?>      
                </tbody>
              </table> 
              </div>
              <form class="form-horizontal" id="experience" method="POST" action="<?php echo URL."resume/insertExperience/".$id_student; ?>">

                   <div class="form-group">
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <input class="form-control input-sm" name="sector" required="required" type="text" placeholder="Sector">
                      </div>
                  
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <input class="form-control input-sm" name="employer" required="required" type="text" placeholder="Empresa">
                      </div>

                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <input class="form-control input-sm" name="position" required="required" type="text" placeholder="Càrrec">
                      </div>
                    </div>


                    <div class="form-group">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input class="form-control input-sm" name="activities" required="required" type="text" placeholder="Principals Activitats">
                      </div>
                    </div>


                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12">                 
                                    <fieldset>
                                    <div class="control-group">
                                      <div class="controls">
                                        <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                          <input type="text" name="startDate" class="form-control has-feedback-left" id="single_cal3" placeholder="dd/mm/aaaa" aria-describedby="inputSuccess2Status" required>
                                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                          <span id="inputSuccess2Status" class="sr-only">(success)</span>
                                        </div>
                                      </div>
                                    </div>
                                  </fieldset>
                      </div>


                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <fieldset>
                                    <div class="control-group">
                                      <div class="controls">
                                        <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                          <input type="text" name="endDate" class="form-control has-feedback-left" id="single_cal4" placeholder="dd/mm/aaaa" aria-describedby="inputSuccess2Status"  required>
                                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                          <span id="inputSuccess2Status" class="sr-only">(success)</span>
                                        </div>
                                      </div>
                                    </div>
                            </fieldset>
                        </div>
                      </div>
                  </div>
                <div class="form-group">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <button class="btn btn-sm btn-success" type="submit">Afegir nou</button> 
                  </div>
                </div> 
              </form>  

            </div> <!-- x-content -->
          </div> <!-- x-pannel -->
        </div> <!-- bootstrap -->
<div class="clearfix"></div>

        <div id="idiomes" class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Idiomes</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
               
              </ul>
              <div class="clearfix"></div>
            </div> <!-- x_title -->
            
            <div class="x_content">
              <!-- 
              <p class="text-muted font-13 m-b-30">
              DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
              </p>
              -->
              <div class="table-responsive">
              <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                <thead>
                  <tr>
                     <!-- <th><input type="checkbox" id="check-all" class="flat"></th>-->
                    <th>Idioma</th>
                    <th>LL. Materna</th>
                    <th>N. Conversa</th>
                    <th>N. Escriptura</th>
                    <th>N. Lectura</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      $idiomes = $curriculum->get("languages");
                      foreach ($idiomes as $idioma) :
                  ?>  
                  <tr>
                    <td>
                        <?=$idioma['language']?>
                    </td>
                    <td>
                        <?php if($idioma['isMotherTongue']):?>
                           <input style="margin-top: 10px;" type="checkbox" checked disabled>
                        <?php else:?>
                           <input style="margin-top: 10px;" type="checkbox"  disabled>
                        <?php endif;?>
                    </td>
                    <td>
                        <?=$idioma['spokenLevel']?>
                    </td>
                    <td>
                        <?=$idioma['writtenLevel']?>
                    </td>
                    <td>
                        <?=$idioma['readingLevel']?>
                    </td>                    
                    <td style="text-align: center;">
                      <a href="<?php echo URL."resume/deleteLanguage/".base64_encode($idioma['language'])."/".$id_student; ?>" onclick="return confirm('Segur que vols esborrrar aquest idioma del teu curriculum?');">
                        <i class="fa fa-trash"></i> <!-- delete -->
                      </a>
                    </td>
                  </tr>
                  <?php endforeach; ?>      
                </tbody>
              </table> 
              </div>
              <form class="form-horizontal"  method="POST" action="<?php echo URL."resume/insertLanguage/".$id_student; ?>">

                   <div class="form-group">
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12" name="language">
                            <?php foreach ($tots_langs as $lang) :?>
                              <option value="<?php echo base64_encode($lang['name']) ?>"><?php echo $lang['name']?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                  
                      <div class="col-md-5 col-sm-5 col-xs-12">
                         <label for="isMotherTongue" class="control-label col-md-6 col-sm-6 col-xs-3">Llengua Materna</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <input name="isMotherTongue" style="margin-top: 10px;" type="checkbox" checked>
                        </div>
                      </div>
                  </div>

                  <div class="form-group">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12" name="spoken">
                          <option value="" selected>Nivell Conversa</option>
                            <?php foreach ($tots_levels as $lang) :?>
                              <option value="<?php echo $lang ?>"><?php echo $lang?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12" name="written">
                          <option value="" selected>Nivell Escriptura</option>
                            <?php foreach ($tots_levels as $lang) :?>
                              <option value="<?php echo $lang ?>"><?php echo $lang?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12" name="reading">
                          <option value="" selected>Nivell Lectura</option>
                            <?php foreach ($tots_levels as $lang) :?>
                              <option value="<?php echo $lang ?>"><?php echo $lang?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                  </div>

                <div class="form-group">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <button class="btn btn-sm btn-success" type="submit">Afegir nou</button> 
                  </div>
                </div> 

              </form> 
            </div> <!-- x-content -->
          </div> <!-- x-pannel -->
        </div> <!-- bootstrap -->

<div class="clearfix"></div>

        <div id="carnets" class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Carnets de Conduir</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
               
              </ul>
              <div class="clearfix"></div>
            </div> <!-- x_title -->
            
            <div class="x_content">
              <!-- 
              <p class="text-muted font-13 m-b-30">
              DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
              </p>
              -->
              <div class="table-responsive">
              <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                <thead>
                  <tr>
                     <!-- <th><input type="checkbox" id="check-all" class="flat"></th>-->
                    <th>Carnet de Conduir</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      $llicencies = $curriculum->get("licences");
                      foreach ($llicencies as $llicencia) :
                  ?>  
                  <tr>
                    <td>
                        <?=$llicencia['licence']?>
                    </td>                   
                    <td style="text-align: center;">
                      <a href="<?php echo URL."resume/deleteLicence/".base64_encode($llicencia['licence'])."/".$id_student; ?>" onclick="return confirm('Segur que vols esborrrar aquest carnet de conduir del teu curriculum?');">
                        <i class="fa fa-trash"></i> <!-- delete -->
                      </a>
                    </td>
                  </tr>
                  <?php endforeach; ?>      
                </tbody>
              </table> 
              </div>
              <form class="form-horizontal"  method="POST" action="<?php echo URL."resume/insertLicence/".$id_student; ?>">

                   <div class="form-group">
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12" name="licence">
                            <?php foreach ($tots_carnets as $carnet) :?>
                              <option value="<?php echo base64_encode($carnet) ?>"><?php echo $carnet?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <button class="btn btn-sm btn-success" type="submit">Afegir nou</button> 
                        </div>
                 </div>

              
                

              </form> 
            </div> <!-- x-content -->
          </div> <!-- x-pannel -->
        </div> <!-- bootstrap -->

<div class="clearfix"></div>
</div>


 <?php  $contenido = ob_get_clean();?>




<?php ob_start();?>

<script>
  $(document).ready(function(){
    $('#education, #experience').submit(function(){
      var ini = $("input[name='startDate']").val();
      var fi = $("input[name='endDate']").val();
      var a_ini = ini.split("/");
      var a_fi = fi.split("/");
      var inidate = new Date(a_ini[2], a_ini[1], a_ini[0]); 
      var fidate = new Date(a_fi[2], a_fi[1], a_fi[0]);  

       if (inidate >= fidate) {
          alert("Sisplau, confirma que les dates d'inici i fi són correctes.");
          return false;
       }
    });
  });
</script>

 <?php  $myscript = ob_get_clean(); ?>
 


 <?php include 'Views/layout.php' ?>