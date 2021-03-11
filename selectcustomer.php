<?php
include('connection.php');
$sql = "SELECT * FROM `customers` WHERE 1";
$result = mysqli_query($conn, $sql);
$id = (isset($_GET['id']) ? $_GET['id'] : ''); 
$sql = "SELECT * from `customers` WHERE id = $id";
$result = mysqli_query($conn, $sql);
 if($result){
  while($res = mysqli_fetch_assoc($result)){
    $name = $res['name'];
    $email = $res['email'];
    $balance = $res['balance'];
  }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View Customer</title>
        <link rel="stylesheet" href="Main.css">
        <style>
          body{
              background-image: url(coins.jpg);
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
            form{
                background-color: whitesmoke;
                color: rgb(8,8,65);
                font-family: Trebuchet MS;
                font-size: 25px;
                width: 60%;
                margin-top:30px;
                border: 2px solid navy;
                margin-left: 20%;
                opacity:0.75;
                border-radius:2em;
            }
            input{
                width: 50%;
                text-align:center;
                font-family: Trebuchet MS;
                font-size: 18px;
            }
            .button a{
                background-color: goldenrod;
                padding: 5px;
                color: rgb(8,8,65);
                border-radius:6px;
            }
        </style>
    </head>
    <body>
        <div class="Title">Ace Finance</div>
        <div class="navigation">
              <a href="home.php">Home</a>
              <a href="customer.php">Customer</a>
              <a href="transaction.php">Transaction</a>
        </div>
        <form method="POST" action="selectcustomer.php?id=<?php echo $id?>" align="center">
            <h2 class="title">Customer Profile</h2>
                <p>Name</p>
                <input type="text" name="name" value="<?php echo $name;?>" readonly >              
                <p>Email</p>
                <input type="email"  name="email" value="<?php echo $email;?>" readonly>
                <p>Balance</p>
                <input type="text"  name="balance" value="₹<?php echo $balance;?>" readonly>
            <input type="hidden" name="id" id="textField" value="<?php echo $id;?>" required="required"><br>
            <p>
            <div class="button">
            <a href ="transfer.php?id=<?php echo $id?>";>Transfer Money</a><br><br>
            <a href="customer.php">Go Back</a>
            </div>
            </p>
        </form>          
    </body>
</html>
