    <!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
<?php
	include_once("Connection.php");
	function bind_Category_List($conn){
		$sqlstring = "SELECT Cate_ID, Cate_name from public.category";
		$result = pg_query($conn, $sqlstring);
		echo"<select name='CategoryList' class='form-control'>
				<option value='0'>Choose category</option>";
				while ($row = pg_fetch_array($result, NULL, PG_ASSOC)){
					echo"<option value='".$row['Cate_ID']."'>".$row['Cate_name']."</option>";
				}
		echo "</select>";
	}
	function bind_Store_List($conn){
		$sqlstring = "SELECT Store_ID, Store_name from public.store";
		$result = pg_query($conn, $sqlstring);
		echo"<select name='StoreList' class='form-control'>
				<option value='0'>Choose store</option>";
				while ($row = pg_fetch_array($result, NULL, PG_ASSOC)){
					echo"<option value='".$row['Store_ID']."'>".$row['Store_name']."</option>";
				}
		echo "</select>";
	}

	if(isset($_POST["btnAdd"]))
	{
		$id = $_POST["txtID"];
		$proname = $_POST["txtName"];
		$price = $_POST['txtPrice'];
		$qty = $_POST['txtQty'];
		$pic = $_FILES['txtImage'];
		$category = $_POST['CategoryList'];
		$store = $_POST['StoreList'];
		$err="";

		if(trim($id)==""){
			$err .= "<li>Enter product ID please</li>";
		}

		if(trim($proname)==""){
			$err .= "<li>Enter product name please</li>";
		}

		if($category=="0"){
			$err .= "<li>Choose product category please</li>";
		}

		if(!is_numeric($price)){
			$err .= "<li>Product price must be a number</li>";
		}

		if($err!=""){
			echo "<ul>$err</ul>";
		}

		else{
			if($pic['type']=="image/jpg" || $pic['type']=="image/jpeg" || $pic['type']=="image/png" || $pic['type']=="image/gif"){
				if($pic['size'] <= 6144000)
				{
					$sq = "SELECT * from public.product where Pro_ID='$id' or Pro_name = '$proname'";
					$result = pg_query($conn, $sq);
					if(pg_num_rows($result)==0)
					{
						copy($pic['tmp_name'], "Images/".$pic['name']);
						$filePic = $pic['name'];
						$sqlstring = "INSERT into public.product(Pro_ID, Pro_name, Price, Qty, Pro_img, Cate_ID, Store_ID)
						Values('$id', '$proname', $price, $qty, '$filePic', '$category', '$store')";

						pg_query($conn, $sqlstring);
						echo '<meta http-equiv="refresh" content="0;URL=?page=proma"/>';
					}
					else{
						echo"<li>Duplicate product ID or Name</li>";
					}
				}

				else{
					echo "Size of image too big";
				}
			}
			else{
				echo "Image format is not correct";
			}
		}
	}



?>
<div class="container">
	<h2 align="center">Adding Product</h2>

	 	<form id="frmProduct" name="frmProduct" method="post" enctype="multipart/form-data" action="" class="form-horizontal" role="form">
				<div class="form-group">
					<label for="txtTen" class="col-sm-2 control-label">Product ID:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Product ID" value=''/>
							</div>
				</div> 

				<div class="form-group"> 
					<label for="txtName" class="col-sm-2 control-label">Product Name:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Product Name" value=''/>
							</div>
                </div>   

                <div class="form-group">   
                    <label for="" class="col-sm-2 control-label">Category:  </label>
							<div class="col-sm-10">
							      <?php bind_Category_List($conn); ?>
							</div>
                </div>
				
				<div class="form-group">   
                    <label for="" class="col-sm-2 control-label">Store:  </label>
							<div class="col-sm-10">
							      <?php bind_Store_List($conn); ?>
							</div>
                </div>  
                          
                <div class="form-group">  
                    <label for="lblGia" class="col-sm-2 control-label">Price:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtPrice" id="txtPrice" class="form-control" placeholder="Price" value=''/>
							</div>
                 </div>
                            
            	<div class="form-group">  
                    <label for="lblSoLuong" class="col-sm-2 control-label">Quantity:  </label>
							<div class="col-sm-10">
							      <input type="number" name="txtQty" id="txtQty" class="form-control" placeholder="Quantity" value=""/>
							</div>
                </div>
 
				<div class="form-group">  
	                <label for="sphinhanh" class="col-sm-2 control-label">Image:  </label>
							<div class="col-sm-10">
							      <input type="file" name="txtImage" id="txtImage" class="form-control" value=""/>
							</div>
                </div>
                        
				<div align="center" class="form-group">
						<div class="col-md-12">
						      <input type="submit"  class="btn btn-primary" name="btnAdd" id="btnAdd" value="Add new"/>
                              <input type="submit" class="btn btn-primary" name="btnCancel"  id="btnCancel" value="Cancel" />
                              	
						</div>
				</div>
			</form>
</div>
