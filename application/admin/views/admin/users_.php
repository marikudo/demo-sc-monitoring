<fieldset class="title-container">
<legend class="module-title"><i class="custom-icon-info" style="margin-top:-3px"></i><?=(strtolower($action)=='edit') ? 'Update' : $action ?> Users</legend>
	<?=showMessageSmall('<strong>Note : </strong><span class="required">*</span>  Indicates fields are required.','info')?>

	<form action="" method="POST" class="form-horizontal" id="validate-form">
				<input type="hidden" id="xusers_id" name="xusers_id" value="<?=$result['xusers_id']?>" />

	<div class="panel panel-default">
    <div class="panel-body">
			<div class="form-group">
		    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> First Name</label>
		    	<div class="col-sm-5">
	      				 <input type="text" id="first_name" name="first_name" class="col-md-4 form-control alphanumeric-n" style="float:left" value="<?=$result['first_name']?>">

		      	</div>
			</div>

			<div class="form-group">
		    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Middle Name</label>
		    	<div class="col-sm-5">
	      				 <input type="text" id="middle_name" name="middle_name"  class="col-md-4 form-control alphanumeric-n" style="float:left" value="<?=$result['middle_name']?>">

		      	</div>
			</div>

			<div class="form-group">
		    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Last Name</label>
		    	<div class="col-sm-5">
	      				<input type="text" id="last_name" name="last_name"  class="col-md-4 form-control alphanumeric-n" style="float:left" value="<?=$result['last_name']?>">

		      	</div>
			</div>

			<div class="form-group">
		    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Email</label>
		    	<div class="col-sm-5">
	      				<input type="email" id="email" name="email" class="col-md-4 form-control" style="float:left" value="<?=$result['email']?>" placeholder="e.g. email@host.com">
