/**
 * @fileoverview
 * Titik masuk utama (entry point) untuk aplikasi frontend Laravel.
 * File ini digunakan untuk mengimpor seluruh file JavaScript kustom yang dibutuhkan.
 *
 * - bootstrap.ts: Berisi konfigurasi dasar seperti axios, CSRF token, dll.
 * - chart.ts: Logika terkait chart atau grafik.
 * - form.ts: Logika validasi dan interaksi form.
 * - hamburger-menu.ts: Logika navigasi menu samping.
 * - profile-photo.ts: Logika interaksi foto profil.
 * - save-intern.ts: Logika penyimpanan data magang.
 * - search.ts: Logika pencarian data.
 */

import "./bootstrap";
import "./chart";
import "./form";
import "./hamburger-menu";
import "./profile-photo";
import "./save-intern";
import "./search";