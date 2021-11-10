<!--<link rel="stylesheet" type="text/css" href="style.css"/>-->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/responsive.css">
<link rel="stylesheet" href="formatCSS.css">
<script src="js/jquery-3.2.0.min.js"/></script>
<script src="js/jquery.dataTables.min.js"/></script>
<script src="js/dataTables.bootstrap.min.js"/></script>

<?php
    if(isset($_POST['btnLogin']))
    {
        $us = $_POST['txtUs'];
        $pa = $_POST['txtPass'];

        $err = "";
        if($us=="")
        {
            $err .= "Enter Username please<br/>";
        }

        if($pa=="")
        {
            $err .= "Enter password please <br>";
        }

        if($err != ""){
            echo $err;
        }

        else{
            include_once("Connection.php");
            $us = pg_real_escape_string($conn, $us);
            $pass = md5($pa);
            $res = pg_query($conn, "SELECT Username, Password, state FROM user WHERE Username='$us' AND Password='$pass'") or die(pg_error($conn));
            $row = pg_fetch_array($res, NULL, PG_ASSOC);
            if(pg_num_rows($res)==1){
                $_SESSION["us"]= $us;
                $_SESSION["admin"] = $row["state"];
                echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
            }
            else{
                echo "You loged in fail";
            }
        }
    }
?>

<div class="container">
    <h1 align="center">Login</h1>
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
                    <input type="password" name="txtPass" id="txtPass" class="form-control" placeholder="Password" value=""/>
            </div>
        </div> 
        <div align="center" class="form-group"> 
            <div  class="col-md-12">
                <input type="submit" name="btnLogin"  class="btn btn-primary" id="btnLogin" value="Login"/>
                <input type="submit" name="btnCancel"  class="btn btn-primary" id="btnCancel" value="Cancel"/>
            </div>  
        </div>
    </form>
 </div>