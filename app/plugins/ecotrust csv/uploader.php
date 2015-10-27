<?php

if($_REQUEST['position']) {
	$position=$_REQUEST['position'];
}

$con=mysqli_connect('localhost','listenbe_lang','12345','listenbe_fom');
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>
<!DOCTYPE html>
<html>
<head>	
	<title>Login</title>
	<style>
		.table-header-rotated {
  border-collapse: collapse;
  .csstransforms & td {
    width: 30px;
  }
  .no-csstransforms & th {
    padding: 5px 10px;
  }
  td {
    text-align: center;
    padding: 10px 5px;
    border: 1px solid #ccc;
  }
  .csstransforms & th.rotate {
    height: 140px;
    white-space: nowrap;
 
    > div {
      transform: 
        translate(25px, 51px)
        rotate(315deg);
      width: 30px;
    }
    > div > span {
      border-bottom: 1px solid #ccc;
      padding: 5px 10px;
    }
  }
  th.row-header {
    padding: 0 10px;
    border-bottom: 1px solid #ccc;
  }
}
		
	</style>	
</head>
	<body>
		
	</body>
</html>
<?php
if ($_FILES[csv][size] > 0) { 

print_r($_FILES);
    //get the csv file 
    $file = $_FILES[csv][tmp_name]; 
    $handle = fopen($file,"r"); 

    //loop through the csv file and insert into database 
    do { 
        if ($data[0]) {
        /*
echo "<br>";
			print_r($data);
		echo "<br>";	
*/
            if (mysqli_query($con,"INSERT INTO weeklyRatings (
						PlayerID
						, PlayerSQL
						, Position
						, RatingConditional
						, RatingConditionalColor
						, RateoMatic
						, RankoMatic
						, RankoMatic_all
						, RemainingRatedAdjusted
						, H_A
						, OPP_week
						, RatingOppC
						, RatingOppC_l5
						, RatingOppC_l5_color
						, RatingOppC_color
						, OPP_WeekPositionRank
						, OPP_WeekPositionRankLastFour
						, WeeklyRank
						, WeeklyRatingAdjusted
						, WeeklyRatingL5
						, DEF_player
						, DEF_grade
						, DEF_position
						, Opp_Week_YPC
						, Start
			) 
			VALUES 
				( 
					'".addslashes($data[0])."',
					'".addslashes($data[1])."',
					'".addslashes($data[2])."',
					'".addslashes($data[3])."', 
					'".addslashes($data[4])."', 
					'".addslashes($data[5])."', 
					'".addslashes($data[6])."', 
					'".addslashes($data[7])."', 
					'".addslashes($data[8])."', 
					'".addslashes($data[9])."', 
					'".addslashes($data[10])."', 
					'".addslashes($data[11])."', 
					'".addslashes($data[12])."', 
					'".addslashes($data[13])."', 
					'".addslashes($data[14])."', 
					'".addslashes($data[15])."', 
					'".addslashes($data[16])."', 
					'".addslashes($data[17])."', 
					'".addslashes($data[18])."', 
					'".addslashes($data[19])."', 
					'".addslashes($data[20])."',
					'".addslashes($data[21])."',
					'".addslashes($data[22])."',
					'".addslashes($data[23])."',
					'".addslashes($data[24])."'
					
				) 
			")){
				/* echo "Record Created Successfully"; */
				} else {
					echo "<p>Error: " . mysqli_error($con).'</p>';
					}
            /* echo '<hr>';  */
        } 
    } while ($data = fgetcsv($handle,1000,",","'")); 
    // 
mysqli_close($con);
    //redirect 
   /*  header('Location: upload_DB.php?success=1'); die;  */

} 

?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
<title>Import a CSV File with PHP & MySQL</title> 

<style>

table {
	
	border-collapse: collapse;
}

td {
	padding: 5px;
	text-align: center;
}

tr:not(:first-child), td {
	border: thin solid #ccc;
}

