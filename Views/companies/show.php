 <?php 

  use Utils\Utils as Utils;

 ob_start() ?>

            <div class="page-title">
              <div class="title_left">
                <h3>Empreses</h3>
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
            <a href="<?php echo URL; ?>company/insert" class="pull-right"><button type="button" class="btn btn-primary">Nova Empresa</button></a>
        </div>



              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Llistat d'empreses</small></h2>
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
                          <th>NIF</th>
                          <th>Nom</th>
                          <th>Email</th>
                          <th>Alta</th>
                          <th>Telèfon</th>
                          <th>Accions</th>
                        </tr>
                      </thead>


                      <tbody>
						<?php foreach ($datos as $empresa) :?>
                        <tr>
                          <td>
							 <th><input type="checkbox" id="check-all" class="flat"></th>
						  </td>
                          <td><?php echo $id = $empresa['id']?></td>
                          <td><?php echo $empresa['name']?></td>
                          <td><?php echo $empresa['email']?></td>
                          <td><?php echo Utils::mysqlToDate($empresa['dateOfBirth'])?></td>
                          <td><?php echo $empresa['telephone']?></td>
                          <td style="text-align: center;">

                          <a href="<?php echo URL."company/info/".$id; ?>" ><i class="fa fa-eye"></i></a> 
                          <a href="<?php echo URL."company/edit/".$id; ?>" ><i class="fa fa-pencil"></i></a> 
                          <a href="<?php echo URL."company/delete/".$id; ?>" onclick="return confirm('Segur que vols esborrrar aquesta empresa? Esborrar una empresa implica esborrar les seves ofertes');"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

        <div class="col-md-12 col-sm-12 col-xs-12" >
            <a href="<?php echo URL; ?>company/insert" class="pull-right"><button type="button" class="btn btn-primary">Nova Empresa</button></a>
        </div>


 <?php  $contenido = ob_get_clean() ?>
 <?php include 'Views/layout.php' ?>
 