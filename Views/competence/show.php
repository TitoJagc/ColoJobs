 <?php ob_start() ?>


        <div class="col-md-12 col-sm-12 col-xs-12"> <!-- bootstrap -->
          <div class="x_panel">
            <div class="x_title">
              <h2>Llistat de competències</h2>
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
                    <th>Competència</th>
                    <th>Especialitat</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
						      <?php
                      $id=2000;
                      foreach ($datos as $competence) :
                          $ck64 = base64_encode($competence['keyword']);
                          $id++;
                  ?>  
                  <tr>
                    <!-- <td><input type="checkbox" id="check-all" class="flat"></td> -->
                    <td>
                      <div id="c<?=$id?>" style="display: inline-block;" competence="<?=$competence['keyword']?>">
                        <?=$competence['keyword']?>
                      </div>
                    </td>
                    <td>
                      <div id="s<?=$id?>" style="display: inline-block;" specialty="<?=$competence['specialty']?>">
                        <?=$competence['specialty']?>
                      </div>
                    </td>
                    <td style="text-align: center;"> <!-- edit -->
                      <a data-title="Edit" data-toggle="modal" data-target="#editModal" data-whatever="<?=$id?>">
                        <i class="fa fa-pencil"></i>
                      </a>
                      &nbsp;
                      <a href="<?php echo URL."competence/delete/".$ck64; ?>" onclick="return confirm('Segur que vols esborrrar aquesta especialitat?');">
                        <i class="fa fa-trash"></i> <!-- delete -->
                      </a>
                    </td>
                  </tr>
                  <?php endforeach; ?>      
                </tbody>
              </table> 

              <form class="form-horizontal" method="POST" action="<?php echo URL; ?>competence/insert" enctype="multipart/form-data">
                <div class="form-group">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <input id="competenceId" class="form-control input-sm" name="keyword" required="required" type="text" placeholder="Nova competència">
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <select class="form-control input-sm" id="selectspecialty" name="specialty">
                      <!-- <option> list by ajax -->
                    </select>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <button class="btn btn-sm btn-success" type="submit">Afegir nova</button> 
                  </div>
                </div> 
              </form>  

            </div> <!-- x-content -->
          </div> <!-- x-pannel -->
        </div> <!-- bootstrap -->

<!-- Modal edit -->

<!--<button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" >
  <i class="fa fa-pencil"></i>
</button>
-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
        </button>
        <h4 class="modal-title custom_align" id="Heading">Edita aquesta competència</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <input class="form-control" type="text" placeholder="Competència" id="mcompetence">
        </div>
        <div class="form-group"> 
          <select class="form-control" id="mspecialty">
            <!-- <option> list by jQuery -->
          </select>
        </div>
      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-warning btn-lg" style="width: 100%;" onclick="updateContent()">
          <span class="glyphicon glyphicon-ok-sign"></span> Update</button>
      </div>
    </div>
  </div> <!-- /.modal-content --> 
</div> <!-- /.modal-dialog --> 

<?php  $contenido = ob_get_clean() ?>




 <?php ob_start();?>
<script>

  function updateContent(){
    var cId = '#'+ 'c' + $('#editModal').attr('nInput');
    var sId = '#'+ 's' + $('#editModal').attr('nInput');
    //console.log('Update: ' + $('#editModal').attr('nInput'));

    $.ajax({
        method: "POST",
        url: "<?=URL?>/competence/edit/" + $(cId).attr('competence'),
        data: { keyword: $('#mcompetence').val(),
                specialty: $('#mspecialty').val(),
              }
      }).done(function( msg ) {
          //console.log( "Data Saved: " + msg );
          if (msg==='200'){
            $(cId).text($('#mcompetence').val()); // Set text nodes
            $(sId).text($('#mspecialty').val());
            $(cId).attr('competence', $('#mcompetence').val());  // Set attributes
            $(sId).attr('specialty', $('#mspecialty').val());
          }
      });

    $('#editModal').modal('hide');  // manually hide the modal  
  }

  // ajax document ready
  
  document.addEventListener("DOMContentLoaded", function() {
    $.ajax({
        method: "POST",
        url: "<?=URL?>/specialty/getSpecialties",
    }).done(function( msg ) {
        //console.log( "Data retrieved: " + msg );

        var msga = $.parseJSON(msg);
        //console.log( "Element at 0: " + msga[0] );

        msga.forEach( function(element) {
          var innerNode = '<option>' + element + '</option>';
          $('#selectspecialty').append(innerNode);
        });

        //console.log("End");
        //console.log('<?=URL?>');
    });
  });
  

  document.addEventListener("DOMContentLoaded", function() {
    $('#editModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes

      var cId = '#'+ 'c' + recipient;
      var sId = '#'+ 's' + recipient;

      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

      var modal = $(this);
      modal.attr('nInput',recipient); // store the row that caused the event
      //console.log(recipient);

      modal.find('#mcompetence').val($(cId).attr('competence'));    // set the competence

      var sel = $('#selectspecialty').children().clone();           // set the specialty

      $('#mspecialty').html(sel);     
      $('#mspecialty').val($(sId).attr('specialty'));

      //console.log($(sId).text());
 
      //modal.find('.modal-title').text('New message to ' + recipient)
      //modal.find('.modal-body input').val(recipient)
    });
  });

</script>
 <?php  $myscript = ob_get_clean(); ?>
 
 <?php include 'Views/layout.php' ?>
 