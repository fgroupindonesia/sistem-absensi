<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= $title; ?></title>

    <style>
        @page {
            size: A4 portrait;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            height: 100%;
        }

        .container {
            width: 100%;
            height: 100%;
            position: relative;
            text-align: center;
        }

        .qr-wrapper {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .qr-img {
            width: 180mm; /* hampir selebar A4 */
            height: auto;
        }

        footer {
            position: absolute;
            bottom: 10mm;
            width: 100%;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="qr-wrapper">
            <h2><?= $title; ?></h2>
            <img src="<?= $link; ?>" alt="QR Code" class="qr-img">
        </div>
        <footer>
            Sistem Absensi - Solusi Digital - FGroupIndonesia
        </footer>
    </div>
</body>
</html>
