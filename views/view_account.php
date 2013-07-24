    <div class="container padding-top">
		<div class="nice_margins">
			<div class="row-fluid">
				<div class="span1">
					<img src="/assets/images/blue-eyed.jpg" width="70" height="105" class="img-rounded">
					<br><br>
				</div>
				<div class="span11">
					<br>
					<h1>Account Info</h1>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<label class="small-text">First name: <font class="red">*</font></label>
					<input class="field" type="text" id="change_first_name" value="<?php echo $_SESSION['first_name']; ?>" size="23" required />
					<label class="small-text">Last name: <font class="red">*</font></label>
					<input class="field" type="text" id="change_last_name" value="<?php echo $_SESSION['last_name']; ?>" size="23" required />
					<label class="small-text">Email: <font class="red">*</font></label>
					<input class="field" type="email" id="change_email" value="<?php echo $_SESSION['email']; ?>"size="23" required />
					<label class="small-text">Password: <font class="red">*</font></label>
					<input class="field" type="password" id="change_password1" value="" size="23" required />
					<label class="small-text">Password (again): <font class="red">*</font></label>
					<input class="field" type="password" id="change_password2" value="" size="23" required /><br><br>
					<button class="btn btn-info" onClick="save_account_changes();">Save Changes</button> 
					<button class="btn btn-info" onclick="javascript:window.history.back(-1);return false;">Done</button><br>
					<font class="red">* required</font>
				</div>
			</div>
		</div>
    </div> 
    <br><br>