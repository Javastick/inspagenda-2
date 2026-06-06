<?php

namespace Database\Factories;

use App\Models\Division;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuditorFactory extends Factory
{
    /**
     * Template nama-nama auditor beserta divisi mereka.
     * Silakan tambahkan atau ubah daftar ini sesuai kebutuhan (tambahkan koma di akhir array).
     */
    public static array $defaultAuditors = [
        //Sekretariat
        ['name' => 'Zaenudin, S.A.P',     'division_id' => 7], 
        ['name' => 'Ghilman Zaka Prayogi, S.Kom.',     'division_id' => 7], 
        ['name' => 'Muhammad Danu Pranowo, S.Tr.I.P',     'division_id' => 7], 
        ['name' => 'Galuh Sekar Arum K, S.Pd',     'division_id' => 7], 
        ['name' => 'Yogi Dwi Herbima',     'division_id' => 7], 
        ['name' => 'Galuh Maharani, SE',     'division_id' => 7], 
        ['name' => 'Insan Susilo Adi, SE',     'division_id' => 7], 
        ['name' => 'Hadi Widyaningsih, SE',     'division_id' => 7], 
        ['name' => 'Dwi Nanda Andriawan, S.H.',     'division_id' => 7], 
        ['name' => 'Lina Sulistyaningrum, A.Md.',     'division_id' => 7], 
        ['name' => 'Sudi Harsono',     'division_id' => 7], 
        ['name' => 'Satrio Tristiadi, SE, MAP',     'division_id' => 7], 
        ['name' => 'Syukron Baihaqi , S.Sos.',     'division_id' => 7], 
        ['name' => 'Burhanudin Yusuf, A.Md.',     'division_id' => 7], 
        ['name' => 'Sri Nurhayati, SE.',     'division_id' => 7], 
        ['name' => 'Heri Ismanto',     'division_id' => 7], 
        ['name' => 'Ade Edwin Irwanto, SE, MM',     'division_id' => 7], 
        ['name' => 'Hertia Aslamia, S.Farm',     'division_id' => 7], 
        ['name' => 'Dukri',     'division_id' => 7], 
        ['name' => 'Nieken Meiyana, Amd',     'division_id' =>  7], 
        ['name' => 'Agus Suciantoro, A.Md.',     'division_id' => 7], 

        // Inspektur
        ['name' => 'Sekretariat',      'division_id' => 1], 
        ['name' => 'Wilayah 1',      'division_id' => 1], 
        ['name' => 'Wilayah 2',      'division_id' => 1], 
        ['name' => 'Wilayah 3',      'division_id' => 1], 
        ['name' => 'Wilayah 4',      'division_id' => 1], 
        ['name' => 'Wilayah Khusus',      'division_id' => 1], 

        //Irban 1
        ['name' => 'Iman Parnoko, S.Ip',      'division_id' => 2], 
        ['name' => 'Hegar Wiratosan, S.Sos',      'division_id' => 2], 
        ['name' => 'Rina Purwaningsih, SE',      'division_id' => 2], 
        ['name' => 'Wulan Tri Hapsari, ST',      'division_id' => 2], 
        ['name' => 'Dani Pratama Putra, SH',      'division_id' => 2], 
        ['name' => 'Lina Setiawati, S.Ip',      'division_id' => 2], 
        ['name' => 'Tono Irianto, SH',      'division_id' =>  2],  
        ['name' => 'Farah Diena Amelia, ST',      'division_id' => 2], 
        ['name' => 'Aris Setyawan, SE',      'division_id' => 2], 
        ['name' => 'Akhmad Jazuli, S.Farm',      'division_id' => 2], 

        // Irban 2
        ['name' => 'Suyekti, SP, M.Si',     'division_id' => 3], 
        ['name' => 'Karnadi, SE',     'division_id' => 3], 
        ['name' => 'Ema Kusuma Dewi, S.Ip, M.Si',     'division_id' => 3], 
        ['name' => 'Dimas Ramadhan, SE',     'division_id' => 3], 
        ['name' => 'Vioni Rahma Soleha, ST',     'division_id' => 3], 
        ['name' => 'Teguh Santoso Yulaiawan, A.Md',     'division_id' => 3], 
        ['name' => 'Adi Surya Triswtiawan, SE',     'division_id' => 3], 
        ['name' => 'Nur Rizki Hardiansyah, ST',     'division_id' => 3], 
        ['name' => 'Widiyawati, S.Farm',     'division_id' => 3], 
        ['name' => 'Kokoh Junia K, SH',     'division_id' => 3], 

        // Irban 3
        ['name' => 'Herbagoes Tri N, SE',    'division_id' => 4], 
        ['name' => 'Yudha Widhaswara, SE',    'division_id' => 4], 
        ['name' => 'Beno Sulistyo T, ST',    'division_id' => 4], 
        ['name' => 'Iwan Hermawan, S.Sos',    'division_id' => 4], 
        ['name' => 'Pratiwi Triana NP, SH',    'division_id' => 4], 
        ['name' => 'Istikhanah, SE',    'division_id' => 4], 
        ['name' => 'Casta, SE',    'division_id' => 4], 
        ['name' => 'Norma Sagita, SE ',    'division_id' => 4], 
        ['name' => 'Elok Prihatin, S.Ap',    'division_id' => 4], 
        ['name' => 'Sukardi Prastyo, A.Md',    'division_id' => 4], 
        
        // Irban 4
        ['name' => 'M Agus P, S.Ip',     'division_id' => 5], 
        ['name' => 'Muktapa, S.Si',     'division_id' => 5], 
        ['name' => 'Saeful Alam, SH',     'division_id' => 5], 
        ['name' => 'Deks Sazha Salsabil, ST',     'division_id' => 5], 
        ['name' => 'Nur Retno Ningsih, SE',     'division_id' => 5], 
        ['name' => 'Dita Amalia Safitri, SIP',     'division_id' => 5], 
        ['name' => 'Ilham Santoso, SH',     'division_id' => 5], 
        ['name' => 'Indira Surya Kumala, ST',     'division_id' => 5], 
        ['name' => 'Zibda Syafaqoti, S.Ak',     'division_id' => 5], 
        ['name' => 'Hanna Firdaus FK, A.Md',     'division_id' => 5], 

        // Irban Khusus
        ['name' => 'Adi Susanto, ST',    'division_id' => 6],
        ['name' => 'M. Nasir A, S.S, M.Ap',    'division_id' => 6],
        ['name' => 'Erlinda Octaviana K.SE',    'division_id' => 6],
        ['name' => 'Ahmad Faqih Hermawan, S.T.',    'division_id' => 6],
        ['name' => 'Anisatun Ma\'sumah, S.E.',    'division_id' => 6],
        ['name' => 'Asa Septa Nugraha, S.E.',    'division_id' => 6],
        ['name' => 'Nur Chotimah, S.Ak.',    'division_id' => 6],
        ['name' => 'Dina Wahyu Pritaningtias, S.H',    'division_id' => 6],
        ['name' => 'Afwan Abdi Salam, S.I.A.',    'division_id' => 6],
        ['name' => 'Gemilang Dwi Anandika, S.H.',    'division_id' => 6],
        ['name' => 'Mohammad Lutfi Mustofa, S.I.P.',    'division_id' => 6],
    ];

    private static int $index = 0;

    public function definition(): array
    {
        // Jika data pada template masih ada, gunakan data dari template
        if (self::$index < count(self::$defaultAuditors)) {
            $auditor = self::$defaultAuditors[self::$index];
            self::$index++;
            
            return [
                'division_id' => $auditor['division_id'],
                'name'        => $auditor['name'],
            ];
        }

        // Jika template habis (misalnya factory dipanggil lebih dari jumlah array), fallback ke data acak
        return [
            'division_id' => Division::inRandomOrder()->first()?->id ?? 1,
            'name'        => $this->faker->name(),
        ];
    }
}
