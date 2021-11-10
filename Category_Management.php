<?php
	if(!isset($_SESSION['admin']) or $_SESSION['admin']==0){
		echo '<script>alert("You are not administrator, you can not access this function");</script>';
		echo '<meta http-equiv="Refresh" content="0;URL=index.php"/>';
	}
	else 
	{
?>

    <!-- Bootstrap --> 
    <link rel="stylesheet" type="text/css" href="style.css"/>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <script language="javascript">
        function deleteConfirm(){
            if(confirm("Are you sure to delete!")){
                return true;
            }
            else{
                return false;
            }
        }
    </script>
    <?php
        include_once("Connection.php");

        if(isset($_GET["function"])=="del"){
        if(isset($_GET["id"])){
        $id=$_GET["id"];
        pg_query($conn, "DELETE from public.category where Cate_ID='$id'");
        }
    }
    ?>

    

        <form name="frm" method="post" action="">
        <h1 align="center">Category Management</h1>
        <div class="container">
        <p>
        <img src="images/add.png" alt="Add new" width="16" height="16" border="0" /> <a href="?page=add_category"> Add</a>
        </p>
        <table id="tablecategory" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><strong>No.</strong></th>
                    <th><strong>Category Name</strong></th>
                    <th><strong>Edit</strong></th>
                    <th><strong>Delete</strong></th>
                </tr>
             </thead>

			<tbody>
                <?php
                    $No=1;
                    $result = pg_query($conn,"SELECT * FROM public.category");
                    while($row=pg_fetch_array($result, NULL, PG_ASSOC))
                    {
                ?>
                <tr>
                    <td class="cotCheckBox"><?php echo $No;?></td>
                    <td><?php echo $row["Cate_name"];?></td>
                    <td style='text-align:center'><a href="?page=update_category&&id=<?php echo $row["Cate_ID"];?>"><img src='images/edit.png' border='0'  /></a></td>
                    <td style='text-align:center'><a href="?page=catema&&function=del&&id=<?php echo $row["Cate_ID"];?>" onclick="return deleteConfirm()"><img src='images/delete.png' border='0' /></a></td>
                </tr>

                <?php
                    $No++;
                    }
                    ?>
                </tbody>
        </table>  
        </div>
        
        <!--Nút Thêm mới , xóa tất cả-->
        <div class="row" style="background-color:#FFF"><!--Nút chức nang-->
            <div class="col-md-12">
            	
            </div>
        </div><!--Nút chức nang-->
 </form>
 
<?php
    }
?>

 
 
   