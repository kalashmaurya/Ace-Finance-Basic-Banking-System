<?php
include('connection.php');
if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from customers where id=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); 

    $sql = "SELECT * from customers where id=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);

    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Negative values cannot be transferred")';
        echo '</script>';
    }
    else if($amount > $sql1['balance']) 
    { 
        echo '<script type="text/javascript">';
        echo ' alert("Insufficient Balance")'; 
        echo '</script>';
    }
    else if($amount == 0){
         echo "<script type='text/javascript'>";
         echo "alert('Oops! Zero value cannot be transferred')";
         echo "</script>";
     }
    else {
         $newbalance = $sql1['balance'] - $amount;
         $sql = "UPDATE customers set balance=$newbalance where id=$from";
         mysqli_query($conn,$sql); 
         $newbalance = $sql2['balance'] + $amount;
         $sql = "UPDATE customers set balance=$newbalance where id=$to";
         mysqli_query($conn,$sql);    
         $sender = $sql1['name'];
         $receiver = $sql2['name'];
         $sql = "INSERT INTO transaction(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
         $query=mysqli_query($conn,$sql);
        
         if($query){
            echo "<script> alert('Transaction Successful');
                  window.location='customer.php';
                  </script>";   
                }
         $newbalance= 0;
         $amount =0;
        }
    
}
?>

<?php
  $id = (isset($_GET['id']) ? $_GET['id'] : '');
  $sql = "SELECT * from `customers` WHERE id=$id";
  $result = mysqli_query($conn, $sql);
  if($result){
    while($res = mysqli_fetch_assoc($result)){
    $balance = $res['balance'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Money Transfer</title>
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
            #outside {
                padding-top: 25px;
                padding-bottom: 25px;
            }
            h1 {
                font-size: 1.5em;
                text-align: center;
            }
            form {
                margin: auto;
                width: 70%;
                padding: 1em;
                border: 3px solid navy;
                border-radius: 1em;
            }
            input, select{
                width: 50%;
                text-align:center;
                font-family: Trebuchet MS;
                font-size: 18px;
            }
            #transaction{
                background-color: whitesmoke;
                opacity: 0.75;
                font-family: Trebuchet MS;
                font-size: 25px;
            }
            fieldset { 
                border:3px solid goldenrod;
                margin: 10px;
            }
            legend {
                font-weight: 700;
                color: rgb(8,8,65);
            }
            button{
                background-color: rgb(8, 8, 65);
                padding: 5px;
                font-size: 18px;
                font-family: Trebuchet MS;
                color: white;
                border-radius: 6px;
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
        <div id="outside">
        <form id="transaction" action="transfer.php?id=<?php echo $id?>" method="POST" align="center">
        <h1>Make Money Transfer</h1>
        <fieldset>
            <legend>Transfer Details</legend>
            <label id="name-label" for="name">Transfer to:</label>
            <select name="to" class="form-control" required>
            <option value="" disabled selected>Choose</option>
            <?php
                $sid=$_GET['id'];
                $sql = "SELECT * FROM customers where id!=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option value="<?php echo $rows['id'];?>" >
                    <?php echo $rows['name'] ;?> 
                    (Balance: <?php echo $rows['balance'] ;?> )
                </option>
            <?php 
                } 
            ?>
        </select>
        <p><label>Amount:</label>
            <input type="number" name="amount" required></p>
            <button name="submit" type="submit">Transfer</button> </div>
        </form>
        </div>
    </body>
</html>