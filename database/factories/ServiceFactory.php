<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = Service::class;
    protected static $sequence = 0;

    public function definition(): array
    {
        $salonData = [
            [
                'name' => 'Hair Spa & Creambath',
                'description' => 'Nourishing treatment to repair and strengthen your hair.',
                'price' => 150000,
                'duration' => 90,
                'image' => 'https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?auto=format&fit=crop&w=1200&q=80'
            ],
            [
                'name' => 'Hair Smoothing',
                'description' => 'Smooth, silky and elegant hair treatment.',
                'price' => 250000,
                'duration' => 120,
                'image' => 'https://images.unsplash.com/photo-1562322140-8baeececf3df?auto=format&fit=crop&w=1200&q=80'
            ],
            [
                'name' => 'Hair Mask',
                'description' => 'Deep treatment for dry and damaged hair.',
                'price' => 120000,
                'duration' => 60,
                'image' => 'https://images.unsplash.com/photo-1515377905703-c4788e51af15?auto=format&fit=crop&w=1200&q=80'
            ],
            [
                'name' => 'Hair Blow',
                'description' => 'Elegant blow styling for glamorous hair.',
                'price' => 80000,
                'duration' => 45,
                'image' => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?auto=format&fit=crop&w=1200&q=80'
            ],
            [
                'name' => 'Hair Styling & Catok',
                'description' => 'Stylish straight hair with premium styling tools.',
                'price' => 100000,
                'duration' => 45,
                'image' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=1200&q=80'
            ],
            [
                'name' => 'Relaxing Massage',
                'description' => 'Relax your body and mind with premium massage therapy.',
                'price' => 200000,
                'duration' => 60,
                'image' => 'https://images.unsplash.com/photo-1519823551278-64ac92734fb1?auto=format&fit=crop&w=1200&q=80'
            ],
        ];

        $current = $salonData[self::$sequence % count($salonData)];
        self::$sequence++;

        return [
            'name' => $current['name'],
            'description' => $current['description'],
            'price' => $current['price'],
            'duration' => $current['duration'],
            'image' => $current['image'],
        ];
    }
}
