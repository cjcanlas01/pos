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
                  <input type="text" id="tmp_prodid" name="tmp_pid" value="ALL" style="display: none;">
                  <input type="text" id="tmp_month" name="tmp_m" style="display: none;">
                  <input type="text" id="tmp_year" name="tmp_y" style="display: none;">
                  <div class="col-md-2">
                     <label>Product</label>
                     <div class="input-group">
                        <select class="form-control select2" style="width: 200%;" id="product">
                        </select>
                        <select class="form-control" id="productid" style="display: none;">
                        </select>
                     </div>
                  </div>
                  <div class="col-md-2">
                     <label>Month</label>
                     <div class="input-group">
                        <select type="text" class="form-control select2" style="width: 150%;" id="month">
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
                            <select type="text" class="form-control select2" style="width: 150%;" id="year">
                                <option>2018</option>
                            </select>
                            <!-- disabled -->
                         </div>
                     </div>
                     <div class="form-group col-md-2">
                         <label>Search</label>
                         <div class="input-group">
                            <input required type="text" id="searchsales" class="form-control" placeholder=""/>
                         </div>
                      </div>
                      <div class="col-md-4">
                         <label></label>
                         <div class="input-group">
                            <button type="submit" id="generate" class="btn btn-primary btn-block btn-flat">GENERATE REPORT</button>
                         </div>
                      </div>
                  </div>
               </div>
               <div class="col-md-12">
                  <br />
               </div>
               <div class="container-fluid">
                    <table id="invreporttable" border="2" class="table table-bordered table-hover" style="width: 100%;">
                       <thead>
                           <tr style="text-align: center;">
                              <td style="font-weight: 1000">Transaction Type</td>
                              <td style="font-weight: 1000">Date</td>
                              <td style="font-weight: 1000">Day</td>
                              <td style="font-weight: 1000">Time (HH-MM-SS)</td>
                              <td style="font-weight: 1000">Product Name</td>
                              <td style="font-weight: 1000">Weight/Volume/Unit</td>
                           </tr>
                           <tr id="t_head">
                           </tr>
                       </thead>
                       <tbody style="text-align: center;" id="t_body">
                       </tbody>
                       <tfoot>
                           <tr id="t_foot">
                           </tr>
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
     'AdminLTE./plugins/select2/select2',
     'AdminLTE./plugins/daterangepicker/daterangepicker'
   ],
   ['block' => 'css']);

   $this->Html->script([
     'AdminLTE./js/ajax-scripts',
     'AdminLTE./plugins/select2/select2.full.min',
     'AdminLTE./plugins/bootstrap-notify/bootstrap-notify.min',
     'AdminLTE./plugins/bootstrap-validator/form-validator.min',
     'AdminLTE./plugins/money-input/accounting'

   ],
   ['block' => 'script']);
   ?>
