<?php // Code within app\Helpers\Helper.php

namespace app\Helpers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use App\Models\Right;
use App\Models\RoleRight;
use App\Models\Setting;
use App\Models\Otp;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use App\Models\ProductPart;
use App\Models\Translation;
use App\Models\Company;
use App\Models\MyFest;
use App\Models\PartnerProduct;
// use Auth;

class Helper
{

    public static function hasRight($right, $role_id = null)
    {
        if ($role_id != null) {
            $role = $role_id;
        } else {
            $role = \Auth::user()->role;
        }
        $right = Right::where('name', $right)->first();
        if (RoleRight::where('role_id', $role)->where('right_id', $right->id)->where('permission', 1)->exists()) {
            return true;
        } else {
            return false;
        }
    }

    public static function getSettings($key)
    {
        $settings = Setting::where('key', $key)->first();
        if (!is_null($settings)) {
            return $settings->value;
        } else {
            return false;
        }
    }


    public static function sendEmail($email, $subject, $data, $template = 'default')
    {
        Mail::send('mails.' . $template, ['data' => $data], function ($message) use ($email, $subject) {
            $message->from(env('MAIL_FROM_ADDRESS'), $subject);
            $message->to($email)->subject($subject);
        });
    }

    public static function checkotp($email, $otp)
    {
        $otp = Otp::where('email', $email)->where('otp', $otp)->where('status', 0)->first();
        if ($otp) {
            return true;
        }
    }

    public static function priceFaterOffer($product_id)
    {
        $product = Product::find($product_id);
        $dicount = 0;

        if (auth()->check() == true) {
            $user = Auth::user();
            $partner = Company::where('user_id', $user->id)->where('status', 1)->first();
            if ($partner) {

                $product_assing = PartnerProduct::where('company_id', $partner->company_id)->where('product_id', $product->id)->first();

                if (isset($product_assing->discount_price) && $product_assing->discount_price > 0) {
                    if ($product_assing->discount_type && $product_assing->discount_type == 'percent') {
                        $dicount = $product->price - ($product_assing->discount_price * $product->price) / 100;
                    } else if ($product_assing->discount_type && $product_assing->discount_type == 'amount') {
                        $dicount = $product->price - $product_assing->discount_price;
                    } else {
                        $dicount = $product->price;
                    }

                    return $dicount;
                } else if (isset($partner->discount) && $partner->discount > 0) {
                    if ($partner->discount_type && $partner->discount_type == 'percent') {
                        $dicount = $product->price - ($partner->discount * $product->price) / 100;
                    } else if ($partner->discount_type && $partner->discount_type == 'amount') {
                        $dicount = $product->price - $partner->discount;
                    } else {
                        $dicount = $product->price;
                    }

                    return $dicount;
                } else if (isset($product->discount) && $product->discount > 0) {
                    if ($product->discount_type && $product->discount_type == 'percent') {
                        $dicount = $product->price - ($product->discount * $product->price) / 100;
                    } else if ($product->discount_type && $product->discount_type == 'amount') {
                        $dicount = $product->price - $product->discount;
                    } else {
                        $dicount = $product->price;
                    }

                    return $dicount;
                } else {
                    $dicount = $product->price;
                    return $dicount;
                }
            } else {

                $dicount = $product->price;
                return $dicount;
            }
        } else {

            $dicount = $product->price;
            return $dicount;
        }
    }


