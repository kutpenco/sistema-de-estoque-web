<script type="text/javascript" language="javascript" class="init">
 $(document).ready(function() {
         table = $('#requisicoes').DataTable({
        dom: 'Blfrtip',
        buttons: [
             { extend: 'copy', text: 'Copiar' }, 'csv', 'excel',  'print'
        ],
        stateSave: true,
        "oLanguage": {
    "sProcessing": "Aguarde enquanto os dados são carregados ...",
    "sLengthMenu": "Mostrar _MENU_ registros por pagina",
    "sZeroRecords": "Nenhum registro correspondente ao criterio encontrado",
    "sInfoEmtpy": "Exibindo 0 a 0 de 0 registros",
    "sInfo": "Exibindo de _START_ a _END_ de _TOTAL_ registros",
    "sInfoFiltered": "",
    "sSearch": "Procurar",
    "oPaginate": {
       "sFirst":    "Primeiro",
       "sPrevious": "Anterior",
       "sNext":     "Próximo",
       "sLast":     "Último"
    }
 }
  });
} );
</script>
    <script>


  $(function() {
    $( ".datepicker" ).datepicker({
        dateFormat: 'yy-mm-dd',
     dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']

        });
  });

    $(function() {
    $( "#datepicker2" ).datepicker({
        dateFormat: 'yy-mm-dd',
     dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']

        });
  });
  </script>
  <div class="content">
  		<div class="container-fluid">
  				<div class="row">
  					<div class="col-md-12">
  					<div class="card ">

              <div class="header">
                  <button class="button-back btn btn-info btn-fill btn-wd" onclick="goBack()"> <i class="ti-angle-left"></i>Voltar</button>
        <h3><?php echo $pagina ?></h3>
      </div>
      <div class="content">
        <?php
          $CI =& get_instance(); if($CI->Controleacesso->acesso_funcao(34) == true){
               echo '<button class="btn btn-success" onclick="add_ativo()"><i class="glyphicon glyphicon-plus"></i>Novo Tipo de ajuste</button>';
            }
            else{
               echo '<button class="btn btn-success" disabled><i class="glyphicon glyphicon-plus"></i>Novo Tipo de ajuste</button>';
            }
            ?>
       <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Recarregar</button>
       <br />
       <br />
       <table id="requisicoes" class="table-striped table-bordered" cellspacing="0" width="100%">
           <thead>
               <tr>
                 <th>Nome</th>
                 <th style="width:50%;">Tipo Movimento</th>
                   <th style="width:65px;">Açao</th>
               </tr>
           </thead>
           <tbody>
                <?php foreach($lista as $lista): ?>
               <tr>

                       <td><?php echo $lista->nome_tipo_ajuste; ?></td>
                       <td><?php
                       if($lista->movimento_tipo_ajuste == 1){
                         echo 'Entrada';
                       }
                        elseif($lista->movimento_tipo_ajuste == 2){
                          echo 'Saída';
                        }

                        ?></td>
                      <td>
                         <?php
                      $CI =& get_instance(); if($CI->Controleacesso->acesso_funcao(36) == true){
                       echo '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_produtos('.$lista->id_tipo_ajuste.')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>';
                       }
                       else{

                       }

                       ?>
                      </td>
               </tr>

               <?php endforeach; ?>
           </tbody>

           <tfoot>
           <tr>

                    <th>Nome</th>
                    <th>Tipo Movimento</th>


                   <th style="width:65px;">Açao</th>
           </tr>
           </tfoot>
       </table>
     </div>
     </div>
</div>
</div>
</div>
</div>




<script type="text/javascript">

var save_method; //for save method string
var table;

$(document).ready(function() {

   //datatables
   table = $('#tble').DataTable({

       "oLanguage": {
   "sProcessing": "Aguarde enquanto os dados são carregados ...",
   "sLengthMenu": "Mostrar _MENU_ registros por pagina",
   "sZeroRecords": "Nenhum registro correspondente ao criterio encontrado",
   "sInfoEmtpy": "Exibindo 0 a 0 de 0 registros",
   "sInfo": "Exibindo de _START_ a _END_ de _TOTAL_ registros",
   "sInfoFiltered": "",
   "sSearch": "Procurar",
   "oPaginate": {
      "sFirst":    "Primeiro",
      "sPrevious": "Anterior",
      "sNext":     "Próximo",
      "sLast":     "Último"
   }
} ,

       "processing": true, //Feature control the processing indicator.
       "serverSide": true, //Feature control DataTables' server-side processing mode.
       "order": [], //Initial no order.

       // Load data for the table's content from an Ajax source
       "ajax": {
           "url": "<?php echo site_url('estoque/ajax_list')?>",
           "type": "POST"
       },

       //Set column definition initialisation properties.
       "columnDefs": [
       {
           "targets": [ -1 ], //last column
           "orderable": false, //set not orderable
       },
       ],

   });

   //datepicker
   $('.datepicker').datepicker({
       autoclose: true,
       format: "yyyy-mm-dd",
       todayHighlight: true,
       orientation: "top auto",
       todayBtn: true,
       todayHighlight: true,
   });

   //set input/textarea/select event when change value, remove class error and remove text help block
   $("input").change(function(){
       $(this).parent().parent().removeClass('has-error');
       $(this).next().empty();
   });
   $("textarea").change(function(){
       $(this).parent().parent().removeClass('has-error');
       $(this).next().empty();
   });
   $("select").change(function(){
       $(this).parent().parent().removeClass('has-error');
       $(this).next().empty();
   });

});



