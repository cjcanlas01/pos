<div id="inserthere" class="container-fluid"></div>

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
      </div>

      <div class="modal-body">
         <form action="<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'addsales')); ?>" method="post" data-toggle="validator" role="form">
         <input type="text" id="salesp_id" name="productid" required class="form-control" placeholder="" style="display: none;"> <!-- productid  -->
         <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-sm-5">Price</label>
                    <div class="col-sm-7">
                        <input type="text" id="s_price" name="price" required class="form-control" placeholder="">
                        <div class="help-block with-errors errorinput"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-5">Weight</label>
                    <div class="col-sm-7">
                        <input type="text" id="s_weight" name="weight" required class="form-control" placeholder="">
                        <div class="help-block with-errors errorinput"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-5">Amount Due</label>
                    <div class="col-sm-7">
                        <input type="text" id="s_amountdue" name="amountdue" required class="form-control" placeholder="" readonly>
                        <div class="help-block with-errors errorinput"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-5">Less Discount</label>
                    <div class="col-sm-7">
                        <input type="text" id="s_lessdiscount" name="lessdiscount" required class="form-control" placeholder="" readonly>
                        <div class="help-block with-errors errorinput"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-5">Net Amount Due</label>
                    <div class="col-sm-7">
                        <input type="text" id="s_netamountdue" name="netamountdue" required class="form-control" placeholder="" readonly>
                        <div class="help-block with-errors errorinput"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-5">Amount Tender</label>
                    <div class="col-sm-7">
                        <input type="text" id="s_amounttender" name="amounttender" required class="form-control" placeholder="" readonly>
                        <div class="help-block with-errors errorinput"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-5">Change</label>
                    <div class="col-sm-7">
                        <input type="text" id="s_change" name="change" required class="form-control" placeholder="" readonly>
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
                        <input type="text" id="wt" name="weight" required class="form-control" placeholder="">
                        <div class="help-block with-errors errorinput"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-5">Unit Price per Kilogram</label>
                    <div class="col-sm-7">
                        <input type="text" id="uprice" name="unitprice" required class="form-control" placeholder="">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-5">Total Inventory</label>
                    <div class="col-sm-7">
                        <input type="text" id="ti" name="totalinventory" required class="form-control" placeholder="" readonly>
                        <div class="help-block with-errors errorinput"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-5">Source of Inventory</label>
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

<?php $this->start('scriptBottom'); ?>
<script>

