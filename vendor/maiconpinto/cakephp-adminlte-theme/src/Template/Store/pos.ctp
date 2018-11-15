<div>
  <div style="display: inline-block;">
   <div class="form-group col-md-6">
     <label><h4>SEARCH</h4></label>
     <div class="input-group">
        <input required type="text" id="searchprod" style="width: 250%;" class="form-control" placeholder=""/>
     </div>
  </div>
</div>

<div id="inserthere" class="container-fluid"></div>
</div>
<!-- Modal -->
<div class="modal fade" id="optionmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title" id="exampleModalLabel">PRODUCTS</h3>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-xs-6">
                  <button type="button" id="openinv" class="btn btn-primary btn-block btn-flat" data-toggle="modal" data-target="#addinventory">Add Inventory</button>
               </div>
               <div class="col-xs-6">
                  <button type="button" id="opensell" class="btn btn-primary btn-block btn-flat" data-toggle="modal" data-target="#sellprod">Sell</button>
               </div>
            </div>
         </div>
         <div class="modal-footer">
         </div>
      </div>
   </div>
</div>
<!-- Modal -->
<div class="modal fade" id="sellprod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title" id="exampleModalLabel">SELL PRODUCTS</h3>
            <h4 id="productname_inv"></h4>
            <h4 id="alert" style="color: red;"></h4>
         </div>
         <div class="modal-body">
            <form action="<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'addsales')); ?>" method="post" data-toggle="validator" role="form">
               <input type="text" id="salesp_id" name="productid" required class="form-control" placeholder="" style="display: none;"> <!-- productid  -->
               <input type="text" id="saleC_INV" name="currentinv" required class="form-control" placeholder="" style="display: none;"> <!-- sales current inventory  -->
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="col-sm-5">Price</label>
                        <div class="col-sm-7">
                           <input required style="text-align: right" type="text" id="s_price" onfocusout="maskNum(this, this.value)" onfocus="unmaskNum(this, this.value)" name="price" class="form-control" placeholder="">
                           <div class="help-block with-errors errorinput"></div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-5">Weight</label>
                        <div class="col-sm-7">
                           <input required style="text-align: right" type="text" id="s_weight" onfocusout="maskNum(this, this.value)" onfocus="unmaskNum(this, this.value)" name="weight" class="form-control" placeholder="">
                           <div class="help-block with-errors errorinput"></div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-5">Amount Due</label>
                        <div class="col-sm-7">
                           <input required style="text-align: right" type="text" id="s_amountdue" onfocusout="maskNum(this, this.value)" onfocus="unmaskNum(this, this.value)" name="amountdue" class="form-control" placeholder="" readonly>
                           <div class="help-block with-errors errorinput"></div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-5">Less Discount</label>
                        <div class="col-sm-7">
                           <input required style="text-align: right" type="text" id="s_lessdiscount" onfocusout="maskNum(this, this.value)" onfocus="unmaskNum(this, this.value)" name="lessdiscount" class="form-control" placeholder="" readonly>
                           <div class="help-block with-errors errorinput"></div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-5">Net Amount Due</label>
                        <div class="col-sm-7">
                           <input required style="text-align: right" type="text" id="s_netamountdue" onfocusout="maskNum(this, this.value)" onfocus="unmaskNum(this, this.value)" name="netamountdue" class="form-control" placeholder="" readonly>
                           <div class="help-block with-errors errorinput"></div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-5">Amount Tender</label>
                        <div class="col-sm-7">
                           <input required style="text-align: right" type="text" id="s_amounttender" onfocusout="maskNum(this, this.value)" onfocus="unmaskNum(this, this.value)" name="amounttender"  class="form-control" placeholder="" readonly>
                           <div class="help-block with-errors errorinput"></div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-5">Change</label>
                        <div class="col-sm-7">
                           <input required style="text-align: right" type="text" id="s_change" onfocusout="maskNum(this, this.value)" onfocus="unmaskNum(this, this.value)" name="change" class="form-control" placeholder="" readonly>
                           <div class="help-block with-errors errorinput"></div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4"><button type="submit" class="btn btn-danger btn-block btn-flat pull-right" data-dismiss="modal">Cancel</button></div>
                  <div class="col-md-4"></div>
                  <div class="col-md-4">
                     <button type="submit" class="btn btn-primary btn-block btn-flat pull-right">Process</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- Modal -->
