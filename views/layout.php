<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MercadoExpress | <?php echo $titulo ?? ''; ?> </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <!-- Swiper js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    <link rel="stylesheet" href="/build/css/app.css">
    <link rel="stylesheet" href="/build/fontawesome/css/all.css">
    <link rel="stylesheet" href="/build/font-awesome/css/brands.css">
    <link rel="stylesheet" href="/build/font-awesome/css/solid.css">
    <link rel="stylesheet" href="/build/font-awesome/css/regular.css">
</head>
<body class="body-layout">

    <?php echo $contenido; ?>


    <?php 
        echo $script ?? '';
    ?>
    
    <!-- Swiper js script -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>
</html>