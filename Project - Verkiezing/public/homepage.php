<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="../assets/css/home.css">
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
</head>

<body>

    <section class="navbar-section">
        <nav class="navbar">
            <div class="logo">
                JOUW STEM TELT
            </div>
            <ul>
                <li><a href="../public/contact.php">CONTACT</a></li>
                
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="../public/account.php">ACCOUNT</a></li>

                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                        <li><a href="../admin/users.php">ADMIN PANEL</a></li> 
                    <?php endif; ?>

                    <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'voter' || $_SESSION['role'] == 'admin')): ?>
                        <li><a href="../public/stem.php">STEMMEN</a></li>
                    <?php endif; ?>

                <?php else: ?>
                    <li><a href="../login/login.php">INLOGGEN</a></li>
                    <li><a href="../login/registratie.php">REGISTREREN</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </section>


    <section class="welcome-section">
    <div class="welcome-content">
        <!-- Embedded YouTube video -->
        <iframe class="background-video" 
        src="https://www.youtube.com/embed/S0RdaqC0EHk?autoplay=1&mute=1&loop=1&playlist=S0RdaqC0EHk&vq=hd1080"
        title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen>
        </iframe>

    </div>
    <div class="square-container">
        <h2>SNEL NAAR</h2>
        <p>Login of registereer eerst en vul dan je stem in.</p>
        <br>
        <a href="../login/login.php">Stem hier</a>
    </div>
    </section>



    <section class="navbar-section" style="height: 35px"></section>


    <section class="news-section">
        <h2>Laatste Verkiezingsnieuws</h2>
        <div class="news-cards">
            <div class="news-card">
            <img src="http://localhost/EXAMENOPDRACHT---VERKIEZING/Code/assets/img/gemeente.jpg" alt="Nieuws afbeelding 1">
            <h3>Verkiezing Aankondiging</h3>
                <p>Het ministerie heeft de datum voor de komende landelijke verkiezingen bekendgemaakt.</p>
                <a href="#" class="read-more"></a>
            </div>
            <div class="news-card">
                <img src="http://localhost/EXAMENOPDRACHT---VERKIEZING/Code/assets/img/partij.jpg" alt="Nieuws afbeelding 2">
                <h3>Regionale Verkiezingen</h3>
                <p>Gemeenten bereiden zich voor op de regionale verkiezingen.</p>
                <a href="#" class="read-more"></a>
            </div>
            <div class="news-card">
                <img src="http://localhost/EXAMENOPDRACHT---VERKIEZING/Code/assets/img/stemgerechtigde.jpg" alt="Nieuws afbeelding 3">
                <h3>Nieuwe Partijen Geregistreerd</h3>
                <p>Verschillende nieuwe politieke partijen hebben zich aangemeld voor de verkiezingen.</p>
                <a href="#" class="read-more"></a>
            </div>
        </div>
    </section>

    <section class="balk-section" style="height: 35px color: white"></section>

    <footer class="footer">
        <div class="footer-section logo-section">
            <img src="http://localhost/EXAMENOPDRACHT---VERKIEZING/Code/assets/img/logo.png" alt="Logo" class="footer-logo">
            <h3 class="footer-title">JOUW STEM TELT</h3>
            <p class="footer-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia, quae!</p>
        </div>
        <div class="footer-section links-section">
            <h3>Links</h3>
            <div class="links-columns">
                <ul>
                    <li><a href="#">Link 1</a></li>
                    <li><a href="#">Link 2</a></li>
                    <li><a href="#">Link 3</a></li>
                    <li><a href="#">Link 4</a></li>
                </ul>
                <ul>
                    <li><a href="#">Link 5</a></li>
                    <li><a href="#">Link 6</a></li>
                    <li><a href="#">Link 7</a></li>
                    <li><a href="#">Link 8</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-section newsletter-section">
            <h3>Nieuwsbrief</h3>
            <form>
                <input type="email" placeholder="Voer je e-mail in" required>
                <button type="submit">Aanmelden</button>
            </form>
        </div>
    </footer>

</body>

</html>