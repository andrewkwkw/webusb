<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        $admin = \App\Models\User::where('role', 'admin')->first();
        
        if (!$admin) {
            $admin = \App\Models\User::create([
                'name' => 'Admin Utama',
                'email' => 'admin@usb.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]);
        }

        // Company Profile
        \App\Models\CompanyProfile::updateOrCreate(['id' => 1], [
            'history' => '<p>' . $faker->paragraphs(3, true) . '</p>',
            'vision_mission' => '<h3>Visi</h3><p>' . $faker->sentence() . '</p><h3>Misi</h3><ul><li>' . $faker->sentence() . '</li><li>' . $faker->sentence() . '</li></ul>',
            'logo_philosophy' => '<p>' . $faker->paragraph() . '</p>',
            'departments' => '<ul><li>Seni Musik</li><li>Seni Rupa</li><li>Seni Teater</li><li>Fotografi</li><li>Videografi</li></ul>',
        ]);

        // Contact Setting
        \App\Models\ContactSetting::updateOrCreate(['id' => 1], [
            'email' => 'hello@ukmsenibudaya.com',
            'address' => 'Gedung Ormawa Lt. 2, Universitas Pakuan, Bogor',
            'instagram' => 'https://instagram.com/ukmsenibudaya',
            'youtube' => 'https://youtube.com',
            'tiktok' => 'https://tiktok.com',
        ]);

        // Art News
        $newsCategories = ['Berita Kampus', 'Berita Seni', 'Agenda', 'Festival', 'Pameran', 'Seni Musik', 'Seni Rupa', 'Seni Teater'];
        for ($i = 0; $i < 10; $i++) {
            \App\Models\ArtNews::create([
                'title' => $faker->sentence(),
                'slug' => \Illuminate\Support\Str::slug($faker->sentence() . '-' . uniqid()),
                'content' => '<p>' . $faker->paragraphs(4, true) . '</p>',
                'category' => $faker->randomElement($newsCategories),
                'user_id' => $admin->id,
                'is_published' => true,
                'is_highlight' => $faker->boolean(20),
            ]);
        }

        // Artworks
        $artCategories = ['Fotografi', 'Videografi', 'Photo Story', 'Dokumenter Visual'];
        for ($i = 0; $i < 10; $i++) {
            \App\Models\Artwork::create([
                'title' => $faker->words(3, true),
                'slug' => \Illuminate\Support\Str::slug($faker->words(3, true) . '-' . uniqid()),
                'description' => '<p>' . $faker->paragraphs(2, true) . '</p>',
                'category' => $faker->randomElement($artCategories),
                'publication_year' => $faker->year(),
                'creator_name' => $faker->name(),
                'is_featured' => $faker->boolean(30),
                'user_id' => $admin->id,
                'is_published' => true,
            ]);
        }

        // Cultural Exploration
        for ($i = 0; $i < 8; $i++) {
            \App\Models\CulturalExploration::create([
                'title' => $faker->sentence(),
                'slug' => \Illuminate\Support\Str::slug($faker->sentence() . '-' . uniqid()),
                'content' => '<p>' . $faker->paragraphs(3, true) . '</p>',
                'location' => $faker->city(),
                'user_id' => $admin->id,
                'is_published' => true,
            ]);
        }

        // Project
        for ($i = 0; $i < 5; $i++) {
            \App\Models\Project::create([
                'title' => $faker->sentence(),
                'slug' => \Illuminate\Support\Str::slug($faker->sentence() . '-' . uniqid()),
                'description' => '<p>' . $faker->paragraphs(2, true) . '</p>',
                'content' => '<p>' . $faker->paragraphs(4, true) . '</p>',
                'user_id' => $admin->id,
                'is_published' => true,
            ]);
        }

        // Archive
        for ($i = 0; $i < 15; $i++) {
            \App\Models\Archive::create([
                'title' => $faker->sentence(),
                'description' => '<p>' . $faker->paragraph() . '</p>',
                'year' => $faker->year(),
                'activity_type' => $faker->randomElement(['Latihan Rutin', 'Workshop', 'Kunjungan', 'Event Internal', 'Dokumentasi']),
                'user_id' => $admin->id,
            ]);
        }

        // Organization Members
        $positions = ['Ketua Umum', 'Wakil Ketua', 'Sekretaris', 'Bendahara', 'Koordinator Divisi'];
        for ($i = 0; $i < 6; $i++) {
            \App\Models\OrganizationMember::create([
                'name' => $faker->name(),
                'position' => $positions[$i % count($positions)],
                'department' => $faker->randomElement(['Seni Musik', 'Seni Rupa', 'Teater', 'Humas']),
                'order_column' => $i,
            ]);
        }
    }
}