function add_ativo()
{
   save_method = 'add';
   $('#form')[0].reset(); // reset form on modals
   $('.form-group').removeClass('has-error'); // clear error class
   $('.help-block').empty(); // clear error string
   $('#modal_form').modal('show'); // show bootstrap modal
   $('.modal-title').text('Novo Tipo de Ajuste'); // Set Title to Bootstrap modal title
}

function edit_produtos(id)
{
   save_method = 'update';
   $('#form')[0].reset(); // reset form on modals
   $('.form-group').removeClass('has-error'); // clear error class
   $('.help-block').empty(); // clear error string

   //Ajax Load data from ajax
   $.ajax({
       url : "<?php echo site_url('ajustes/tipo_ajuste_edit/')?>/" + id,
       type: "GET",
       dataType: "JSON",
       success: function(data)
       {

           $('[name="id_tipo_ajuste"]').val(data.id_tipo_ajuste);
           $('[name="nome_tipo_ajuste"]').val(data.nome_tipo_ajuste);
           $('[name="movimento_tipo_ajuste"]').val(data.movimento_tipo_ajuste);
           $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
           $('.modal-title').text('Editar Ativo'); // Set title to Bootstrap modal title

       },
       error: function (jqXHR, textStatus, errorThrown)
       {
           alert('Erro ao editar');
       }
   });
}
function reload_table()
{
   location.reload();
}

function save()
{
   $('#btnSave').text('saving...'); //change button text
   $('#btnSave').attr('disabled',true); //set button disable
   var url;

   if(save_method == 'add') {
       url = "<?php echo site_url('ajustes/tipo_ajuste_add')?>";
   } else {
       url = "<?php echo site_url('ajustes/tipo_ajuste_update')?>";
   }

   // ajax adding data to database
   $.ajax({
       url : url,
       type: "POST",
       data: $('#form').serialize(),
       dataType: "JSON",
       success: function(data)
       {

           if(data.status) //if success close modal and reload ajax table
           {
               $('#modal_form').modal('hide');
               reload_table();
           }
           else
           {
               for (var i = 0; i < data.inputerror.length; i++)
               {
                   $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                   $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
               }
           }
           $('#btnSave').text('save'); //change button text
           $('#btnSave').attr('disabled',false); //set button enable


       },
       error: function (jqXHR, textStatus, errorThrown)
       {
           alert('Error adding / update data');
           $('#btnSave').text('save'); //change button text
           $('#btnSave').attr('disabled',false); //set button enable

       }
   });
}



function delete_produtos(id)
{
   if(confirm('Are you sure delete this data?'))
   {
       // ajax delete data to database
       $.ajax({
           url : "<?php echo site_url('ativos/ativo_delete/')?>/"+id,
           type: "POST",
           dataType: "JSON",
           success: function(data)
           {
               //if success reload ajax table
               $('#modal_form').modal('hide');
               reload_table();
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
               alert('Error deleting data');
           }
       });

   }
}


</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h3 class="modal-title">Ajuste</h3>
           </div>
           <div class="modal-body form">
               <form action="#" id="form" class="form-horizontal">
                   <input type="hidden" value="" name="id_tipo_ajuste"/>
                   <div class="form-body">
                       <div class="form-group">
                           <label class="control-label col-md-3">Nome do Ajuste</label>
                           <div class="col-md-9">
                               <input name="nome_tipo_ajuste" placeholder="Nome do Ajuste" class="form-control" type="text">
                               <span class="help-block"></span>
                           </div>
                       </div>



                       <div class="form-group">
                           <label class="control-label col-md-3">Tipo de movimento</label>
                           <div class="col-md-9">
                           <select class="form-control" name="movimento_tipo_ajuste">
                             <option value="1" >Entrada</option>
                             <option value="2"> Saída</option>
                            </select>
                               <span class="help-block"></span>
                           </div>
                       </div>



                   </div>
               </form>
           </div>
           <div class="modal-footer">
               <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Salvar</button>
               <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
           </div>
       </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<script type="text/javascript">
           $(function () {
              $('.datepicker-input').datepicker({ dateFormat: 'yy-mm-dd' })
           });
       </script>



<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-ui-1.10.1.custom.min.js' ?>"></script>


 <script>
 $(function() {
   $( ".datepicker" ).datepicker();
 });
 </script>
</body>
</html>
