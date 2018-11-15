<div class="container-fluid">
   <br />
   <div class="col-md-12">
      <div class="box box-success">
         <div class="box-header with-border">
            <h4 class="box-title"><b>PURCHASES REPORT</b></h4>
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
                  <div class="col-md-3">
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
                        <select class="form-control select2" style="width: 200%;" id="product" disabled>
                        </select>
                        <select class="form-control" id="productid" style="display: none;">
                        </select>
                     </div>
                  </div>
                  <div class="col-md-2">
                     <label>Branch</label>
                     <div class="input-group">
                        <select class="form-control select2" style="width: 200%;" id="source" disabled>
                        </select>
                        <select class="form-control" id="sourceid" style="display: none;">
                        </select>
                     </div>
                  </div>
                  <div class="form-group col-md-2">
                     <label>Search</label>
                     <div class="input-group">
                        <input required type="text" id="searchpurch" class="form-control" placeholder=""/>
                     </div>
                  </div>
                  <div class="form-group col-md-2">
                     <label></label>
                     <div class="input-group">
                        <button type="submit" id="generate" class="btn btn-primary btn-block btn-flat">GENERATE REPORT</button>
                     </div>
                  </div>
               </div>
               <div class="col-md-12">
                  <br />
               </div>
            </div>
            <table id="invreporttable" class="table table-bordered table-hover" style="width: 100%; text-align: center;">
               <thead>
                  <tr>
                    <td style="font-weight: 1000">Date</td>
                    <td style="font-weight: 1000">Day</td>
                    <td style="font-weight: 1000">Time</td>
                    <td style="font-weight: 1000">Product Name</td>
                    <td style="font-weight: 1000; width: 100px">Weight/ Volume/ Unit</td>
                    <td style="font-weight: 1000">Unit Price</td>
                    <td style="font-weight: 1000; width: 100px">Inventory Amount</td>
                    <td style="font-weight: 1000">Supplier</td>
                  </tr>
               </thead>
               <tbody id="t_body"></tbody>
               <tfoot id="t_foot"></tfoot>
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
     'AdminLTE./plugins/select2/select2'
   ],
   ['block' => 'css']);

   $this->Html->script([
     'AdminLTE./js/ajax-scripts',
     'AdminLTE./plugins/select2/select2.full.min',
     'AdminLTE./plugins/daterangepicker/moment.min',
     'AdminLTE./plugins/daterangepicker/daterangepicker',
     'AdminLTE./plugins/bootstrap-notify/bootstrap-notify.min',
     'AdminLTE./plugins/bootstrap-validator/form-validator.min',
     'AdminLTE./plugins/money-input/accounting'

   ],
   ['block' => 'script']);
   ?>
<?php $this->start('scriptBottom'); ?>
<script>
   var day = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];

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
        var result=null;
        var tbl = "", td = "", tf = "";
        var totalweight = 0;
        var totalinventory = 0;

         $('#t_body').empty();
         $('#t_foot').empty();

         jQuery.ajax({
           url: '<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'genreportpurchases')); ?>',
           type: 'post',
           dataType: 'json',
           data: {
                 startdate: $('#tmp_startdate').val(),
                 enddate: $('#tmp_enddate').val(),
                 productid: $('#tmp_prodid').val(),
                 sourceid: $('#tmp_sourceid').val()
           },
           success:function(data)
           {
              result = data;
              if (result.length > 0) {
                for(var i = 0; i < result.length; i++) {
                    tbl += "<tr>";
                        tbl += "<td>"+ result[i].dateissued +"</td>";
                        var myDate = new Date(result[i].dateissued);
                        tbl += "<td>"+ day[myDate.getDay()] +"</td>";
                        tbl += "<td>"+ result[i].timeissued +"</td>";
                        tbl += "<td>"+ result[i].productname +"</td>";
                        tbl += "<td>"+ maskNumA(result[i].weight) +"</td>";
                        tbl += "<td>"+ maskNumA(result[i].unitprice) +"</td>";
                        tbl += "<td>"+ maskNumA(result[i].totalinventory) +"</td>";
                        tbl += "<td>"+ result[i].name +"</td>";
                    tbl += "</tr>";
                    totalweight = totalweight + unmaskNumA(result[i].weight);
                    totalinventory = totalinventory + unmaskNumA(result[i].totalinventory);
                }

                    tf += "<td><h4><b>TOTAL</h4></b></td>";
                    tf += "<td></td>";
                    tf += "<td></td>";
                    tf += "<td></td>";
                    tf += "<td><h4><b>"+ maskNumA(parseFloat(totalweight).toFixed(2)) +"</b></h4></td>";
                    tf += "<td></td>";
                    tf += "<td><h4><b>"+ maskNumA(parseFloat(totalinventory).toFixed(2)) +"</b></h4></td>";
                    tf += "<td></td>";
                    tf += "<td></td>";

                $('#t_foot').append(tf);
                $('#t_body').append(tbl);
              } else {
                tbl += "<td colspan='7'>No data available in table</td>";
                $('#t_body').append(tbl);
              }
             }
        });
   });

   $(document).ready(function(){

       $('.select2 ').select2();

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

       function populatesofi(){
       var result=null;
       jQuery.ajax({
       url: '<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'viewsofi')); ?>',
       type: 'get',
       dataType: 'json',
       success:function(data)
       {
           result = data;
           var select_source = $('#source'), option = '';
           select_source.empty();

           for(var i=0; i<result.length; i++)
           {
               if(i==0){
                   option += "<option>ALL</option>";
                   option += "<option>"+ result[i].name +"</option>";
               }
               else{
                   option += "<option>"+ result[i].name +"</option>";
               }
           }

           select_source.append(option);

           var select_sourceid = $('#sourceid'), option_ = '';
           select_sourceid.empty();

           for(var i=0; i<result.length; i++)
           {
               if(i==0){
                   option_ += "<option>ALL</option>";
                   option_ += "<option>"+ result[i].sourceid +"</option>";
               }
               else{
                   option_ += "<option>"+ result[i].sourceid +"</option>";
               }
           }
           select_sourceid.append(option_);
       }
       });
   }
       populatesofi();
       populateproduct();

   }); //End of document-ready function

       $('#product').on('select2:select', function(){
           $('#tmp_prodid').val(document.getElementById('productid').options[$('#product').find(':selected').index()].text);
           $('#source').prop('disabled', false);
       });

       $('#source').on('select2:select', function(){
           $('#tmp_sourceid').val(document.getElementById('sourceid').options[$('#source').find(':selected').index()].text);
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
           $('#tmp_sourceid').val('ALL');

           $('#product').val('ALL');
           $('#product').trigger('change');

           $('#source').val('ALL');
           $('#source').trigger('change');

           $('#inserthere').empty();
           $('#product').prop('disabled', true);
           $('#source').prop('disabled', true);
       });

        function maskNumA (value){
          return accounting.formatNumber(value, 2);
        }

        function unmaskNumA (value){
            return accounting.unformat(value);
        }

</script>
<?php $this->end(); ?>
