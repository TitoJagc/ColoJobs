<?php 

 use Utils\Utils as Utils;

 ob_start(); ?>

<h3>Ofertes</h3>

           <div class="clearfix"></div>
             <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Descripció Oferta<small>Nom Empresa</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                   <!-- <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>-->
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                 <form class="form-horizontal form-label-left" method="POST" action="<?php echo URL."offer/edit/".$id."/".$id_company; ?>" >


                       <?php if($id_company == ""):?>  
                        <!--SI VE DEL LLISTAT D'OFERTES(TEACHER) LI DEIXO MODIFICAR EMPRESA A LA QUE PERTANY L'OFERTA-->
                            <div class="item form-group">
                              <label for="company_id" class="control-label col-md-3 col-sm-3 col-xs-12">Empresa</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">

                                  <select class="form-control col-md-7 col-xs-12" name="company_id">
                                  <?php foreach ($empresas as $empresa) :?>
                                    <?php if($empresa['id'] == $oferta["idCompany"]):?>
                                        <option selected value="<?php echo $empresa['id']?>"><?php echo $empresa['name']?></option>
                                    <?php else:?>
                                          <option  value="<?php echo $empresa['id']?>"><?php echo $empresa['name']?></option>                          
                                   <?php endif;?>                                     
                                  <?php endforeach; ?>
                                  </select>

                            </select>
                              </div>
                            </div>
                        <?php endif;?> 


                        <div id="alerts"></div>
                        <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor-one">
                          <div class="btn-group">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                            </ul>
                          </div>

                          <div class="btn-group">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                              <li>
                                <a data-edit="fontSize 5">
                                  <p style="font-size:17px">Huge</p>
                                </a>
                              </li>
                              <li>
                                <a data-edit="fontSize 3">
                                  <p style="font-size:14px">Normal</p>
                                </a>
                              </li>
                              <li>
                                <a data-edit="fontSize 1">
                                  <p style="font-size:11px">Small</p>
                                </a>
                              </li>
                            </ul>
                          </div>

                          <div class="btn-group">
                            <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                            <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                            <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                            <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                          </div>

                          <div class="btn-group">
                            <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                            <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                            <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                            <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                          </div>

                          <div class="btn-group">
                            <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                            <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                            <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                            <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                          </div>

                          <div class="btn-group">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
                            <div class="dropdown-menu input-append">
                              <input class="span2" placeholder="URL" type="text" data-edit="createLink" />
                              <button class="btn" type="button">Add</button>
                            </div>
                            <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                          </div>

                          <div class="btn-group">
                            <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="fa fa-picture-o"></i></a>
                            <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
                          </div>

                          <div class="btn-group">
                            <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                            <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                          </div>
                        </div>

                        <div id="editor-one" class="editor-wrapper placeholderText" contenteditable="true"><?php echo html_entity_decode(html_entity_decode($oferta["description"]))?></div>

                        <textarea name="descr" id="descr" style="display:none;"></textarea>
                        
                        <br />

                       <?php if($id_company == ""):?> 
                        <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ini">Data Inici <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <!--<input type="text" id="naixement" name="naixement" required="required"  class="form-control col-md-7 col-xs-12">-->
                                <fieldset>
                                <div class="control-group">
                                  <div class="controls">
                                    <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                      <input type="text" name="ini" class="form-control has-feedback-left" id="single_cal2" placeholder="dd/mm/aaaa" aria-describedby="inputSuccess2Status" value="<?php echo Utils::mysqlToDate($oferta["dateStart"]);?>" required>
                                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                      <span id="inputSuccess2Status" class="sr-only">(success)</span>
                                    </div>
                                  </div>
                                </div>
                              </fieldset>
                              </div>
                        </div>    
                       <?php endif;?> 

                        <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fi">Data Finalització <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <!--<input type="text" id="naixement" name="naixement" required="required"  class="form-control col-md-7 col-xs-12">-->
                                <fieldset>
                                <div class="control-group">
                                  <div class="controls">
                                    <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                      <input type="text" name="fi" class="form-control has-feedback-left" id="single_cal1" placeholder="dd/mm/aaaa" aria-describedby="inputSuccess2Status" value="<?php echo Utils::mysqlToDate($oferta["dateEnd"]);?>" required>
                                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                      <span id="inputSuccess2Status" class="sr-only">(success)</span>
                                    </div>
                                  </div>
                                </div>
                              </fieldset>
                              </div>
                        </div>    

                  <div class="ln_solid"></div>
                  <div class="item form-group">
                  <!-- start accordion -->
                    <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                    <?php 
                    $i = 0;//identificador panels
                    $j = 0; //recorre les competencies
                    
                    foreach($especialitats as $especialitat):?>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$i?>" aria-expanded="true" aria-controls="collapseOne">
                          <h4 class="panel-title"><?= $especialitat["name"]?></h4>
                        </a>
                        <div id="collapse<?=$i?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                          <?php 
                              while (($j < count($competencies))and ($competencies[$j]["specialty"] == $especialitat["name"]) ){

                                if(in_array($competencies[$j]["keyword"],$competenciesOferta)){
                                    echo '<input name="competencies[]" value="'.base64_encode($competencies[$j]["keyword"]).'"  type="checkbox" checked> ';
                                }else{
                                    echo '<input name="competencies[]" value="'.base64_encode($competencies[$j]["keyword"]).'"  type="checkbox" > ';
                                }
                                echo $competencies[$j]["keyword"]."<br>";

                                $j++;

                              }
                          ?>
                          </div>
                        </div>
                      </div>
                      <?php 
                      $i++;//identificador panels
                    endforeach; ?>


                    </div>
                    <!-- end of accordion -->

                    <div class="clearfix"></div>

                  </div>





                       <div class="ln_solid"></div>
                       <div class="form-group ">
                        <div class="col-md-offset-3 pull-right">
                          <button class="btn btn-primary" type="submit" onclick="getDescripcio()">Enviar</button>
                          <?php if($id_company == ""):?> 
                            <a href="<?php echo URL."offer/show"; ?>">
                              <button type="button" class="btn btn-success">Cancel·lar</button>
                            </a>
                          <?php else:?>
                            <a href="<?php echo URL."company/info/".$id_company; ?>">
                              <button type="button" class="btn btn-success">Cancel·lar</button>
                            </a>
                          <?php endif;?> 
                        </div>
                      </div>
                    </form>
                </div>
              </div>
            </div>
            </div>



          <script type="text/javascript">

            function getDescripcio(){
              var editor = document.getElementById("editor-one");
              var text = document.getElementById("descr");

              text.value = editor.innerHTML;  
              //alert(text.value);
            }

          </script>



 <?php  $contenido = ob_get_clean() ?>
 <?php include 'Views/layout.php' ?>