<div class="modal fade" id="addinventory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title" id="exampleModalLabel">ADD INVENTORY</h3>
            <h4 id="productname_sales"></h4>
         </div>
         <div class="modal-body">
            <form action="<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'addinventory')); ?>" method="post" data-toggle="validator" role="form">
               <input type="text" id="invp_id" name="productid" required class="form-control" placeholder="" style="display: none;"> <!-- productid  -->
               <input type="text" id="s_id" name="sourceid" required class="form-control" placeholder="" style="display: none;"> <!-- sourceid -->
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group row">
                        <label class="col-sm-5">Weight</label>
                        <div class="col-sm-7">
                           <input required style="text-align: right" type="text" id="wt" onfocusout="maskNum(this, this.value)" onfocus="unmaskNum(this, this.value)" name="weight" class="form-control" placeholder="">
                           <div class="help-block with-errors errorinput"></div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-5">Unit Price per Kilogram</label>
                        <div class="col-sm-7">
                           <input required style="text-align: right" type="text" id="uprice" onfocusout="maskNum(this, this.value)" onfocus="unmaskNum(this, this.value)" name="unitprice" class="form-control" placeholder="">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-5">Total Inventory</label>
                        <div class="col-sm-7">
                           <input required style="text-align: right" type="text" id="ti" onfocusout="maskNum(this, this.value)" onfocus="unmaskNum(this, this.value)" name="totalinventory" class="form-control" placeholder="" readonly>
                           <div class="help-block with-errors errorinput"></div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-5">Supplier</label>
                        <div class="col-sm-7">
                           <select type="text" id="source" name="name" required class="form-control">
                           </select>
                           <select type="text" class="sourceid_" id="sourceid" name="sofiid" required class="form-control" style="display: none;">
                           </select>
                           <div class="help-block with-errors errorinput"></div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4"><button type="submit" class="btn btn-danger btn-block btn-flat pull-right" data-dismiss="modal">Cancel</button></div>
                  <div class="col-md-4"></div>
                  <div class="col-md-4">
                     <button type="submit" class="btn btn-primary btn-block btn-flat pull-right">Process</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<?php

$this->Html->script([
  'AdminLTE./plugins/money-input/accounting',
],
['block' => 'script']);
?>