<?php $this->start('scriptBottom'); ?>
<script>
   var testoutput = 0;
   var day = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];

   function GetTodayDate2() {
      var tdate = new Date();
      var dd = tdate.getDate(); //yields day
      var MM = tdate.getMonth(); //yields month
      var yyyy = tdate.getFullYear(); //yields year
      var currentDate= yyyy + "-" + ( MM+1) + "-" + dd;
      return currentDate;
   }

   function GetCurrentYear() {
      var tdate = new Date();
      var yyyy = tdate.getFullYear(); //yields year
      return yyyy;
   }

   function GetCurrentMonth() {
      var tdate = new Date();
      var MM = tdate.getMonth(); //yields month
      return MM;
   }

    $('#generate').click(function(){
        var result=null;
        var tbl = "", td = "", tf = "";
        var prevendingamnt = 0;
        var finalendingamnt = 0;

         jQuery.ajax({
           url: '<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'getendinginventory')); ?>',
           type: 'post',
           dataType: 'json',
           data: {
               month: $('#tmp_month').val(),
               year: $('#tmp_year').val(),
               productid: $('#tmp_prodid').val()
           },
           success:function(data)
           {
                result = data;
                for(var i = 0; i < result.length; i++) {
                    prevendingamnt = prevendingamnt + parseFloat(result[i].computedweight);
                }

                $('#t_head').empty();
                $('#t_body').empty();
                $('#t_foot').empty();

                jQuery.ajax({
                   url: '<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'genreportinv')); ?>',
                   type: 'post',
                   dataType: 'json',
                   data: {
                       month: $('#tmp_month').val(),
                       year: $('#tmp_year').val(),
                       productid: $('#tmp_prodid').val()
                   },
                   success:function(data)
                   {
                        result = data;
                            td += "<td style='text-align: center'><h4><b>BEGINNING INVENTORY</b></h4></td>";
                            td += "<td style='text-align: right' colspan='5'><h4><b>"+ maskNumA(prevendingamnt) +"</b></h4></td>";
                        for(var i = 0; i < result.length; i++) {
                            tbl += "<tr>";
                                tbl += "<td>"+ result[i].transactiontype +"</td>";
                                tbl += "<td>"+ result[i].dateissued +"</td>";
                                var myDate = new Date(result[i].dateissued);
                                tbl += "<td>"+ day[myDate.getDay()] +"</td>";
                                tbl += "<td>"+ result[i].timeissued +"</td>";
                                tbl += "<td>"+ result[i].productname +"</td>";
                                if (result[i].transactiontype == "Sales") {
                                    tbl += "<td style='text-align: right;'>-"+ maskNumA(result[i].weight) +"</td>";
                                    finalendingamnt = finalendingamnt - unmaskNumA(result[i].weight);
                                } else {
                                    tbl += "<td style='text-align: right;'>"+ maskNumA(result[i].weight) +"</td>";
                                    finalendingamnt = finalendingamnt + unmaskNumA(result[i].weight);
                                }
                            tbl += "</tr>";
                        }
                            finalendingamnt = finalendingamnt + prevendingamnt;
                            tf += "<td style='text-align: center'><h4><b>ENDING INVENTORY</b></h4></td>";
                            tf += "<td style='text-align: right' colspan='5'><h4><b>"+ maskNumA(parseFloat(finalendingamnt).toFixed(2)) +"</b></h4></td>>";

                        $('#t_head').append(td);
                        $('#t_body').append(tbl);
                        $('#t_foot').append(tf);
                   }
                });
           }
        });
    });

       $(document).ready(function(){
           $('#tmp_month').val(GetCurrentMonth() + 1);
           $('#tmp_year').val(GetCurrentYear());
           $('#month').val(document.getElementById('month').options[GetCurrentMonth()].text);
           $('#month').trigger('change');

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
           //$('#month').attr('disabled', false);
       });

       $('#month').on('select2:select', function(){
           $('#tmp_month').val($('#month').find(':selected').index() + 1);
           //$('#year').attr('disabled', false);
       });

       $('#year').on('select2:select', function(){
           $('#tmp_year').val($('#year').find(':selected').index() + 1);
       });

       $('#product').on('select2:open', function(){
           $("#tmp_month").val(GetCurrentMonth() + 1);
           $('#tmp_year').val(GetCurrentYear());
           $('#tmp_prodid').val('ALL');

           $('#product').val('ALL');
           $('#product').trigger('change');
           $('#month').val(document.getElementById('month').options[GetCurrentMonth()].text);
           $('#month').trigger('change');
           $('#year').val(document.getElementById('year').options[0].text);
           $('#year').trigger('change');

           //$('#month').attr('disabled', true);
           //$('#year').attr('disabled', true);
       });

        function maskNumA (value){
          return accounting.formatNumber(value, 2);
        }

        function unmaskNumA (value){
            return accounting.unformat(value);
        }

</script>
<?php $this->end(); ?>
