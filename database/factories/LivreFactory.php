<?php

namespace Database\Factories;

use \Log;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Livre>
 */
class LivreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */    public function definition(): array
    {
        // List of real book ISBNs for random selection
        $isbnList = [
            '9780140449266', '9780451524935', '9780679783268', '9780743273565', '9780439139601',
            '9780316769488', '9780061120084', '9781982148239', '9781501171345', '9780141439600'
        ];

        $isbn = $this->faker->randomElement($isbnList);
        $image1 = 'livres/' . uniqid() . '.jpg';
        $image2 = 'livres/' . uniqid() . '.jpg';

        try {
            $url1 = "https://covers.openlibrary.org/b/isbn/{$isbn}-L.jpg"; // Large book cover
            $url2 = "https://covers.openlibrary.org/b/isbn/{$this->faker->randomElement($isbnList)}-L.jpg";

            // Validate if the images are valid
            $imageContent1 = file_get_contents($url1);
            $imageContent2 = file_get_contents($url2);

            // Check if the content is a valid image (mime type check)
            if (getimagesizefromstring($imageContent1)) {
                Storage::disk('public')->put($image1, $imageContent1);
            } else {
                throw new \Exception("Invalid image content for {$url1}");
            }

            if (getimagesizefromstring($imageContent2)) {
                Storage::disk('public')->put($image2, $imageContent2);
            } else {
                throw new \Exception("Invalid image content for {$url2}");
            }
        } catch (\Exception $e) {
            Log::error("Error fetching book image: " . $e->getMessage());
            // Default fallback images in case of error
            $image1 = 'default.jpg';
            $image2 = 'default.jpg';
        }

        return [
            'titre' => $this->faker->sentence(),
            'auteur' => $this->faker->name(),
            'editeur' => $this->faker->company(),
            'date_edition' => $this->faker->date(),
            'nbr_exemplaire' => $this->faker->numberBetween(1, 100),
            'categorie_id' => Categorie::factory(),
            'image1' => $image1,
            'image2' => $image2,
        ];
    }
}