.table-header-rotated {
  border-collapse: collapse;
}
.csstransforms, td {
  min-width: 75px;
  min-width: 75px;
}

.csstransforms .table-header-rotated, th.rotate {
  height: 140px;
  white-space: nowrap;
}
.csstransforms .table-header-rotated, th.rotate > div {
  /*
-webkit-transform: translate(25px, 51px) rotate(315deg);
      -ms-transform: translate(25px, 51px) rotate(315deg);
          transform: translate(25px, 51px) rotate(315deg);
*/
          
          -webkit-transform: translate(70px, 51px) rotate(315deg);
      -ms-transform: translate(70px, 51px) rotate(315deg);
          transform: translate(70px, 51px) rotate(315deg);

          
  width: 30px;
}
.csstransforms .table-header-rotated, th.rotate > div > span {
  border-bottom: 1px solid #ccc;
  padding: 5px 10px;
}
.table-header-rotated, th.row-header {
  padding: 0 10px;
  border-bottom: 1px solid #ccc;
}
	
</style>

</head> 

<body> 

<?php if (!empty($_GET[success])) { echo "<b>Your file has been imported.</b><br><br>"; } //generic success notice ?> 

<form action="upload_DB.php" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
  Choose your file: <br /> 
  <input name="csv" type="file" id="csv" /> 
  <input type="submit" name="Submit" value="Submit" />
  <input type="submit" name="Submit" value="DeleteRecords" />
  <input type="submit" name="Submit" value="DeleteTable" />
  <input type="submit" name="Submit" value="RecreateTable" />
  
  <h3>Filter by position</h3>
  <input type="submit" name="position" value="RB" />
   <input type="submit" name="position" value="QB" />
    <input type="submit" name="position" value="WR" />
     <input type="submit" name="position" value="TE" />
</form> 



</body> 
</html> 

<?php
$con=mysqli_connect('localhost','listenbe_lang','12345','listenbe_fom');
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if($_REQUEST['Submit']=="DeleteRecords"){
	$deleterecords = "TRUNCATE TABLE weeklyRatings";
mysqli_query($con,$deleterecords);
echo "All Records have been deleted<br>";
	
}

if($_REQUEST['Submit']=="DeleteTable"){
	// Delete Table

	$delete = "DROP TABLE weeklyRatings";
	mysqli_query($con,$delete);
	
	if (mysqli_query($con,$delete)) {
	  echo "Table WeeklyRatings Deleted Successfully";
	} else {
	  echo "Error Deleting table: " . mysqli_error($con);
	}

}

if($_REQUEST['Submit']=="RecreateTable"){
	
	// Create table
$create="CREATE TABLE IF NOT EXISTS weeklyRatings(
  PlayerID INTEGER(5) NOT NULL PRIMARY KEY AUTO_INCREMENT
, PlayerSQL VARCHAR(30)
, Position VARCHAR(2)
, RatingConditional NUMERIC(6,2)
, RatingConditionalColor VARCHAR(10)
, RateoMatic INTEGER(3)
, RankoMatic INTEGER(3)
, RankoMatic_all INTEGER(3)
, RemainingRatedAdjusted NUMERIC(6,2)
, H_A VARCHAR(1)
, OPP_week VARCHAR(4)
, RatingOppC VARCHAR(5)
, RatingOppC_l5 VARCHAR(5)
, RatingOppC_l5_color VARCHAR(10)
, RatingOppC_color VARCHAR(10)
, OPP_WeekPositionRank INTEGER(2)
, OPP_WeekPositionRankLastFour INTEGER(2)
, WeeklyRank INTEGER(5)
, WeeklyRatingAdjusted NUMERIC(5,2)
, WeeklyRatingL5 NUMERIC(5,2)
, DEF_player VARCHAR(20)
, DEF_grade VARCHAR(20)
, DEF_position VARCHAR(6)
, Opp_Week_YPC VARCHAR(30)
, Start VARCHAR(30)
)";

