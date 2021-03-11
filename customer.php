<?php
include("connection.php");
$sql = "SELECT * from `customers`";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Customer List</title>
        <link rel="stylesheet" href="Main.css">
        <style>
          body{
              background-image: url(card.jpg);
              background-size: cover;
            }
            a:link, a:visited
              {
                background-color: rgb(8, 8, 65);
                color: white;
                text-decoration: none;
              }
            a:hover
              {
                background-color: whitesmoke;
                color: black;
              } 
              #customer {
                background-color: whitesmoke;
                opacity: 0.7;
                border-collapse: collapse; 
                width: 80%;
                margin-top: 30px;
                border: 2px solid navy; 
                font-size: 20px; 
                color: rgb(8,8,65);
                font-family: Trebuchet MS;
              }
              #customer a{
                color: rgb(8,8,65);
                font-family: Trebuchet MS;
                background-color: inherit;
              }
              #customer th, #customer td {
                text-align: center; 
                padding: 12px; 
              }
              
              #customer tr {
                border-bottom: 1px solid goldenrod;
              }
              
              #customer tr.header, #customer tr:hover {
                background-color: goldenrod;
              }
        </style>
    </head>
    <body>
        <div class="Title">Ace Finance</div>
        <div class="navigation">
              <a href="home.php">Home</a>
              <a href="customer.php" style="background-color:whitesmoke; color: black;">Customers</a>
              <a href="transaction.php">Transaction</a>
        </div>
        <table id="customer" align="center">
        <tr class="header">
          <th>Customer ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Current Balance</th>
        </tr>
        <?php
				while ($customers = mysqli_fetch_assoc($result)) {
					$cusid = $customers['id'];
					$lg1="<a href='selectcustomer.php?id=$cusid'>"; 
					echo "<tr>";
					echo "<td>"; echo $customers['id']; echo "</td>";
					echo "<td>"; echo "$lg1"; echo $customers['name']; echo "</td>";
					echo "<td>"; echo $customers['email']; echo "</td>";
					echo "<td>"; echo"₹"; echo $customers['balance']; echo "/- </td>";				
				  }
			  ?>
		  </table>
  </body>
</html>