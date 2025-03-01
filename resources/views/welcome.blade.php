<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JanjiTemu</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<nav>
    <div class="wrapper">
        <div class="logo"><a href=''>JanjiTemu</a></div>
        <div class="menu">
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="/admin/login" class="login-button">Log In</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="wrapper">
    <!-- untuk home -->
    <section id="home">
        <img src="{{ asset('images/doctor.png') }}"/>
        <div class="kolom">
            <p class="description">Ingin ketemu dokter tapi tidak punya waktu janjian?</p>
            <h2>Solusi mudah sekarang bisa janjian dengan dokter melalui kami...</h2>
            <p>Langsung saja tekan</p>
            <p><a href="/admin/appointments" class="appointment-button">Atur Jadwal Janjian</a></p>
        </div>
    </section>
</div>

<div id="copyright">
    <div class="wrapper">
        &copy; Created By <b>Nur Habib Rizki Saputro</b>
    </div>
</div>

</body>
</html>
