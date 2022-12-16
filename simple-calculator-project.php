<?php
$conn = mysqli_connect("localhost","root","","test");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
<?php
if(isset($_POST['sub']))
{
	$txt1=$_POST['n1'];
	$txt2=$_POST['n2'];
	$oprnd=$_POST['sub'];
	if($oprnd=="+")
		$res=$txt1+$txt2;
	else if($oprnd=="-")
		$res=$txt1-$txt2;
	else if($oprnd=="x")
		$res=$txt1*$txt2;
	else if($oprnd=="/")
		$res=cos($txt1);
	echo "";
	$sql = "INSERT INTO `valuescal` (`id`, `number1`, `number2`, `operator`, `result`) VALUES (NULL, '$txt1', '$txt2', '$oprnd', '$res' ) ";
	if ($conn->query($sql) === TRUE) {
    echo "Calculation successfully!!!";
    } 
	else {
    echo "Error: " . $sql . "<br>" . $conn->error;
		}
}
?>
<html>
<head>
	<style type="text/css">
		.container
		{
			left: 25%;
			
			margin: auto;
			text-align: center;
			border: 1px solid green;
			background-color: deepskyblue;
			
		}
		input, select {
  			width: 40%;
  			padding: 12px 15px;
  			margin: 10px 10;
  			display: inline-block;
  			border: 2px solid #ccc;
  			border-radius: 6px;
  			box-sizing: border-box;
		}

		input[type=submit] {
  			width: 10%;
 		 	background-color: lightseagreen;
  			color: white;
  			padding: 14px 20px;
  			margin: 8px 0;
  			border: none;
	 	 	border-radius: 4px;
  			cursor: pointer;
}
	</style>
</head>
<body>
	<div class="container">
<form method="post" action="">
<h1>Simple Calculator Create By Kaseem Ahmad</h1>
<br>
"Input Only Integer Numbers"
<br>
First Number:<input required type="number" name="n1" value="">
<br>
Second Number:<input required type="number" name="n2" value="">
<br><br>
<input type="submit" name="sub" value="+">
<input type="submit" name="sub" value="-">
<input type="submit" name="sub" value="x">
<input type="submit" name="sub" value="/">
<br><br>
Result: <input type='text' value="<?php echo @$res; ?>">
<br>
</form>
</div>
<div class="button">
<form method="post">
	<input  type="submit" name="ans" value="Last Calculation">
</form>
</div>
</body>
</html>
<?php
if(isset($_POST['ans']))
{
$sql = "SELECT * FROM valuescal";
$result = $conn->query($sql);
if(mysqli_num_rows($result) > 0){
        echo "<table style='border: 1px dashed black;'>";
            echo "<tr>";
                echo "<th>First Number:</th>";
                echo "<th>Second Number:</th>";
                echo "<th>Operator</th>";
                echo "<th>Result</th>";
            echo "</tr>";
            echo "All records found.";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['number1'] . "</td>";
                echo "<td>" . $row['number2'] . "</td>";
                echo "<td>" . $row['operator'] . "</td>";
                echo "<td>" . $row['result'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        mysqli_num_rows($result);
    } else{
        echo "No records found.";
    }
}
?>