<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $currentCategory = $request->get('category', 'all');

        $allImages = [
        // === HAIR TREATMENT (5 Data) ===
        [
            'url' => 'https://images.unsplash.com/photo-1562322140-8baeececf3df?auto=format&fit=crop&w=800&q=80',
            'title' => 'Premium Smoothing & Hair Blow',
            'category' => 'hair-treatment'
        ],
        [
            'url' => 'https://images.unsplash.com/photo-1607779097040-26e80aa78e66?auto=format&fit=crop&w=800&q=80',
            'title' => 'Luxury Keratin Hair Spa Care',
            'category' => 'hair-treatment'
        ],
        [
            'url' => 'https://images.unsplash.com/photo-1595425970377-c9703cf48b6d?auto=format&fit=crop&w=800&q=80',
            'title' => 'Professional Hair Wash & Scalp Massage',
            'category' => 'hair-treatment'
        ],
        [
            'url' => 'https://images.unsplash.com/photo-1580618672591-eb180b1a973f?auto=format&fit=crop&w=800&q=80',
            'title' => 'Classic Women Haircut & Layering',
            'category' => 'hair-treatment'
        ],
        [
            'url' => 'https://images.unsplash.com/photo-1492106087820-71f1a00d2b11?auto=format&fit=crop&w=800&q=80',
            'title' => 'Voluminous Silk Roller Blowout',
            'category' => 'hair-treatment'
        ],

        // === SALON INTERIOR (5 Data) ===
        [
            'url' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=800&q=80',
            'title' => 'Modern Minimalist Styling Station',
            'category' => 'salon-interior'
        ],
        [
            'url' => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=800&q=80',
            'title' => 'Comfortable Waiting Lounge & Cafe Bar',
            'category' => 'salon-interior'
        ],
        [
            'url' => 'https://images.unsplash.com/photo-1633681926035-ec1ac984418a?auto=format&fit=crop&w=800&q=80',
            'title' => 'Premium Hair Washing Aesthetic Chairs',
            'category' => 'salon-interior'
        ],
        [
            'url' => 'https://images.unsplash.com/photo-1600948836101-f9ffda59d250?auto=format&fit=crop&w=800&q=80',
            'title' => 'Our Main Elegant Vanity & Lighting Mirror',
            'category' => 'salon-interior'
        ],
        [
            'url' => 'https://images.unsplash.com/photo-1512496015851-a90fb38ba796?auto=format&fit=crop&w=800&q=80',
            'title' => 'Exclusive VIP Treatment Room',
            'category' => 'salon-interior'
        ],

        // === MAKEUP (5 Data) ===
        [
            'url' => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?auto=format&fit=crop&w=800&q=80',
            'title' => 'Glamour Wedding Bridal Makeup',
            'category' => 'makeup'
        ],
        [
            'url' => 'https://images.unsplash.com/photo-1515688594390-b649af70d282?auto=format&fit=crop&w=800&q=80',
            'title' => 'Soft Flawless Graduation Look',
            'category' => 'makeup'
        ],
        [
            'url' => 'https://images.unsplash.com/photo-1526045478516-99145907023c?auto=format&fit=crop&w=800&q=80',
            'title' => 'Bold Night Party Eyeshadow Art',
            'category' => 'makeup'
        ],
        [
            'url' => 'https://images.unsplash.com/photo-1519415387722-a1c3bbef716c?auto=format&fit=crop&w=800&q=80',
            'title' => 'Natural Korean Glow Dewy Finish',
            'category' => 'makeup'
        ],
        [
            'url' => 'https://images.unsplash.com/photo-1596462502278-27bfdc403348?auto=format&fit=crop&w=800&q=80',
            'title' => 'Photo Session High-Definition Touch',
            'category' => 'makeup'
        ],

        // === BEFORE & AFTER (5 Data) ===
        [
            'url' => 'https://thumbs.dreamstime.com/b/comparison-woman-s-hair-illustrating-transformation-frizzy-to-sleek-straight-locks-use-379623129.jpg', 
            'title' => 'Hair Transformation: From Frizzy to Silky Smooth Shines',
            'category' => 'before-after'
        ],
        [
            'url' => 'https://i.ytimg.com/vi/HjBKN9QdE30/maxresdefault.jpg',
            'title' => 'Style Makeover: Dramatic Long Hair to Chic Pixie Bob',
            'category' => 'before-after'
        ],
        [
            'url' => 'https://i.pinimg.com/736x/c6/ea/18/c6ea18de9c57486223e2b9b60f7e3d06.jpg', 
            'title' => 'Color Transformation: Dull Hair to Ash Grey Balayage',
            'category' => 'before-after'
        ],
        [
            'url' => 'https://i.ytimg.com/vi/W98QWY9G8sw/maxresdefault.jpg', 
            'title' => 'Bridal Makeup: Acne Coverage to Flawless Glow Finish',
            'category' => 'before-after'
        ],
        [
            'url' => 'https://i.pinimg.com/736x/ed/ac/8e/edac8e3f7d8eef9a818b9774d518cf7e--keratin-complex-before-after.jpg', 
            'title' => 'Texture Repair: Intense Keratin Treatment Results',
            'category' => 'before-after'
        ],
        
    ];

        $galleryCollection = collect($allImages);

        if ($currentCategory !== 'all') {
            $galleries = $galleryCollection->where('category', $currentCategory);
        } else {
            $galleries = $galleryCollection;
        }

        return view('gallery.index', compact('galleries', 'currentCategory'));
    }
}