$(document).ready(function(){

        console.log('WORKING LINE');

        function getuserdetails(name)
        {
         var result = null;
         jQuery.ajax({
            url: '<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'userdetailsloader')); ?>',
            type: 'get',
            dataType: 'json',
            success:function(data)
            {
                result = data;
                $('#openinv').click(function(){ //Function for getting userid
                    $('#u_id').val(result);
                });
            }
         });
        }

        function rendersofielem(name)
        {
         var result = null;
         jQuery.ajax({
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
                            options_ += "<option>--SELECT--</option>";
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

        function renderproductelem(name)
        {
         /*
         Notes:
            Table 'product', field 'image' needs to have specific datatype and process for getting the image file
          */
         var result = null;
         var inc = 0;
         var divID = "divID";
         var btnID = "";
         var spanIDp_id = "spanIDp_id"; //productid
         var spanIDp_up = "spanIDp_up"; //product unitprice
         var spanIDp_n = "spanIDp_n"; //product name
         jQuery.ajax({
            url: '<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'viewproduct')); ?>',
            type: 'get',
            dataType: 'json',
            success:function(data)
            {
                result = data;
                for(var i = 0; i < data.length; i++)
                {
                    divID = divID + i;
                    btnID  = btnID + i;
                    spanIDp_id = spanIDp_id + i;
                    spanIDp_up = spanIDp_up + i;
                    spanIDp_n = spanIDp_n + i;

                    if(i==0 || i%3==0) {
                    var tmp = divID;
                    $("#inserthere").append("<br />");
                    $("#inserthere").append("<div class='row text-center' style='' id='"+ divID +"'></div>");
                    $("#"+ divID +"").append("<div class='col-md-4' style='height: 170px; margin: 0px 0px 30px 0px;'><span id='"+ spanIDp_id  +"' style='display: none;'>"+ result[i].productid +"</span><span id='"+ spanIDp_up  +"' style='display: none;'>"+ result[i].unitprice +"</span><button id='"+ btnID +"' onclick='clickHandler(this)' style='height: 100%; width: 100%;' value='' data-toggle='modal' data-target='#optionmodal'><span style='font-size: 25px;' id='"+ spanIDp_n +"'>"+ capitalizeFirstLetter(result[i].productname) +"</span></button></div>");
                    //<img src='' style='height: 100%; width: 100%;'>
                    }
                    else {
                        $("#"+ tmp +"").append("<div class='col-md-4' style='height: 170px;'><span id='"+ spanIDp_id  +"' style='display: none;'>"+ result[i].productid +"</span><span id='"+ spanIDp_up  +"' style='display: none;'>"+ result[i].unitprice +"</span><button id='"+ btnID +"' onclick='clickHandler(this)' style='height: 100%; width: 100%' value='' data-toggle='modal' data-target='#optionmodal'><span style='font-size: 25px;' id='"+ spanIDp_n +"'>"+ capitalizeFirstLetter(result[i].productname) +"</span></button></div>");
                    }
                }
            }
         });
        }

        renderproductelem('');
        rendersofielem('');
        getuserdetails('');

    });

        function clickHandler(object){ //Function for getting productid and productinventory
           $('#invp_id').val($("#spanIDp_id" + object.id).html());
           $('#salesp_id').val($("#spanIDp_id" + object.id).html());
           $('#uprice').val($("#spanIDp_up" + object.id).html()); //uprice
           $('#s_price').val($("#spanIDp_up" + object.id).html()); //s_price
           $('#productname_inv').html($("#spanIDp_n" + object.id).html()); //s_price
           $('#productname_sales').html($("#spanIDp_n" + object.id).html()); //s_price
        }

        function capitalizeFirstLetter(string) {
            return string[0].toUpperCase() + string.slice(1);
        }

        $('#source').click(function(){ //Function for selecting sourceid
            $('#s_id').val(document.getElementById('sourceid').options[$('#source option:selected').index()].text);
        });

        $('input').keyup(function(){
            var computedVal = $('#wt').val() * $('#uprice').val();
            $('#ti').val(computedVal);
        });

        $('#openinv').click(function(){
            $('#wt').val('');
            $('#ti').val('');
        });

        $('#opensell').click(function(){
            $('#s_weight').val('');
            $('#s_amountdue').val('');
            $('#s_lessdiscount').val('');
            $('#s_netamountdue').val('');
            $('#s_amounttender').val('');
        });

        $('#s_weight').keyup(function(){
            if(($('#s_weight').val()) == ""){
                $('#s_amountdue').val('');
                $('#s_lessdiscount').attr("readonly", true);
            }
            else{
                var computedVal = $('#s_price').val() * $('#s_weight').val();
                $('#s_amountdue').val(computedVal);
                $('#s_lessdiscount').attr("readonly", false);
            }
        });

        $('#s_lessdiscount').keyup(function(){
            if($('#s_lessdiscount').val() == "" || !$('#s_lessdiscount').val() == ""){
                var computedVal = $('#s_amountdue').val() - $('#s_lessdiscount').val();
                $('#s_netamountdue').val(computedVal);
                $('#s_amounttender').attr("readonly", false);
            }
        });

        var computedVal = 0;
        $('#s_amounttender').keyup(function(){
            if(($('#s_amounttender').val()) == ""){
                $('#s_change').val('');
            }
            else{
                if(Number($('#s_amounttender').val()) >= Number($('#s_netamountdue').val())) {
                    computedVal = $('#s_amounttender').val() - $('#s_netamountdue').val();
                    $('#s_change').val(computedVal);
                } else {
                    $('#s_change').val('');
                }
            }
        });

</script>
<?php $this->end(); ?>