<span class="validation-status"></span>
		      	</div>
			</div>

			<div class="form-group">
		    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Password</label>
		    	<div class="col-sm-3">
	      			<?php

							if($action!='Edit'){

							?>
							<input type="password" id="password" name="password" class="col-md-4 form-control" style="float:left"><span class="validation-status pull-left"></span>
							<?php
							}else{
								if($user['xrole_id']<=2){
								
							?>
							<input type="button" id="reset-password" name="reset-password" value="Reset Password" class="btn btn-warning btn-small" onClick="return reset()">

							<?php
								}else{
									echo "Contact your administrator to reset password.";
								}
							}

						?>
		      	</div>
			</div>
			<div class="form-group">
		    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Select Role</label>
		    	<div class="col-sm-5">
	      			<select name="xroles_id" id="xroles_id" class="selectpicker required" style="float:left">
	      					
                            <optgroup label=""><option value="" selected>-SELECT ROLE-</option></optgroup>
                            <?php
                            	$selected = '';
								if($result['custom_role']==1){
									$selected = 'selected';
								}
							?>
                          	<optgroup label=""><option value="0" <?=$selected?>>Custom Role</option></optgroup>
 	      					<optgroup label="">
								<?php
									foreach($role as $k => $v){
									$selected = ($result['xroles_id']==$v->xroles_id) ? "selected" : null;
									?>
									 <option value="<?=$v->xroles_id?>" <?=$selected?>><?=$v->role?></option>
									<?php
									}
								?>
							</optgroup>
						  </select>
						  <span class="validation-status pull-left"></span>
		      	</div>
			</div>

	<div class="form-group custom-role-container">
		    	<label class="col-sm-3 control-label ckey"><span class="required">*</span> Select Custom Role</label>
		    	<div class="col-sm-8">
		    		<table class="table table-hover table-custom display table-xhrs role" style="font: 12px 'Arial';margin-top:10px" id="module">
						<thead>
				        <tr>
				          <th></th>
				          <th>Create<!-- <br /><input type="checkbox" name="createall" id="createall" />--></th>
				          <th>Read<!-- <br /><input type="checkbox" name="readall" id="readall" /--></th>
				          <th>Update<!-- <br /><input type="checkbox" name="updateall" id="updateall" />--></th>
				          <th>Delete<!-- <br /><input type="checkbox" name="deleteall" id="deleteall" />--></th>
				          <th>Export<!-- <br /><input type="checkbox" name="exportall" id="exportall" />--></th>
				          <th>Print<!-- <br /><input type="checkbox" name="printall" id="printall" />--></th>
				          <th>Upload<!-- <br /><input type="checkbox" name="uploadall" id="uploadall" />--></th>
				        </tr>
				      </thead>
					      <tbody>
					  	   <?php

						//print_r($role_create);

						   $ctr = 1;
							foreach($role_create as $key => $get){

								$_create = ($get->_xcreate != 1) ? 'disabled' : null;
								$_read = ($get->_xread != 1) ? 'disabled' : null;
								$_update = ($get->_xupdate != 1) ? 'disabled' : null;
								$_delete = ($get->_xdelete != 1) ? 'disabled' : null;
								$_export = ($get->_xexport != 1) ? 'disabled' : null;
								$_print = ($get->_xprint != 1) ? 'disabled' : null;
								$_upload = ($get->_upload != 1) ? 'disabled' : null;
								$_create_ = ($modules[$get->xparentmodule_id]['_xcreate'] == 1) ? 'checked' : null;
								$_read_ = ($modules[$get->xparentmodule_id]['_xread'] == 1) ? 'checked' : null;
								$_update_ = ($modules[$get->xparentmodule_id]['_xupdate'] == 1) ? 'checked' : null;
								$_delete_ = ($modules[$get->xparentmodule_id]['_xdelete'] == 1) ? 'checked' : null;
								$_export_ = ($modules[$get->xparentmodule_id]['_xexport'] == 1) ? 'checked' : null;
								$_print_ = ($modules[$get->xparentmodule_id]['_xprint'] == 1) ? 'checked' : null;
								$_upload_ = ($modules[$get->xparentmodule_id]['_upload'] == 1) ? 'checked' : null;

									
								?>
					        <tr>
					          <td><?=$get->parentmodule?></td>
					          <td>
					          	<?php
					          		if ($_create!='disabled') {
					          			?>
					          			<input type="checkbox" name="<?="_".$get->xparentmodule_id?>[_xcreate]" value="<?=$get->_xcreate?>" <?=$_create?> <?=$_create_?> />
					          			<?php
					          		}

					          	?>

					          </td>
					          <td>
					          	<?php
					          		if ($_read!='disabled') {
					          			?>
					          			<input type="checkbox" name="<?="_".$get->xparentmodule_id?>[_xread]" value="<?=$get->_xread?>" <?=$_read?> <?=$_read_?> />
					          			<?php
					          		}

					          	?>
					          	</td>
					          <td>
					          		<?php
					          		if ($_update!='disabled') {
					          			?>
					          			<input type="checkbox" name="<?="_".$get->xparentmodule_id?>[_xupdate]" value="<?=$get->_xupdate?>"<?=$_update?> <?=$_update_?> />
					          			<?php
					          		}

					          	?>

					          	</td>
					          <td>
					          	<?php
					          		if ($_delete!='disabled') {
					          			?>
					          			<input type="checkbox" name="<?="_".$get->xparentmodule_id?>[_xdelete]" value="<?=$get->_xdelete?>"<?=$_delete?> <?=$_delete_?> />
										<?php
					          		}

					          	?>

					          </td>
					          <td>
					          	<?php
					          		if ($_export!='disabled') {
					          			?>
					          			<input type="checkbox" name="<?="_".$get->xparentmodule_id?>[_xexport]" value="<?=$get->_xexport?>"<?=$_export?> <?=$_export_?> />
					          			<?php
					          		}

					          	?>
					          	</td>
					          <td>
					          		<?php
					          		if ($_print!='disabled') {
					          			?>
					          			<input type="checkbox" name="<?="_".$get->xparentmodule_id?>[_xprint]" value="<?=$get->_xprint?>"<?=$_print?> <?=$_print_?> />
					         			<?php
					          		}

					          	?>
					          	 </td>
					          <td>

					          	<?php
					          		if ($_upload!='disabled') {
					          			?>
					          				<input type="checkbox" name="<?="_".$get->xparentmodule_id?>[_upload]" value="<?=$get->_upload?>"<?=$_upload?> <?=$_upload_?> />
					          				<?php
					          		}

					          	?>
					          </td>

						   </tr>
								<?php
							}

						   ?>
					      </tbody>
		    			</table>
		    			<br class="clear clr" />
		      	</div>
			</div>

			 <div class="form-group">
			    <label class="col-sm-3 control-label ckey">Status</label>
			    <div class="col-sm-5">
			      	<label class="radio inline pull-left scaffolding-lbl">
					  <input type="radio" name="status" id="status_1" value="1" <?=($result['status']==1) ? 'checked' : null;?> >
					  Active
					</label>
					<label class="radio inline pull-left scaffolding-lbl" style="margin-left:20px">
					  <input type="radio" name="status" id="status_0" value="0"  <?=($result['status']==0) ? 'checked' : null;?>>
					 Deactive
					</label>
			      </div>
			  </div>

			  


	
	    </div> 
    <div class="panel-footer clearfix">
        <div class="form-actions">
				<?=submit($action);?>
				</div>
    </div>

