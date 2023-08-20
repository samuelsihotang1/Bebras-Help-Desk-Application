<?php

namespace Database\Seeders;

use App\Models\about;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    // \App\Models\about::factory(1)->create();
    // \App\Models\User::factory(20)->create();
    // //question
    // \App\Models\Question::factory(15)->create();
    // //topic
    // \App\Models\Topic::factory(15)->create();
    // //question_topic
    // \App\Models\QuestionTopic::factory(15)->create();


    // About
    DB::table('abouts')->insert([
      'title' => 'Tentang kami',
      'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse gravida dui id ultricies bibendum. Maecenas elit nisl, varius volutpat interdum viverra, euismod eget augue. Nam ante odio, viverra ac risus a, bibendum euismod tortor. Etiam imperdiet ullamcorper lacus, at sagittis lorem facilisis sagittis. Praesent sed enim sed risus efficitur facilisis in at elit. Curabitur ac turpis vestibulum, rutrum lorem eu, bibendum sem. Etiam semper vel dolor et laoreet. Curabitur velit sem, faucibus id molestie quis, efficitur nec justo. ',
      'img' => 'about.jpg',
      'created_at' => now(),
      'updated_at' => now(),
    ]);


    // User
    // super-admin
    DB::table('users')->insert([
      'name' => 'Super Admin',
      'name_slug' => 'super-admin',
      'email' => 'admin@gmail.com',
      'email_verified_at' => now(),
      'password' => bcrypt('admin@gmail.com'),
      'avatar' => 'https://ui-avatars.com/api/?name=admin&background=868e96&color=fff',
      'country' => 'Indonesia',
      'role' => 'admin',
      'marker' => 'super-admin',
      'approved' => 'true',
      'remember_token' => Str::random(10),
      'created_at' => now(),
      'updated_at' => now(),
    ]);

    // biro
    for ($i = 1; $i <= 3; $i++) {
      DB::table('users')->insert([
        'name' => 'Biro ' . $i,
        'name_slug' => 'biro-' . $i,
        'email' => 'biro' . $i . '@gmail.com',
        'email_verified_at' => now(),
        'password' => bcrypt('biro' . $i . '@gmail.com'),
        'avatar' => 'https://ui-avatars.com/api/?name=admin&background=868e96&color=fff',
        'country' => 'Indonesia',
        'role' => 'admin',
        'marker' => 'biro',
        'approved' => 'true',
        'remember_token' => Str::random(10),
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    // guru
    for ($i = 1; $i <= 3; $i++) {
      DB::table('users')->insert([
        'name' => 'Guru ' . $i,
        'name_slug' => 'guru-' . $i,
        'email' => 'guru' . $i . '@gmail.com',
        'email_verified_at' => now(),
        'password' => bcrypt('guru' . $i . '@gmail.com'),
        'avatar' => 'https://ui-avatars.com/api/?name=admin&background=868e96&color=fff',
        'country' => 'Indonesia',
        'role' => 'user',
        'marker' => 'guru',
        'approved' => 'true',
        'remember_token' => Str::random(10),
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    // pusat
    for ($i = 1; $i <= 3; $i++) {
      DB::table('users')->insert([
        'name' => 'Pusat ' . $i,
        'name_slug' => 'pusat-' . $i,
        'email' => 'pusat' . $i . '@gmail.com',
        'email_verified_at' => now(),
        'password' => bcrypt('pusat' . $i . '@gmail.com'),
        'avatar' => 'https://ui-avatars.com/api/?name=admin&background=868e96&color=fff',
        'country' => 'Indonesia',
        'role' => 'admin',
        'marker' => 'pusat',
        'approved' => 'true',
        'remember_token' => Str::random(10),
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    // Topik
    $topics = [
      'Pemrograman Web',
      'Belajar',
      'Seni Rupa',
      'Aktor',
      'Anime',
      'Kebugaran',
      'Pakaian',
      'Film',
      'Penulis',
      'Buku',
      'Ilmu Pengetahuan',
      'Biologi',
      'Merek',
      'Branding',
      'Kamera',
      'Komputer',
      'Kartu',
      'Motor',
      'Mesin',
      'Web',
      'Digital',
      'Pemasaran',
      'Musik',
      'Hewan Peliharaan',
      'Kedokteran',
      'Mimpi',
      'Resep',
      'Pengalaman',
      'Bahasa Inggris',
      'Sastra',
      'Fakta',
      'Makanan',
      'Ilmu Data'
    ];

    for ($i = 0; $i < count($topics); $i++) {
      DB::table('topics')->insert([
        'name' => $topics[$i],
        'name_slug' => Str::of($topics[$i])->slug('-'),
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    // Topik User
    for ($i = 1; $i <= 33; $i++) {
      DB::table('user_topics')->insert([
        'user_id' => ($i % 10 == 0) ? 10 : $i % 10,
        'topic_id' => $i,
      ]);
    }

    // Pertanyaan
    $questions = [
      'Apa fungsi klorofil dalam tumbuhan?',
      'Bagaimana cara kerja mesin jet?',
      'Apa yang dimaksud dengan global warming?',
      'Siapa pelukis Mona Lisa?',
      'Apa itu algoritma?',
      'Apa peran mitokondria dalam sel?',
      'Apa itu fotosintesis?',
      'Bagaimana struktur bumi?',
      'Apa yang dimaksud dengan hukum Newton pertama?',
      'Siapa penulis novel "Laskar Pelangi"?',
      'Apa itu sistem kekebalan tubuh?',
      'Apa perbedaan antara virus dan bakteri?',
      'Apa itu teori evolusi?',
      'Bagaimana cara kerja sel surya?',
      'Siapa penemu bola lampu?',
      'Apa itu efek rumah kaca?',
      'Apa yang dimaksud dengan revolusi industri?',
      'Siapa penulis drama "Romeo dan Juliet"?',
      'Apa fungsi dari otak manusia?',
      'Apa itu DNA?',
      'Bagaimana proses pembentukan bintang?',
      'Apa yang menyebabkan mare (laut) di bulan?',
      'Apa itu burung pengicau?',
      'Siapa presiden Amerika Serikat ke-44?',
      'Apa perbedaan antara mitosis dan meiosis?',
      'Apa yang dimaksud dengan efek Doppler?',
      'Apa itu alat musik biola terbuat dari?',
      'Bagaimana internet bekerja?',
      'Apa fungsi dari enzim dalam tubuh?',
      'Apa itu senyawa kimia H2O?',
      'Siapa penulis novel "Harry Potter"?',
      'Apa peran ribosom dalam sel?',
      'Apa itu teori relativitas?',
      'Bagaimana terbentuknya goa-goa alam?',
      'Apa yang dimaksud dengan tumbuhan berbunga?',
      'Apa itu pemanasan global?',
      'Apa fungsi dari mitokondria dalam sel?',
      'Siapa ilmuwan yang merumuskan hukum gravitasi?',
      'Apa itu sistem pencernaan manusia?',
      'Apa perbedaan antara unsur dan senyawa?',
      'Apa yang dimaksud dengan lubang hitam?',
      'Bagaimana fotosintesis berlangsung dalam tumbuhan?',
      'Apa itu teori big bang?',
      'Apa fungsi dari klorofil dalam tumbuhan?',
      'Siapa penulis drama "Hamlet"?',
      'Apa warna langit?',
      'Siapa presiden pertama Indonesia?',
      'Berapakah hasil dari 5 dikali 7?',
      'Apa ibukota Jepang?',
      'Siapa penemu gravitasi?',
    ];

    for ($i = 0; $i < count($questions); $i++) {
      DB::table('questions')->insert([
        'user_id' => ($i % 10 == 0) ? 10 : $i % 10,
        'title' => $questions[$i],
        'title_slug' => Str::of($questions[$i])->slug('-'),
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    // Pertanyaan Topik
    for ($i = 1; $i <= 50; $i++) {
      DB::table('question_topics')->insert([
        'question_id' => $i,
        'topic_id' => ($i % 10 == 0) ? 10 : $i % 10,
      ]);
    }

    // Jawaban
    $answers = [
      'Menghasilkan makanan melalui fotosintesis',
      'Dengan menyemprotkan bahan bakar ke dalam mesin dan membakarnya untuk menghasilkan dorongan',
      'Pemanasan global adalah peningkatan suhu rata-rata Bumi akibat aktivitas manusia',
      'Leonardo da Vinci',
      'Sekumpulan instruksi langkah demi langkah untuk menyelesaikan tugas atau masalah',
      'Tempat produksi energi dalam sel',
      'Proses di mana tumbuhan menggunakan energi matahari untuk mengubah karbon dioksida dan air menjadi gula dan oksigen',
      'Bumi memiliki lapisan dalam, mantel, dan kerak',
      'Benda cenderung tetap dalam keadaan diam atau bergerak lurus dengan kecepatan konstan kecuali ada gaya yang bekerja pada mereka',
      'Andrea Hirata',
      'Sistem pertahanan tubuh terhadap patogen dan benda asing lainnya',
      'Virus adalah parasit intraseluler obligat, sedangkan bakteri adalah organisme prokariotik',
      'Teori yang menjelaskan bagaimana spesies berevolusi melalui seleksi alam dan perubahan genetik',
      'Dengan menangkap energi matahari dan mengubahnya menjadi energi listrik',
      'Thomas Edison',
      'Fenomena peningkatan suhu di atmosfer akibat peningkatan gas rumah kaca',
      'Periode perubahan besar dalam produksi dan teknologi yang mengubah masyarakat secara drastis',
      'William Shakespeare',
      'Mengendalikan semua fungsi tubuh dan proses mental',
      'Molekul yang membawa informasi genetik dalam sel',
      'Melalui gravitasi dan kompresi gas di dalam awan molekul',
      'Pukulan asteroid atau komet ke permukaan bulan',
      'Burung yang memiliki suara kicauan yang indah',
      'Barack Obama',
      'Mitosis adalah pembelahan sel untuk pertumbuhan dan perbaikan, sedangkan meiosis menghasilkan sel-sel reproduksi',
      'Perubahan frekuensi suara saat sumber suara bergerak mendekati atau menjauhi pendengar',
      'Kayu dan dawai kuda',
      'Internet adalah jaringan komputer global yang saling terhubung',
      'Enzim membantu mempercepat reaksi kimia dalam tubuh',
      'Senyawa kimia yang dikenal sebagai air',
      'J.K. Rowling',
      'Produksi protein dalam sel',
      'Teori yang dikemukakan oleh Albert Einstein mengenai hubungan antara ruang dan waktu',
      'Dibentuk oleh erosi air yang mengikis batuan',
      'Tumbuhan yang memiliki bunga untuk reproduksi',
      'Peningkatan suhu rata-rata global Bumi akibat aktivitas manusia',
      'Mitokondria adalah tempat produksi energi dalam sel',
      'Isaac Newton',
      'Sistem yang memproses makanan menjadi nutrisi untuk tubuh',
      'Unsur terdiri dari atom dengan nomor atom yang sama, sedangkan senyawa terdiri dari unsur-unsur yang terikat bersama',
      'Wilayah di ruang waktu di mana gaya gravitasi sangat kuat sehingga tidak ada apa pun yang dapat keluar darinya',
      'Proses di mana tumbuhan menggunakan energi matahari untuk mengubah karbon dioksida dan air menjadi gula',
      'Teori yang menjelaskan awal alam semesta dari ledakan besar',
      'Klorofil mengubah energi matahari menjadi energi kimia selama fotosintesis',
      'William Shakespeare',
      'Biru',
      'Soekarno',
      '35',
      'Tokyo',
      'Isaac Newton',
    ];

    $j = 0;
    for ($i = 1; $i <= count($answers); $i++) {
      if ($i % 2) {
        $j++;
      }
      DB::table('answers')->insert([
        'user_id' => ($i % 10 == 0) ? 10 : $i % 10,
        'question_id' => $i,
        'text' => $answers[$i - 1],
        'image' => ($i % 2 == 0 && $j <= 8) ? $j . '.jpeg' : null,
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    // Komentar
    $comments = [
      'Sangat tepat, klorofil menghasilkan makanan bagi tumbuhan.',
      'Benar, mesin jet bekerja dengan pembakaran bahan bakar untuk menghasilkan dorongan.',
      'Benar, pemanasan global terjadi akibat aktivitas manusia.',
      'Benar, Mona Lisa dilukis oleh Leonardo da Vinci.',
      'Tepat, algoritma adalah langkah-langkah untuk menyelesaikan masalah.',
      'Anda benar, mitokondria berperan dalam produksi energi dalam sel.',
      'Benar, fotosintesis adalah proses konversi energi matahari menjadi makanan bagi tumbuhan.',
      'Anda benar, Bumi terdiri dari lapisan-lapisan yang berbeda.',
      'Tepat, hukum Newton pertama menyatakan bahwa benda cenderung tetap dalam keadaan diam atau bergerak dengan kecepatan konstan.',
      'Betul, Andrea Hirata adalah penulis novel "Laskar Pelangi".',
      'Benar, sistem kekebalan tubuh melindungi tubuh dari patogen.',
      'Benar, virus dan bakteri memiliki perbedaan dalam struktur dan sifat.',
      'Tepat, teori evolusi menjelaskan bagaimana spesies berkembang.',
      'Anda benar, sel surya mengubah energi matahari menjadi energi listrik.',
      'Betul, Thomas Edison adalah penemu bola lampu.',
      'Benar, efek rumah kaca terkait dengan peningkatan suhu akibat gas-gas tertentu di atmosfer.',
      'Benar, revolusi industri mengubah masyarakat melalui perkembangan teknologi.',
      'Tepat, William Shakespeare adalah penulis drama "Romeo dan Juliet".',
      'Anda benar, otak mengendalikan fungsi tubuh dan pikiran.',
      'Betul, DNA mengandung informasi genetik dalam sel.',
      'Benar, bintang terbentuk melalui gravitasi dan tekanan gas.',
      'Anda benar, mare di bulan disebabkan oleh dampak benda luar angkasa.',
      'Benar, burung pengicau memiliki suara kicauan yang indah.',
      'Benar, Barack Obama adalah presiden Amerika Serikat ke-44.',
      'Tepat, mitosis dan meiosis adalah proses pembelahan sel yang berbeda.',
      'Benar, efek Doppler terkait dengan perubahan frekuensi suara akibat pergerakan sumber suara.',
      'Tepat, biola terbuat dari kayu dan dawai kuda.',
      'Anda benar, internet adalah jaringan komputer global.',
      'Benar, enzim mempercepat reaksi kimia dalam tubuh.',
      'Betul, H2O adalah rumus kimia untuk air.',
      'Tepat, J.K. Rowling adalah penulis novel "Harry Potter".',
      'Benar, ribosom berperan dalam produksi protein dalam sel.',
      'Anda benar, teori relativitas menjelaskan hubungan antara ruang dan waktu.',
      'Betul, goa-goa alam terbentuk melalui erosi batuan.',
      'Benar, tumbuhan berbunga memiliki bunga untuk reproduksi.',
      'Anda benar, pemanasan global terjadi akibat aktivitas manusia.',
      'Benar, mitokondria adalah "pabrik" energi dalam sel.',
      'Betul, Isaac Newton merumuskan hukum gravitasi.',
      'Tepat, sistem pencernaan memproses makanan untuk tubuh.',
      'Benar, unsur dan senyawa memiliki perbedaan dalam komposisi atom.',
      'Anda benar, lubang hitam memiliki gravitasi yang sangat kuat.',
      'Betul, fotosintesis melibatkan konversi energi matahari menjadi gula.',
      'Tepat, teori big bang menjelaskan asal usul alam semesta.',
      'Anda benar, klorofil mengubah energi matahari menjadi energi kimia.',
      'Betul, William Shakespeare adalah penulis drama "Hamlet".',
      'Benar, langit biasanya terlihat berwarna biru.',
      'Betul, Soekarno adalah presiden pertama Indonesia.',
      'Tepat, 5 kali 7 adalah 35.',
      'Iya, ibukota Jepang adalah Tokyo.',
      'Anda benar, Isaac Newton adalah penemu gravitasi.',
    ];

    for ($i = 1; $i <= count($comments); $i++) {
      DB::table('comments')->insert([
        'user_id' => ($i % 10 == 0) ? 10 : $i % 10,
        'comment' => $comments[$i - 1],
        'commentable_id' => $i,
        'commentable_type' => 'App\Models\Answer',
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    // Report
    // Topik
    $report_comment_types = [
      'Pelecehan',
      'Spam',
    ];

    $report_answer_types = [
      'Pelecehan',
      'Spam',
      'Tidak menjawab pertanyaan',
      'Peniruan',
      'Jawaban seperti lelucon',
      'Penyesatan informasi yang berbahaya',
      'Kredensial yang tidak pantas',
      'Hoax',
      'Konten dewasa',
    ];

    $report_question_types = [
      'Pelecehan',
      'Spam',
      'Jawaban seperti lelucon',
      'Penyesatan informasi yang berbahaya',
      'Topik salah',
    ];

    // Report Answer
    for ($i = 1; $i <= count($report_answer_types); $i++) {
      DB::table('report_answers')->insert([
        'user_id' => ($i % 10 == 0) ? 10 : $i % 10,
        'answer_id' => $i,
        'type' => $report_answer_types[$i - 1],
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    // Report Comment
    for ($i = 1; $i <= count($report_comment_types); $i++) {
      DB::table('report_comments')->insert([
        'user_id' => ($i % 10 == 0) ? 10 : $i % 10,
        'comment_id' => $i,
        'type' => $report_comment_types[$i - 1],
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    // Report Question
    for ($i = 1; $i <= count($report_question_types); $i++) {
      DB::table('report_questions')->insert([
        'user_id' => ($i % 10 == 0) ? 10 : $i % 10,
        'question_id' => $i,
        'type' => $report_question_types[$i - 1],
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    // FAQ
    $faqs = [
      'Apa itu website Bebras?',
      'Bagaimana cara menggunakan website ini?',
      'Apakah saya perlu membuat akun untuk mengakses pertanyaan dan jawaban?',
      'Bagaimana cara mengajukan pertanyaan di website ini?',
      'Bisakah saya menjawab pertanyaan tanpa membuat akun?',
      'Apakah konten di website ini dimoderasi?',
      'Bagaimana cara mengedit atau menghapus jawaban saya?',
      'Apakah saya bisa mengikuti topik atau kategori tertentu?',
      'Apakah ada fitur poin atau penghargaan di website ini?',
      'Bagaimana cara melaporkan konten yang tidak pantas atau melanggar aturan?',
    ];

    $answerFaqs = [
      'Website Bebras adalah platform tanya jawab di mana pengguna dapat mengajukan pertanyaan dan memberikan jawaban serta berbagi pengetahuan.',
      'Untuk menggunakan website ini, Anda perlu membuat akun atau masuk jika sudah memiliki akun. Setelah itu, Anda bisa mulai menjelajahi pertanyaan, memberikan jawaban, dan berinteraksi dengan komunitas.',
      'Ya, Anda perlu membuat akun untuk dapat mengajukan pertanyaan dan memberikan jawaban di website ini. Namun, beberapa pertanyaan dapat diakses tanpa perlu masuk.',
      'Anda dapat mengajukan pertanyaan baru dengan mengklik tombol "Ajukan Pertanyaan" atau yang serupa. Isi detail pertanyaan Anda dan pilih kategori yang sesuai sebelum mengirimkannya.',
      'Sebagian besar platform memerlukan akun untuk memberikan jawaban. Namun, persyaratan ini mungkin bervariasi tergantung pada aturan situs ini.',
      'Ya, konten di website ini biasanya dimoderasi untuk menjaga kualitas dan keamanan. Konten yang melanggar pedoman komunitas atau tidak pantas dapat dihapus oleh moderator.',
      'Anda biasanya dapat mengedit atau menghapus jawaban Anda dengan masuk ke akun Anda, menavigasi ke pertanyaan yang berisi jawaban Anda, dan mengikuti petunjuk untuk mengedit atau menghapus.',
      'Tentu, Anda bisa mengikuti topik atau kategori tertentu yang menarik bagi Anda. Ini akan membantu Anda mendapatkan pembaruan tentang pertanyaan dan jawaban terkait topik tersebut.',
      'Ya, banyak platform serupa memiliki sistem poin atau penghargaan. Anda bisa mendapatkan poin dengan menjawab pertanyaan dengan baik, mendapatkan suka, dan berkontribusi secara positif pada komunitas.',
      'Jika Anda menemukan konten yang tidak pantas atau melanggar aturan, biasanya ada opsi untuk melaporkannya. Biasanya, ada tombol "laporkan" di bawah konten yang Anda curigai.',
    ];

    for ($i = 0; $i < count($faqs); $i++) {
      DB::table('faqs')->insert([
        'title' => $faqs[$i],
        'text' => $answerFaqs[$i],
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }
  }
}