<?php $this->start('scriptBottom'); ?>
<script>

   var tmpCurrentInv = [];
   var prodID = [];
   var prodelem, sofielem, userdetails;

   var tdate = new Date();
   var dd = tdate.getDate()//yields date
   var MM = tdate.getMonth() + 1; //yields month
   var yyyy = tdate.getFullYear(); //yields year
   var currentDate = yyyy + "-" + MM + "-" + dd;

   function genproductlayout(result, data) {
      var divID = "divID";
      var btnID = "";
      var newdir = "";
      var finalnewdir = "";
      var spanIDp_id = "spanIDp_id"; //productid
      var spanIDp_up = "spanIDp_up"; //product unitprice
      var spanIDp_n = "spanIDp_n"; //product name
      var spanIDc_inv = "spanIDc_inv"; //current inventory

      for(var i = 0; i < data.length; i++)
      {
         divID = divID + result[i].productid;
         btnID  = btnID + result[i].productid;
         spanIDp_id = spanIDp_id + result[i].productid;
         spanIDp_up = spanIDp_up + result[i].productid;
         spanIDp_n = spanIDp_n + result[i].productid;
         spanIDc_inv = spanIDc_inv + result[i].productid;
         tmpCurrentInv[i] = result[i].productid;
         prodID[i] = result[i].productid;

         if(i==0 || i%4==0) {
             var tmp = divID;
             newdir = result[i].image;
             $("#inserthere").append("<br />");
             $("#inserthere").append("<div class='row text-center' style='' id='"+ divID +"'></div>");
             $("#"+ divID +"").append("<div style='height: 170px; width: 23%; margin: 5px 5px 5px 5px; display: inline-block;'><span id='"+ spanIDp_id  +"' style='display: none;'>"+ result[i].productid +"</span><span id='"+ spanIDp_up  +"' style='display: none;'>"+ result[i].unitprice +"</span><span id='"+ spanIDc_inv  +"' style='display: none;'></span><img id='"+ btnID +"' onclick='clickHandler(this)' style='height: 100%; width: 100%; border-radius:15px;' value='' data-toggle='modal' data-target='#optionmodal' src='"+ newdir.replace("home1/kgconsul/public_html/myonlinepos/webroot/","") +"' alt=''/><span style='font-size: 20px;' id='"+ spanIDp_n +"'>"+ capitalizeFirstLetter(result[i].productname) +"</span></div>");
             ///"+ newdir.replace("home1/kgconsul/public_html/myonlinepos/webroot/","") +"
             ///pos/"+ newdir.replace("C:xampphtdocsposwebroot","")
         }
         else {
             newdir = result[i].image;
             $("#"+ tmp +"").append("<div style='height: 170px; width: 23%; margin: 5px 5px 5px 5px; display: inline-block;'><span id='"+ spanIDp_id  +"' style='display: none;'>"+ result[i].productid +"</span><span id='"+ spanIDp_up  +"' style='display: none;'>"+ result[i].unitprice +"</span><span id='"+ spanIDc_inv  +"' style='display: none;'></span><img id='"+ btnID +"' onclick='clickHandler(this)' style='height: 100%; width: 100%; border-radius:15px;' value='' data-toggle='modal' data-target='#optionmodal' src='"+ newdir.replace("home1/kgconsul/public_html/myonlinepos/webroot/","") +"' alt=''/><span style='font-size: 20px;' id='"+ spanIDp_n +"'>"+ capitalizeFirstLetter(result[i].productname) +"</span></div>");
         }
      }
   }

   $('#searchprod').keyup(function(){

      jQuery.ajax({
         url: '<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'searchprods')); ?>',
         type: 'post',
         dataType: 'json',
         data: {proddata: $('#searchprod').val()},
         beforeSend: function()
         {
          $('#inserthere').empty();
         },
         success:function(data)
         {
           result = data;
           $('#inserthere').empty();
           genproductlayout(result, data);
         }
      });
   });

   $(document).ready(function(){

       renderproductelem();
       rendersofielem();

       $.when(prodelem).done(function() {
          monthlygenrecord(currentDate, MM, yyyy);
      });
   });

       //Start of important methods
       function monthlygenrecord(date, month, year)
       {
         var result = null;
         var tmpC_INV = "#spanIDc_inv";

         jQuery.ajax({
           url: '<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'checkupdate')); ?>',
           type: 'post',
           dataType: 'json',
           data: {date: date, month: month, year: year},
           success:function(data)
           {
               result = data;
               for(var i=0; i<result.length; i++)
               {
                  tmpC_INV = tmpC_INV + result[i].productid;
                     if (tmpCurrentInv[i] == result[i].productid) {
                       $(tmpC_INV).html(result[i].computedweight);
                  }
               }
           }
          });
       }

       function rendersofielem()
       {
        var result = null;
        sofielem = jQuery.ajax({
           url: '<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'viewsofi')); ?>',
           type: 'get',
           dataType: 'json',
           success:function(data)
           {
               result = data;
               $("#openinv").click(function(){
                   var select = $("#source"), options = '';
                   select.empty();
                  for(var i=0;i<result.length; i++)
                  {
                       if(i==0) {
                           options += "<option value=''>--SELECT--</option>";
                           options += "<option value=''>"+ result[i].name +"</option>";
                       }
                       else {
                           options += "<option value=''>"+ result[i].name +"</option>";
                       }
                  }
                  select.append(options);

                  var select_ = $("#sourceid"), options_ = '';
                  select_.empty();
                  for(var i=0;i<result.length; i++)
                  {
                   if(i==0) {
                           options_ += "<option>ALL</option>";
                           options_ += "<option value=''>"+ result[i].sourceid +"</option>";
                       }
                       else {
                           options_ += "<option value=''>"+ result[i].sourceid +"</option>";
                       }
                  }
                  select_.append(options_);
               });
           }
        });
       }

       function renderproductelem()
       {
        /*
        Notes:
           Table 'product', field 'image' needs to have specific datatype and process for getting the image file
         */

        prodelem = jQuery.ajax({
           url: '<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'viewproduct')); ?>',
           type: 'get',
           dataType: 'json',
           success:function(data)
           {
               result = data;
               genproductlayout(result, data);
           }
        });
       }

       function clickHandler(object){ //Function for getting productid and productinventory
          $('#invp_id').val($("#spanIDp_id" + object.id).html());
          $('#salesp_id').val($("#spanIDp_id" + object.id).html());
          $('#uprice').val($("#spanIDp_up" + object.id).html());
          $('#s_price').val($("#spanIDp_up" + object.id).html());
          $('#productname_inv').html($("#spanIDp_n" + object.id).html());
          $('#productname_sales').html($("#spanIDp_n" + object.id).html());
          $('#saleC_INV').val($("#spanIDc_inv" + object.id).html());
       }

       $('#source').click(function(){ //Function for selecting sourceid
           $('#s_id').val(document.getElementById('sourceid').options[$('#source option:selected').index()].text);
       });

       $('input').keyup(function(){
           var computedVal = unmaskNumA($('#wt').val()) * unmaskNumA($('#uprice').val());
           $('#ti').val(maskNumA(computedVal));
       });

       $('#openinv').click(function(){
           $('#wt').val('');
           $('#ti').val('');
       });

       $('#opensell').click(function(){
           resetvals();
           $('#alert').html('');
       });

       $('#s_weight').keyup(function(){
           if(($('#s_weight').val()) == ""){
               $('#s_amountdue').val('');
               $('#s_lessdiscount').attr("readonly", true);
           }
           else{
               var computedVal = unmaskNumA($('#s_price').val()) * unmaskNumA($('#s_weight').val());
               $('#s_amountdue').val(maskNumA(computedVal));
               $('#s_lessdiscount').attr("readonly", false);
           }
       });

       $('#s_lessdiscount').keyup(function(){
           if($('#s_lessdiscount').val() == "" || !$('#s_lessdiscount').val() == ""){
               var computedVal = unmaskNumA($('#s_amountdue').val()) - $('#s_lessdiscount').val();
               $('#s_netamountdue').val(maskNumA(computedVal));
               $('#s_amounttender').attr("readonly", false);
           }
       });

       var computedVal = 0;
       $('#s_amounttender').keyup(function(){
           if(($('#s_amounttender').val()) == ""){
               $('#s_change').val('');
           }
           else{
               if(unmaskNumA(Number($('#s_amounttender').val())) >= unmaskNumA(Number($('#s_netamountdue').val()))) {
                   computedVal = unmaskNumA($('#s_amounttender').val()) - unmaskNumA($('#s_netamountdue').val());
                   $('#s_change').val(maskNumA(computedVal));
               } else {
                   $('#s_change').val('');
               }
           }
       });

       $('#s_weight').keyup(function(){
          $('#alert').html('');
          if(Number($('#s_weight').val()) > Number($('#saleC_INV').val())) {
            $('#alert').html('Unavailable to sell. Inventory insufficient.');
            resetvals();
          }
       });
       //End of important methods

       //Start of misc methods
       function capitalizeFirstLetter(string) {
           return string[0].toUpperCase() + string.slice(1);
       }

        function maskNum (elem, value){
          var inputElement = elem;
          inputElement.value = accounting.formatNumber(value, 2);
        }

        function maskNumA (value){
          return accounting.formatNumber(value, 2);
        }

        function unmaskNumA (value){
            return accounting.unformat(value);
        }

        function unmaskNum (elem, value){
            var inputElement = elem;
            inputElement.value = accounting.unformat(value);
        }

        function resetvals() {
           $('#s_weight').val('');
           $('#s_amountdue').val('');
           $('#s_lessdiscount').val('');
           $('#s_netamountdue').val('');
           $('#s_amounttender').val('');
        }
       //End of misc methods

</script>
<?php $this->end(); ?>
