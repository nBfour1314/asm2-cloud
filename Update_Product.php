    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>

	<?php	
	if(isset($_POST["btnUpdate"]))
	{
		$id = $_POST["txtID"];
		$proname = $_POST["txtName"];
		$price = $_POST['txtPrice'];
		$qty = $_POST['txtQty'];
		$pic = $_FILES['txtImage'];
		$category = $_POST['CategoryList'];
		$store = $_POST['StoreList'];
		$err="";


		if(trim($proname)==""){
			$err .= "<li>Enter product name please</li>";
		}

		if($category=="0"){
			$err .= "<li>Choose product category please</li>";
		}

		if(!is_numeric($price)){
			$err .= "<li>Product price must be a number</li>";
		}

		if(!is_numeric($qty)){
			$err .= "<li>Product quantity must be a number</li>";
		}
		
		if($err!=""){
			echo "<ul>$err</ul>";
		}

		else
		{
			if($pic['name']!="")
			{
				if($pic['type']=="image/jpg" || $pic['type']=="image/jpeg" || $pic['type']=="image/png" || $pic['type']=="image/gif"){
					if($pic['size'] <= 6144000)
					{
						$sq = "SELECT * from public.product where Pro_ID !='$id' and Pro_name = '$proname'";
						$result = pg_query($conn, $sq);
						if(pg_num_rows($result)==0)
						{
							copy($pic['tmp_name'], "Images/".$pic['name']);
							$filePic = $pic['name'];
							$sqlstring = "UPDATE public.product set
								Pro_name = '$proname', Price=$price, Qty=$qty,
								Pro_img = '$filePic', Cate_ID='$category', Store_ID='$store' Where Pro_ID='$id'";
								pg_query($conn, $sqlstring);
								echo '<meta http-equiv ="refresh" content="0;URL=?page=proma"/>';
						}
						else{
							echo "<li>Duplicate product Name</li>";
						}
					}
					else{
						echo "Size of image too big";
					}
			}
			else
			{
				$sq = "SELECT * from public.product where Pro_ID != '$id' and Pro_name='$proname'";
				$result = pg_query($conn, $sq);
				if(pg_num_rows($result)==0)
				{
					$sqlstring="UPDATE public.product set Pro_name='$proname',
					Price=$price, Qty=$qty, Cate_ID='$category', Store_ID='$store' Where Pro_ID='$id'";
								pg_query($conn, $sqlstring);
								echo '<meta http-equiv ="refresh" content="0;URL=?page=proma"/>';
						}
						else{
							echo "<li>Duplicate product Name</li>";
						}
				}
			}
		}
	}
?>

<?php
	include_once("Connection.php");
	function bind_Category_List($conn,$selectedValue){
		$sqlstring = "SELECT Cate_ID, Cate_name from category";
		$result = pg_query($conn, $sqlstring);
		echo "<select name='CategoryList' class='form-control'>
				<option value='0'>Choose category</option>";
				while ($row = pg_fetch_array($result, NULL, PG_ASSOC)){
					if ($row['Cate_ID'] == $selectedValue){
						echo "<option value ='". $row['Cate_ID']."'selected>".$row['Cate_name']."</option>";
					}
					else{
						echo "<option value='".$row['Cate_ID']."'>".$row['Cate_name']."</option>";
					}
				}
				echo "</select>";
	}


	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sqlstring = "SELECT Pro_name, Price, Qty, Pro_img, Cate_ID from product where Pro_ID='$id'";
		$result = pg_query($conn, $sqlstring);
		$row = pg_fetch_array($result, NULL, PG_ASSOC);
		$proname = $row["Pro_name"];
		$price = $row['Price'];
		$qty = $row['Qty'];
		$pic = $row['Pro_img'];
		$category = $row['Cate_ID'];
		$store = $row['Store_ID'];
?>
<div class="container">
	<h2 align="center">Updating Product</h2>

	 	<form id="frmProduct" name="frmProduct" method="post" enctype="multipart/form-data" action="" class="form-horizontal" role="form">
				<div class="form-group">
					<label for="txtTen" class="col-sm-2 control-label">Product ID:  </label>
							<div class="col-sm-10">
								  <input type="text" name="txtID" id="txtID" class="form-control" 
								  placeholder="Product ID" readonly value='<?php echo $id; ?>'/>
							</div>
				</div> 
				<div class="form-group"> 
					<label for="txtTen" class="col-sm-2 control-label">Product Name:  </label>
							<div class="col-sm-10">
								  <input type="text" name="txtName" id="txtName" class="form-control" 
								  placeholder="Product Name" value='<?php echo $proname; ?>'/>
							</div>
                </div>   
                <div class="form-group">   
                    <label for="" class="col-sm-2 control-label">Category:  </label>
							<div class="col-sm-10">
							      <?php bind_Category_List($conn, $category); ?>
							</div>
                </div>  

				<div class="form-group">   
                    <label for="" class="col-sm-2 control-label">Store:  </label>
							<div class="col-sm-10">
							      <?php bind_Store_List($conn, $category); ?>
							</div>
                </div> 
                          
                <div class="form-group">  
                    <label for="lblGia" class="col-sm-2 control-label">Price:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtPrice" id="txtPrice" class="form-control" placeholder="Price" value='<?php echo $price; ?>'/>
							</div>
                 </div>
                            
            	<div class="form-group">  
                    <label for="lblSoLuong" class="col-sm-2 control-label">Quantity:  </label>
							<div class="col-sm-10">
							      <input type="number" name="txtQty" id="txtQty" class="form-control" placeholder="Quantity" value="<?php echo $qty; ?>"/>
							</div>
                </div>
 
				<div class="form-group">  
	                <label for="sphinhanh" class="col-sm-2 control-label">Image:  </label>
							<div class="col-sm-10">
							<img src='images/<?php echo $pic; ?>' border='0' width="50" height="50"  />
							      <input type="file" name="txtImage" id="txtImage" class="form-control" value=""/>
							</div>
                </div>
                        
				<div align="center" class="form-group">
						<div class="col-md-12">
						      <input type="submit"  class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update"/>
                              <input type="submit" class="btn btn-primary" name="btnCancel"  id="btnCancel" value="Cancel" onclick="window.location=''" />
                              	
						</div>
				</div>
			</form>
</div>

<?php
	}
	else{
		echo '<meta http-equiv="refresh" content="0;URL=?page=proma"/>';
	}	
?>