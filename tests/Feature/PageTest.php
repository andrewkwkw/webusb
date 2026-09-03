<?php

namespace Tests\Feature;

use App\Models\ArtNews;
use App\Models\Artwork;
use App\Models\CompanyProfile;
use App\Models\ContactSetting;
use App\Models\CulturalExploration;
use App\Models\OprecSetting;
use App\Models\PageHero;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        PageHero::create(['page_name' => 'Beranda', 'image_path' => 'page-heroes/beranda_1.jpg']);
        PageHero::create(['page_name' => 'Tentang', 'image_path' => 'page-heroes/tentang_1.jpg']);
        PageHero::create(['page_name' => 'Karya', 'image_path' => 'page-heroes/karya_1.jpg']);
        PageHero::create(['page_name' => 'Budaya', 'image_path' => 'page-heroes/budaya_1.jpg']);
        PageHero::create(['page_name' => 'Seni', 'image_path' => 'page-heroes/seni_1.jpg']);
        PageHero::create(['page_name' => 'Proyek', 'image_path' => 'page-heroes/proyek_1.jpg']);
        PageHero::create(['page_name' => 'Arsip', 'image_path' => 'page-heroes/arsip_1.jpg']);
        PageHero::create(['page_name' => 'Kontak', 'image_path' => 'page-heroes/kontak_1.jpg']);
        PageHero::create(['page_name' => 'Oprec', 'image_path' => 'page-heroes/oprec_1.jpg']);

        CompanyProfile::create([
            'history' => 'Sejarah USB',
            'vision_mission' => 'Visi Misi USB',
        ]);

        ContactSetting::create([
            'email' => 'test@usb.com',
            'address' => 'Bogor',
        ]);

        OprecSetting::create([
            'is_active' => true,
            'title' => 'Open Recruitment',
        ]);

        Artwork::create([
            'title' => 'Karya Seni Uji',
            'slug' => 'karya-seni-uji',
            'description' => 'Deskripsi karya uji',
            'category' => 'Fotografi',
            'images' => ['artworks/test.jpg'],
            'is_featured' => true,
            'is_published' => true,
            'user_id' => $user->id,
        ]);

        CulturalExploration::create([
            'title' => 'Budaya Uji',
            'slug' => 'budaya-uji',
            'content' => 'Konten budaya uji',
            'category' => 'Tradisi',
            'user_id' => $user->id,
            'is_published' => true,
        ]);

        ArtNews::create([
            'title' => 'Berita Seni Uji',
            'slug' => 'berita-seni-uji',
            'content' => 'Konten berita uji',
            'category' => 'Festival',
            'user_id' => $user->id,
            'is_published' => true,
        ]);
    }

    public function test_all_public_pages_return_successful_response(): void
    {
        $this->get('/')->assertStatus(200);
        $this->get('/tentang')->assertStatus(200);
        $this->get('/karya')->assertStatus(200);
        $this->get('/karya/karya-seni-uji')->assertStatus(200);
        $this->get('/budaya')->assertStatus(200);
        $this->get('/budaya/budaya-uji')->assertStatus(200);
        $this->get('/seni')->assertStatus(200);
        $this->get('/seni/berita-seni-uji')->assertStatus(200);
        $this->get('/proyek')->assertStatus(200);
        $this->get('/arsip')->assertStatus(200);
        $this->get('/kontak')->assertStatus(200);
        $this->get('/oprec')->assertStatus(200);
        $this->get('/search?q=uji')->assertStatus(200);
    }
}
