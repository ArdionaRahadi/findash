<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>404 - Page Not Found</title>
        <link rel="stylesheet" href="/findash/public/css/404.css"/>
    </head>
    <body>
        <div class="particles"></div>
        <div class="container">
            <div class="error-code">403</div>
            <h1 class="error-message">Oops! Forbidden Access</h1>
            <p class="sub-message">
                Oops! You don't have permission to view this page. Please check your aceess right
            </p>
            <a href="/findash/" class="home-button">Back to Home</a>
        </div>
        <script>
            // Menghapus parameter URL yang tidak valid dan mengarahkannya ke halaman bersih
            window.history.replaceState({}, document.title, window.location.pathname);
        </script>

        <script src="/findash/public/js/404.js"></script>
    </body>
</html>
