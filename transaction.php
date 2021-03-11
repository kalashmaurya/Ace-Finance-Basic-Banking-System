<?php
include("connection.php");
$sql ="SELECT * from `transaction`";
$query =mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Transaction History</title>
      <link rel="stylesheet" href="Main.css">        
        <style>
          body{
              background-image: url(notes.jpg);
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
              <a href="customer.php">Customer</a>
              <a href="transaction.php" style="background-color:whitesmoke; color: black;">Transaction</a>
        </div>
        <table id="customer" align="center">
        <tr class="header">
          <th>Sender</th>
          <th>Receiver</th>
          <th>Amount</th>
          <th>Time Stamp</th>
        </tr>
        <?php
          while($rows = mysqli_fetch_assoc($query))
          {
        ?>
        <tr>
          <td><?php echo $rows['sender']; ?></td>
          <td><?php echo $rows['receiver']; ?></td>
          <td>₹<?php echo $rows['balance']; ?> </td>
          <td><?php echo $rows['datetime']; ?> </td>      
        <?php
          }
        ?>
        </tr>
        </table>  
    </body>
  </html>