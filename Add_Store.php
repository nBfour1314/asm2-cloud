     <!-- Bootstrap --> 
    <link rel="stylesheet" type="text/css" href="style.css"/>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
	    
	<?php
		include_once("Connection.php");
		if(isset($_POST["btnAdd"]))
		{
			$id = $_POST["txtID"];
			$name = $_POST["txtName"];
			$tel = $_POST["txtPhone"];
			$address = $_POST["txtAd"];
			$err="";

			if($id==""){
				$err.="<li>Enter store ID, please</li>";
			}
			if($name==""){
				$err.="<li>Enter store name, please</li>";
			}
			if($err!=""){
				echo"<ul>$err</ul>";
			}
			else{
				$sq = "SELECT * From public.store where Store_ID='$id' or Store_name='$name'";
				$result = pg_query($conn,$sq);
				if(pg_num_rows($result)==0)
				{
					pg_query($conn, "INSERT into public.store (Store_ID, Store_name) VALUES ('$id', '$name')");
					echo '<meta http-equiv="refresh" content ="0;URL=?page=stor"/>';
				}

				else{
					echo "<li>Duplicate store ID or Name </li>";
				}
			}
		}
	?>

<div class="container">
	<h2 align="center">Adding Store</h2>
			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
				 <div class="form-group">
						    <label for="txtID" class="col-sm-2 control-label">Store ID:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Store ID" value='<?php echo isset($_POST["txtID"])?($_POST["txtID"]):"";?>'>
							</div>
					</div>	
					<div class="form-group">
						    <label for="txtName" class="col-sm-2 control-label">Store Name:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Store Name" value='<?php echo isset($_POST["txtName"])?($_POST["txtName"]):"";?>'>
							</div>
					</div>
					<div class="form-group">
						    <label for="txtPhone" class="col-sm-2 control-label">Telephone:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtPhone" id="txtPhone" class="form-control" placeholder="Telephone" value='<?php echo isset($_POST["txtPhone"])?($_POST["txtPhone"]):"";?>'>
							</div>
					</div>
					<div class="form-group">
						    <label for="txtAd" class="col-sm-2 control-label">Address:  </label>
							<div class="col-sm-10">
							      <input type="txt" name="textAdd" id="txtAd" class="form-control" placeholder="Addess" value='<?php echo isset($_POST["txtAd"])?($_POST["txtAd"]):"";?>'>
							</div>
					</div>
                    
					<div class="form-group">
						<div align="center" class="col-md-12">
						      <input type="submit"  class="btn btn-primary" name="btnAdd" id="btnAdd" value="Add"/>
                              <input type="submit" class="btn btn-primary" name="btnCancel"  id="btnCancel" value="Cancel" onclick="window.location='?page=store_management'" />
                              	
						</div>
					</div>
				</form>
	</div>