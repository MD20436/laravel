<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\MenuItem;

class RestaurantSeeder extends Seeder
{
    public function run()
    {
        $restaurants = [
            [
                'name' => 'Pizza Paradise',
                'category' => 'Pizza',
                'image' => 'pizza-paradise.png',
                'menu_items' => [
                    [
                        'name' => 'Margherita Pizza',
                        'description' => 'Klasyczna pizza z mozzarellą i sosem pomidorowym.',
                        'price' => 25.99,
                        'image' => 'margherita.jpg',
                    ],
                    [
                        'name' => 'Pepperoni Pizza',
                        'description' => 'Pizza z salami pepperoni i mozzarellą.',
                        'price' => 29.99,
                        'image' => 'pepperoni.jpg',
                    ],
                    [
                        'name' => 'Hawaiian Pizza',
                        'description' => 'Pizza z szynką, ananasem i mozzarellą.',
                        'price' => 27.99,
                        'image' => 'hawaiian.jpg',
                    ],
                    [
                        'name' => 'Vegetarian Pizza',
                        'description' => 'Pizza z warzywami: papryką, pieczarkami i cebulą.',
                        'price' => 24.99,
                        'image' => 'vegetarian.jpg',
                    ],
                    [
                        'name' => 'BBQ Chicken Pizza',
                        'description' => 'Pizza z kurczakiem BBQ, czerwoną cebulą i mozzarellą.',
                        'price' => 28.99,
                        'image' => 'bbq-chicken.jpg',
                    ],
                ],
            ],
            [
                'name' => 'Burger Kingdom',
                'category' => 'Burgery',
                'image' => 'burger-kingdom.jpg',
                'menu_items' => [
                    [
                        'name' => 'Classic Cheeseburger',
                        'description' => 'Burger z serem cheddar, sałatą i pomidorem.',
                        'price' => 19.99,
                        'image' => 'cheeseburger.jpg',
                    ],
                    [
                        'name' => 'Bacon Burger',
                        'description' => 'Burger z boczkiem, serem i sosem BBQ.',
                        'price' => 21.99,
                        'image' => 'bacon-burger.jpg',
                    ],
                    [
                        'name' => 'Double Cheeseburger',
                        'description' => 'Podwójny burger z serem cheddar i sosem.',
                        'price' => 25.99,
                        'image' => 'double-cheeseburger.jpg',
                    ],
                    [
                        'name' => 'Chicken Burger',
                        'description' => 'Burger z chrupiącym kurczakiem i sosem majonezowym.',
                        'price' => 18.99,
                        'image' => 'chicken-burger.jpg',
                    ],
                    [
                        'name' => 'Vegan Burger',
                        'description' => 'Burger wegański z warzywnym kotletem i sosem roślinnym.',
                        'price' => 22.99,
                        'image' => 'vegan-burger.jpg',
                    ],
                ],
            ],
            [
                'name' => 'Sushi World',
                'category' => 'Sushi',
                'image' => 'sushi-world.jpeg',
                'menu_items' => [
                    [
                        'name' => 'California Roll',
                        'description' => 'Rolka z krabem, awokado i ogórkiem.',
                        'price' => 34.99,
                        'image' => 'california-roll.jpg',
                    ],
                    [
                        'name' => 'Salmon Nigiri',
                        'description' => 'Kawałek surowego łososia na ryżu.',
                        'price' => 29.99,
                        'image' => 'salmon-nigiri.jpg',
                    ],
                    [
                        'name' => 'Tuna Sashimi',
                        'description' => 'Plastry surowego tuńczyka.',
                        'price' => 39.99,
                        'image' => 'tuna-sashimi.jpg',
                    ],
                    [
                        'name' => 'Dragon Roll',
                        'description' => 'Rolka z węgorzem, ogórkiem i awokado.',
                        'price' => 42.99,
                        'image' => 'dragon-roll.jpg',
                    ],
                    [
                        'name' => 'Vegetarian Sushi',
                        'description' => 'Rolka z ogórkiem, awokado i marchewką.',
                        'price' => 26.99,
                        'image' => 'vegetarian-sushi.jpg',
                    ],
                ],
            ],
        ];

        foreach ($restaurants as $restaurantData) {
            // Tworzenie restauracji
            $restaurant = Restaurant::create([
                'name' => $restaurantData['name'],
                'category' => $restaurantData['category'],
                'image' => $restaurantData['image'],
            ]);

            // Tworzenie pozycji menu dla restauracji
            foreach ($restaurantData['menu_items'] as $menuItemData) {
                MenuItem::create([
                    'restaurant_id' => $restaurant->id,
                    'name' => $menuItemData['name'],
                    'description' => $menuItemData['description'],
                    'price' => $menuItemData['price'],
                    'image' => $menuItemData['image'],
                ]);
            }
        }
    }
}