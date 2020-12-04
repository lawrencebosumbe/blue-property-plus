<link rel="stylesheet" href="public/bootstrap/css/bootstrap.css" />
<h1>Employee Sign Up</h1>

<form method="post" action="<?php echo URL; ?>employee_signup/add_employee">
	<div class="form-group">
        <div class="col-lg-4">
        	<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Firstname" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-4">
        	<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Lastname" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-4">
        	<input type="email" class="form-control" id="email" name="email" placeholder="Email" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-4">
        	<input type="password" class="form-control" id="re-password" name="re-password" placeholder="Retype Password" />
        </div>
        <div class="col-lg-4">
        	<input type="password" class="form-control" id="password" name="password" placeholder="Password" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-4">
        	<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-4">
        	<select name="role">
            	<option selected="selected">Select Role</option>
                <option>Default</option>
                <option>Admin</option>
                <option>Manager</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-4">
        	<input type="file" class="form-control" id="image" name="image" />
        </div>
    </div>
    <div class="form-group">
        <!-- male label -->
        <div class="col-lg-5">
            <div class="radio">
        		<label class="gender-radio col-lg-3 control-label">
        
              		<!-- male radio button -->
              		<input type="radio" name="gender" id="gender" value="Male" 
                    <?php if(isset($_POST['gender']) && $_POST['gender']=="Male"){ ?>
                        checked
                    <?php  } ?> 
               		/>  Male
               <!-- end male radio button -->
               
        		</label>
        		<!-- end male label -->
        	</div>
        </div>
        <!-- female label -->
        <div class="col-lg-5">
            <div class="radio">
                <label class="gender-radio col-lg-3 control-label">
                
                      <!-- female radio button -->
                      <input type="radio" name="gender" id="gender" value="Female"
                            <?php if(isset($_POST['gender']) && $_POST['gender']=="Female"){ ?>
                                checked
                            <?php  }?> 
                      /> Female
                      <!--end  female radio button -->
                      
                </label>
                <!-- end female label -->
        	</div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-9 col-lg-offset-3">
            <button type="submit" class="btn btn-primary">Sign up</button>
        </div>
   </div>
</form>