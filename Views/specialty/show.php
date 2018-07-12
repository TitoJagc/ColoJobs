 <?php ob_start() ?>


        <div class="col-md-12 col-sm-12 col-xs-12"> <!-- bootstrap -->
          <div class="x_panel">
            <div class="x_title">
              <h2>Llistat d'especialitats</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Settings 1</a></li>
                    <li><a href="#">Settings 2</a></li>
                  </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
              </ul>
              <div class="clearfix"></div>
            </div> <!-- x_title -->
            <div class="x_content">
              <!-- 
              <p class="text-muted font-13 m-b-30">
              DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
              </p>
              -->
              <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                <thead>
                  <tr>
							       <!-- <th><input type="checkbox" id="check-all" class="flat"></th>-->
                    <th>Nom</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
						      <?php
                      $id=1000;
                      foreach ($datos as $specialty) :
                          $sn64 = base64_encode($specialty['name']);
                          $id++;
                  ?>  
                  <tr>
                    <!-- <td><input type="checkbox" id="check-all" class="flat"></td> -->
                    <td>
                        <div id="t<?=$id?>" style="display: inline-block;">
                          <?=$specialty['name']?>
                        </div>
                        <div id="f<?=$id?>" style="display: none;width: 100%">
                          <input class="input-sm" name="newspecialty" required="required" type="text" value="<?=$specialty['name']?>" oldvalue="<?=$specialty['name']?>" id="<?=$id?>" style="width: 80%">
                          &nbsp;
                          <a onclick="updateContent('<?=$id?>')" >
                              <i class="fa fa-check"></i>
                          </a>
                          <a onclick="cancelUpdate('<?=$id?>')" >
                              <i class="fa fa-close"></i>
                          </a>
                         <div> 
                    </td>
                    <td style="text-align: center;"> <!-- edit -->
                      <a onclick="swapState('<?=$id?>')" >
                        <i class="fa fa-pencil"></i>
                      </a>
                      &nbsp;
                      <a href="<?php echo URL."specialty/delete/".$sn64; ?>" onclick="return confirm('Segur que vols esborrrar aquesta especialitat?');">
                        <i class="fa fa-trash"></i> <!-- delete -->
                      </a>
                    </td>
                  </tr>
                  <?php endforeach; ?>      
                </tbody>
              </table> 

              <form class="form-horizontal" method="POST" action="<?php echo URL; ?>specialty/insert" enctype="multipart/form-data">
                <div class="form-group">
                  <div class="col-md-8 col-sm-8 col-xs-12">
                    <input id="specialtyId" class="form-control input-sm" name="specialty" required="required" type="text" placeholder="Nova especialitat">
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <button class="btn btn-sm btn-success" type="submit">Afegir nova</button> 
                  </div>
                </div> 
              </form>  

            </div> <!-- x-content -->
          </div> <!-- x-pannel -->
        </div> <!-- bootstrap -->





 <?php  $contenido = ob_get_clean() ?>

 <?php ob_start();?>

<script>

  function swapState(specialtyInput){
    var fId = '#'+ 'f' + specialtyInput;
    var tId = '#'+ 't' + specialtyInput;
    $(fId).css('display', 'inline-block');
    $(tId).css('display', 'none');
    //alert(specialtyInput);
  }

  function cancelUpdate(specialtyInput){
    var fId = '#'+ 'f' + specialtyInput;
    var tId = '#'+ 't' + specialtyInput;
    $(fId).css('display', 'none');
    $(tId).css('display', 'inline-block');
   
    var Id = '#'+ specialtyInput;
    $(Id).val($(Id).attr('oldvalue'));
    //$(Id).attr('value', $(Id).attr('oldvalue'));
    //alert('value'+ $(Id).attr('value'));
  }

  function updateContent(specialtyInput){
    var Id = '#'+ specialtyInput;
    var fId = '#'+ 'f' + specialtyInput;
    var tId = '#'+ 't' + specialtyInput;

    $.ajax({
        method: "POST",
        url: "edit",
        data: { specialty: $(Id).attr('oldvalue'),
                newspecialty: $(Id).val(),
              }
      }).done(function( msg ) {
          console.log( "Data Saved: " + msg );
          if (msg==='200'){
            $(Id).attr('oldvalue', $(Id).val());
            $(tId).text($(Id).val());
            $(fId).css('display', 'none');
            $(tId).css('display', 'inline-block');
          }
      });
  }

</script>

 <?php  $myscript = ob_get_clean(); ?>
 <?php include 'Views/layout.php' ?>
 