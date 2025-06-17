<?php

namespace Database\Seeders;

use App\Models\Paket;
use App\Models\Soal;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class SoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Get all paket IDs or create one if none exists
        $paketIds = Paket::pluck('id')->toArray();
        if (empty($paketIds)) {
            $paket = Paket::create([
                'nama' => 'Paket Soal Default',
                'deskripsi' => 'Paket soal yang dibuat otomatis oleh seeder',
                'durasi' => 90,
                'status' => 'aktif',
            ]);
            $paketIds = [$paket->id];
        }

        // Question subjects
        $subjects = [
            'matematika' => [
                'pertanyaan' => [
                    'Hitunglah hasil dari %d + %d × %d',
                    'Jika x² + %d = %d, maka nilai x adalah',
                    'Sebuah segitiga memiliki panjang alas %d cm dan tinggi %d cm. Berapakah luas segitiga tersebut?',
                    'Jika log(%d) = 2, maka nilai %d adalah',
                    'Sebuah lingkaran memiliki jari-jari %d cm. Berapakah luas lingkaran tersebut? (π = 3.14)',
                ],
                'options' => function ($faker, $question) {
                    // Extract numbers from question for calculations
                    preg_match_all('/\d+/', $question, $matches);
                    $numbers = $matches[0];

                    // Generate appropriate answers based on the question
                    if (strpos($question, 'Hitunglah hasil dari') !== false) {
                        $a = intval($numbers[0]);
                        $b = intval($numbers[1]);
                        $c = intval($numbers[2]);
                        $correct = $a + ($b * $c);

                        return [
                            'A' => $correct,
                            'B' => $correct + $faker->numberBetween(1, 5),
                            'C' => $correct - $faker->numberBetween(1, 5),
                            'D' => $a * $b * $c,
                            'E' => $a * $b + $c,
                            'correct' => 'A',
                        ];
                    } elseif (strpos($question, 'x²') !== false) {
                        $a = intval($numbers[0]);
                        $b = intval($numbers[1]);
                        $correct = sqrt($b - $a);

                        return [
                            'A' => $correct - 1,
                            'B' => $correct,
                            'C' => -$correct,
                            'D' => sqrt($b + $a),
                            'E' => $b - $a,
                            'correct' => 'B',
                        ];
                    } elseif (strpos($question, 'segitiga') !== false) {
                        $a = intval($numbers[0]);
                        $b = intval($numbers[1]);
                        $correct = 0.5 * $a * $b;

                        return [
                            'A' => $correct,
                            'B' => $a * $b,
                            'C' => $correct + $faker->numberBetween(1, 5),
                            'D' => $correct - $faker->numberBetween(1, 5),
                            'E' => 2 * $correct,
                            'correct' => 'A',
                        ];
                    } elseif (strpos($question, 'log') !== false) {
                        $a = intval($numbers[0]);
                        $correct = 100;

                        return [
                            'A' => $correct / 10,
                            'B' => $correct * 10,
                            'C' => $correct,
                            'D' => $a * 2,
                            'E' => pow($a, 2),
                            'correct' => 'C',
                        ];
                    } elseif (strpos($question, 'lingkaran') !== false) {
                        $r = intval($numbers[0]);
                        $correct = 3.14 * $r * $r;

                        return [
                            'A' => 2 * 3.14 * $r,
                            'B' => 3.14 * $r,
                            'C' => $correct + $faker->numberBetween(1, 5),
                            'D' => $correct,
                            'E' => $r * $r,
                            'correct' => 'D',
                        ];
                    }

                    // Default options if no specific formula matches
                    return [
                        'A' => $faker->numberBetween(10, 50),
                        'B' => $faker->numberBetween(51, 100),
                        'C' => $faker->numberBetween(101, 150),
                        'D' => $faker->numberBetween(151, 200),
                        'E' => $faker->numberBetween(201, 250),
                        'correct' => $faker->randomElement(['A', 'B', 'C', 'D', 'E']),
                    ];
                },
            ],

            'bahasa_indonesia' => [
                'pertanyaan' => [
                    'Manakah penggunaan tanda baca yang tepat dalam kalimat berikut?',
                    'Arti dari kata "%s" adalah',
                    'Kalimat berikut yang menggunakan majas personifikasi adalah',
                    'Makna dari peribahasa "%s" adalah',
                    'Manakah yang merupakan contoh kalimat efektif?',
                ],
                'options' => function ($faker, $question) {
                    // Generate appropriate answers based on the question
                    if (strpos($question, 'tanda baca') !== false) {
                        return [
                            'A' => 'Saya pergi ke pasar, membeli sayur dan buah.',
                            'B' => 'Saya pergi, ke pasar membeli sayur, dan buah.',
                            'C' => 'Saya pergi ke pasar membeli sayur dan buah',
                            'D' => 'Saya pergi, ke pasar, membeli sayur dan buah.',
                            'E' => 'Saya, pergi ke pasar membeli sayur dan buah.',
                            'correct' => 'A',
                        ];
                    } elseif (strpos($question, 'Arti dari kata') !== false) {
                        // Common Indonesian words with meanings
                        $words = [
                            'Gemilang' => 'Cemerlang atau sangat bagus',
                            'Suaka' => 'Tempat untuk berlindung atau mengungsi',
                            'Hakiki' => 'Sebenarnya atau sesungguhnya',
                            'Khalayak' => 'Orang banyak atau masyarakat',
                            'Lugas' => 'Tanpa hiasan atau polos',
                        ];

                        $word = array_rand($words);
                        $correct = $words[$word];

                        // Replace placeholder with the word
                        $question = str_replace('%s', $word, $question);

                        // Shuffle and get other words as incorrect answers
                        $incorrectAnswers = array_diff($words, [$correct]);
                        $incorrectValues = array_values($incorrectAnswers);

                        return [
                            'A' => $correct,
                            'B' => $incorrectValues[0],
                            'C' => $incorrectValues[1],
                            'D' => $incorrectValues[2],
                            'E' => $incorrectValues[3],
                            'correct' => 'A',
                            'question' => $question,
                        ];
                    } elseif (strpos($question, 'majas personifikasi') !== false) {
                        return [
                            'A' => 'Dia sangat pandai seperti Einstein.',
                            'B' => 'Angin berbisik di telingaku.',
                            'C' => 'Rumahnya sangat besar.',
                            'D' => 'Dia adalah bunga di antara kaktus.',
                            'E' => 'Saya akan bekerja keras untuk itu.',
                            'correct' => 'B',
                        ];
                    } elseif (strpos($question, 'peribahasa') !== false) {
                        // Indonesian proverbs and meanings
                        $proverbs = [
                            'Air beriak tanda tak dalam' => 'Orang yang banyak bicara biasanya sedikit ilmunya',
                            'Bagai air di daun talas' => 'Tidak tetap pendirian',
                            'Ada gula ada semut' => 'Di mana ada keuntungan, di situ orang akan berkumpul',
                            'Berat sama dipikul, ringan sama dijinjing' => 'Bekerja sama dalam suka dan duka',
                        ];

                        $proverb = array_rand($proverbs);
                        $correct = $proverbs[$proverb];

                        // Replace placeholder with proverb
                        $question = str_replace('%s', $proverb, $question);

                        // Shuffle and get other meanings as incorrect answers
                        $incorrectAnswers = array_diff($proverbs, [$correct]);
                        $incorrectValues = array_values($incorrectAnswers);

                        return [
                            'A' => $incorrectValues[0],
                            'B' => $incorrectValues[1],
                            'C' => $incorrectValues[2],
                            'D' => $correct,
                            'E' => 'Semua jawaban di atas salah',
                            'correct' => 'D',
                            'question' => $question,
                        ];
                    } elseif (strpos($question, 'kalimat efektif') !== false) {
                        return [
                            'A' => 'Kami mendiskusikan tentang masalah politik.',
                            'B' => 'Surat itu sudah saya kirimkan kemarin.',
                            'C' => 'Para hadirin sekalian diharapkan tenang.',
                            'D' => 'Dia merasa amat sangat sedih sekali.',
                            'E' => 'Dalam hal ini saya mau menyimpulkan bahwa...',
                            'correct' => 'B',
                        ];
                    }

                    // Default options
                    return [
                        'A' => $faker->sentence(6),
                        'B' => $faker->sentence(6),
                        'C' => $faker->sentence(6),
                        'D' => $faker->sentence(6),
                        'E' => $faker->sentence(6),
                        'correct' => $faker->randomElement(['A', 'B', 'C', 'D', 'E']),
                    ];
                },
            ],

            'pengetahuan_umum' => [
                'pertanyaan' => [
                    'Ibukota %s adalah',
                    'Siapakah penemu %s?',
                    '%s adalah nama lain dari',
                    'Mata uang resmi %s adalah',
                    'Peristiwa %s terjadi pada tahun',
                ],
                'options' => function ($faker, $question) {
                    if (strpos($question, 'Ibukota') !== false) {
                        $countries = [
                            'Indonesia' => 'Jakarta',
                            'Malaysia' => 'Kuala Lumpur',
                            'Jepang' => 'Tokyo',
                            'Thailand' => 'Bangkok',
                            'Filipina' => 'Manila',
                        ];

                        $country = array_rand($countries);
                        $correct = $countries[$country];

                        // Replace placeholder with country
                        $question = str_replace('%s', $country, $question);

                        // Shuffle and get other cities as incorrect answers
                        $incorrectAnswers = array_diff($countries, [$correct]);
                        $incorrectValues = array_values($incorrectAnswers);

                        return [
                            'A' => $incorrectValues[0],
                            'B' => $correct,
                            'C' => $incorrectValues[1],
                            'D' => $incorrectValues[2],
                            'E' => $incorrectValues[3],
                            'correct' => 'B',
                            'question' => $question,
                        ];
                    }

                    // Default options - this is just a placeholder for brevity
                    $choices = ['A', 'B', 'C', 'D', 'E'];
                    $correctIndex = array_rand($choices);

                    return [
                        'A' => $faker->word,
                        'B' => $faker->word,
                        'C' => $faker->word,
                        'D' => $faker->word,
                        'E' => $faker->word,
                        'correct' => $choices[$correctIndex],
                    ];
                },
            ],
        ];

        // Create 200 questions
        for ($i = 0; $i < 200; $i++) {
            // Select random subject and question template
            $subject = array_rand($subjects);
            $subjectData = $subjects[$subject];
            $questionTemplate = $faker->randomElement($subjectData['pertanyaan']);

            // Fill in template placeholders
            if (strpos($questionTemplate, '%d') !== false) {
                $questionText = sprintf(
                    $questionTemplate,
                    $faker->numberBetween(1, 20),
                    $faker->numberBetween(1, 20),
                    $faker->numberBetween(1, 20)
                );
            } elseif (strpos($questionTemplate, '%s') !== false) {
                // For string placeholders, create temporary question for options generation
                $tempQuestion = $questionTemplate;
                $options = $subjectData['options']($faker, $tempQuestion);

                // If options function returned a modified question, use it
                if (isset($options['question'])) {
                    $questionText = $options['question'];
                } else {
                    $questionText = sprintf($questionTemplate, $faker->word);
                }
            } else {
                $questionText = $questionTemplate;
            }

            // Generate options
            $options = $subjectData['options']($faker, $questionText);
            $correctAnswer = $options['correct'];

            // Create the question
            Soal::create([
                'paket_id' => $faker->randomElement($paketIds),
                'pertanyaan' => $questionText,
                'pilihan_a' => $options['A'],
                'pilihan_b' => $options['B'],
                'pilihan_c' => $options['C'],
                'pilihan_d' => $options['D'],
                'pilihan_e' => $options['E'],
                'jawaban_benar' => $correctAnswer,
                'pembahasan' => $faker->paragraph(2),
            ]);
        }
    }
}
