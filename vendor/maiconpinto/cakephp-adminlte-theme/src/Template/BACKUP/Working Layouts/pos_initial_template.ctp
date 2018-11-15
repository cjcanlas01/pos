<div class="container-fluid">
    <div class="row text-center">
        <div class="col-md-4" style="border: 2px solid rgb(60, 141, 188); height: 170px;">
            <button style="height: 100%; width: 100%" data-toggle="modal" data-target="#exampleModal"><img src="beef.png" style="height: 100%; width: 100%"></button>
        </div>
        <div class="col-md-4" style="border: 2px solid rgb(60, 141, 188); height: 170px;">
            <button style="height: 100%; width: 100%" data-toggle="modal" data-target="#exampleModal"><img src="beef.png" style="height: 100%; width: 100%"></button>
        </div>
        <div class="col-md-4" style="border: 2px solid rgb(60, 141, 188); height: 170px;">
            <button style="height: 100%; width: 100%" data-toggle="modal" data-target="#exampleModal"><img src="beef.png" style="height: 100%; width: 100%"></button>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-md-4" style="border: 2px solid rgb(60, 141, 188); height: 170px;">
            <button style="height: 100%; width: 100%" data-toggle="modal" data-target="#exampleModal"><img src="pork.png" style="height: 100%; width: 100%"></button>
        </div>
        <div class="col-md-4" style="border: 2px solid rgb(60, 141, 188); height: 170px;">
            <button style="height: 100%; width: 100%" data-toggle="modal" data-target="#exampleModal"><img src="pork.png" style="height: 100%; width: 100%"></button>
        </div>
        <div class="col-md-4" style="border: 2px solid rgb(60, 141, 188); height: 170px;">
           <button style="height: 100%; width: 100%" data-toggle="modal" data-target="#exampleModal"><img src="pork.png" style="height: 100%; width: 100%"></button>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-md-4" style="border: 2px solid rgb(60, 141, 188); height: 170px;">
            <button style="height: 100%; width: 100%" data-toggle="modal" data-target="#exampleModal"><img src="chicken.png" style="height: 100%; width: 100%"></button>
        </div>
        <div class="col-md-4" style="border: 2px solid rgb(60, 141, 188); height: 170px;">
            <button style="height: 100%; width: 100%" data-toggle="modal" data-target="#exampleModal"><img src="chicken.png" style="height: 100%; width: 100%"></button>
        </div>
        <div class="col-md-4" style="border: 2px solid rgb(60, 141, 188); height: 170px;">
            <button style="height: 100%; width: 100%" data-toggle="modal" data-target="#exampleModal"><img src="chicken.png" style="height: 100%; width: 100%"></button>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="exampleModalLabel">PRODUCTS</h3>
      </div>

      <div class="modal-body">
        <div class="row">
            <div class="col-xs-6">
                <button type="button" class="btn btn-primary btn-block btn-flat">Add Inventory</button>
            </div>
            <div class="col-xs-6">
                <button type="button" class="btn btn-primary btn-block btn-flat" data-toggle="modal" data-target="#exampleModal2">Sell</button>
            </div>
        </div>
      </div>

      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="exampleModalLabel">PRODUCTS</h3>
      </div>

      <div class="modal-body">
         <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-sm-5">Price</label>
                    <div class="col-sm-7">
                        <input type="text" id="" name="price" required class="form-control" placeholder="500">
                        <div class="help-block with-errors errorinput"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-5">Weight</label>
                    <div class="col-sm-7">
                        <input type="text" id="" name="weight" required class="form-control" placeholder="1.5">
                        <div class="help-block with-errors errorinput"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-5">Amount Due</label>
                    <div class="col-sm-7">
                        <input type="text" id="" name="amountdue" required class="form-control" placeholder="500">
                        <div class="help-block with-errors errorinput"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-5">Amount Tender</label>
                    <div class="col-sm-7">
                        <input type="text" id="" name="amounttender" required class="form-control" placeholder="1000">
                        <div class="help-block with-errors errorinput"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-5">Change</label>
                    <div class="col-sm-7">
                        <input type="text" id="" name="change" required class="form-control" placeholder="500">
                        <div class="help-block with-errors errorinput"></div>
                    </div>
                </div>
            </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-block btn-flat">Process</button>
      </div>
    </div>
  </div>
</div>
