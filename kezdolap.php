<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="kezdolap.css">
</head>
<body>
    <header>
        <div class="logo">
            <!-- Ide jön majd a logo -->
            <img src="pizza_logo.jpg" alt="Paprika Pizza Logo" height="30">
        </div>
        <nav class="nav-links">
            <a href="#">Étlap</a>
            <a href="#">Rendelés</a>
            <a href="#">Kapcsolat</a>
            <a href="#">Kosár (0)</a>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-text">
            <span style="color: #f39c12; font-size: 12px; font-weight: bold;">FRISS SZÁLLÍTÁS &nbsp; 30 perc alatt</span>
            <h1>Igazi olasz ízek, hazai alapanyagokból.</h1>
            <p>Kézzel nyújtott tészták, füstölt sajtok és friss zöldségek. Minden pizzánk a konyhánkban készül, a hagyományos olasz receptek szerint.</p>
            <a href="#" style="background: #e67e22; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block;">Étlap megtekintése</a>
        </div>
        <div class="hero-image">
            <img src="image_c00768.png" alt="Pizza">
        </div>
    </section>

    <!-- Kiemelt -->
    <section class="features">
        <div class="feature-box">
            <h3>Gyors szállítás</h3>
            <p>Az ország egész területére szállítunk, 30 perc alatt.</p>
        </div>
        <div class="feature-box">
            <h3>Minőségi alapanyagok</h3>
            <p>Csak a legjobb, hazai beszállítóktól származó zöldségeket használjuk.</p>
        </div>
        <div class="feature-box">
            <h3>Házias hangulat</h3>
            <p>Olyan ételeket, amelyeket szeretettel készítünk, és örömmel fogyasztunk.</p>
        </div>
    </section>

    <!-- Nepszeru pizzak resz -->
    <section class="menu-section">
        <h2>Népszerű pizzáink</h2>
        <p>Próbáld ki legújabb kreációnkat!</p>
        
        <div class="pizza-grid">
            <div class="pizza-card">
                <img src="image_c00768.png" alt="Margherita">
                <div class="pizza-info">
                    <h3>Margherita <span>2 490 Ft</span></h3>
                    <p>San Marzano paradicsom, mozzarella di bufala, friss bazsalikom.</p>
                </div>
            </div>
            <div class="pizza-card">
                <img src="image_c00768.png" alt="Quattro Formaggi">
                <div class="pizza-info">
                    <h3>Quattro Formaggi <span>3 290 Ft</span></h3>
                    <p>Mozzarella, parmezán, gorgonzola és ricotta sajtok.</p>
                </div>
            </div>
            <div class="pizza-card">
                <img src="image_c00768.png" alt="Prosciutto e Funghi">
                <div class="pizza-info">
                    <h3>Prosciutto e Funghi <span>3 490 Ft</span></h3>
                    <p>Sonka, gomba, mozzarella és rukkola saláta.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <h3>Paprika Pizza</h3>
            <p>A város legjobb pizzériája. Minden nap frissen készítve, szeretettel.</p>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Paprika Pizza. Minden jog fenntartva.</p>
        </div>
    </footer>
    
</body>
</html>