<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<style>
    body {
        background-color: rgb(236, 236, 236);
    }

#ddprty {
    font-family: Arial, sans-serif;
    color: white;
}

.fg {
    max-width: 800px;
      margin: 0 auto;
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);

}

.gh {
    border: 1px solid rgb(190, 190, 190);
    margin-top: 1%;
    border-radius: 20px;
    height: 100px;
    padding-top: 30px;

    background-color: rgb(72, 96, 231);
}

.ldkg {
    background-color: white;
    padding-top: 2%;
    width: 100%;
    border: 1px solid rgb(190, 190, 190);
    margin-top: 2%;
    border-radius: 10px;
    height: 450px;

}

.margined {
    margin-top: 4%;
    font-size: 25px;
    
    line-height: 1;
}

.spacer {
    margin-left: 30%;
}

input, select {
    height: 40px;
    width: 35%;
    min-width: 340px;
    padding: 5px;
    border: 1px solid rgb(151, 151, 151);
    font-size: 15px;
}

label {
    font-weight: bold;
    font-size: 18px;
}

.btn {
    background-color: rgb(76, 103, 255);
    cursor: pointer;
    width: 200px;
    height: 50px;
    color: white;
    

}

.btn:hover {
    border: 2px solid black;
}
</style>
</head>
<body>
    <br>
<div class="container-xl fg">

        


    <div class="container gh">
        <h3 id="ddprty"><b>Select your Room</b></h3>

    </div>


<form method="POST" action="roomprocess.php" enctype="multipart/form-data">
    <div class="container ldkg">
        <h3 class="text-muted" style="font-family: Arial">Room of Choice</h3>


            <div class="col-12 col-xl-6 margined">
            <label for="RoomTp">Room Type:</label>
                <select id="RoomTp" name="RoomTp">
                    <option value="">Select Room Type</option>
                    <option value="1">Standard Single</option>
                    <option value="2">Standard Double</option>
                    <option value="3">Deluxe Single</option>
                    <option value="4">Deluxe Double</option>
                    <option value="5">Suite</option>
                  </select>
            </div>

            <div class="col-12 col-xl-6 margined">
            <label for="RoomNm">Room Number:</label>
            <input type="number" id="RoomNm" name="RoomNm">
            </div>

            <div class="col-12 col-xl-6 margined">
            <label for="FlrNm">Floor Number:</label>
            <input type="number" id="FlrNm" name="FlrNm">
            </div>

            <div class="col-12 col-xl-6 margined">
            <label for="OccLm">Occupancy Limit (By no. of Beds):</label>
            <input type="number" id="OccLm" name="OccLm">
            </div>

            <input type="submit" class="btn" name="submit" value="Submit">

        

        
    </div>
    



        
</div>
</form>

<?php
if (isset($_POST["submit"])) {
    $RoomType = trim($_POST["RoomTp"]);
    $RoomNumber = trim($_POST["RoomNm"]);
    $FloorNumber = trim($_POST["FlrNm"]);
    $Occupancy = trim($_POST["OccLm"]);

    if (empty($RoomType) || empty($RoomNumber) || empty($FloorNumber) || empty($Occupancy)) {
        echo "<p style='color: red;'>* All fields are Required</p>";
    }
    elseif (!preg_match('/^\d+$/', $RoomNumber)) {
        echo "<p style='color: red;'>* Room Numbers must only contain digits";

    }

    elseif (!preg_match('/^\d+$/', $FloorNumber)) {
        echo "<p style='color: red;'>* Floor Numbers must only contain digits";

    }

    elseif (!preg_match('/^\d+$/', $Occupancy)) {
        echo "<p style='color: red;'>* Occupancy must only contain digits";

    }

    else {
        $_SESSION['RoomType'] = $RoomType;
        $_SESSION['RoomNumber'] = $RoomNumber;
        $_SESSION['FloorNumber'] = $FloorNumber;
        $_SESSION['Occupancy'] = $Occupancy;

        header("roomprocess.php");
        exit();
    }
}




?>
    
</body>

</html>