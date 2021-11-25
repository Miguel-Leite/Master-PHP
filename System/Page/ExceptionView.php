<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: #333333;
            font-family: Arial, Helvetica, sans-serif;
        }
        .box{
            margin: 100px auto;
            width: 700px;
            padding: 50px 100px;
            border: rgba(0, 0, 0, 0.109) solid 1px;
            text-align: center;
            box-shadow: 3px 6px 15px rgba(0, 0, 0, 0.109);     
        }
        .box > h3 {
            margin: 10px 0px;
            text-transform: uppercase;
        }

        .box > p {
            margin: 10px 0px;
        }
    </style>

</head>
<body>
    
    <div class="box">
        <h3><?=$title?></h3>
        <hr>
        <p> <?=$message?> </p>
    </div>

</body>
</html>