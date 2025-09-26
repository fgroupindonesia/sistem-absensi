<?php
if (!function_exists('format_hp_clear')) {
    function format_hp_clear($w)
    {

       
        // 1. Hilangkan semua karakter non-digit
        $w = preg_replace('/\D/', '', $w); 

        // 2. Jika nomor diawali "62" ubah jadi "0"
        if (substr($w, 0, 2) === '62') {
            $w = '0' . substr($w, 2);
        }

        // 3. Pastikan hanya format 08xxxxxxx
        if (substr($w, 0, 1) !== '0') {
            $w = '0' . $w; // jaga-jaga kalau awalnya bukan 0
        }

        return $w;


    }

}

if (!function_exists('format_rupiah')) {
    function format_rupiah($angka, $with_prefix = true)
    {
        // pastikan input angka
        $angka = (float) $angka;

        // format jadi ribuan dengan pemisah titik
        $hasil = number_format($angka, 0, ',', '.');

        // tambahin prefix Rp kalau diminta
        if ($with_prefix) {
            return 'Rp ' . $hasil;
        } else {
            return $hasil;
        }
    }
}



if (!function_exists('tanggal_indonesia')) {
    function tanggal_indonesia($tanggal)
    {
        if (empty($tanggal)) {
            return '';
        }

        // Mapping hari
        $hari = [
            'Sunday'    => 'Minggu',
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu',
        ];

        // Mapping bulan
        $bulan = [
            'Jan' => 'Januari',
            'Feb' => 'Februari',
            'Mar' => 'Maret',
            'Apr' => 'April',
            'May' => 'Mei',
            'Jun' => 'Juni',
            'Jul' => 'Juli',
            'Aug' => 'Agustus',
            'Sep' => 'September',
            'Oct' => 'Oktober',
            'Nov' => 'November',
            'Dec' => 'Desember',
        ];

        $timestamp = strtotime($tanggal);
        if ($timestamp === false) {
            return '';
        }

        $hariIndo = $hari[date('l', $timestamp)];
        $tgl      = date('d', $timestamp);
        $bln      = $bulan[date('M', $timestamp)];
        $thn      = date('Y', $timestamp);
        $jam      = date('H:i', $timestamp);

        return "$hariIndo, $tgl-$bln-$thn, $jam WIB";
    }
}
