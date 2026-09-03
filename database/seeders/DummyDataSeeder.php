<?php

namespace Database\Seeders;

use App\Models\Archive;
use App\Models\ArtNews;
use App\Models\Artwork;
use App\Models\CompanyProfile;
use App\Models\ContactSetting;
use App\Models\CulturalExploration;
use App\Models\InboxMessage;
use App\Models\OprecRegistration;
use App\Models\OprecSetting;
use App\Models\OrganizationMember;
use App\Models\PageHero;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DummyDataSeeder extends Seeder
{
    /**
     * Helper to download image or create fallback image.
     */
    protected function saveImage(string $url, string $relativePath, string $label = ''): string
    {
        $fullPath = storage_path('app/public/' . $relativePath);
        $dir = dirname($fullPath);

        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        // If file already exists and is valid (> 1KB), reuse it
        if (file_exists($fullPath) && filesize($fullPath) > 1024) {
            return $relativePath;
        }

        // Try downloading image via cURL
        $downloaded = false;
        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 12);
            $data = curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($code === 200 && $data && strlen($data) > 1024) {
                file_put_contents($fullPath, $data);
                $downloaded = true;
            }
        }

        // Fallback: Generate clean styled canvas image using GD
        if (!$downloaded && extension_loaded('gd')) {
            $width = 1200;
            $height = 800;
            $image = imagecreatetruecolor($width, $height);
            $bgColor = imagecolorallocate($image, 15, 23, 42); // Dark Slate / Navy
            $textColor = imagecolorallocate($image, 212, 175, 55); // Gold
            $subTextColor = imagecolorallocate($image, 255, 255, 255); // White

            imagefilledrectangle($image, 0, 0, $width, $height, $bgColor);
            
            // Draw subtle frame
            $borderColor = imagecolorallocate($image, 45, 55, 72);
            imagerectangle($image, 20, 20, $width - 20, $height - 20, $borderColor);

            $displayText = $label ?: basename($relativePath);
            imagestring($image, 5, 40, 40, 'UKM SENI BUDAYA UNIVERSITAS PAKUAN', $textColor);
            imagestring($image, 5, 40, 80, $displayText, $subTextColor);

            imagejpeg($image, $fullPath, 90);
            imagedestroy($image);
        }

        return $relativePath;
    }

    public function run(): void
    {
        $this->command->info('Memulai seeding data lengkap dengan foto aset...');

        // 1. Akun Pengguna
        $admin = User::updateOrCreate(
            ['email' => 'admin@usb.com'],
            [
                'name' => 'Admin Utama',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'editor@usb.com'],
            [
                'name' => 'Editor Konten',
                'password' => Hash::make('password'),
                'role' => 'editor',
            ]
        );

        User::updateOrCreate(
            ['email' => 'author1@usb.com'],
            [
                'name' => 'Author Satu',
                'password' => Hash::make('password'),
                'role' => 'author',
            ]
        );

        // 2. Company Profile
        $structImg = $this->saveImage(
            'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&q=80',
            'company-profiles/struktur_organisasi.jpg',
            'Bagan Struktur Organisasi UKM Seni Budaya'
        );

        CompanyProfile::updateOrCreate(['id' => 1], [
            'history' => '<p>Unit Kegiatan Mahasiswa Seni dan Budaya (USB) Universitas Pakuan didirikan sebagai wadah ekspresi, eksplorasi, dan pelestarian seni budaya bagi seluruh mahasiswa. Sejak awal berdirinya, USB terus bertumbuh menjadi episentrum kreativitas yang menaungi berbagai divisi kesenian mulai dari musik tradisional dan modern, seni rupa, teater, hingga karya multimedia visual.</p><p>Melalui semangat kolaborasi dan kecintaan pada warisan nusantara, USB berkomitmen melahirkan karya-karya bermakna dan menjaga nyala api kebudayaan di lingkungan kampus maupun masyarakat luas.</p>',
            'vision_mission' => '<h3>Visi</h3><p>Menjadi unit kegiatan mahasiswa terdepan dalam merawat, mengembangkan, dan mempromosikan nilai-nilai seni dan budaya nusantara melalui inovasi kreatif generasi muda yang berkarakter dan berdaya saing global.</p><h3>Misi</h3><ul><li>Membina potensi dan bakat mahasiswa dalam bidang seni rupa, musik, teater, dan media visual.</li><li>Menggelar pameran, festival seni, dan pentas karya secara berkala untuk apresiasi publik.</li><li>Mendokumentasikan serta mengarsipkan ragam tradisi dan kekayaan budaya daerah.</li><li>Membangun jejaring kolaborasi kreatif lintas komunitas seni tingkat regional maupun nasional.</li></ul>',
            'logo_philosophy' => '<p>Logo UKM Seni Budaya memadukan ornamen sulur nusantara berwarna emas (*gold*) yang melambangkan keagungan cipta rasa karsa, dilingkupi warna biru maritim yang menggambarkan kedalaman intelektual dan keberanian berinovasi.</p>',
            'organization_structure_image' => $structImg,
            'departments' => '<ul><li><strong>Divisi Seni Musik:</strong> Karawitan, gamelan Sunda, paduan suara, dan musik akustik kontemporer.</li><li><strong>Divisi Seni Rupa:</strong> Lukis, seni kriya, mural, ilustrasi, dan desain grafis.</li><li><strong>Divisi Seni Teater & Sastra:</strong> Seni peran, monolog, kepenulisan naskah, dan puisi panggung.</li><li><strong>Divisi Media & Dokumentasi:</strong> Fotografi etnografi, sinematografi dokumenter, dan arsip visual digital.</li><li><strong>Divisi Humas & Kemitraan:</strong> Hubungan eksternal, festival management, dan publikasi media.</li></ul>',
        ]);

        // 3. Contact Setting
        ContactSetting::updateOrCreate(['id' => 1], [
            'email' => 'ukmsenibudaya@unpak.ac.id',
            'address' => 'Gedung Student Center (Ormawa) Lt. 2, Universitas Pakuan, Jl. Pakuan No. 1, Baranangsiang, Bogor, Jawa Barat 16143',
            'instagram' => 'https://instagram.com/ukmsenibudaya_unpak',
            'youtube' => 'https://youtube.com/@ukmsenibudaya',
            'tiktok' => 'https://tiktok.com/@ukmsenibudaya',
        ]);

        // 4. Page Heroes (Banner ganda dinamis untuk setiap halaman)
        $heroesData = [
            [
                'page_name' => 'Beranda',
                'img1_url' => 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=1600&q=80',
                'img1_file' => 'page-heroes/beranda_1.jpg',
                'img2_url' => 'https://images.unsplash.com/photo-1460661419201-fd4cecdf8a8b?w=1600&q=80',
                'img2_file' => 'page-heroes/beranda_2.jpg',
            ],
            [
                'page_name' => 'Tentang',
                'img1_url' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1600&q=80',
                'img1_file' => 'page-heroes/tentang_1.jpg',
                'img2_url' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=1600&q=80',
                'img2_file' => 'page-heroes/tentang_2.jpg',
            ],
            [
                'page_name' => 'Karya',
                'img1_url' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=1600&q=80',
                'img1_file' => 'page-heroes/karya_1.jpg',
                'img2_url' => 'https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?w=1600&q=80',
                'img2_file' => 'page-heroes/karya_2.jpg',
            ],
            [
                'page_name' => 'Budaya',
                'img1_url' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=1600&q=80',
                'img1_file' => 'page-heroes/budaya_1.jpg',
                'img2_url' => 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?w=1600&q=80',
                'img2_file' => 'page-heroes/budaya_2.jpg',
            ],
            [
                'page_name' => 'Seni',
                'img1_url' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=1600&q=80',
                'img1_file' => 'page-heroes/seni_1.jpg',
                'img2_url' => 'https://images.unsplash.com/photo-1507676184212-d03ab07a01bf?w=1600&q=80',
                'img2_file' => 'page-heroes/seni_2.jpg',
            ],
            [
                'page_name' => 'Proyek',
                'img1_url' => 'https://images.unsplash.com/photo-1485846234645-a62644f84728?w=1600&q=80',
                'img1_file' => 'page-heroes/proyek_1.jpg',
                'img2_url' => 'https://images.unsplash.com/photo-1531403009284-440f080d1e12?w=1600&q=80',
                'img2_file' => 'page-heroes/proyek_2.jpg',
            ],
            [
                'page_name' => 'Arsip',
                'img1_url' => 'https://images.unsplash.com/photo-1457369804613-52c61a468e7d?w=1600&q=80',
                'img1_file' => 'page-heroes/arsip_1.jpg',
                'img2_url' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=1600&q=80',
                'img2_file' => 'page-heroes/arsip_2.jpg',
            ],
            [
                'page_name' => 'Kontak',
                'img1_url' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=1600&q=80',
                'img1_file' => 'page-heroes/kontak_1.jpg',
                'img2_url' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1600&q=80',
                'img2_file' => 'page-heroes/kontak_2.jpg',
            ],
            [
                'page_name' => 'Oprec',
                'img1_url' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=1600&q=80',
                'img1_file' => 'page-heroes/oprec_1.jpg',
                'img2_url' => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=1600&q=80',
                'img2_file' => 'page-heroes/oprec_2.jpg',
            ],
        ];

        foreach ($heroesData as $hero) {
            $p1 = $this->saveImage($hero['img1_url'], $hero['img1_file'], 'Hero ' . $hero['page_name'] . ' 1');
            $p2 = $this->saveImage($hero['img2_url'], $hero['img2_file'], 'Hero ' . $hero['page_name'] . ' 2');

            PageHero::updateOrCreate(
                ['page_name' => $hero['page_name']],
                [
                    'image_path' => $p1,
                    'image_path_2' => $p2,
                ]
            );
        }

        // 5. Struktur Pengurus (Organization Members)
        $membersData = [
            [
                'name' => 'Bima Arya Wicaksana',
                'position' => 'Ketua Umum',
                'department' => 'Badan Pengurus Harian',
                'img' => 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=600&q=80',
                'order' => 1,
            ],
            [
                'name' => 'Anindya Putri Rahayu',
                'position' => 'Wakil Ketua',
                'department' => 'Badan Pengurus Harian',
                'img' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600&q=80',
                'order' => 2,
            ],
            [
                'name' => 'Muhammad Farhan',
                'position' => 'Sekretaris Umum',
                'department' => 'Kesekretariatan',
                'img' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&q=80',
                'order' => 3,
            ],
            [
                'name' => 'Dinda Kirana Putri',
                'position' => 'Bendahara Umum',
                'department' => 'Kebendaharaan',
                'img' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=600&q=80',
                'order' => 4,
            ],
            [
                'name' => 'Reza Maulana Akbar',
                'position' => 'Koordinator Divisi',
                'department' => 'Seni Musik',
                'img' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=600&q=80',
                'order' => 5,
            ],
            [
                'name' => 'Nathania Clarissa',
                'position' => 'Koordinator Divisi',
                'department' => 'Seni Rupa',
                'img' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=600&q=80',
                'order' => 6,
            ],
            [
                'name' => 'Fajar Ramadhan',
                'position' => 'Koordinator Divisi',
                'department' => 'Seni Teater',
                'img' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=600&q=80',
                'order' => 7,
            ],
            [
                'name' => 'Siti Aisyah Nurhaliza',
                'position' => 'Koordinator Divisi',
                'department' => 'Humas & Media',
                'img' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=600&q=80',
                'order' => 8,
            ],
        ];

        OrganizationMember::truncate();
        foreach ($membersData as $idx => $m) {
            $imgPath = $this->saveImage($m['img'], 'organization-members/member_' . ($idx + 1) . '.jpg', $m['name']);
            OrganizationMember::create([
                'name' => $m['name'],
                'position' => $m['position'],
                'department' => $m['department'],
                'image_path' => $imgPath,
                'order_column' => $m['order'],
            ]);
        }

        // 6. Galeri Karya (Artworks)
        $artworksData = [
            [
                'title' => 'Gema Dawai Pasundan',
                'category' => 'Fotografi',
                'creator' => 'Aditya Pratama',
                'year' => 2025,
                'featured' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=1000&q=80',
                    'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=1000&q=80',
                ],
                'video_url' => null,
                'desc' => '<p>Karya fotografi yang menangkap dinamika petikan dawai kecapi tradisional Sunda dalam sorotan cahaya teatrikal panggung. Merefleksikan harmoni ritme kuno dengan ketenangan jiwa manusia modern.</p>',
            ],
            [
                'title' => 'Kala Senja di Kebun Raya Bogor',
                'category' => 'Fotografi',
                'creator' => 'Rian Hidayat',
                'year' => 2025,
                'featured' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=1000&q=80',
                ],
                'video_url' => null,
                'desc' => '<p>Eksplorasi siluet pepohonan purba dan pantulan cahaya emas di danau teratai Kebun Raya Bogor saat matahari berpulang. Merekam keteduhan Kota Hujan dalam sudut pandang lanskap alami.</p>',
            ],
            [
                'title' => 'Melodi Sunyi: Dokumenter Nada & Jiwa',
                'category' => 'Videografi',
                'creator' => 'Tim Sinematografi USB',
                'year' => 2025,
                'featured' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?w=1000&q=80',
                ],
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'desc' => '<p>Video dokumenter pendek berdurasi 7 menit yang mengisahkan dedikasi maestro pembuat suling bambu di lereng Gunung Salak dalam mewariskan nada-nada tradisi kepada generasi muda.</p>',
            ],
            [
                'title' => 'Jalinan Benang, Warisan Hayat',
                'category' => 'Photo Story',
                'creator' => 'Maya Anggraini',
                'year' => 2024,
                'featured' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1606744888344-498238981440?w=1000&q=80',
                    'https://images.unsplash.com/photo-1534447677768-be436bb09401?w=1000&q=80',
                ],
                'video_url' => null,
                'desc' => '<p>Rangkaian foto esai yang mengabadikan proses rumit pembuatan kain tenun ikat tradisional. Setiap helai benang merekam doa, kesabaran, dan kearifan lokal para pengrajin perempuan nusantara.</p>',
            ],
            [
                'title' => 'Topeng Cirebon: Balada Karakter Manusia',
                'category' => 'Dokumenter Visual',
                'creator' => 'Dimas Prasetyo',
                'year' => 2025,
                'featured' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1534447677768-be436bb09401?w=1000&q=80',
                ],
                'video_url' => null,
                'desc' => '<p>Dokumentasi visual 5 karakter topeng Cirebon (Panji, Samba, Rumyang, Tumenggung, Klana) yang merepresentasikan metamorfosis spiritual dan emosi manusia dari fitrah suci hingga amarah duniawi.</p>',
            ],
            [
                'title' => 'Goresan Cat dan Imajinasi Liar',
                'category' => 'Fotografi',
                'creator' => 'Sarah Melati',
                'year' => 2025,
                'featured' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1460661419201-fd4cecdf8a8b?w=1000&q=80',
                ],
                'video_url' => null,
                'desc' => '<p>Close-up macro photography dari tekstur kuas akrilik dan palet warna seniman kampus. Mencerminkan eksplorasi tanpa batas seni rupa kontemporer.</p>',
            ],
            [
                'title' => 'Dinamika Gerak Teater Jalanan',
                'category' => 'Fotografi',
                'creator' => 'Fauzan Rizky',
                'year' => 2024,
                'featured' => false,
                'images' => [
                    'https://images.unsplash.com/photo-1508700115892-45ecd05ae2ad?w=1000&q=80',
                ],
                'video_url' => null,
                'desc' => '<p>Dokumentasi aksi teatrikal ruang publik di kawasan Suryakencana Bogor, menyuarakan pesan perdamaian dan kerukunan warga multikultural.</p>',
            ],
            [
                'title' => 'Harmoni Orkestra Bambu',
                'category' => 'Photo Story',
                'creator' => 'Bagus Santoso',
                'year' => 2024,
                'featured' => false,
                'images' => [
                    'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=1000&q=80',
                ],
                'video_url' => null,
                'desc' => '<p>Foto cerita tentang konser angklung interaktif gabungan mahasiswa dan anak-anak panti asuhan, membuktikan musik adalah bahasa universal yang menyatukan.</p>',
            ],
        ];

        Artwork::truncate();
        foreach ($artworksData as $idx => $item) {
            $savedImages = [];
            foreach ($item['images'] as $subIdx => $imgUrl) {
                $savedImages[] = $this->saveImage(
                    $imgUrl,
                    'artworks/artwork_' . ($idx + 1) . '_' . ($subIdx + 1) . '.jpg',
                    $item['title'] . ' ' . ($subIdx + 1)
                );
            }

            Artwork::create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title'] . '-' . uniqid()),
                'description' => $item['desc'],
                'category' => $item['category'],
                'images' => $savedImages,
                'video_url' => $item['video_url'],
                'publication_year' => $item['year'],
                'creator_name' => $item['creator'],
                'is_featured' => $item['featured'],
                'is_published' => true,
                'user_id' => $admin->id,
            ]);
        }

        // 7. Eksplorasi Budaya (Cultural Exploration)
        $culturesData = [
            [
                'title' => 'Menyusuri Tradisi Seren Taun di Kasepuhan Banten Kidul',
                'category' => 'Tradisi',
                'location' => 'Sukabumi & Bogor, Jawa Barat',
                'img' => 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?w=1000&q=80',
                'tags' => ['Seren Taun', 'Adat Sunda', 'Kearifan Lokal', 'Panen Raya'],
                'content' => '<p>Seren Taun merupakan ritual tahunan masyarakat agraris Sunda sebagai wujud rasa syukur atas hasil panen padi yang melimpah sekaligus memohon berkah untuk musim tanam mendatang. Tradisi ini sarat dengan pesan penghormatan terhadap alam, tanah, dan Sang Pencipta.</p><p>Tim Eksplorasi Budaya USB berkesempatan mengikuti prosesi sakral penyerahan ikatan padi ke <em>Leuit Si Gajah Ngidek</em> (lumbung utama) dan menyaksikan pertunjukan seni rengkong, dogdog lojor, serta tari tarawangsa yang memukau.</p>',
            ],
            [
                'title' => 'Kisah Para Pengrajin Wayang Golek Bogor: Menjaga Pahatan Warisan Karuhun',
                'category' => 'Komunitas',
                'location' => 'Bogor, Jawa Barat',
                'img' => 'https://images.unsplash.com/photo-1563245372-f21724e3856d?w=1000&q=80',
                'tags' => ['Wayang Golek', 'Seni Kriya', 'Bogor', 'Budaya Sunda'],
                'content' => '<p>Di tengah kepungan era modernisasi, sanggar pembuatan wayang golek kayu di perkampungan Bogor tetap gigih memahat karakter tokoh pewayangan dari kayu albasiah dan lame. Setiap goresan pisau ukir membutuhkan ketelitian dan penghayatan karakter spiritual yang mendalam.</p><p>Melalui liputan ini, kami mendokumentasikan proses dari gelondongan kayu mentah hingga menjadi figur tokoh pewayangan lengkap dengan kostum beludru berhias sulaman emas.</p>',
            ],
            [
                'title' => 'Menenun Narasi Silam di Desa Tradisional Sasak Sade',
                'category' => 'Catatan Perjalanan',
                'location' => 'Lombok Tengah, NTB',
                'img' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=1000&q=80',
                'tags' => ['Tenun Ikat', 'Sasak Sade', 'Lombok', 'Etnografi'],
                'content' => '<p>Dusun Sade mempertahankan arsitektur rumah adat beralaskan tanah liat dan kotoran kerbau kering yang bersih dari bau. Namun yang paling memikat adalah denting kayu alat tenun tradisional yang dimainkan para perempuan desa sejak usia belia.</p><p>Kain tenun songket Sade bukan sekadar busana, melainkan dokumen sejarah visual yang memuat motif-motif filosofis tentang kosmologi dan keteguhan perempuan Sasak.</p>',
            ],
            [
                'title' => 'Ritual Megibung: Simbol Persaudaraan di Ujung Timur Pulau Dewata',
                'category' => 'Liputan Budaya',
                'location' => 'Karangasem, Bali',
                'img' => 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?w=1000&q=80',
                'tags' => ['Megibung', 'Bali', 'Kuliner Budaya', 'Kebersamaan'],
                'content' => '<p>Tradisi makan bersama dalam satu wadah besar (gibungan) yang diperkenalkan oleh Raja Karangasem I Gusti Anglurah Ketut Karangasem pada abad ke-17. Tradisi ini meniadakan sekat status sosial dan kasta, memperkuat rasa persaudaraan dan gotong royong.</p>',
            ],
        ];

        CulturalExploration::truncate();
        foreach ($culturesData as $idx => $cult) {
            $imgPath = $this->saveImage($cult['img'], 'cultural-explorations/culture_' . ($idx + 1) . '.jpg', $cult['title']);
            CulturalExploration::create([
                'title' => $cult['title'],
                'slug' => Str::slug($cult['title'] . '-' . uniqid()),
                'content' => $cult['content'],
                'image_path' => $imgPath,
                'category' => $cult['category'],
                'location' => $cult['location'],
                'tags' => $cult['tags'],
                'user_id' => $admin->id,
                'is_published' => true,
            ]);
        }

        // 8. Berita Seni & Agenda (Art News)
        $newsData = [
            [
                'title' => 'Pekan Seni Budaya Pakuan 2026: Merayakan Kolaborasi Lintas Generasi',
                'category' => 'Festival',
                'date' => now()->addDays(14)->toDateString(),
                'highlight' => true,
                'img' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=1000&q=80',
                'content' => '<p>Pekan Seni Budaya (PSB) tahun ini akan diselenggarakan secara akbar di Graha Pakuan Siliwangi. Menghadirkan puluhan pertunjukan seni tari, konser musik bambu kolosal, pameran instalasi seni rupa, dan bazaar kuliner tradisional nusantara. Seluruh sivitas akademika dan masyarakat umum diundang untuk hadir.</p>',
            ],
            [
                'title' => 'Workshop Fotografi Etnografi: Merekam Kearifan Lokal Melalui Lensa',
                'category' => 'Pameran',
                'date' => now()->addDays(5)->toDateString(),
                'highlight' => false,
                'img' => 'https://images.unsplash.com/photo-1452587925148-ce544e77e70d?w=1000&q=80',
                'content' => '<p>Divisi Multimedia USB bekerja sama dengan Asosiasi Fotografer Indonesia mengadakan pelatihan intensif dokumentasi budaya bagi mahasiswa. Peserta akan dibekali teknik *storytelling visual*, etika peliputan komunitas adat, dan teknik pencahayaan alami di lapangan.</p>',
            ],
            [
                'title' => 'Malam Apresiasi Teater Mahasiswa: Lakon "Jejak Dalam Sunyi"',
                'category' => 'Seni Teater',
                'date' => now()->subDays(3)->toDateString(),
                'highlight' => false,
                'img' => 'https://images.unsplash.com/photo-1507676184212-d03ab07a01bf?w=1000&q=80',
                'content' => '<p>Pementasan teater tahunan USB berhasil memukau lebih dari 400 penonton di Auditorium FKIP. Mengangkat tema refleksi pencarian jati diri pemuda di tengah derasnya arus disrupsi digital dan individualisme perkotaan.</p>',
            ],
            [
                'title' => 'Harmonisasi Akustik & Gamelan: Penampilan Memukau di Dies Natalis Kampus',
                'category' => 'Seni Musik',
                'date' => now()->subDays(10)->toDateString(),
                'highlight' => false,
                'img' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=1000&q=80',
                'content' => '<p>Kolaborasi unik antara instrumen cello, biola, dan gamelan pelog Sunda persembahan Divisi Musik USB mendapat standing ovation dari Rektor dan jajaran senat universitas pada seremoni pembukaan Dies Natalis.</p>',
            ],
        ];

        ArtNews::truncate();
        foreach ($newsData as $idx => $news) {
            $imgPath = $this->saveImage($news['img'], 'art-news/news_' . ($idx + 1) . '.jpg', $news['title']);
            ArtNews::create([
                'title' => $news['title'],
                'slug' => Str::slug($news['title'] . '-' . uniqid()),
                'content' => $news['content'],
                'image_path' => $imgPath,
                'category' => $news['category'],
                'event_date' => $news['date'],
                'is_highlight' => $news['highlight'],
                'user_id' => $admin->id,
                'is_published' => true,
            ]);
        }

        // 9. Proyek Unggulan (Projects)
        $projectsData = [
            [
                'title' => 'Video Profil Resmi UKM Seni Budaya 2026',
                'category' => 'Company Profile',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'img' => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=1000&q=80',
                'desc' => 'Video profil komprehensif yang menampilkan perjalanan divisi musik, rupa, teater, dan multimedia dalam menciptakan ruang berekspresi yang inklusif dan dinamis.',
                'content' => '<p>Proyek multimedia berdurasi 5 menit ini diproduksi secara mandiri oleh anggota USB, mencakup proses latihan rutin, persiapan panggung, pameran galeri, dan wawancara dengan para alumni teladan.</p>',
                'is_coming_soon' => true,
            ],
            [
                'title' => 'Film Dokumenter: Menjaga Dentang Gamelan di Tanah Hujan',
                'category' => 'Dokumenter Budaya',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'img' => 'https://images.unsplash.com/photo-1485846234645-a62644f84728?w=1000&q=80',
                'desc' => 'Sebuah penelusuran sinematik tentang pelestarian gamelan degung di kalangan generasi Z Bogor.',
                'content' => '<p>Film dokumenter hasil riset lapangan selama 3 bulan yang merekam dialog antar generasi antara empu karawitan dan mahasiswa penabuh gamelan muda.</p>',
                'is_coming_soon' => true,
            ],
            [
                'title' => 'Pameran Seni Visual Virtual "Goresan Harapan"',
                'category' => 'Pameran',
                'video_url' => null,
                'img' => 'https://images.unsplash.com/photo-1460661419201-fd4cecdf8a8b?w=1000&q=80',
                'desc' => 'Showcase pameran seni rupa 360 derajat yang menampilkan 45 karya lukis, kriya, dan ilustrasi digital mahasiswa.',
                'content' => '<p>Menggunakan teknologi galeri virtual interaktif agar penikmat seni di seluruh Indonesia dapat mengapresiasi dan membeli karya orisinal mahasiswa.</p>',
                'is_coming_soon' => false,
            ],
        ];

        Project::truncate();
        foreach ($projectsData as $idx => $proj) {
            $imgPath = $this->saveImage($proj['img'], 'projects/project_' . ($idx + 1) . '.jpg', $proj['title']);
            Project::create([
                'title' => $proj['title'],
                'slug' => Str::slug($proj['title'] . '-' . uniqid()),
                'description' => $proj['desc'],
                'content' => $proj['content'],
                'category' => $proj['category'],
                'video_embed_url' => $proj['video_url'],
                'cover_image_path' => $imgPath,
                'user_id' => $admin->id,
                'is_published' => true,
                'is_coming_soon' => $proj['is_coming_soon'],
            ]);
        }

        // 10. Arsip Aktivitas (Archives)
        $archivesData = [
            [
                'title' => 'Dokumentasi Latihan Rutin Divisi Musik Gamelan Degung',
                'year' => 2025,
                'type' => 'Latihan Rutin',
                'img' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=800&q=80',
                'desc' => 'Arsip dokumentasi mingguan penguasaan notasi gending Sunda klasik di Aula Seni Gedung C.',
            ],
            [
                'title' => 'Modul & Notulensi Workshop Tata Panggung Teater',
                'year' => 2025,
                'type' => 'Workshop',
                'img' => 'https://images.unsplash.com/photo-1457369804613-52c61a468e7d?w=800&q=80',
                'desc' => 'Materi pelatihan pencahayaan (lighting), tata suara akustik ruangan, dan manajemen panggung teater.',
            ],
            [
                'title' => 'Laporan Kunjungan Kebudayaan ke Sanggar Tari Jaipong',
                'year' => 2024,
                'type' => 'Kunjungan',
                'img' => 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?w=800&q=80',
                'desc' => 'Dokumen studi komparasi gerakan dasar tari Jaipong kreasi baru bersama seniman tari Jawa Barat.',
            ],
            [
                'title' => 'Musyawarah Besar & Laporan Pertanggungjawaban Pengurus 2024',
                'year' => 2024,
                'type' => 'Event Internal',
                'img' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=800&q=80',
                'desc' => 'Arsip LPJ tahunan, laporan keuangan organisasi, dan berita acara serah terima jabatan ketua umum.',
            ],
            [
                'title' => 'Katalog Dokumentasi Pameran Seni Angkatan 2023',
                'year' => 2023,
                'type' => 'Dokumentasi',
                'img' => 'https://images.unsplash.com/photo-1460661419201-fd4cecdf8a8b?w=800&q=80',
                'desc' => 'Buku katalog digital kumpulan karya seni rupa, foto etnografi, dan ulasan kurator.',
            ],
        ];

        Archive::truncate();
        foreach ($archivesData as $idx => $arc) {
            $docPath = $this->saveImage($arc['img'], 'archives/archive_' . ($idx + 1) . '.jpg', $arc['title']);
            Archive::create([
                'title' => $arc['title'],
                'description' => $arc['desc'],
                'activity_type' => $arc['type'],
                'year' => $arc['year'],
                'document_path' => $docPath,
                'user_id' => $admin->id,
            ]);
        }

        // 11. Oprec Settings
        $brochureImg = $this->saveImage(
            'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=1000&q=80',
            'company-profiles/brosur_oprec.jpg',
            'Brosur Open Recruitment Anggota Baru'
        );

        OprecSetting::updateOrCreate(['id' => 1], [
            'is_active' => true,
            'start_date' => now()->toDateString(),
            'end_date' => now()->addDays(30)->toDateString(),
            'title' => 'Penerimaan Anggota Baru UKM Seni Budaya 2026',
            'description' => '<p>Mari bergabung menjadi bagian dari keluarga besar UKM Seni Budaya Universitas Pakuan! Asah minat, kembangkan bakat artistik, dan bersama-sama merawat kekayaan budaya nusantara.</p>',
            'brochure_image' => $brochureImg,
        ]);

        // 12. Sampel Pendaftaran Oprec & Pesan Masuk
        OprecRegistration::truncate();
        OprecRegistration::create([
            'name' => 'Ahmad Fauzi',
            'email' => 'ahmad.fauzi@student.unpak.ac.id',
            'phone' => '081234567890',
            'division' => 'Seni Musik',
            'motivation' => 'Ingin memperdalam instrumen gamelan dan berkontribusi dalam tim musik pementasan kampus.',
            'portfolio_link' => 'https://instagram.com/fauzi_music',
            'status' => 'pending',
        ]);

        OprecRegistration::create([
            'name' => 'Citra Lestari',
            'email' => 'citra.lestari@student.unpak.ac.id',
            'phone' => '089876543210',
            'division' => 'Seni Rupa',
            'motivation' => 'Memiliki minat di bidang ilustrasi digital dan lukis kanvas, ingin berkolaborasi di pameran seni.',
            'portfolio_link' => 'https://behance.net/citralestari',
            'status' => 'accepted',
        ]);

        InboxMessage::truncate();
        InboxMessage::create([
            'name' => 'Dewi Sartika',
            'email' => 'dewi.sartika@gmail.com',
            'subject' => 'Undangan Kolaborasi Festival Seni Kota Bogor',
            'message' => 'Halo rekan-rekan UKM Seni Budaya Unpak, kami dari Dewan Kesenian Kota Bogor bermaksud mengundang USB untuk tampil mengisi acara panggung utama pada perayaan Hari Jadi Bogor mendatang.',
            'is_read' => false,
        ]);

        $this->command->info('✅ Seeding data dan unduhan foto selesai dengan sukses!');
    }
}
