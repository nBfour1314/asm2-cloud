<link rel="stylesheet" type="text/css" href="style.css"/>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/bootstrap.min.css">

<?php
		if(isset($_POST["btnUpdate"]))
		{
			$id = $_POST["txtID"];
			$name = $_POST["txtName"];
			$telephone = $_POST["txtPhone"];
			$address = $_POST["txtAd"];
			$err = "";
			if($name=="")
			{
				$err .= "<li>Enter store Name, please</li>";
			}
			if($err!="")
			{
				echo "<ul>$err</ul>";
			}
			else
			{
				$sq="SELECT * from public.store where Store_ID != '$id' and Store_name='$name'";
				$result = pg_query($conn, $sq);
				if(pg_num_rows($result)==0)
				{
					pg_query($conn, "UPDATE public.store Set Store_name = '$name' where Store_ID='$id'");
					echo '<meta http-equiv="refresh" content="0;URL=?page=stor"/>';
				}
				else
				{
					echo "<li>Duplicate store name</li>";
				}
			}
		}
	?>
   <?php
		include_once("Connection.php");
		if(isset($_GET["id"]))
		{
			$id = $_GET["id"];
			$result = pg_query($conn, "SELECT * from public.store where Store_ID='$id'");
			$row = pg_fetch_array($result, NULL, PG_ASSOC);
			$cat_id = $row['Store_ID'];
			$cat_name = $row['Store_name'];
			$tel = $row['Telephone'];
			$ad = $row['Address'];
	?>
	
<div class="container">
	<h2 align="center">Updating Store</h2>
		<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
			<div class="form-group">
				<label for="txtID" class="col-sm-2 control-label">store ID:  </label>
				<div class="col-sm-10">
					<input type="text" name="txtID" id="txtID" class="form-control" placeholder="store ID" readonly value='<?php echo $cat_id; ?>'>
				</div>
			</div>

			<div class="form-group">
				<label for="txtName" class="col-sm-2 control-label">store Name:  </label>
				<div class="col-sm-10">
					<input type="text" name="txtName" id="txtName" class="form-control" placeholder="store Name" value='<?php echo $cat_name; ?>'>
				</div>
			</div>
			<div class="form-group">
						    <label for="txtPhone" class="col-sm-2 control-label">Telephone:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtPhone" id="txtPhone" class="form-control" placeholder="Telephone"  value='<?php echo $tel; ?>'>
							</div>
					</div>
					<div class="form-group">
						    <label for="txtAd" class="col-sm-2 control-label">Address:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtAdd" id="textAd" class="form-control" placeholder="Addess" value='<?php echo $ad; ?>'>
							</div>
					</div>
                    
			<div class="form-group">
				<div align="center" class="col-md-12">
					<input type="submit"  class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update"/>
                    <input type="submit" class="btn btn-primary" name="btnCancel"  id="btnCancel" value="Cancel" onclick="window.location='?page=stor'" />
                </div>
			</div>
		</form>
	</div>

	<?php
		}
	else
	{
		echo '<meta http-equiv="Refresh" content="0;URL=?page=stor"/>';
	}
	?>



	
      