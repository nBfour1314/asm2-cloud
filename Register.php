<meta charset="utf-8" />

<link rel="stylesheet" type="text/css" href="style.css"/>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/responsive.css">

<script src="js/jquery-3.2.0.min.js"/></script>
<script src="js/jquery.dataTables.min.js"/></script>
<script src="js/dataTables.bootstrap.min.js"/></script>

<script>
    function formValid()
    {
        f = document.form1;
        var phone = /^(\0\d{1,3}\)\d{7})|(0\d{9,10})$/;
        var email = /^[a-zA-Z]\w*(\.\w+)*\@\w+(\.\w{2,3})+$/;

        if(email.test(f.txtEmail.value)==false)
        {
            alert("Invalid Email Address!!!");
            f.txtEmail.focus();
            return false;
        }

        if(phone.test(f.txtTel.value)==false)
        {
            alert("Invalid Phone Number!!!");
            f.txtTel.focus();
            return false;
        }       
    }
</script>
 
<?php
if(isset($_POST['btnRegister']))
{
    $us = $_POST['txtUs'];
    $pass = $_POST['txtPass'];
    $conpass = $_POST['txtConpass'];
    $email = $_POST['txtEmail'];
    $address = $_POST['txtAddress'];
    $tel = $_POST['txtTel'];
    $err = "";

    if($us=="" || $pass=="" || $conpass=="" || $email=="" || $address=="")
    {
        $err .= "<li>Information do not empty</li>";
    }
    if(strlen($pass)<5)
    {
        $err .= "<li>Password must be greater than 5 chars</li>";
    }
    if($pass!=$conpass)
    {
        $err .= "<li>Confirm password do not match</li>";
    }
    if($err!= "")
    {
        echo $err;
    }
    else
    {
        include_once("Connection.php");
        $pass = md5($pass);
        $sq = "SELECT * FROM user WHERE Username='$us' OR email='$email'";
        $res = pg_query($conn,$sq);
        if(pg_num_rows($res)==0)
        {
            pg_query($conn, "INSERT INTO user (Username, Password, Email, Address, Telephone)
                                VALUES('$us', '$pass', '$email','$address', '$tel')") or die(pg_error($conn));
            echo "You have registered successfully";
        }
        else
        {
            echo "Username or email already exists";
        }
    }
}
?>


<div class="container">
        <h2 align="center">Registration</h2>
			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form" onsubmit="return formValid()">
					    <div class="form-group">
                            <label for="txtUs" class="col-sm-2 control-label">Username:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtUs" id="txtUs" class="form-control" placeholder="Username" value=""/>
							</div>
                        </div>  
                      
                       <div class="form-group">   
                            <label for="txtPass" class="col-sm-2 control-label">Password:  </label>
							<div class="col-sm-10">
							      <input type="password" name="txtPass" id="txtPass" class="form-control" placeholder="Password"/>
							</div>
                       </div>     
                       
                       <div class="form-group"> 
                            <label for="txtConpass" class="col-sm-2 control-label">Confirm Password:  </label>
							<div class="col-sm-10">
							      <input type="password" name="txtConpass" id="txtConpass" class="form-control" placeholder="Confirm Password"/>
							</div>
                       </div> 
                       
                       <div class="form-group">      
                            <label for="txtEmail" class="col-sm-2 control-label">Email:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtEmail" id="txtEmail" value="" class="form-control" placeholder="Email"/>
							</div>
                       </div>  
                       
                        <div class="form-group">   
                             <label for="textAddress" class="col-sm-2 control-label">Address:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtAddress" id="txtAddress" value="" class="form-control" placeholder="Address"/>
							</div>
                        </div>  
                        
                        <div class="form-group">  
                            <label for="txtTel" class="col-sm-2 control-label">Telephone:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtTel" id="txtTel" value="" class="form-control" placeholder="Telephone" />
							</div>
                        </div>

                        <div class="form-group">
                            <div align="center" class="col-md-12">
                                <input type="submit" class="btn btn-primary" name="btnRegister" id="btnRegister" value="Register"/> 	
                                <input type="submit" class="btn btn-primary" name="btnCancel"  id="btnCancel" value="Cancel"/>
                            </div>
                        </div>
				</form>
</div>
    