// Execute query
if (mysqli_query($con,$create)) {
  echo "Table WeeklyRatings created successfully";
} else {
  echo "Error creating table: " . mysqli_error($con);
}

	
	
}


echo "<h3>All Records</h3><hr>";


$result = mysqli_query($con,"SELECT * FROM weeklyRatings");
if (mysqli_num_rows($result) <= 0) { 
 	echo '<h3>No position selected</h3>'; 
}else{
echo 'There are '.mysqli_num_rows($result).' Records';

		echo "<table>
				<tr>
					<th class='rotate'><div><span>PlayerID</span></div></th>
					<th class='rotate'><div><span>PlayerSQL</span></div></th>
					<th class='rotate'><div><span>Position</span></div></th>
					
					<th class='rotate'><div><span>RatingConditional</span></div></th>
					<th class='rotate'><div><span>RatingConditionalColor</span></div></th>
					<th class='rotate'><div><span>RateoMatic</span></div></th>
					<th class='rotate'><div><span>RankoMatic</span></div></th>
					<th class='rotate'><div><span>RankoMatic_all</span></div></th>
					<th class='rotate'><div><span>RemainingRatedAdjusted</span></div></th>
					<th class='rotate'><div><span>H_A</span></div></th> 
					<th class='rotate'><div><span>OPP_week</span></div></th>   
					<th class='rotate'><div><span>RatingOppC</span></div></th>
					<th class='rotate'><div><span>RatingOppC_l5</span></div></th>
					<th class='rotate'><div><span>RatingOppC_l5_color</span></div></th>
					<th class='rotate'><div><span>OPP_WeekPositionRank</span></div></th>
					<th class='rotate'><div><span>OPP_WeekPositionRankLastFour</span></div></th>
					<th class='rotate'><div><span>WeeklyRank</span></div></th>
					<th class='rotate'><div><span>WeeklyRatingAdjusted</span></div></th>
					<th class='rotate'><div><span>WeeklyRatingL5</span></div></th>
					<th class='rotate'><div><span>DEF_player</span></div></th>
					<th class='rotate'><div><span>DEF_grade</span></div></th>
					<th class='rotate'><div><span>DEF_position</span></div></th>
					<th class='rotate'><div><span>Opp_Week_YPC</span></div></th>
					<th class='rotate'><div><span>start</span></div></th>
				<tr>
				";
				
		while($row = mysqli_fetch_array($result)) {
			echo "<tr>";
			echo "<td>".$row['PlayerID']."</td>";
			echo "<td>".$row['PlayerSQL']."</td>";
			echo "<td>".$row['Position']."</td>";
			echo "<td>".$row['RatingConditional']."</td>";
			echo "<td>".$row['RatingConditionalColor']."</td>";
			echo "<td>".$row['RateoMatic']."</td>";
			echo "<td>".$row['RankoMatic']."</td>";
			echo "<td>".$row['RankoMatic_all']."</td>";
			echo "<td>".$row['RemainingRatedAdjusted']."</td>";
			echo "<td>".$row['H_A']."</td>";
			echo "<td>".$row['OPP_week']."</td>";
			echo "<td>".$row['RatingOppC']."</td>";
			echo "<td>".$row['RatingOppC_l5']."</td>";
			echo "<td>".$row['RatingOppC_l5_color']."</td>";
			echo "<td>".$row['OPP_WeekPositionRank']."</td>";
			echo "<td>".$row['OPP_WeekPositionRankLastFour']."</td>";
			echo "<td>".$row['WeeklyRank']."</td>";
			echo "<td>".$row['WeeklyRatingAdjusted']."</td>";
			echo "<td>".$row['WeeklyRatingL5']."</td>";
			echo "<td>".$row['DEF_player']."</td>";
			echo "<td>".$row['DEF_grade']."</td>";
			echo "<td>".$row['DEF_position']."</td>";
			echo "<td>".$row['Opp_Week_YPC']."</td>";
			echo "<td>".$row['Start']."</td>";
			
			echo "</tr>";
		}
		echo "</table>";
	}
