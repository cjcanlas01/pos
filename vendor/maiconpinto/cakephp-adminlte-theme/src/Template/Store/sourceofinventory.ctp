<section class="content-header">
   <h1> Supplier </h1>
   <ol class="breadcrumb">
      <!-- <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li> -->
      <!-- <li><a>Client Invoice</a></li> -->
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row">
      <div class="col-md-5">
         <div class="box box-primary">
            <div class="box-header with-border">
               <h3 class="box-title">Add Supplier</h3>
               <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
               </div>
            </div>
            <div class="box-body">
               <form action="<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'addsofi')); ?>" method="post" data-toggle="validator" role="form">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group row">
                           <label class="col-sm-5">Name</label>
                           <div class="col-sm-7">
                              <input type="text" name="name" required class="form-control" placeholder="">
                              <div class="help-block with-errors errorinput"></div>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-5">TIN</label>
                           <div class="col-sm-7">
                              <input type="text" name="tin" required class="form-control" placeholder="">
                              <div class="help-block with-errors errorinput"></div>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-5">Address</label>
                           <div class="col-sm-7">
                              <input type="text" name="address" required class="form-control" placeholder="">
                              <div class="help-block with-errors errorinput"></div>
                           </div>
                        </div>
                        <div class="pull-right">
                           <button type="reset" class="btn btn-danger btn-sm" style="width: 115px">
                           RESET
                           </button>
                           <button class="btn btn-primary btn-sm" style="width: 115px">
                           ADD
                           </button>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
            <!-- /.box-body -->
         </div>
      </div>
      <div class="col-md-7">
         <div class="box box-success">
            <div class="box-header with-border">
               <h3 class="box-title">Source List</h3>
               <div class="box-tools pull-right">
               </div>
            </div>
            <div class="box-body">
               <table id="sofitable" class="table table-bordered table-hover" style="width: 100%">
                  <thead>
                     <tr>
                        <td style="width: 230px; font-weight: 1000">Source ID</td>
                        <td style="width: 230px; font-weight: 1000">Name</td>
                        <td style="width: 100px; font-weight: 1000">Action</td>
                     </tr>
                  </thead>
                  <tbody></tbody>
                  <tfoot></tfoot>
               </table>
            </div>
            <!-- /.box-body -->
         </div>
      </div>
      <!-- /.col (RIGHT) -->
   </div>
   <!-- /.row -->
</section>
<!-- /.content -->
<div class="modal fade" id="editsource" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title" id="exampleModalLabel">Edit Supplier</h3>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-12">
                  <form action="<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'updatesofi')); ?>" method="post" data-toggle="validator" role="form">
                     <input type="text" id="editid" name="editid" required class="form-control" placeholder="0" style="display: none;">
                     <div class="form-group row">
                        <label class="col-sm-5">Name</label>
                        <div class="col-sm-7">
                           <input type="text" id="editname" name="name" required class="form-control" placeholder="">
                           <div class="help-block with-errors errorinput"></div>
                        </div>
                     </div>
                     <div class="pull-right">
                        <button class="btn btn-primary btn-sm" style="width: 115px">
                        UPDATE
                        </button>
                     </div>
               </div>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
</div>
</div>
<?php
   $this->Html->css([
       'AdminLTE./plugins/datatables/dataTables.bootstrap',
     ],
     ['block' => 'css']);

   $this->Html->script([
     'AdminLTE./plugins/datatables/jquery.dataTables.min',
     'AdminLTE./plugins/datatables/dataTables.bootstrap.min',
     'AdminLTE./js/ajax-scripts',
     'AdminLTE./plugins/bootstrap-notify/bootstrap-notify.min',
     'AdminLTE./plugins/bootstrap-validator/form-validator.min',
   ],
   ['block' => 'script']);
   ?>
<?php $this->start('scriptBottom'); ?>
<script>
   $(document).ready(function(){

       //Start of important methods
       var dataTable = $('#sofitable').DataTable({
           "ajax": {
               url: "<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'viewsofi')); ?>",
               dataSrc: ""
           },
           "columns": [
               {"data": "sourceid"},
               {"data": "name"},
           ],
           "columnDefs": [{
               "targets": 2,
               "data": null,
               "defaultContent": "<div style='text-align: center'><button data-toggle='modal' data-target='#editsource' id='edit' class='btn btn-primary btn-sm' style='margin: 0px; padding: 0px 5px 0px 5px;'><i class='fa fa-pencil'></i></button>&nbsp;&nbsp;<button class='btn btn-danger btn-sm' style='margin: 0px; padding: 0px 5px 0px 5px;'><i class='fa fa-times'></i></button></div>"
           },
           {
             "targets": 0,
             "visible": false,
           }]
       });

       $('#sofitable tbody').on( 'click', '#edit', function () {
           var data = dataTable.row( $(this).parents('tr') ).data();
           $('#editid').val(data['sourceid']);
           $('#editname').val(data['name']);
       });
       //End of important methods
   });
</script>
<?php $this->end(); ?>
