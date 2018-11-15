<div class="container-fluid">
   <br />
   <div class="col-md-12">
      <div class="box box-success">
         <div class="box-header with-border">
            <h4 class="box-title"><b>INVENTORY REPORT</b></h4>
            <div class="box-tools pull-right">
            </div>
         </div>
         <div class="box-body">
            <div class="row">
               <div class="col-md-12">
                  <input type="text" id="tmp_prodid" name="p_id" value="ALL" style="display: none;">
                  <input type="text" id="tmp_startdate" name="sd" style="display: none;">
                  <input type="text" id="tmp_enddate" name="ed" style="display: none;">
                  <div class="col-md-2">
                     <label>Product</label>
                     <div class="input-group">
                        <select class="form-control select2" style="width: 150px;" id="product">
                        </select>
                        <select class="form-control" id="productid" style="display: none;">
                        </select>
                     </div>
                  </div>
                  <div class="col-md-2">
                     <label>Month</label>
                     <div class="input-group">
                        <select type="text" class="form-control select2" id="month" disabled>
                            <option>ALL</option>
                            <option>January</option>
                            <option>February</option>
                            <option>March</option>
                            <option>April</option>
                            <option>May</option>
                            <option>June</option>
                            <option>July</option>
                            <option>August</option>
                            <option>September</option>
                            <option>October</option>
                            <option>November</option>
                            <option>December</option>
                        </select>
                        <!-- disabled -->
                     </div>
                     </div>
                     <div class="col-md-2">
                        <label>Year</label>
                         <div class="input-group">
                            <select type="text" class="form-control select2" id="year" disabled>
                                <option>ALL</option>
                                <option>2018</option>
                            </select>
                            <!-- disabled -->
                         </div>
                     </div>
                      <div class="col-md-4">
                         <label></label>
                         <div class="input-group">
                            <button type="submit" id="generate" class="btn btn-primary btn-block">GENERATE REPORT</button>
                         </div>
                      </div>
                  </div>
               </div>
               <div class="col-md-12">
                  <br />
               </div>
               <div class="container-fluid">
                    <table id="invreporttable" border="2" class="table table-bordered table-hover" style="width: 100%; text-align: center;">
                       <thead>
                       <tr>
                          <td style="width: 300px; font-weight: 1000">Transaction Type</td>
                          <td style="width: 300px; font-weight: 1000">Date (YYYY-MM-DD)</td>
                          <td style="width: 300px; font-weight: 1000">Time (HH-MM-SS)</td>
                          <td style="width: 300px; font-weight: 1000">Product Name</td>
                          <td style="width: 300px; font-weight: 1000">Weight</td>
                       </tr>
                       <tr>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                       </tr>
                       </thead>
                       <tbody id="t_body"></tbody>
                       <tfoot id="t_foot">
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                       </tfoot>
                    </table>
                </div>
            </div>
         </div>
         <!-- /.box-body -->
      </div>
   </div>
   <!-- /.col (RIGHT) -->
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
   var testoutput = 0;
   var headeramnt = 0;
   function GetTodayDate() {
      var tdate = new Date();
      var dd = tdate.getDate(); //yields day
      var MM = tdate.getMonth(); //yields month
      var yyyy = tdate.getFullYear(); //yields year
      var currentDate= dd + "-" +( MM+1) + "-" + yyyy;
      return currentDate;
   }

   function GetTodayDate2() {
      var tdate = new Date();
      var dd = tdate.getDate(); //yields day
      var MM = tdate.getMonth(); //yields month
      var yyyy = tdate.getFullYear(); //yields year
      var currentDate= yyyy + "-" + ( MM+1) + "-" + dd;
      return currentDate;
   }

   $('#generate').click(function(){
          $("#invreporttable").dataTable().fnDestroy();
          testoutput = 0;

          var dataTable = $('#invreporttable').DataTable({
               dom: 'Bfrtip',
               buttons: [
                   {
                       extend: 'excel',
                       exportOptions: {
                            columns: ':visible'
                        },
                       messageTop: function() {
                           if ($('#tmp_startdate').val() == "" || $('#tmp_enddate').val() == "") {
                               return 'As of ' + GetTodayDate2();
                           }
                           else {
                               return 'As of ' + $('#tmp_startdate').val() + ' to ' + $('#tmp_enddate').val();
                           }
                        },
                       title: 'Inventory Report ' + GetTodayDate2(),
                       header: true,
                       footer: true
                   },
                   {
                       extend: 'pdf',
                       exportOptions: {
                            columns: ':visible'
                        },
                       messageTop: function() {
                           if ($('#tmp_startdate').val() == "" || $('#tmp_enddate').val() == "") {
                               return 'As of ' + GetTodayDate2();
                           }
                           else {
                               return 'As of ' + $('#tmp_startdate').val() + ' to ' + $('#tmp_enddate').val();
                           }
                           },
                       title: 'Inventory Report ' + GetTodayDate2(),
                       header: true,
                       footer: true
                   }
               ],
               "order": [],
               "paging": false,
               "bInfo": false,
               "ajax": {
                   url: "<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'testgenreport')); ?>",
                   data: {
                       startdate: $('#tmp_startdate').val(),
                       enddate: $('#tmp_enddate').val(),
                       productid: $('#tmp_prodid').val()
                   },
                   type: "POST",
                   dataSrc: ""

               },
               "columns": [
                   { "data": "transactiontype"},
                   { "data": "dateissued"},
                   { "data": "timeissued" },
                   { "data": "productname"},
                   { "data": "weight"},
                   { "data": "computedweight"},

               ],
               "columnDefs": [{
                   "targets": "_all",
                   "className": "text-center",
                   "orderable": false
              },
              {
                   "targets": 4,
                   "render": function(data, type, row){
                      switch(row.transactiontype) {
                           case "Add Inventory":
                               return data;
                               break;
                           case "Sales":
                               return "-" + data;
                               break;
                       }
                   }
              },{
                    "targets": 5,
                    "visible": false
              }],
                "headerCallback": function( thead, data, start, end, display ) {
                    var api = this.api(), data;
                    $( api.column( 0 ).header() ).html("<span><h4><b>BEGINNING INVENTORY</b></h4></span>");
                    $( api.column( 4 ).header() ).html(api.column(5).data()[0]);
                    headeramnt = $( api.column( 4 ).header() ).html();
                },
                "footerCallback" : function ( row, data, start, end, display ) {
                   var api = this.api(), data;

                   // converting to interger to find total
                   var intVal = function ( i ) {
                       return typeof i === 'string' ?
                           i.replace(/[\$,]/g, '')*1 :
                           typeof i === 'number' ?
                               i : 0;
                   };
                   var index_ = 0;
                   var mount = [];
                   testoutput = testoutput + intVal(headeramnt); //Computation for including beginning header in ending inventory amount
                   var testcompute = api
                       .column( 4 )
                       .data()
                       .reduce( function (a, b) {
                           if (api.column(0).data()[index_] == "Add Inventory") {
                               testoutput = testoutput + intVal(b);
                           }
                           else if (api.column(0).data()[index_] == "Sales") {
                               testoutput = testoutput - intVal(b);
                           }
                           index_++;
                           console.log(testoutput);
                           //console.log(testoutput);
                           //api.column(0).data()[index_]
                           //return intVal(a) + intVal(b);
                   }, 0 );

                   $( api.column( 0 ).footer() ).html("<span><h4><b>ENDING INVENTORY</b></h4></span>");
                   $( api.column( 4 ).footer() ).html("<span style='text-decoration: underline double;'><h4><b>"+ testoutput +"</b></h4></span>");
               }
           });
       });

       $(document).ready(function(){
           $('#tmp_startdate').val(GetTodayDate2());
           $('#tmp_enddate').val(GetTodayDate2());

           $('.select2').select2();
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

       $('#product').on('select2:select', function(){
           $('#tmp_prodid').val(document.getElementById('productid').options[$('#product').find(':selected').index()].text);
           $('#month').attr('disabled', false);
       });

       $('#month').on('select2:select', function(){
           $('#year').attr('disabled', false);
       });

       $('#product').on('select2:open', function(){
           $('#tmp_startdate').val('');
           $('#tmp_enddate').val('');
           $('#tmp_prodid').val('ALL');

           $('#product').val('ALL');
           $('#product').trigger('change');
           $('#month').val('ALL');
           $('#month').trigger('change');
           $('#year').val('ALL');
           $('#year').trigger('change');

           $('#month').attr('disabled', true);
           $('#year').attr('disabled', true);
       });

</script>
<?php $this->end(); ?>
