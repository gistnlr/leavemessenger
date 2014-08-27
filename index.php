<style type="text/css">
	.TFtable{
		width:40%; 
		border-collapse:collapse; 
	}
	.TFtable td{ 
		padding:7px; border:#4e95f4 1px solid;
	}
	/* provide some minimal visual accomodation for IE8 and below */
	.TFtable tr{
		background: #b8d1f3;
	}
	/*  Define the background color for all the ODD background rows  */
	.TFtable tr:nth-child(odd){ 
		background: #b8d1f3;
	}
	/*  Define the background color for all the EVEN background rows  */
	.TFtable tr:nth-child(even){
		background: #dae5f4;
	}
</style>
<?php
$con=mysqli_connect("localhost","thesunte","tst123","thesunte_lm");
// Check connection

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$ID=$_GET['id'];




$result=mysqli_query($con,"select trim(staff_design) staff_design from staff where staff_id='$ID'");
$row1 = mysqli_fetch_array($result);
if($row1['staff_design']=='EO')
{
$result1=mysqli_query($con,"select studentleaveform.*,stu_dep,stu_year,stu_sec from studentleaveform,student where studentleaveform.stu_id=student.stu_id and leave_status='Approved by Principal'");
}
if (!$result1) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}


if (!$result1) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
echo "<table class=\"TFtable\">
<tr style=\"font-size:9px\">
<tr style=\"font-size:9px;width=30%\">
<th>ID</th>
<th>Reason</th>
<th>Days</th>
<th>From Date</th>
<th>To Date</th>
<th>InCharge</th>
<th>Status</th>
<th>Branch</th>
<th>Year</th>
<th>section</th>


</tr>";
//echo $result;
while($row = mysqli_fetch_array($result1)) {
if($row['leave_status']=='apply')
 $rowcolor="Blue";
 else if ($row['leave_status']=='Rejected')
 $rowcolor="Red";
 else if ($row['leave_status']=='Approved')
 $rowcolor="green";
 
  echo "<tr color style=\"font-size:9px;width=30%\">";
  echo "<td>" . $row['stu_id'] . "</td>";
  echo "<td>" . $row['stu_leavereason'] . "</td>";
  echo "<td>" . $row['stu_numofdays'] . "</td>";
  echo "<td style=white-space: nowrap>" . $row['stu_leaveondate'] . "</td>";
  echo "<td style=white-space: nowrap>" . $row['stu_returndate'] . "</td>";
  echo "<td>" . $row['stu_classincharge'] . "</td>";
  echo "<td>" . $row['leave_status'] . "</td>";
  echo "<td>" . $row['stu_dep']. "</td>";
  echo "<td>" . $row['stu_year']. "</td>";
  echo "<td>" . $row['stu_sec']. "</td>";
  
  
  echo "</tr>";
  
}

echo "</table>";


mysqli_close($con);

?>
