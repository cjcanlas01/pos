<br />
<div class="container-fluid">
    <div class="form-group">
        <!-- <form action="<?php echo $this->Url->build(array('controller' => 'Store', 'action' => '')); ?>" method="post" role="form"> -->
        <input type="text" name="tmp_prodid" style="display: none;">
        <input type="text" name="tmp_sourceid" style="display: none;">
        <span>START DATE</span>
        <div class='input-group date' id='datetimepicker1'>
            <input type='text' class="form-control" />
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
        <span>END DATE</span>
        <div class='input-group date' id='datetimepicker2'>
            <input type='text' class="form-control" />
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
        <div>
            <span>PRODUCT</span>
            <select class="form-control" id="product">
            </select>
            <select class="form-control" id="productid" style="display: none;">
            </select>
        </div>
        <div>
            <span>BRANCH</span>
            <select class="form-control" id="source">
            </select>
            <select class="form-control" id="sourceid" style="display: none;">
            </select>
        </div>
        <br />
        <div class="">
            <button type="submit" id="generate" class="btn btn-primary btn-block btn-flat pull-right">GENERATE</button>
        </div>
        <!-- </form> -->
    </div>
</div>
<br />
<div class="container-fluid">
    <div class="form-control" style="height: 100%;">
        <div id="inserthere"></div>
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

    //function testloadcomp(){
    //
    $('#generate').click(function(){
        var result=null;
        jQuery.ajax({
        url: '<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'genreportsales')); ?>',
        type: 'get',
        dataType: 'json',
        success:function(data)
        {
            result = data;
            $('#inserthere').empty();
            $('#inserthere').append(result);
        }
        });
    });
    //}
    //

    $(document).ready(function(){
        function populateproduct(){
            var result=null;
            jQuery.ajax({
            url: '<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'viewprod')); ?>',
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
                        option += "<option> --SELECT-- </option>";
                        option += "<option>"+ result[i].name +"</option>";
                    }
                    else{
                        option += "<option>"+ result[i].name +"</option>";
                    }
                }

                select_prod.append(option);

                var select_prodid = $('#productid'), option_ = '';
                select_prodid.empty();

                for(var i=0; i<result.length; i++)
                {
                    if(i==0){
                        option_ += "<option> --SELECT-- </option>";
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

        function populatesofi(){
        var result=null;
        jQuery.ajax({
        url: '<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'sourceloader')); ?>',
        type: 'get',
        dataType: 'json',
        success:function(data)
        {
            result = data;
            var select_prod = $('#source'), option = '';
            select_prod.empty();

            for(var i=0; i<result.length; i++)
            {
                if(i==0){
                    option += "<option> --SELECT-- </option>";
                    option += "<option>"+ result[i].name +"</option>";
                }
                else{
                    option += "<option>"+ result[i].name +"</option>";
                }
            }

            select_prod.append(option);

            var select_prodid = $('#sourceid'), option_ = '';
            select_prodid.empty();

            for(var i=0; i<result.length; i++)
            {
                if(i==0){
                    option_ += "<option> --SELECT-- </option>";
                    option_ += "<option>"+ result[i].sourceid +"</option>";
                }
                else{
                    option_ += "<option>"+ result[i].sourceid +"</option>";
                }
            }
            select_prodid.append(option_);
        }
        });
    }
        populatesofi();
    });

        $('#product').click(function(){ //Function for selecting productid
            $('#tmp_prodid').val(document.getElementById('productid').options[$('#product option:selected').index()].text);
            console.log(document.getElementById('productid').options[$('#product option:selected').index()].text);
        });

        $('#source').click(function(){ //Function for selecting productid
            $('#tmp_sourceid').val(document.getElementById('sourceid').options[$('#source option:selected').index()].text);
            console.log(document.getElementById('sourceid').options[$('#source option:selected').index()].text);
        });

        /*
        $(function () {
            $('#datetimepicker1').datetimepicker();
        });
         */

        /*
        $(function () {
            $('#datetimepicker2').datetimepicker()
        });
         */

    //testloadcomp();
</script>
<?php $this->end(); ?>