</div>
</form>
</fieldset>

<script type="text/javascript">
$(document).ready(function(){
	$('.number').numeric();
	$('.alphanumeric-n').alpha({allow:". "});
	$('.alphanumeric').alphanumeric({allow:"., -"});
	$('.alphanumeric-d').alphanumeric({allow:"-"});
	var validator = $("#validate-form").validate({
		ignore: [],
		rules: {
			first_name:{
				required:true
			},middle_name:{
				required:true
			},last_name:{
				required:true,
			},password:{
				required:true,
				minlength: 6
			},mobile_number:{
				required:true,
				maxlength: 9,
				minlength: 9
			},role_id:{

				required:true
			},email:{
				required:true,
				email:true,
				 remote: "<?=base_url('xhrs/api/doesexists/')?><?=strtolower($action)?>/?current=<?=htmlentities($result['email'])?>&gConf=<?=$hashConfig?>"
			}

		},messages:{
			 email:{
		        remote: $.format("<strong>{0}</strong> is already exists.")
		      },
		      role_id:{
		        required: "This field is required."
		      }

		},

		errorPlacement: function(error, element) {
			if ( element.is(":radio") )
				error.appendTo( element.parent().next().next() );
			else if ( element.is(":checkbox") )
				error.appendTo ( element.next() );
			else
				error.appendTo( element.parent().find('span.validation-status') );
		},
		success: "valid",
		submitHandler: function(form){
			$('button[type=submit]').attr('disabled', 'true');
			$(this).bind("keypress", function(e) { if (e.keyCode == 13) return false; });
				var formx = new FormData($(form)[0]);
			          $.ajax({
							url: $(form).attr('action'),
							type: 'POST',
							dataType:'json',
							xhr: function() {
							 myXhr = $.ajaxSettings.xhr();
					                if(myXhr.upload){ // check if upload property exists
					                    //myXhr.upload.addEventListener('progress',progressHandlingFunction, false); // for handling the progress of the upload
					                }
					                return myXhr;
							
							},
							//add beforesend handler to validate or something
							beforeSend: function(){

							},
							success: function (res) {
								if(res.result=='true'){
								 window.location = '<?=base_url()?>xhrs/users';
								}
								//
							},
							//add error handler for when a error occurs if you want!
							//error: errorfunction,
							data: formx,
							// this is the important stuf you need to overide the usual post behavior
							cache: false,
							contentType: false,
							processData: false
						});
			
			//form.submit(form);
			 document.forms["validate-form"].reset();
		}
	});

	$('#reset-password').click(function(){
		//$("#validate-form").submit();
	});

	$('#xroles_id').on('change',function(){
		var thisval = $(this).val();
			if(thisval==null || thisval==""){
				$('.main').css({'overflow-y':'hidden'});
				$('.custom-role-container').css({'height':'0px'});
			}else if(thisval==0) {
				$('.custom-role-container').css({'height':'auto'});
				$('.main').css({'overflow-y':'scroll'});
			}else{
				$('.main').css({'overflow-y':'hidden'});
				$('.custom-role-container').css({'height':'0px'});
			}
			
	})
	<?php
	if($result['custom_role']!=1){
	?>
	$('.custom-role-container').css({'height':'0px'});
	<?php
	}
	?>
	

});

</script>

<style type="text/css">
	select#reference_id{width: 180px!important}
	input.error,select.error{border: 1px solid red!important}
	.btn-group.bootstrap-select{margin-left: 0px!important;float: left;}
	.custom-role-container{
		overflow: hidden;
	}

</style>