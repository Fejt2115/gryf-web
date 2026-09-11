<?php

declare(strict_types=1);

$pageTitle = 'Kontakt - Towarzystwo Żeglarskie "Gryf"';
$pageDescription = 'Skontaktuj się z Towarzystwem Żeglarskim "Gryf" w Grudziądzu.';
$activePage = 'kontakt';

require __DIR__ . '/includes/header.php';
?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10">
                <h1 class="mb-4">Kontakt</h1>

                <h3>Nasza lokacja</h3>
                <div class="card mb-4">
                    <iframe class="card-img-bottom"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2376.565868666806!2d18.73357817691556!3d53.44047016767651!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4702d14c281f2c0f%3A0xf3c007f2bc7c090a!2sTowarzystwo%20%C5%BBeglarskie%20GRYF!5e0!3m2!1spl!2spl!4v1711376247698!5m2!1spl!2spl"
                        width="600" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" title="Mapa dojazdu - Towarzystwo Żeglarskie GRYF"></iframe>
                </div>

                <div class="facebook-articles">
                    <p class="h6"><b>KRS:</b> 0000129681</p>
                    <p class="h6"><b>NIP:</b> 8761280141</p>
                    <p class="h6"><b>REGON:</b> 870012280</p>
                    <p class="h6"><b>ADRES E-MAIL:</b> <a href="mailto:Tzgryf.grudziadz@wp.pl">tzgryf.grudziadz@wp.pl</a></p>
                    <p class="h6"><b>ADRES:</b> Spacerowa 4, 86-300 Grudziądz, Polska</p>
                </div>

                <h3>Nasze profile w sieci</h3>
                <div class="d-flex align-items-center my-3">
                    <a href="https://www.facebook.com/profile.php?id=100084212346120" target="_blank"
                        rel="noopener noreferrer" class="mr-3" aria-label="Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#1877F2"
                            viewBox="0 0 16 16">
                            <path
                                d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                        </svg>
                    </a>
                    <span>Facebook — Towarzystwo Żeglarskie „Gryf"</span>
                </div>

                <div class="d-flex align-items-center my-3">
                    <a href="mailto:Tzgryf.grudziadz@wp.pl" class="mr-3" aria-label="E-mail">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#EA4335"
                            viewBox="0 0 16 16">
                            <path
                                d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                        </svg>
                    </a>
                    <span>Tzgryf.grudziadz@wp.pl</span>
                </div>

                <hr class="my-4">

                <h3>Nasi partnerzy</h3>
                <div class="d-flex flex-wrap align-items-center">
                    <a href="https://pya.org.pl/polski-zwiazek-zeglarski" target="_blank" rel="noopener noreferrer" class="mr-3 mb-2">
                        <img src="public/PZZ_logo.jpeg" height="60" alt="Polski Związek Żeglarski">
                    </a>
                    <a href="http://tozz.org.pl/" target="_blank" rel="noopener noreferrer" class="mr-3 mb-2">
                        <img src="public/tozz.png" height="60" alt="Toruński Okręgowy Związek Żeglarski">
                    </a>
                    <a href="https://grudziadz.pl/" target="_blank" rel="noopener noreferrer" class="mr-3 mb-2">
                        <img src="public/herb.jpg" height="60" alt="Urząd Miejski w Grudziądzu">
                    </a>
                    <a href="https://kujawsko-pomorskie.pl/" target="_blank" rel="noopener noreferrer" class="mb-2">
                        <img src="public/kujawsko.jpg" height="60" alt="Województwo Kujawsko-Pomorskie">
                    </a>
                </div>
            </div>
        </div>
    </div>

<?php require __DIR__ . '/includes/footer.php'; ?>