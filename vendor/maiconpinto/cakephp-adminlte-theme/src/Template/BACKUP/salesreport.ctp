<div class="container-fluid">
<br />
        <input type="text" id="tmp_prodid" name="p_id" style="display: none;">
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
                <select class="form-control select2" style="width: 150px;" id="product" readonly>
                </select>
                <select class="form-control" id="productid" style="display: none;">
                </select>
            </div>

        </div>

        <div class="form-group col-md-6">
            <label></label>

            <div class="input-group">
              <button type="submit" id="generate" class="btn btn-primary btn-block">GENERATE REPORT</button>
            </div>
        </div>

</div>

<div class="container-fluid">
    <div class="col-md-12">
        <h3><b>SALES REPORT</b></h3>
        <div class="form-control" style="height: 100%">
            <div id="inserthere">
            </div>
        </div>
    </div>
</div>


<?php
$this->Html->css([
  'AdminLTE./plugins/daterangepicker/daterangepicker',
  'AdminLTE./plugins/select2/select2'
],
['block' => 'css']);

$this->Html->script([
  'AdminLTE./js/ajax-scripts',
  'AdminLTE./plugins/datepicker/bootstrap-datepicker',
  'AdminLTE./plugins/daterangepicker/moment.min',
  'AdminLTE./plugins/daterangepicker/daterangepicker',
  'AdminLTE./plugins/select2/select2.full.min',
  'AdminLTE./plugins/bootstrap-notify/bootstrap-notify.min',
  'AdminLTE./plugins/bootstrap-validator/form-validator.min'
],
['block' => 'script']);
?>

<?php $this->start('scriptBottom'); ?>
<script>

    $('#generate').click(function(){
        var result=null;
        jQuery.ajax({
        url: '<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'genreportsales')); ?>',
        type: 'post',
        data: {
            startdate: $('#tmp_startdate').val(),
            enddate: $('#tmp_enddate').val(),
            productid: $('#tmp_prodid').val(),
        },
        success:function(data)
        {
            result = data;
            $('#inserthere').empty();
            $('#inserthere').append(result);
        }
        });
    });

    $(document).ready(function(){

        $('.select2').select2({
            theme: "classic",
            disabled: true
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

    });

        $('#product').on('select2:select', function(){
            //console.log($('#product').find(':selected').index()); Retrieving index
            //$('#tmp_prodid').val(document.getElementById('productid').options[$('#product option:selected').index()].text); //Getting value of other select element using index of other select element
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
                //console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });

        $('#daterange').click(function(){
            $('#tmp_startdate').val('');
            $('#tmp_enddate').val('');
            $('#tmp_prodid').val('');

            $('#product').val('ALL');
            $('#product').trigger('change');

            $('#inserthere').empty();
            $('#product').prop('disabled', true);
        });

        /*$('#startdatepicker').datepicker().on("changeDate", function() { Datepicker function
           console.log($('#startdatepicker').datepicker({ dateFormat: 'yyyy,MM,dd' }).val());
           $('#tmp_startdate').val($('#startdatepicker').datepicker({ dateFormat: 'yyyy,MM,dd' }).val());
           $('#enddatediv').css('display', '');
           $('#enddatedisp').css('display', '');
        });*/

</script>
<?php $this->end(); ?>

