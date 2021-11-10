<link rel="stylesheet" type="text/css" href="style.css"/>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/bootstrap.min.css">

<?php
		if(isset($_POST["btnUpdate"]))
		{
			$id = $_POST["txtID"];
			$name = $_POST["txtName"];
			$err = "";
			if($name=="")
			{
				$err .= "<li>Enter Category Name, please</li>";
			}
			if($err!="")
			{
				echo "<ul>$err</ul>";
			}
			else
			{
				$sq="SELECT * from category where Cate_ID != '$id' and Cate_name='$name'";
				$result = pg_query($conn, $sq);
				if(pg_num_rows($result)==0)
				{
					pg_query($conn, "UPDATE category Set Cate_name = '$name' where Cate_ID='$id'");
					echo '<meta http-equiv="refresh" content="0;URL=?page=catema"/>';
				}
				else
				{
					echo "<li>Duplicate Category name</li>";
				}
			}
		}
	?>
   <?php
		include_once("Connection.php");
		if(isset($_GET["id"]))
		{
			$id = $_GET["id"];
			$result = pg_query($conn, "SELECT * from category where Cate_ID='$id'");
			$row = pg_fetch_array($result, NULL, PG_ASSOC);
			$cat_id = $row['Cate_ID'];
			$cat_name = $row['Cate_name'];
	?>
	
<div class="container">
	<h2 align="center">Updating Product Category</h2>
		<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
			<div class="form-group">
				<label for="txtID" class="col-sm-2 control-label">Category ID:  </label>
				<div class="col-sm-10">
					<input type="text" name="txtID" id="txtID" class="form-control" placeholder="Category ID" readonly value='<?php echo $cat_id; ?>'>
				</div>
			</div>

			<div class="form-group">
				<label for="txtName" class="col-sm-2 control-label">Category Name:  </label>
				<div class="col-sm-10">
					<input type="text" name="txtName" id="txtName" class="form-control" placeholder="Category Name" value='<?php echo $cat_name; ?>'>
				</div>
			</div>
                    
			<div class="form-group">
				<div align="center" class="col-md-12">
					<input type="submit"  class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update"/>
                    <input type="submit" class="btn btn-primary" name="btnCancel"  id="btnCancel" value="Cancel" onclick="window.location='?page=catema'" />
                </div>
			</div>
		</form>
	</div>

	<?php
		}
	else
	{
		echo '<meta http-equiv="Refresh" content="0;URL=?page=catemma"/>';
	}
	?>



	
      