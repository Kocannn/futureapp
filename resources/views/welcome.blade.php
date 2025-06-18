<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>FUTURE.APT</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet" />
        <link rel="icon" type="image/png" href="{{ asset('images/FUTURE.APT__1.png?v=2') }}">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Animasi tombol */
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px rgba(99, 102, 241, 0.4);
        }
        .btn-secondary:hover {
            background-color: #eef2ff;
        }
        /* Animasi ikon */
        .icon-bounce {
            animation: bounce 2s infinite;
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body class="bg-gradient-to-b from-slate-50 to-white text-gray-800">

    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-3xl font-extrabold text-indigo-700 tracking-wide">FUTURE.APT</h1>
            <nav class="space-x-6">
                <a href="/login" class="text-gray-700 font-semibold hover:text-indigo-600 transition">Masuk</a>
                <a href="/register" class="bg-indigo-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition">Daftar</a>
            </nav>
        </div>
    </header>

 <main class="max-w-7xl mx-auto px-6 py-16 grid md:grid-cols-2 gap-12 items-center">
    <!-- Konten Teks -->
    <div>
        <h2 class="text-5xl font-extrabold text-slate-900 mb-6 leading-tight">
            Bimbel Termurah se-Indonesia
        </h2>

        <p class="text-lg font-medium text-slate-800 mb-4">
            Dibimbing langsung oleh akademisi dan apoteker berpengalaman yang telah mengikuti ujian — 
            membuat proses belajar Anda lebih terarah, akurat, dan efektif untuk meraih tujuan: 
            <span class="text-indigo-600 font-bold">KOMPETEN ONE SHOOT APOTEKER</span>
        </p>

        <p class="text-lg text-slate-700 mb-8 max-w-xl">
            Future APT adalah platform bimbingan belajar dan tryout online berbasis CBT (Computer Based Test) 
            yang dirancang untuk membantu Anda lulus berbagai macam ujian, seperti UKMPPAI dan ujian masuk 
            perguruan tinggi apoteker. Kami menyediakan materi up-to-date, latihan soal relevan, dan simulasi 
            ujian yang menyerupai kondisi sebenarnya. Semua disusun oleh para ahli dan praktisi berpengalaman.
        </p>

        <p class="text-lg text-slate-700 mb-8 max-w-xl">
            Bergabunglah sekarang dan persiapkan diri Anda dengan metode belajar yang efektif — 
            dan tentu saja, dengan harga yang sangat terjangkau!
        </p>

        <!-- Tombol CTA -->
        <div class="flex flex-wrap gap-4 mb-10">
            <a href="/login" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-semibold shadow-md transition-transform duration-300 hover:shadow-lg hover:-translate-y-1">
                Masuk Sekarang
            </a>
            <a href="/register" class="border border-indigo-600 text-indigo-600 px-8 py-3 rounded-xl font-semibold transition-colors duration-300 hover:bg-indigo-50">
                Daftar Gratis
            </a>
        </div>

        <!-- Keunggulan Fitur -->
        <div class="grid grid-cols-3 gap-6 max-w-md text-center">
            <div>
                <div class="text-indigo-600 text-4xl mb-2 icon-bounce">📚</div>
                <p class="font-semibold text-slate-700">Ribuan Soal</p>
            </div>
            <div>
                <div class="text-indigo-600 text-4xl mb-2 icon-bounce">⏰</div>
                <p class="font-semibold text-slate-700">Waktu Realistis</p>
            </div>
            <div>
                <div class="text-indigo-600 text-4xl mb-2 icon-bounce">📈</div>
                <p class="font-semibold text-slate-700">Laporan Perkembangan</p>
            </div>
        </div>
    </div>

    <!-- Gambar -->
    <div class="flex justify-center md:justify-end">
        <img src="pexels-polina-tankilevitch-3735707.jpg" 
             alt="Ilustrasi Tryout Online" 
             class="w-full max-w-sm sm:max-w-md md:max-w-lg rounded-xl shadow-lg" />
    </div>
</main>


    <!-- Testimonial Section -->
    <section class="bg-indigo-50 py-16">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h3 class="text-3xl font-extrabold text-indigo-700 mb-8">Apa Kata Pengguna Kami?</h3>
            <div class="grid md:grid-cols-2 gap-10">
                <blockquote class="bg-white rounded-lg p-6 shadow-md text-slate-800">
                    <p class="mb-4 italic">"FUTURE.APT membantu saya fokus pada materi yang penting dan meningkatkan confidence saya sebelum ujian nasional. Sangat direkomendasikan!"</p>
                    <footer class="font-semibold text-indigo-600">- Rina S.</footer>
                </blockquote>
                <blockquote class="bg-white rounded-lg p-6 shadow-md text-slate-800">
                    <p class="mb-4 italic">"Antarmuka yang mudah digunakan dan soal yang sesuai dengan standar. Fitur evaluasi sangat membantu untuk memahami kelemahan saya."</p>
                    <footer class="font-semibold text-indigo-600">- Andi M.</footer>
                </blockquote>
            </div>
        </div>
    </section>
    <!-- Fitur Unggulan -->
<section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h3 class="text-3xl font-extrabold text-slate-800 mb-12">Kenapa Memilih FUTURE.APT?</h3>
        <div class="grid md:grid-cols-3 gap-10">
            <div class="p-6 border rounded-xl shadow-sm hover:shadow-md transition">
                <div class="text-4xl mb-4 text-indigo-600">🧠</div>
                <h4 class="text-xl font-semibold mb-2">Soal Berkualitas</h4>
                <p class="text-slate-600">Disusun oleh tim ahli dan sesuai dengan standar ujian terbaru.</p>
            </div>
            <div class="p-6 border rounded-xl shadow-sm hover:shadow-md transition">
                <div class="text-4xl mb-4 text-indigo-600">📊</div>
                <h4 class="text-xl font-semibold mb-2">Analisis Hasil</h4>
                <p class="text-slate-600">Dapatkan grafik performa, skor, dan pembahasan tiap soal.</p>
            </div>
            <div class="p-6 border rounded-xl shadow-sm hover:shadow-md transition">
                <div class="text-4xl mb-4 text-indigo-600">🕒</div>
                <h4 class="text-xl font-semibold mb-2">Bisa Kapan Saja</h4>
                <p class="text-slate-600">Akses tryout fleksibel dari mana saja dan kapan saja.</p>
            </div>
        </div>
    </div>
</section>

<!-- Cara Kerja -->
<section class="bg-indigo-50 py-20">
    <div class="max-w-7xl mx-auto px-6">
        <h3 class="text-3xl font-extrabold text-center text-indigo-700 mb-12">Cara Kerja Pengerjaan Soal Online</h3>
        <div class="grid md:grid-cols-4 gap-6 text-center">
            <div class="p-4">
                <div class="text-4xl mb-3">📝</div>
                <h4 class="font-semibold text-lg mb-1">1. Daftar Akun</h4>
                <p class="text-slate-600 text-sm">Buat akun gratis untuk mulai menggunakan platform.</p>
            </div>
            <div class="p-4">
                <div class="text-4xl mb-3">📚</div>
                <h4 class="font-semibold text-lg mb-1">2. Pilih Paket</h4>
                <p class="text-slate-600 text-sm">Pilih tryout berdasarkan mata pelajaran dan ujian.</p>
            </div>
            <div class="p-4">
                <div class="text-4xl mb-3">🕒</div>
                <h4 class="font-semibold text-lg mb-1">3. Kerjakan Soal</h4>
                <p class="text-slate-600 text-sm">Kerjakan dengan sistem waktu nyata seperti ujian asli.</p>
            </div>
            <div class="p-4">
                <div class="text-4xl mb-3">📈</div>
                <h4 class="font-semibold text-lg mb-1">4. Lihat Skor</h4>
                <p class="text-slate-600 text-sm">Dapatkan hasil, pembahasan, dan rekomendasi belajar.</p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="bg-white py-20">
    <div class="max-w-4xl mx-auto px-6">
        <h3 class="text-3xl font-extrabold text-center text-slate-800 mb-10">Pertanyaan Umum (FAQ)</h3>
        <div class="space-y-6">
            <div class="border-b pb-4">
                <h4 class="font-semibold text-lg text-indigo-700">Apakah FUTURE.APT gratis digunakan?</h4>
                <p class="text-slate-600 mt-2">Ya! Kamu bisa mendaftar dan mencoba soal secara gratis. Untuk fitur lanjutan, akan tersedia paket berbayar (optional).</p>
            </div>
            <div class="border-b pb-4">
                <h4 class="font-semibold text-lg text-indigo-700">Apakah saya bisa mengulang pengerjaan soal?</h4>
                <p class="text-slate-600 mt-2">Bisa! Kamu dapat mengerjakan paket soal berkali-kali untuk evaluasi lebih baik.</p>
            </div>
            <div class="border-b pb-4">
                <h4 class="font-semibold text-lg text-indigo-700">Apa bisa digunakan lewat HP?</h4>
                <p class="text-slate-600 mt-2">Tentu! FUTURE.APT mendukung tampilan mobile, jadi kamu bisa latihan lewat smartphone dengan lancar.</p>
            </div>
        </div>
    </div>
</section>


    <!-- Footer -->
    <!-- Footer Baru -->
<!-- Footer Baru -->
<footer class="bg-white border-t pt-12 pb-6">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-3 gap-8 text-center md:text-left">
        
        <!-- CTA & Branding -->
        <div>
            <h4 class="text-xl font-extrabold text-indigo-700 mb-2">FUTURE.APT</h4>
            <p class="text-slate-600 text-sm mb-4">Latih kemampuanmu dan raih hasil terbaik bersama kami.</p>
            <a href="/register" class="inline-block bg-indigo-600 text-white text-sm px-4 py-2 rounded-lg mt-2 hover:bg-indigo-700 transition">
                Daftar Sekarang
            </a>
        </div>

        <!-- Kontak -->
        <div>
            <h5 class="text-lg font-semibold text-slate-800 mb-2">Kontak Kami</h5>
            <p class="text-sm text-slate-600 mt-1">WhatsApp: <a href="https://wa.me/6282259672747" target="_blank" class="text-indigo-600 hover:underline">+62 812-3456-7890</a></p>
        </div>

        <!-- Media Sosial -->
        <div>
            <h5 class="text-lg font-semibold text-slate-800 mb-2">Ikuti Kami</h5>
            <div class="flex justify-center md:justify-start gap-4 mt-2">
                <a href="https://instagram.com/future.apt" target="_blank" class="text-indigo-600 hover:text-indigo-800 text-xl" title="Instagram">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2.2c3.2 0 3.6 0 4.8.1 1.2.1 2 .3 2.5.5.6.3 1 .6 1.4 1.1.4.4.8.9 1.1 1.4.2.5.4 1.3.5 2.5.1 1.2.1 1.6.1 4.8s0 3.6-.1 4.8c-.1 1.2-.3 2-.5 2.5-.3.6-.6 1-1.1 1.4-.4.4-.9.8-1.4 1.1-.5.2-1.3.4-2.5.5-1.2.1-1.6.1-4.8.1s-3.6 0-4.8-.1c-1.2-.1-2-.3-2.5-.5-.6-.3-1-.6-1.4-1.1-.4-.4-.8-.9-1.1-1.4-.2-.5-.4-1.3-.5-2.5C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.8c.1-1.2.3-2 .5-2.5.3-.6.6-1 1.1-1.4.4-.4.9-.8 1.4-1.1.5-.2 1.3-.4 2.5-.5C8.4 2.2 8.8 2.2 12 2.2m0-2.2C8.7 0 8.3 0 7.1.1c-1.3.1-2.3.3-3.2.6C3 1 2.3 1.4 1.7 2 .9 2.8.5 3.5.2 4.5 0 5.4-.1 6.4 0 7.7 0 8.9 0 9.3 0 12s0 3.1.1 4.3c.1 1.3.3 2.3.6 3.2.3 1 .8 1.7 1.5 2.4.7.7 1.4 1.2 2.4 1.5.9.3 1.9.5 3.2.6 1.2.1 1.6.1 4.3.1s3.1 0 4.3-.1c1.3-.1 2.3-.3 3.2-.6 1-.3 1.7-.8 2.4-1.5.7-.7 1.2-1.4 1.5-2.4.3-.9.5-1.9.6-3.2.1-1.2.1-1.6.1-4.3s0-3.1-.1-4.3c-.1-1.3-.3-2.3-.6-3.2-.3-1-.8-1.7-1.5-2.4C21.7 1.4 21 1 20 0.7c-.9-.3-1.9-.5-3.2-.6C15.1 0 14.7 0 12 0z"/><path d="M12 5.8A6.2 6.2 0 0 0 5.8 12 6.2 6.2 0 0 0 12 18.2 6.2 6.2 0 0 0 18.2 12 6.2 6.2 0 0 0 12 5.8m0 10.2A4 4 0 0 1 8 12a4 4 0 0 1 4-4 4 4 0 0 1 4 4 4 4 0 0 1-4 4zM18.4 4.6a1.4 1.4 0 1 0 0 2.8 1.4 1.4 0 0 0 0-2.8z"/></svg>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Copyright -->
    <div class="text-center text-xs text-slate-500 mt-10">
        &copy; 2025 Future.APT. All rights reserved.
    </div>
</footer>

</body>
</html>
