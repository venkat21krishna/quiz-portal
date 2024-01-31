<?php
    session_start();
    if(isset($_SESSION['studentName'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/dashboard.css">
    <script src=" https://code.jquery.com/jquery-3.0.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/brands.min.css" integrity="sha512-sVSECYdnRMezwuq5uAjKQJEcu2wybeAPjU4VJQ9pCRcCY4pIpIw4YMHIOQ0CypfwHRvdSPbH++dA3O4Hihm/LQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <title>Student Dashboard</title>

    <style>
        .container {
            display: flex;
            flex-direction: column;
            text-align:center;
            color: white;
            box-shadow: 0 0 30px black;
        }



    .formContainer {
        display: flex;
        flex-direction: column;
        gap: 15px;
        width: 50vw;
        margin-top: 50px;

    }

    tr {
        text-align: center;
    }
    th {
        text-align: center;
    }
    td {
        padding: 3px;
    }
    .table-container {
        width: 100%;
        align-items: center;
    }
    table {
        width: 100%
    }
    </style>
</head>
<body>
    <div class="listContainer">
        <span id="Name">QUIZ PORTAL</span>
        <div class="list">
            <ul>
                <li class="active"><a href="dashboard.php">HOME</a></li>
                <li><a href="result.php">Result</a></li>
                <li><a onclick="logout()">Log Out</a></li>
            </ul>
        </div>
    </div>
    <div class="mainContainer">
        <div class="heading">
            <h1>WELCOME <?php echo $_SESSION['studentName'];?></h1>
        </div>
        <div class="formContainer col-sm-12">
            <div class="col-sm-1"></div>
            <h1>Available Tests</h1>
            <div class="table-container" style = "margin-top: 50px;">
        </div>
    </div>

    <script>
        getTest();

        function getTest(){
            var token = "<?php echo password_hash("getTestList", PASSWORD_DEFAULT);?>";
            var cid = "<?php echo $_SESSION['cid'];?>";
            $.ajax({
                type:'POST',
                url:"ajax/getTestList.php",
                data:{token:token, cid: cid},
                success:function(data){
                    $('.table-container').html(data);
                }
            });
        }

        function takeTest(tid) {
            $.ajax({
                    type:'POST',
                    url:"ajax/activateTest.php",
                    data:{activeTest:tid},
                    success:function(data){
                        alert("Starting Test " + data);
                        window.location = "testPage.php";
                    }
                });
        }
        function logout(){
            $.ajax({
                type:'POST',
                url:"../ajax/logout.php",
                data:{},
                success:function(data){
                    window.location.href = "../index.html"
                }
            });
        }

    </script>
</body>
</html>

<?php
    }
else {
    echo "You are not authorized";
}
?>