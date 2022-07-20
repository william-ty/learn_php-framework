<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/main.css">
    <title>Novus</title>
</head>

<body>
    
    <section id="nav">
        <div class="container">
            <nav class="nav">
                <div style="width:100%; background-color:gray; padding:1rem;"><?php echo $pageName ?></div>
            </nav>
        </div>
    </section>
    
    <section id="main">
        <main>
            <div id="page">
                <div style="width:100%; background-color:lightblue; padding:1rem;">
                <!-- <?php echo $data["welcome"] ?> -->
                <?php isset($data["view"]) && include $data["view"];?>
            </div>
            </div>
        </main>
    </section>

</body>

</html>