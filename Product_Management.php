<?php
	if(!isset($_SESSION['admin']) or $_SESSION['admin']==0){
		echo '<script>alert("You are not administrator, you can not access this function");</script>';
		echo '<meta http-equiv="Refresh" content="0;URL=index.php"/>';
	}
	else 
	{
?>

<script language="javascript">
    function deleteConfirm(){
        if(confirm("Are you sure to delete?")){
            return true;
        }
        else{
            return false;
        }
    }
</script>    
    

    <link rel="stylesheet" type="text/css" href="style.css"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <div class="container">
        <form name="frm" method="post" action="">
        <h1 align="center">Product Management</h1>
        <p>
        	<img src="images/add.png" alt="Add new" width="16" height="16" border="0" /><a href="?page=add_product"> Add</a>
        </p>
        <table id="tableproduct" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                     <th><strong>Product ID</strong></th>
                    <th><strong>Product Name</strong></th>
                    <th><strong>Price</strong></th>
                    <th><strong>Quantity</strong></th>
                    <th><strong>Caterogy ID</strong></th>
                    <th><strong>Store ID</strong></th>
                    <th><strong>Image</strong></th>
                    <th><strong>Edit</strong></th>
                    <th><strong>Delete</strong></th>
                </tr>
             </thead>

			<tbody>
            <?php
				include_once("Connection.php");

                if(isset($_GET["function"])=="del"){
                    if(isset($_GET["id"])){
                        $id = $_GET["id"];
                        $sq = "SELECT Pro_img from public.product where Pro_ID='$id'";
                        $res = pg_query($conn, $sq);
                        $row = pg_fetch_array($res, NULL, PG_ASSOC);
                        $filePic = $row['Pro_img'];
                        unlink("images/".$filePic);
                        pg_query($conn, "DELETE From public.product where Pro_ID='$id'");
                    }
                }

                $No=1;
                $result = pg_query($conn, "SELECT Pro_ID, Pro_name, Price, Qty, Pro_img, Cate_name, Store_name from public.product a, public.category b, public.store c where a.Cate_ID = b.Cate_ID, a.Store_ID = c.Store_ID");
                while($row=pg_fetch_array($result, NULL, PG_ASSOC)){
                    ?>
                			
			<tr>
              <td ><?php echo $row["Pro_ID"]; ?></td>
              <td><?php echo $row["Pro_name"]; ?></td>
              <td><?php echo $row["Price"]; ?></td>
              <td ><?php echo $row["Qty"]; ?></td>
              <td><?php echo $row["Cate_name"]; ?></td>
              <td><?php echo $row["Store_name"]; ?></td>
             <td align='center' class='cotNutChucNang'>
                 <img src='images/<?php echo $row['Pro_img'] ?>' border='0' width="50" height="50"  /></td>
             <td align='center' class='cotNutChucNang'><a href="?page=update_product&&function=del&&id=<?php echo $row["Pro_ID"];?>"><img src='images/edit.png' border='0'/></a></td>
             <td align='center' class='cotNutChucNang'><a href="?page=proma&&function=del&&id=<?php echo $row["Pro_ID"];?>" onclick="return deleteConfirm()"><img src='images/delete.png' border='0' /></a></td>
            </tr>
            <?php
               $No++;
                }
			?>
			</tbody>
        
        </table>  

 </form></div>
<?php
    }
?>