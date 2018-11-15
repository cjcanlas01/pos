<section class="content-header">
   <h1> USERS </h1>
   <ol class="breadcrumb">
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row">
      <div class="col-md-5">
         <div class="box box-primary">
            <div class="box-header with-border">
               <h3 class="box-title">Add Users</h3>
               <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
               </div>
            </div>
            <div class="box-body">
               <form action="<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'adduser')); ?>" method="post" data-toggle="validator" role="form">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group row">
                           <label class="col-sm-5">Username</label>
                           <div class="col-sm-7">
                              <input type="text" name="username" required class="form-control" placeholder="User123">
                              <div class="help-block with-errors errorinput"></div>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-5">Password</label>
                           <div class="col-sm-7">
                              <input type="password" id="password" name="password" required class="form-control" placeholder="********" >
                              <div class="help-block with-errors errorinput"></div>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-5">Re-Type Password</label>
                           <div class="col-sm-7">
                              <input type="password" name="re-type" required class="form-control" placeholder="********" data-match-error="Password do not match" data-match="#password">
                              <div class="help-block with-errors errorinput"></div>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-5">Last Name</label>
                           <div class="col-sm-7">
                              <input type="text" name="lastname" required class="form-control" placeholder="Dela Cruz">
                              <div class="help-block with-errors errorinput"></div>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-5">First Name</label>
                           <div class="col-sm-7">
                              <input type="text" name="firstname" required class="form-control" placeholder="Juan">
                              <div class="help-block with-errors errorinput"></div>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-5">Middle Name</label>
                           <div class="col-sm-7">
                              <input type="text" name="middlename" required class="form-control" placeholder="Lazaro">
                              <div class="help-block with-errors errorinput"></div>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-5">Role</label>
                           <div class="col-sm-7">
                              <select type="text" name="role" required class="form-control">
                                 <option selected disabled value=""> -- Select -- </option>
                                 <option> Store </option>
                                 <option> Admin </option>
                              </select>
                              <div class="help-block with-errors errorinput"></div>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-5">Position</label>
                           <div class="col-sm-7">
                              <input type="text" name="position" required class="form-control" placeholder="">
                              <div class="help-block with-errors errorinput"></div>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-5">Branch</label>
                           <div class="col-sm-7">
                              <input type="text" name="branch" required class="form-control" placeholder="">
                              <div class="help-block with-errors errorinput"></div>
                           </div>
                        </div>
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
         <!-- Modal -->
         <div class="modal fade" id="edituser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                     <h3 class="modal-title" id="exampleModalLabel">EDIT USER</h3>
                  </div>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-12">
                           <form action="<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'updateuser')); ?>" method="post" data-toggle="validator" role="form">
                              <input type="text" id="editid" name="id" required class="form-control" placeholder="0" style="display: none;">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group row">
                                       <label class="col-sm-5">Username</label>
                                       <div class="col-sm-7">
                                          <input type="text" id="editusern" name="username" required class="form-control" placeholder="example123">
                                          <div class="help-block with-errors errorinput"></div>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-5">Password</label>
                                       <div class="col-sm-7">
                                          <input type="password" id="editpass" name="password" required class="form-control" placeholder="********" >
                                          <div class="help-block with-errors errorinput"></div>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-5">Re-Type Password</label>
                                       <div class="col-sm-7">
                                          <input type="password" id="editrepass" name="re-type" required class="form-control" placeholder="********" data-match-error="Password do not match" data-match="#editpass">
                                          <div class="help-block with-errors errorinput"></div>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-5">Last Name</label>
                                       <div class="col-sm-7">
                                          <input type="text" id="editln" name="lastname" required class="form-control" placeholder="Dela Cruz">
                                          <div class="help-block with-errors errorinput"></div>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-5">First Name</label>
                                       <div class="col-sm-7">
                                          <input type="text" id="editfn" name="firstname" required class="form-control" placeholder="Juan">
                                          <div class="help-block with-errors errorinput"></div>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-5">Middle Name</label>
                                       <div class="col-sm-7">
                                          <input type="text" id="editmn" name="middlename" required class="form-control" placeholder="Lazaro">
                                          <div class="help-block with-errors errorinput"></div>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-5">Role</label>
                                       <div class="col-sm-7">
                                          <select type="text" id="editrole" name="role" required class="form-control" disabled>
                                             <option selected disabled value=""> -- Select -- </option>
                                             <option> Store </option>
                                             <option> Admin </option>
                                          </select>
                                          <div class="help-block with-errors errorinput"></div>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-5">Position</label>
                                       <div class="col-sm-7">
                                          <input type="text" id="editpos" name="position" required class="form-control" placeholder="">
                                          <div class="help-block with-errors errorinput"></div>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-5">Branch</label>
                                       <div class="col-sm-7">
                                          <input type="text" id="editbranch" name="branch" required class="form-control" placeholder="">
                                          <div class="help-block with-errors errorinput"></div>
                                       </div>
                                    </div>
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
      </div>
      <div class="col-md-7">
         <div class="box box-success">
            <div class="box-header with-border">
               <h3 class="box-title">Users List</h3>
               <div class="box-tools pull-right">
               </div>
            </div>
            <div class="box-body">
               <table id="userstable" class="table table-bordered table-hover" style="width: 100%">
                  <thead>
                     <tr>
                        <td style="width: 150px; font-weight: 1000">ID</td>
                        <!-- 0 -->
                        <td style="width: 150px; font-weight: 1000">Username</td>
                        <td style="width: 150px; font-weight: 1000">Password</td>
                        <!-- 2 -->
                        <td style="width: 150px; font-weight: 1000">Name</td>
                        <td style="width: 150px; font-weight: 1000">Position</td>
                        <td style="width: 150px; font-weight: 1000">Role</td>
                        <!-- 5 -->
                        <td style="width: 150px; font-weight: 1000">Branch</td>
                        <td style="width: 150px; font-weight: 1000">Action</td>
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
   $(document).ready(function(){

       //Start of important methods
       var dataTable = $('#userstable').DataTable({
           "ajax": {
               url: "<?php echo $this->Url->build(array('controller' => 'Store', 'action' => 'viewuser')); ?>",
               dataSrc: ""
           },
           "columns": [
               {"data": "id"},
               {"data": "username"},
               {"data": "password"},
               {"render":function(data, type, full, meta){
                   return full.lastname + ", " + full.firstname + " " + full.middlename;}},
               {"data": "role"},
               {"data": "position"},
               {"data": "branch"},
           ],
           "columnDefs": [{
               "targets": 7,
               "data": null,
               "defaultContent": "<div style='text-align: center'><button data-toggle='modal' data-target='#edituser' id='edit' class='btn btn-primary btn-sm' style='margin: 0px; padding: 0px 5px 0px 5px;'><i class='fa fa-pencil'></i></button>&nbsp;&nbsp;<button class='btn btn-danger btn-sm' style='margin: 0px; padding: 0px 5px 0px 5px;'><i class='fa fa-times'></i></button></div>"
           },
           {
               "targets": 0,
               "visible": false,
           },
           {
               "targets": 2,
               "visible": false,
           },
           {
               "targets": 5,
               "visible": false,
           }]
       });

       $('#userstable tbody').on( 'click', '#edit', function () {
           var data = dataTable.row( $(this).parents('tr') ).data();
           $('#editid').val(data['id']);
           $('#editusern').val(data['username']);
           $('#editpass').val(data['password']);
           $('#editrepass').val(data['password']);
           $('#editln').val(data['lastname']);
           $('#editfn').val(data['firstname']);
           $('#editmn').val(data['middlename']);
           $('#editrole').val(capitalizeFirstLetter(data['role']));
           $('#editpos').val(data['position']);
           $('#editbranch').val(data['branch']);
       });

       //Start of misc methods
       function capitalizeFirstLetter(string) {
           return string[0].toUpperCase() + string.slice(1);
       }

   });
</script>
<?php $this->end(); ?>
