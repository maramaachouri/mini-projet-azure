<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Project Cloud</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        .nav {
            margin-top: 20px;
        }

        .nav a {
            display: inline-block;
            margin-right: 15px;
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.3s, transform 0.2s;
        }

        .nav a:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .nav a:active {
            background-color: #003d80;
        }
    </style>
</head>
<body>

<section>
        <h2>À propos du projet</h2>
        <p>Ce projet a été développé par <strong>Maram Achouri</strong>  
        </p>
    </section>
       
    
    <div class="nav">
        <a href="./views/client/list.php">Manage Clients</a>
        <a href="./views/region/list.php">View Regions</a>
    </div>
</body>
</html>
