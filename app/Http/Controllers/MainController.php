<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\ComingSoon;
use App\Models\Concept;
use App\Models\Contact;
use App\Models\ContactType;
use App\Models\Food;
use App\Models\FoodTruck;
use App\Models\LeftLink;
use App\Models\Price;
use App\Models\PriceContent;
use App\Models\RightLink;
use App\Models\School;
use App\Models\Section;
use App\Models\SectionItem;
use App\Models\Sponsor;
use App\Models\Welcome;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {
        $data = [
            'welcomes' => Welcome::find(1),
            'concepts' => Concept::all(),
            'addresses' => Address::all(),
            'price_contents' => PriceContent::all(),
            'prices' => Price::all(),
            'sections' => Section::all(),
            'section_items' => SectionItem::all(),
            'schools' => School::all(),
            'food' => Food::all(),
            'food_truck' => FoodTruck::find(1),
            'contact_types' => ContactType::all(),
            'contacts' => Contact::all(),
            'sponsors' => Sponsor::all(),
            'left_links' => LeftLink::all(),
            'right_links' => RightLink::all(),
            'coming_soon' => ComingSoon::find(1),
        ];
        return view('index', $data);
    }
}
