<?php
  if(!isset($_SESSION['uniqueid'])){
    header("location: ../logout.php");
}
            $uniqueid = $_SESSION['uniqueid'];
            $sql2 = mysql_query("SELECT*FROM users WHERE uniqueid!=$uniqueid ORDER BY user_id ASC") or die(mysql_error());
            while ($row2 = mysql_fetch_assoc($sql2)) {
              # code...   
         ?>
				                        

		<a class="btn uniqueid"  value="<?php echo $row2['uniqueid']; ?>">
		 <div class="content">
              <img src="images/<?php echo $row2['images'];?>" alt="">
              <div class="details">
                <span><?php echo $row2['username'];?></span>
              </div>
            </div>
        </a>
                    
<?php } ?>

					