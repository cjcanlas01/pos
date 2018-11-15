<section class="content-header">
   <h1> PRODUCT </h1>
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
               <h3 class="box-title">Add Product</h3>
               <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
               </div>
            </div>
            <div class="box-body">
               <form action="<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'addproduct')); ?>" enctype="multipart/form-data" method="post" data-toggle="validator" role="form">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group row">
                           <label class="col-sm-5">Product Name</label>
                           <div class="col-sm-7">
                              <input type="text" name="name" required class="form-control" placeholder="Chicken">
                              <div class="help-block with-errors errorinput"></div>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-5">Unit Price per Kilogram</label>
                           <div class="col-sm-7">
                              <input required type="text" style="text-align: right" name="unitprice" onfocusout="maskNum(this, this.value)" onfocus="unmaskNum(this, this.value)" class="form-control" placeholder="00.00">
                              <div class="help-block with-errors errorinput"></div>
                           </div>
                        </div>
                        <?php echo $this->Form->control('image', array(
                            'type' => 'file',
                            'label' => 'Please Upload Image of Product'
                            ));
                        ?>
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
               <h3 class="box-title">Product List</h3>
               <div class="box-tools pull-right">
               </div>
            </div>
            <div class="box-body">
               <table id="prodtable" class="table table-bordered table-hover" style="width: 100%">
                  <thead>
                     <tr>
                        <td style="width: 230px; font-weight: 1000">Product ID</td>
                        <td style="width: 230px; font-weight: 1000">Product Name</td>
                        <td style="width: 150px; font-weight: 1000">Unit Price</td>
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
<div class="modal fade" id="editproduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title" id="exampleModalLabel">EDIT PRODUCT</h3>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-12">
                  <form action="<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'updateproduct')); ?>" enctype="multipart/form-data" method="post" data-toggle="validator" role="form">
                     <input type="text" id="editid" name="productid" required class="form-control" placeholder="0" style="display: none;">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group row">
                              <label class="col-sm-5">Name</label>
                              <div class="col-sm-7">
                                 <input type="text" id="editname" name="name" required class="form-control" placeholder="Chicken">
                                 <div class="help-block with-errors errorinput"></div>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-5">Unit Price per Kilogram</label>
                              <div class="col-sm-7">
                                 <input required type="text" style="text-align: right" id="editunitprice" name="unitprice" onfocusout="maskNum(this, this.value)" onfocus="unmaskNum(this, this.value)" class="form-control" placeholder="00.00">
                                 <div class="help-block with-errors errorinput"></div>
                              </div>
                           </div>
                           <?php echo $this->Form->control('editimage', array(
                            'type' => 'file',
                            'label' => 'Please Upload Image of Product'
                            ));
                           ?>
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

<div class="modal fade" id="alert_delete" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <form action="<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'deleteprod')); ?>" enctype="multipart/form-data" method="post" data-toggle="validator" role="form">
        <input type="text" id="deleteid" name="id" required class="form-control" placeholder="0" style="display: none;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">DELETE THIS PRODUCT?</h4>
        </div>
        <div class="modal-footer">
            <div class="col-xs-6">
                <button type="submit" class="btn btn-primary btn-block btn-flat" onclick="">Yes</button>
            </div>
            <div class="col-xs-6">
                <button type="reset" class="btn btn-danger btn-block btn-flat">No</button>
            </div>
        </div>
    </form>
    </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
   $this->Html->css([
       'AdminLTE./plugins/datatables/dataTables.bootstrap',
       'AdminLTE./plugins/select2/select2.full.min'
     ],
     ['block' => 'css']);

   $this->Html->script([
     'AdminLTE./plugins/datatables/jquery.dataTables.min',
     'AdminLTE./plugins/datatables/dataTables.bootstrap.min',
     'AdminLTE./js/ajax-scripts',
     'AdminLTE./plugins/select2/select2.full.min',
     'AdminLTE./plugins/bootstrap-notify/bootstrap-notify.min',
     'AdminLTE./plugins/bootstrap-validator/form-validator.min',
     'AdminLTE./plugins/money-input/accounting',
   ],
   ['block' => 'script']);
   ?>
<?php $this->start('scriptBottom'); ?>
<script>
   $(document).ready(function(){

       //Start of important methods
       var dataTable = $('#prodtable').DataTable({
           "ajax": {
               url: "<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'viewproduct')); ?>",
               dataSrc: ""
           },
           "columns": [
               {"data": "productid"},
               {"data": "productname"},
               {"data": "unitprice"},
           ],
           "columnDefs": [{
               "targets": 3,
               "data": null,
               "defaultContent": "<div style='text-align: center'><button data-toggle='modal' data-target='#editproduct' id='edit' class='btn btn-primary btn-sm' style='margin: 0px; padding: 0px 5px 0px 5px;'><i class='fa fa-pencil'></i></button>&nbsp;&nbsp;<button class='btn btn-danger btn-sm' data-toggle='modal' data-target='#alert_delete' id='delete' style='margin: 0px; padding: 0px 5px 0px 5px;'><i class='fa fa-times'></i></button></div>"
           },
           {
             "targets": 0,
             "visible": false,
           },
           {
              "targets": 2,
              "render": function(data, type, row){
                  return maskNumA(data);
              }
            }]
       });

       $('#prodtable tbody').on( 'click', '#edit', '#delete', function () {
           var data = dataTable.row( $(this).parents('tr') ).data();
           $('#editid').val(data['productid']);
           $('#editname').val(data['productname']);
           $('#editunitprice').val(data['unitprice']);
           $('#deleteid').val(data['productid']);
       });
       //End of important methods

   });

    function maskNum (elem, value){
        var inputElement = elem;
        inputElement.value = accounting.formatNumber(value, 2);
    }

    function maskNumA (value){
      return accounting.formatNumber(value, 2);
    }

    function unmaskNum (elem, value){
        var inputElement = elem;
        inputElement.value = accounting.unformat(value);
    }
</script>
<?php $this->end(); ?>