    public static function productDiscountAmount($product_id)
    {
        $product = Product::find($product_id);
        $dicount = 0;

        if (auth()->check()) {
            $user = Auth::user();
            $partner = Company::where('user_id', $user->id)->where('status', 1)->first();
            if ($partner) {

                $product_assing = PartnerProduct::where('company_id', $partner->company_id)->where('product_id', $product->id)->first();

                if (isset($product_assing->discount_price) && $product_assing->discount_price > 0) {
                    if ($product_assing->discount_type && $product_assing->discount_type == 'percent') {
                        $dicount = ($product_assing->discount_price * $product->price) / 100;
                    } else if ($product_assing->discount_type && $product_assing->discount_type == 'amount') {
                        $dicount = $product_assing->discount_price;
                    } else {
                        $dicount = $product->discount;
                    }

                    return $dicount;
                }

                if (isset($partner->discount) && $partner->discount > 0) {
                    if ($partner->discount_type && $partner->discount_type == 'percent') {
                        $dicount = ($partner->discount * $product->price) / 100;
                    } else if ($partner->discount_type && $partner->discount_type == 'amount') {
                        $dicount = $partner->discount;
                    } else {
                        $dicount = $product->discount;
                    }

                    return $dicount;
                }

                if (isset($product->discount) && $product->discount > 0) {
                    if ($product->discount_type && $product->discount_type == 'percent') {
                        $dicount = ($product->discount * $product->price) / 100;
                    } else if ($product->discount_type && $product->discount_type == 'amount') {
                        $dicount = $product->discount;
                    } else {
                        $dicount = $product->discount;
                    }

                    return $dicount;
                }
            } else {

                $dicount = $product->discount;
                return $dicount;
            }
        } else {
            return $dicount;
        }
    }

    public static function partPriceFaterOffer($part_id)
    {
        $part = ProductPart::find($part_id);
        $dicount = 0;

        if ($part->discount_type && $part->discount_type == 'percent') {
            $dicount = $part->price - ($part->discount * $part->price) / 100;
        } else if ($part->discount_type && $part->discount_type == 'amount') {
            $dicount = $part->price - $part->discount;
        }

        if ($dicount > 0) {
            return $dicount;
        } else {
            return $part->price;
        }
    }

    public static function partDiscountAmount($part_id)
    {
        $part = ProductPart::find($part_id);
        $dicount = 0;
        if ($part->discount_type && $part->discount_type == 'percent') {
            $dicount = ($part->discount * $part->price) / 100;
        } else if ($part->discount_type && $part->discount_type == 'amount') {
            $dicount = $part->discount;
        }
        return $dicount;
    }


    public static function alreadyInCart($product_id)
    {
        $return = false;
        if (session()->has('cartlist')) {
            $cartlist = session()->get('cartlist');
            if (isset($cartlist[$product_id])) {
                $return = true;
            }
        }
        return $return;
    }

    public static function getCart()
    {
        $cart = Cart::where(function ($query) {
            $query->where('session_id', Session::get('session_id'))
                ->orwhere('user_id', Session::get('user_id'));
        })->get();

        return $cart;
    }

    // Helper function to make building xml dom easier
    public static function appendXmlNode($domDocument, $parentNode, $name, $value)
    {
        $childNode      = $domDocument->createElement($name);
        $childNodeValue = $domDocument->createTextNode($value);
        $childNode->appendChild($childNodeValue);
        $parentNode->appendChild($childNode);
    }

