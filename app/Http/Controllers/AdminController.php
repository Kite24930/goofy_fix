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
use App\Models\PriceImg;
use App\Models\RightLink;
use App\Models\School;
use App\Models\Section;
use App\Models\SectionItem;
use App\Models\Sponsor;
use App\Models\Welcome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as InterventionImage;

class AdminController extends Controller
{
    public function edit()
    {
        $data = [
            'welcomes' => Welcome::find(1),
            'concepts' => Concept::all(),
            'addresses' => Address::all(),
            'price_contents' => PriceContent::all(),
            'prices' => Price::all(),
            'price_img' => PriceImg::find(1),
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
        return view('admin.edit', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'email|required|string|max:255',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = auth()->user();

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    public function editHeaderLogo()
    {
        return view('admin.edit.header_logo');
    }

    public function updateHeaderLogo(Request $request)
    {
        $request->validate([
            'header_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
        [
            'header_logo.required' => '画像を選択してください。',
            'header_logo.image' => '画像ファイルを選択してください。',
            'header_logo.mimes' => '画像ファイルを選択してください。',
            'header_logo.max' => '画像ファイルは2MB以下にしてください。',
        ]);

        try {
            $image = InterventionImage::make($request->file('header_logo'));
            $image->orientate();
            $image->resize(
                200,
                null,
                function ($constraint) {
                    // 縦横比を保持したままにする
                    $constraint->aspectRatio();
                    // 小さい画像は大きくしない
                    $constraint->upsize();
                }
            );
            $filePath = storage_path('app/public/logo.png');
            $image->encode('png')->save($filePath);

            return back()->with('success', 'Header Logo updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Header Logo updated failed!');
        }
    }

    public function editSlick()
    {
        $data = [
            'top_img_count' => Welcome::find(1)->top_img_count,
        ];
        return view('admin.edit.slick', $data);
    }

    public function sortSlick(Request $request)
    {
        try {
            $sorting = [];
            foreach ($request->sort as $value) {
                $sorting[] = InterventionImage::make(storage_path('app/public/top_'.$value.'.jpg'));
            }
            foreach ($sorting as $index => $sort) {
                $sort->save(storage_path('app/public/top_'.$index.'.jpg'));
            }
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }

    public function destroySlick(Request $request)
    {
        try {
            DB::beginTransaction();
            $top_img_count = Welcome::find(1)->top_img_count;
            if ($top_img_count > 1) {
                $top_img_count--;
                $welcome = Welcome::find(1);
                $welcome->update(['top_img_count' => $top_img_count]);
                $target = Storage::disk('public')->delete('top_'.$request->target.'.jpg');
                DB::commit();
                return response()->json(['success' => true]);
            } else {
                DB::rollBack();
                return response()->json(['success' => false, 'message' => '画像は1枚以上必要です。']);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false]);
        }
    }

    public function updateSlick(Request $request)
    {
        $request->validate([
            'add_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
        [
            'add_file.required' => '画像を選択してください。',
            'add_file.image' => '画像ファイルを選択してください。',
            'add_file.mimes' => '画像ファイルを選択してください。',
            'add_file.max' => '画像ファイルは2MB以下にしてください。',
        ]);

        try {
            DB::beginTransaction();
            $top_img_count = Welcome::find(1)->top_img_count;
            $image = InterventionImage::make($request->file('add_file'));
            $image->orientate();
            $filePath = storage_path('app/public/top_'.$top_img_count.'.jpg');
            $image->encode('jpg')->save($filePath);
            $top_img_count++;
            $welcome = Welcome::find(1);
            $welcome->update(['top_img_count' => $top_img_count]);
            DB::commit();
            return back()->with('success', 'Header Logo updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Header Logo updated failed!');
        }
    }

    public function editWelcome()
    {
        $data = [
            'welcomes' => Welcome::find(1),
        ];
        return view('admin.edit.welcome', $data);
    }

    public function updateWelcome(Request $request)
    {
        $request->validate([
            'welcome_eng_msg' => 'required|string|max:255',
            'welcome_jp_msg' => 'required|string|max:255',
        ],
        [
            'welcome_eng_msg.required' => '英語メッセージを入力してください。',
            'welcome_jp_msg.required' => '日本語メッセージを入力してください。',
        ]);

        try {
            $data = [
                'welcome_eng_msg' => $request->welcome_eng_msg,
                'welcome_jp_msg' => $request->welcome_jp_msg,
            ];

            $welcome = Welcome::find(1);
            $welcome->update($data);

            return back()->with('success', 'Welcome updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Welcome updated failed!');
        }

    }

    public function editConcept()
    {
        $data = [
            'concepts' => Concept::all(),
        ];
        return view('admin.edit.concept', $data);
    }

    public function updateConcept($id, Request $request)
    {
        $request->validate([
            'concept_title' => 'required|string|max:255',
            'concept_text' => 'required|string|max:255',
            'concept_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            if ($request->file('concept_img')) {
                $image = InterventionImage::make($request->file('concept_img'));
                $image->orientate();
                $img_name = $request->file('concept_img')->getClientOriginalName();
                $filePath = storage_path('app/public/'.$img_name);
                $image->save($filePath);

                $data = [
                    'concept_title' => $request->concept_title,
                    'concept_text' => $request->concept_text,
                    'concept_img' => $img_name,
                ];
            } else {
                $data = [
                    'concept_title' => $request->concept_title,
                    'concept_text' => $request->concept_text,
                ];
            }

            Concept::updateOrCreate(['id' => $id], $data);

            return back()->with('success', 'Concept updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Concept updated failed!');
        }
    }

    public function destroyConcept($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $target = Concept::find($id);
            if (Concept::all()->count() > 1) {
                $target->delete();
                DB::commit();
                return back()->with('success', 'Concept deleted successfully!');
            } else {
                DB::rollBack();
                return back()->with('error', 'Concept deleted failed!');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Concept deleted failed!');
        }
    }

    public function editAddress()
    {
        $data = [
            'addresses' => Address::all(),
        ];
        return view('admin.edit.address', $data);
    }

    public function updateAddress(Request $request)
    {
        try {
            DB::beginTransaction();

            foreach ($request->id_list as $id) {
                $data = [
                    'address_title' => $request->sendData[$id]['title'],
                    'address_text' => $request->sendData[$id]['text'],
                ];
                Address::updateOrCreate(['id' => $id], $data);
            }

            DB::commit();
            return back()->with('success', 'Address updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Address updated failed!')->with('request', $request->all());
        }
    }

    public function destroyAddress($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $target = Address::find($id);
            if (Address::all()->count() > 1) {
                $target->delete();
                DB::commit();
                return back()->with('success', 'Address deleted successfully!');
            } else {
                DB::rollBack();
                return back()->with('error', 'Address deleted failed!');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Address deleted failed!');
        }
    }

    public function editPrice()
    {
        $data = [
            'price_contents' => PriceContent::all(),
            'prices' => Price::all(),
        ];
        return view('admin.edit.price', $data);
    }

    public function updatePrice(Request $request)
    {
        try {
            DB::beginTransaction();
            foreach ($request->id as $id) {
                Price::updateOrCreate(['id' => $id], [
                    'content_id' => $request->content_id[$id],
                    'price_content' => $request->price_content[$id],
                    'price' => $request->price[$id],
                ]);
            }
            DB::commit();
            return back()->with('success', 'Price updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Price updated failed!')->with('request', $request->all());
        }
    }

    public function updatePriceContent(Request $request) {
        try {
            DB::beginTransaction();
            foreach ($request->id as $id) {
                PriceContent::updateOrCreate(['id' => $id], [
                    'price_title' => $request->price_title[$id],
                ]);
            }
            DB::commit();
            return back()->with('success', 'Price Content updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Price Content updated failed!');
        }
    }

    public function destroyPrice($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $target = Price::find($id);
            if (Price::all()->count() > 1) {
                $target->delete();
                DB::commit();
                return back()->with('success', 'Price deleted successfully!');
            } else {
                DB::rollBack();
                return back()->with('error', 'Price deleted failed!');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Price deleted failed!');
        }
    }

    public function destroyPriceContent($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $target = PriceContent::find($id);
            if (PriceContent::all()->count() > 1) {
                $target->delete();
                DB::commit();
                return back()->with('success', 'Price Content deleted successfully!');
            } else {
                DB::rollBack();
                return back()->with('error', 'Price Content deleted failed!');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Price Content deleted failed!');
        }
    }

    public function editPriceImg()
    {
        $data = [
            'price_img' => PriceImg::find(1),
        ];
        return view('admin.edit.price_img', $data);
    }

    public function updatePriceImg(Request $request)
    {
        $request->validate([
            'price_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
        [
            'price_img.required' => '画像を選択してください。',
            'price_img.image' => '画像ファイルを選択してください。',
            'price_img.mimes' => '画像ファイルを選択してください。',
            'price_img.max' => '画像ファイルは2MB以下にしてください。',
        ]);

        try {
            $image = InterventionImage::make($request->file('price_img'));
            $image->orientate();
            $img_name = $request->file('price_img')->getClientOriginalName();
            $filePath = storage_path('app/public/'.$img_name);
            $image->save($filePath);

            $data = [
                'img' => $img_name,
            ];

            $price_img = PriceImg::find(1);
            $price_img->update($data);

            return back()->with('success', 'Price Image updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Price Image updated failed!');
        }
    }

    public function editSection()
    {
        $data = [
            'sections' => Section::all(),
            'section_items' => SectionItem::all(),
            'coming_soons' => ComingSoon::find(1),
        ];
        return view('admin.edit.section', $data);
    }

    public function updateSection($id, Request $request)
    {
        try {
            $request->validate([
                'section_title' => 'required|string|max:255',
                'section_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($request->file('section_img')) {
                $image = InterventionImage::make($request->file('section_img'));
                $image->orientate();
                $img_name = $request->file('section_img')->getClientOriginalName();
                $filePath = storage_path('app/public/'.$img_name);
                $image->save($filePath);

                $data = [
                    'section_title' => $request->section_title,
                    'section_img' => $img_name,
                ];
            } else {
                $data = [
                    'section_title' => $request->section_title,
                ];
            }

            Section::updateOrCreate(['id' => $id], $data);

            return back()->with('success', 'Section updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Section updated failed!');
        }
    }

    public function updateSectionItem(Request $request) {
        try {
            DB::beginTransaction();
            $save = [];
            foreach ($request->id as $index => $id) {
                if ($request->file('section_img-'.$id)) {
                    $image = InterventionImage::make($request->file('section_img-'.$id));
                    $image->orientate();
                    $img_name = $request->file('section_img-'.$id)->getClientOriginalName();
                    $filePath = storage_path('app/public/'.$img_name);
                    $image->save($filePath);
                    $save[] = [
                        'id' => $index + 1,
                        'section_id' => $request->section_id[$id],
                        'section_img' => $img_name,
                        'section_content' => $request->section_content[$id],
                    ];
                } else {
                    $section_item = SectionItem::find($id);
                    if ($section_item) {
                        $save[] = [
                            'id' => $index + 1,
                            'section_id' => $request->section_id[$id],
                            'section_img' => $section_item->section_img,
                            'section_content' => $request->section_content[$id],
                        ];
                    } else {
                        DB::rollBack();
                        return back()->with('error', 'Section Item updated failed!新規追加したセクションアイテムに画像を設定してください。');
                    }
                }
            }
            foreach ($save as $item) {
                SectionItem::updateOrCreate(['id' => $item['id']], [
                    'section_id' => $item['section_id'],
                    'section_img' => $item['section_img'],
                    'section_content' => $item['section_content'],
                ]);
            }
            DB::commit();
            return back()->with('success', 'Section Item updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Section Item updated failed!');
        }
    }

    public function destroySection($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $target = Section::find($id);
            if (Section::all()->count() > 1) {
                $target->delete();
                DB::commit();
                return back()->with('success', 'Section deleted successfully!');
            } else {
                DB::rollBack();
                return back()->with('error', 'Section deleted failed!');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Section deleted failed!');
        }
    }

    public function destroySectionItem($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $target = SectionItem::find($id);
            if (SectionItem::all()->count() > 1) {
                $target->delete();
                DB::commit();
                return back()->with('success', 'Section Item deleted successfully!');
            } else {
                DB::rollBack();
                return back()->with('error', 'Section Item deleted failed!');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Section Item deleted failed!');
        }
    }

    public function publishSection(Request $request)
    {
        try {
            $coming_soon = ComingSoon::find(1);
            $coming_soon->update(['section_item' => $request->publish]);
            if ($request->publish == 1) {
                return response(['success' => 'セクションを公開しました。'], 200);
            } else {
                return response(['success' => 'セクションを非公開にしました。'], 200);
            }
        } catch (\Exception $e) {
            return response(['error' => 'セクションの公開に失敗しました。'], 500);
        }
    }

    public function editSchool()
    {
        $data = [
            'schools' => School::all(),
        ];
        return view('admin.edit.school', $data);
    }

    public function updateSchool(Request $request)
    {
        $request->validate([
            'school_title' => 'required|string|max:255',
            'school_description' => 'required|string|max:255',
            'school_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $school_image = $request->file('school_image');
        $school_image_name = time() . '.' . $school_image->extension();
        $school_image->move(public_path('images'), $school_image_name);

        $data = [
            'school_title' => $request->school_title,
            'school_description' => $request->school_description,
            'school_image' => $school_image_name,
        ];

        $school = School::find(1);
        $school->update($data);

        return back()->with('success', 'School updated successfully!');
    }

    public function editFood()
    {
        $data = [
            'food' => Food::all(),
        ];
        return view('admin.edit.food', $data);
    }

    public function updateFood(Request $request)
    {
        try {
            foreach ($request->id as $index => $id) {
                if ($request->file('food_img-'.$id)) {
                    $image = InterventionImage::make($request->file('food_img-'.$id));
                    $image->orientate();
                    $img_name = $request->file('food_img-'.$id)->getClientOriginalName();
                    $filePath = storage_path('app/public/menu/'.$img_name);
                    $image->save($filePath);
                    $data[] = [
                        'id' => $index + 1,
                        'food_img' => $img_name,
                    ];
                } else {
                    $food = Food::find($id);
                    if ($food) {
                        $data[] = [
                            'id' => $index + 1,
                            'food_img' => $food->food_img,
                        ];
                    } else {
                        return back()->with('error', 'Food updated failed!新規追加したフードに画像を設定してください。');
                    }
                }
            }
            DB::beginTransaction();
            foreach ($data as $item) {
                Food::updateOrCreate(['id' => $item['id']], [
                    'food_img' => $item['food_img']
                ]);
            }
            DB::commit();

            return back()->with('success', 'Food updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Food updated failed!');
        }
    }

    public function destroyFood($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $target = Food::find($id);
            if (Food::all()->count() > 1) {
                $target->delete();
                DB::commit();
                return back()->with('success', 'Food deleted successfully!');
            } else {
                DB::rollBack();
                return back()->with('error', 'Food deleted failed!');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Food deleted failed!');
        }
    }

    public function editFoodTruck()
    {
        $data = [
            'food_truck' => FoodTruck::find(1),
        ];
        return view('admin.edit.food_truck', $data);
    }

    public function updateFoodTruck(Request $request)
    {
        $request->validate([
            'food_truck_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'food_truck_text' => 'required|string|max:4294967295',
        ],
        [
            'food_truck_text.required' => 'テキストを入力してください。',
            'food_truck_text.max' => '画像を挿入した場合はサイズを小さくしてください。',
        ]);

        try {
            if ($request->file('food_truck_img')) {
                $image = InterventionImage::make($request->file('food_truck_img'));
                $image->orientate();
                $img_name = $request->file('food_truck_img')->getClientOriginalName();
                $filePath = storage_path('app/public/'.$img_name);
                $image->save($filePath);

                $data = [
                    'food_truck_img' => $img_name,
                    'food_truck_text' => $request->food_truck_text,
                ];
            } else {
                $data = [
                    'food_truck_text' => $request->food_truck_text,
                ];
            }

            $food_truck = FoodTruck::find(1);
            $food_truck->update($data);

            return back()->with('success', 'Food Truck updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Food Truck updated failed!');
        }
    }

    public function editContact()
    {
        $data = [
            'contact_types' => ContactType::all(),
            'contacts' => Contact::all(),
        ];
        return view('admin.edit.contact', $data);
    }

    public function updateContact(Request $request)
    {
        $request->validate([
            'contact_title' => 'required|string|max:255',
            'contact_description' => 'required|string|max:255',
            'contact_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $contact_image = $request->file('contact_image');
        $contact_image_name = time() . '.' . $contact_image->extension();
        $contact_image->move(public_path('images'), $contact_image_name);

        $data = [
            'contact_title' => $request->contact_title,
            'contact_description' => $request->contact_description,
            'contact_image' => $contact_image_name,
        ];

        $contact = Contact::find(1);
        $contact->update($data);

        return back()->with('success', 'Contact updated successfully!');
    }

    public function editSponsor()
    {
        $data = [
            'sponsors' => Sponsor::all(),
            'coming_soons' => ComingSoon::find(1),
        ];
        return view('admin.edit.sponsor', $data);
    }

    public function publishSponsor(Request $request)
    {
        try {
            $coming_soon = ComingSoon::find(1);
            $coming_soon->update(['sponsor' => $request->publish]);
            if ($request->publish == 1) {
                return response(['success' => 'スポンサーを公開しました。'], 200);
            } else {
                return response(['success' => 'スポンサーを非公開にしました。'], 200);
            }
        } catch (\Exception $e) {
            return response(['error' => 'スポンサーの公開に失敗しました。'], 500);
        }
    }

    public function updateSponsor(Request $request)
    {
        try {
            foreach ($request->id as $index => $id) {
                if ($request->file('sponsor_logo-'.$id)) {
                    $image = InterventionImage::make($request->file('sponsor_logo-'.$id));
                    $image->orientate();
                    $img_name = $request->file('sponsor_logo-'.$id)->getClientOriginalName();
                    $filePath = storage_path('app/public/sponsor/'.$img_name);
                    $image->save($filePath);
                    $data[] = [
                        'id' => $index + 1,
                        'sponsor_logo' => $img_name,
                        'sponsor_name' => $request->sponsor_name[$id],
                        'sponsor_url' => $request->sponsor_url[$id],
                    ];
                } else {
                    $sponsor = Sponsor::find($id);
                    if ($sponsor) {
                        $data[] = [
                            'id' => $index + 1,
                            'sponsor_logo' => $sponsor->sponsor_logo,
                            'sponsor_name' => $request->sponsor_name[$id],
                            'sponsor_url' => $request->sponsor_url[$id],
                        ];
                    } else {
                        $data[] = [
                            'id' => $index + 1,
                            'sponsor_logo' => null,
                            'sponsor_name' => $request->sponsor_name[$id],
                            'sponsor_url' => $request->sponsor_url[$id],
                        ];
                    }
                }
            }
            DB::beginTransaction();
            foreach ($data as $item) {
                Sponsor::updateOrCreate(['id' => $item['id']], [
                    'sponsor_logo' => $item['sponsor_logo'],
                    'sponsor_name' => $item['sponsor_name'],
                    'sponsor_url' => $item['sponsor_url'],
                ]);
            }
            DB::commit();

            return back()->with('success', 'Food updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Food updated failed!')->with('msg', $e->getMessage())->with('request', $request->all())->with('data', $data);
        }
    }

    public function destroySponsor($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $target = Sponsor::find($id);
            if (Sponsor::all()->count() > 1) {
                $target->delete();
                DB::commit();
                return back()->with('success', 'Sponsor deleted successfully!');
            } else {
                DB::rollBack();
                return back()->with('error', 'Sponsor deleted failed!');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Sponsor deleted failed!');
        }
    }
}
