<div class="container-fluid">
   <br />
   <div class="col-md-12">
      <div class="box box-success">
         <div class="box-header with-border">
            <h4 class="box-title"><b>SALES REPORT</b></h4>
            <div class="box-tools pull-right">
            </div>
         </div>
         <div class="box-body">
            <div class="row">
               <div class="col-md-12">
                  <input type="text" id="tmp_prodid" name="p_id" value="ALL" style="display: none;">
                  <input type="text" id="tmp_sourceid" name="ed" value="ALL" style="display: none;">
                  <input type="text" id="tmp_startdate" name="sd" style="display: none;">
                  <input type="text" id="tmp_enddate" name="ed" style="display: none;">
                  <div class="col-md-4">
                     <label>Date range:</label>
                     <div class="input-group">
                        <div class="input-group-addon">
                           <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control" id="daterange">
                     </div>
                  </div>
                  <div class="col-md-2">
                     <label>Product</label>
                     <div class="input-group">
                        <select class="form-control select2" style="width: 150px;" id="product" disabled>
                        </select>
                        <select class="form-control" id="productid" style="display: none;">
                        </select>
                     </div>
                  </div>
                  <div class="form-group col-md-4">
                     <label></label>
                     <div class="input-group">
                        <button type="submit" id="generate" class="btn btn-primary btn-block">GENERATE REPORT</button>
                     </div>
                  </div>
               </div>
               <div class="col-md-12">
                  <br />
               </div>
            </div>
            <table id="salesreporttable" class="table table-bordered table-hover" style="width: 100%; text-align: center;">
               <thead>
                  <tr>
                     <td style="width: 300px; font-weight: 1000">Sales ID</td>
                     <td style="width: 300px; font-weight: 1000">Product Name</td>
                     <td style="width: 300px; font-weight: 1000">Price</td>
                     <td style="width: 300px; font-weight: 1000">Weight</td>
                     <td style="width: 300px; font-weight: 1000">Amount Due</td>
                     <td style="width: 300px; font-weight: 1000">Less Discount</td>
                     <td style="width: 300px; font-weight: 1000">Net Amount Due</td>
                     <td style="width: 300px; font-weight: 1000">Amount Tender</td>
                     <td style="width: 300px; font-weight: 1000">Amount Change</td>
                     <td style="width: 300px; font-weight: 1000">Date</td>
                     <td style="width: 300px; font-weight: 1000">User</td>
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
<?php
   $this->Html->css([
     'AdminLTE./plugins/daterangepicker/daterangepicker',
     'AdminLTE./plugins/datatables/dataTables.bootstrap',
     'AdminLTE./plugins/select2/select2',
     'https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css'
   ],
   ['block' => 'css']);

   $this->Html->script([
     'AdminLTE./js/ajax-scripts',
     'AdminLTE./plugins/datepicker/bootstrap-datepicker',
     'AdminLTE./plugins/daterangepicker/moment.min',
     'AdminLTE./plugins/daterangepicker/daterangepicker',
     'AdminLTE./plugins/select2/select2.full.min',
     'AdminLTE./plugins/bootstrap-notify/bootstrap-notify.min',
     'AdminLTE./plugins/bootstrap-validator/form-validator.min',
     'AdminLTE./plugins/datatables/jquery.dataTables.min',
     'AdminLTE./plugins/datatables/dataTables.bootstrap.min',
     'https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js',
     'https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js',
     'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js',
     'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js',
     'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js',
     'https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js',
     'https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js'
   ],
   ['block' => 'script']);
   ?>
<?php $this->start('scriptBottom'); ?>
<script>
   function GetTodayDate() {
      var tdate = new Date();
      var dd = tdate.getDate(); //yields day
      var MM = tdate.getMonth(); //yields month
      var yyyy = tdate.getFullYear(); //yields year
      //var currentDate= dd + "-" +( MM+1) + "-" + yyyy;
      var currentDate = yyyy + "-" + (MM+1) + "-" + dd;

      return currentDate;
   }

   $('#generate').click(function(){
       $("#salesreporttable").dataTable().fnDestroy();
       var dataTable = $('#salesreporttable').DataTable({
           dom: 'Bfrtip',
           buttons: [
               {
                   extend: 'excel',
                   messageTop: 'As of ' + $('#tmp_startdate').val() + ' to ' + $('#tmp_enddate').val(),
                   title: 'Sales Report ' + GetTodayDate()
               },
               {
                   extend: 'pdf',
                   messageTop: 'As of ' + $('#tmp_startdate').val() + ' to ' + $('#tmp_enddate').val(),
                   title: 'Sales Report ' + GetTodayDate()
               }
           ],
           "ajax": {
               url: "<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'genreportsales')); ?>",
               data: {
                   startdate: $('#tmp_startdate').val(),
                   enddate: $('#tmp_enddate').val(),
                   productid: $('#tmp_prodid').val()
               },
               type: "POST",
               dataSrc: ""
           },
           "columns": [
               { "data": "salesid"},
               { "data": "productname"},
               { "data": "price" },
               { "data": "weight"},
               { "data": "amountdue"},
               { "data": "lessdiscount"},
               { "data": "netamountdue"},
               { "data": "amounttender"},
               { "data": "amountchange"},
               { "data": "dateissued"},
               { "data": "username"},
           ]
       });

   });

   $(document).ready(function(){

       $('.select2 ').select2({
           theme: "classic"
       });

       function populateproduct(){
           var result=null;
           jQuery.ajax({
           url: '<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'viewproduct')); ?>',
           type: 'get',
           dataType: 'json',
           success:function(data)
           {
               result = data;
               var select_prod = $('#product'), option = '';
               select_prod.empty();

               for(var i=0; i<result.length; i++)
               {
                   if(i==0){
                       option += "<option selected='selected'>ALL</option>";
                       option += "<option>"+ result[i].productname +"</option>";
                   }
                   else{
                       option += "<option>"+ result[i].productname +"</option>";
                   }
               }

               select_prod.append(option);

               var select_prodid = $('#productid'), option_ = '';
               select_prodid.empty();

               for(var i=0; i<result.length; i++)
               {
                   if(i==0){
                       option_ += "<option>ALL</option>";
                       option_ += "<option>"+ result[i].productid +"</option>";
                   }
                   else{
                       option_ += "<option>"+ result[i].productid +"</option>";
                   }
               }

               select_prodid.append(option_);
           }
           });
       }

       populateproduct();

   }); //End of document-ready function

       $('#product').on('select2:select', function(){
           $('#tmp_prodid').val(document.getElementById('productid').options[$('#product').find(':selected').index()].text);
       });

       $(function () {
           $('#daterange').daterangepicker({
               autoApply: true,
           },
           function(start, end, label) {
               $('#tmp_startdate').val(start.format('YYYY-MM-DD'));
               $('#tmp_enddate').val(end.format('YYYY-MM-DD'));
               $('#product').prop('disabled', false);
           });
       });

       $('#daterange').click(function(){
           $('#tmp_startdate').val('');
           $('#tmp_enddate').val('');
           $('#tmp_prodid').val('ALL');

           $('#product').val('ALL');
           $('#product').trigger('change');

           $('#inserthere').empty();
           $('#product').prop('disabled', true);
       });

</script>
<?php $this->end(); ?>