    public static function makePayment($xmlRequest, $gatewayURL = null)
    {
        $gatewayURL = 'https://secure.nmi.com/api/transact.php';
        $APIKey = '2F822Rw39fx762MaV7Yy86jXGTC7sCDy';



        $ch = curl_init(); // Initialize curl handle
        curl_setopt($ch, CURLOPT_URL, $gatewayURL); // Set POST URL

        $headers = array();
        $headers[] = "Content-type: text/xml";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Add http headers to let it know we're sending XML
        $xmlString = $xmlRequest->saveXML();
        curl_setopt($ch, CURLOPT_FAILONERROR, 1); // Fail on errors
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // Allow redirects
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Return into a variable
        curl_setopt($ch, CURLOPT_PORT, 443); // Set the port number
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Times out after 30s
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlString); // Add XML directly in POST

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);


        // This should be unset in production use. With it on, it forces the ssl cert to be valid
        // before sending info.
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        if (!($data = curl_exec($ch))) {
            print  "curl error =>" . curl_error($ch) . "\n";
            throw new Exception(" CURL ERROR :" . curl_error($ch));
        }
        curl_close($ch);

        return $data;
    }

    public static function insertLanguage($translatable_type, $translatable_id, $language_code, $field, $value)
    {
        $language = Translation::firstOrNew(array('translatable_type' => $translatable_type, 'translatable_id' => $translatable_id, 'language_code' => $language_code, 'field' => $field));
        $language->translatable_type = $translatable_type;
        $language->translatable_id = $translatable_id;
        $language->language_code = $language_code;
        $language->field = $field;
        $language->value = $value;
        $language->save();
    }

    public static function getCountrynameByCode($code)
    {
        $all_country = Helper::getCountryCodes();
        $key = array_search($code, $all_country);
        return $key;
    }

    public static function getCountryCodes()
    {
        return [
            "Afghanistan" => "004",
            "Åland Islands" => "248",
            "Albania" => "008",
            "Algeria" => "012",
            "American Samoa" => "016",
            "Andorra" => "020",
            "Angola" => "024",
            "Anguilla" => "660",
            "Antarctica" => "010",
            "Antigua and Barbuda" => "028",
            "Argentina" => "032",
            "Armenia" => "051",
            "Aruba" => "533",
            "Australia" => "036",
            "Austria" => "040",
            "Bahamas" => "044",
            "Bahrain" => "048",
            "Bangladesh" => "050",
            "Barbados" => "052",
            "Belarus" => "112",
            "Belgium" => "056",
            "Belize" => "084",
            "Benin" => "204",
            "Bermuda" => "060",
            "Bhutan" => "064",
            "Bolivia:  Plurinational State of" => "068",
            "Bonaire:  Sint Eustatius and Saba" => "535",
            "Bosnia and Herzegovina" => "070",
            "Botswana" => "072",
            "Bouvet Island" => "074",
            "Brazil" => "076",
            "British Indian Ocean Territory" => "086",
            "Brunei Darussalam" => "096",
            "Bulgaria" => "100",
            "Burkina Faso" => "854",
            "Burundi" => "108",
            "Cambodia" => "116",
            "Cameroon" => "120",
            "Canada" => "124",
            "Cape Verde" => "132",
            "Cayman Islands" => "136",
            "Central African Republic" => "140",
            "Chad" => "148",
            "Chile" => "152",
            "China" => "156",
            "Christmas Island" => "162",
            "Cocos (Keeling) Islands" => "166",
            "Colombia" => "170",
            "Comoros" => "174",
            "Congo" => "178",
            "Congo:  the Democratic Republic of the" => "180",
            "Cook Islands" => "184",
            "Costa Rica" => "188",
            "Côte d'Ivoire" => "384",
            "Croatia" => "191",
            "Cuba" => "192",
            "Curaçao" => "531",
            "Cyprus" => "196",
            "Czech Republic" => "203",
            "Denmark" => "208",
            "Djibouti" => "262",
            "Dominica" => "212",
            "Dominican Republic" => "214",
            "Ecuador" => "218",
            "Egypt" => "818",
            "El Salvador" => "222",
            "Equatorial Guinea" => "226",
            "Eritrea" => "232",
            "Estonia" => "233",
            "Eswatini" => "748",
            "Ethiopia" => "231",
            "Falkland Islands (Malvinas)" => "238",
            "Faroe Islands" => "234",
            "Fiji" => "242",
            "Finland" => "246",
            "France" => "250",
            "French Guiana" => "254",
            "French Polynesia" => "258",
            "French Southern Territories" => "260",
            "Gabon" => "266",
            "Gambia" => "270",
            "Georgia" => "268",
            "Germany" => "276",
            "Ghana" => "288",
            "Gibraltar" => "292",
            "Greece" => "300",
            "Greenland" => "304",
            "Grenada" => "308",
            "Guadeloupe" => "312",
            "Guam" => "316",
            "Guatemala" => "320",
            "Guernsey" => "831",
            "Guinea" => "324",
            "Guinea-Bissau" => "624",
            "Guyana" => "328",
            "Haiti" => "332",
            "Heard Island and McDonald Islands" => "334",
            "Holy See (Vatican City State)" => "336",
            "Honduras" => "340",
            "Hong Kong" => "344",
            "Hungary" => "348",
            "Iceland" => "352",
            "India" => "356",
            "Indonesia" => "360",
            "Iran:  Islamic Republic of" => "364",
            "Iraq" => "368",
            "Ireland" => "372",
            "Isle of Man" => "833",
            "Israel" => "376",
            "Italy" => "380",
            "Jamaica" => "388",
            "Japan" => "392",
            "Jersey" => "832",
            "Jordan" => "400",
            "Kazakhstan" => "398",
            "Kenya" => "404",
            "Kiribati" => "296",
            "Korea:  Democratic People's Republic of" => "408",
            "Korea:  Republic of" => "410",
            "Kuwait" => "414",
            "Kyrgyzstan" => "417",
            "Lao People's Democratic Republic" => "418",
            "Latvia" => "428",
            "Lebanon" => "422",
            "Lesotho" => "426",
            "Liberia" => "430",
            "Libya" => "434",
            "Liechtenstein" => "438",
            "Lithuania" => "440",
            "Luxembourg" => "442",
            "Macao" => "446",
            "Macedonia:  the Former Yugoslav Republic of" => "807",
            "Madagascar" => "450",
            "Malawi" => "454",
            "Malaysia" => "458",
            "Maldives" => "462",
            "Mali" => "466",
            "Malta" => "470",
            "Marshall Islands" => "584",
            "Martinique" => "474",
            "Mauritania" => "478",
            "Mauritius" => "480",
            "Mayotte" => "175",
            "Mexico" => "484",
            "Micronesia:  Federated States of" => "583",
            "Moldova:  Republic of" => "498",
            "Monaco" => "492",
            "Mongolia" => "496",
            "Montenegro" => "499",
            "Montserrat" => "500",
            "Morocco" => "504",
            "Mozambique" => "508",
            "Myanmar" => "104",
            "Namibia" => "516",
            "Nauru" => "520",
            "Nepal" => "524",
            "Netherlands" => "528",
            "New Caledonia" => "540",
            "New Zealand" => "554",
            "Nicaragua" => "558",
            "Niger" => "562",
            "Nigeria" => "566",
            "Niue" => "570",
            "Norfolk Island" => "574",
            "Northern Mariana Islands" => "580",
            "Norway" => "578",
            "Oman" => "512",
            "Pakistan" => "586",
            "Palau" => "585",
            "Palestine:  State of" => "275",
            "Panama" => "591",
            "Papua New Guinea" => "598",
            "Paraguay" => "600",
            "Peru" => "604",
            "Philippines" => "608",
            "Pitcairn" => "612",
            "Poland" => "616",
            "Portugal" => "620",
            "Puerto Rico" => "630",
            "Qatar" => "634",
            "Réunion" => "638",
            "Romania" => "642",
            "Russian Federation" => "643",
            "Rwanda" => "646",
            "Saint Barthélemy" => "652",
            "Saint Helena:  Ascension and Tristan da Cunha" => "654",
            "Saint Kitts and Nevis" => "659",
            "Saint Lucia" => "662",
            "Saint Martin (French part)" => "663",
            "Saint Pierre and Miquelon" => "666",
            "Saint Vincent and the Grenadines" => "670",
            "Samoa" => "882",
            "San Marino" => "674",
            "Sao Tome and Principe" => "678",
            "Saudi Arabia" => "682",
            "Senegal" => "686",
            "Serbia" => "688",
            "Seychelles" => "690",
            "Sierra Leone" => "694",
            "Singapore" => "702",
            "Sint Maarten (Dutch part)" => "534",
            "Slovakia" => "703",
            "Slovenia" => "705",
            "Solomon Islands" => "090",
            "Somalia" => "706",
            "South Africa" => "710",
            "South Georgia and the South Sandwich Islands" => "239",
            "South Sudan" => "728",
            "Spain" => "724",
            "Sri Lanka" => "144",
            "Sudan" => "729",
            "Suriname" => "740",
            "Svalbard and Jan Mayen" => "744",
            "Sweden" => "752",
            "Switzerland" => "756",
            "Syrian Arab Republic" => "760",
            "Taiwan:  Province of China" => "158",
            "Tajikistan" => "762",
            "Tanzania:  United Republic of" => "834",
            "Thailand" => "764",
            "Timor-Leste" => "626",
            "Togo" => "768",
            "Tokelau" => "772",
            "Tonga" => "776",
            "Trinidad and Tobago" => "780",
            "Tunisia" => "788",
            "Turkey" => "792",
            "Turkmenistan" => "795",
            "Turks and Caicos Islands" => "796",
            "Tuvalu" => "798",
            "Uganda" => "800",
            "Ukraine" => "804",
            "United Arab Emirates" => "784",
            "United Kingdom" => "826",
            "United States" => "840",
            "United States Minor Outlying Islands" => "581",
            "Uruguay" => "858",
            "Uzbekistan" => "860",
            "Vanuatu" => "548",
            "Venezuela:  Bolivarian Republic of" => "862",
            "Viet Nam" => "704",
            "Virgin Islands:  British" => "092",
            "Virgin Islands:  U.S." => "850",
            "Wallis and Futuna" => "876",
            "Western Sahara" => "732",
            "Yemen" => "887",
            "Zambia" => "894",
            "Zimbabwe" => "716",
        ];
    }

    public static function event($event, $user_id = null)
    {
        if ($user_id) {
            $my_fest = MyFest::where([['user_id', $user_id], ['event_id', $event->id]])->first();
            if ($my_fest) {
                $event->is_liked = 1;
                $event->fest_id = $my_fest->id;
            } else {
                $event->is_liked = 0;
            }
        } else {
            $event->is_liked = 0;
        }

        /* Pricing Count Start */
        if ($event->discount_type == 'fixed') {
            $event->amount = $event->amount - $event->discount_value;
        }
        if ($event->discount_type == 'percentage') {
            $event->amount = $event->amount * (1 - ($event->discount_value / 100));
        }
        if ($event->is_free == '1') {
            $event->amount = 'Free';
        }
        /* Pricing Count End */

        $event->venue = $event->venue()->select('name', 'address')->first();
        $event->venue->address = $event->venue->address()->select('country', 'city', 'state', 'latitude', 'longitude')->first();
        $event->event_artists = $event->event_artists()->select('artist_id')->get();
        $artists = [];
        foreach ($event->event_artists as $event_artist) {
            $artist = $event_artist->artist()->first();
            $artist->social_media_links = json_decode($artist->social_media_links);
            $artist->profile_image = env("APP_URL") . '/uploads/user-images/' . $artist->profile_image;
            $artists[] = $artist;
        }
        $event->artists = $artists;
        unset($event->event_artists);

        $event->event_sponsors = $event->event_sponsors()->select('sponsor_id')->get();
        $sponsors = [];
        foreach ($event->event_sponsors as $event_sponsor) {
            $sponsor = $event_sponsor->sponsor()->first();
            $sponsor->social_media_links = json_decode($sponsor->social_media_links);
            $sponsor->profile_image = env("APP_URL") . '/uploads/user-images/' . $sponsor->profile_image;
            $sponsors[] = $sponsor;
        }
        $event->sponsors = $sponsors;
        unset($event->event_sponsors);

        $banners = json_decode($event->banner);
        $new_banners = [];
        foreach ($banners as $item) {
            $new_banners[] = env("APP_URL") . '/uploads/event-images/' . $item;
        }
        $event->banner = $new_banners;
        $event->social_media_links = json_decode($event->social_media_links);

        return $event;
    }

    public static function venue($venue, $user_id = null)
    {
        $venue->address = $venue->address()->select('country', 'city', 'state', 'latitude', 'longitude', 'address_line_1', 'address_line_2')->first();
        $new_images = [];
        foreach (json_decode($venue->images) as $image) {
            $new_images[] = env("APP_URL") . '/uploads/venue-images/' . $image;
        }
        $venue->images = $new_images;
        $venue->social_media_links = json_decode($venue->social_media_links);
        return $venue;
    }

    public static function sendPushNotification($device_token, $title, $body, $news_id, $image)
    {

        $data = [
            'to' => $device_token,
            'content_available' => true,
            "sticky" => true,
            'notification' => [
                'title' => $title,
                'body' => $body,
                'style' => 'picture',
                "image" => env("APP_URL") . '/uploads/news-images/' . $image,
                "click_action" => 'news-details/'.$news_id
            ],
            'data' => [
                'title' => $title,
                'body' => json_encode($body),
                'status' => 'done',
                "image" => env("APP_URL") . '/uploads/news-images/' . $image,
                "click_action" => 'news-details/'.$news_id
            ],
        ];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                "Authorization: key=AAAAk19AU8Q:APA91bHDHYZb1PKD2YTOiTQILmsUQnQFtYLHSF21RbyOeWRXmd5BbQ9_as4FQcpq_316smqZ-IZbPyBVsU5hSbYWzZgh-31qJLICFEOu9A6-SvyAf64jo3shNV4QE8aULN68Z8f0fZxj",
                "Content-Type: application/json"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }
}
