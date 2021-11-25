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
            font-family: Arial, Helvetica, sans-serif;
            color: #333333;
        }
        a {
            text-decoration: none;
        }
        h1 {
            text-align: center;
            margin: 15px 0px;
        }

        nav {
            width: 100%;
            height: 50px;
            background-color: rgb(255, 119, 29);
            display: flex;
            align-items: center;
            justify-content: space-around;
        }

        .logo {
            color: #fff !important;
            font-weight: 800;
            font-size: 20px;
        }

        nav > ul
        {
            list-style: none;
            display: flex;
        }
        ul > li{
            margin-left: 20px;
            color: #fff;
            font-weight: 500;
        }
        nav > ul > li > b
        {
            color: #fff;
        }

        nav > ul > li > a {
            color: #fff;
            transition: all ease .5s;
        }

        nav > ul > li > a:hover
        {
            background-color: rgba(255, 197, 158, 0.309);
            color: #eee;
            transition: all ease .5s;
        }

        .welcome {
            width: 800px;
            border: rgba(0, 0, 0, 0.100) solid 1px;
            margin: 100px auto;       
            padding: 50px 10px;
            box-shadow: 3px 6px 15px rgba(0, 0, 0, 0.109); 
        }

        .welcome p {
            text-align: justify;
            margin: 30px 20px 0px 20px;
        }

        form {
            width: 500px;
            height: auto;
            border: 1px solid rgb(218, 217, 217);
            padding: 10px 20px;
            margin: 100px auto;
            box-shadow: 3px 6px 12px rgba(0, 0, 0, 0.11);
        }
        form > input {
            width: 100%;
            margin: 10px 0px;
            padding: 10px;
            border:rgb(223, 223, 223) 1px solid;
        }

        form > button 
        {
            padding: 10px 20px;
            background-color: #eee;
            color: rgb(56, 56, 56);
            border:rgb(141, 141, 141) 1px solid;
            cursor: pointer;
            transition: all ease .5s;
        }

        form > button:hover
        {
            background-color: rgb(56, 56, 56);
            color: #eee;
            transition: all ease .5s;
        }

    </style>

</head>
<body>
    <nav>
        <a href="#" class="logo"> Master </a>

        <ul>
            <li><a href="#"> Documantation </a></li>
            <li>Developer: <b>Miguel Leite</b></li>
        </ul>
    </nav>

    <div class="welcome">
        <h1> <?=strtoupper($title)?> </h1>
    </div>

</body>
</html>