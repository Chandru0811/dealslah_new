<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use App\Models\CategoryGroup;
use App\Models\Category;
use App\Models\CouponCodeUsed;
use App\Models\Slider;
use App\Traits\ApiResponses;
use App\Models\DealCategory;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\DealClick;
use App\Models\Dealenquire;
use App\Models\DealShare;
use App\Models\DealViews;
use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;

class AppController extends Controller
{
    use ApiResponses;

    public function homepage(Request $request)
    {
        $today = now()->toDateString();

        $categoryGroups = CategoryGroup::where('active', 1)->take(10)->get();
        $sliders = Slider::get();
        $cashBackDeals = DealCategory::where('active', 1)->get();

        $products = Product::where('active',1)->with(['shop:id,city,shop_ratings'])->get();

        $treandingdeals = DealViews::whereDate('viewed_at',Carbon::today())->get();
        $populardeals = DealViews::select('deal_id', DB::raw('count(*) as total_views'))->groupBy('deal_id')->limit(5)->orderBy('total_views', 'desc')->having('total_views', '>', 10)->get(); 
        $earlybirddeals = Product::where('active', 1)->whereDate('start_date', now())->get();
        $lastchancedeals = Product::where('active', 1)->whereDate('end_date', now())->get();
        $limitedtimedeals = Product::where('active', 1)->whereRaw('DATEDIFF(end_date, start_date) <= ?', [2])->get();

        $bookmarkedProducts = collect();

        if (Auth::check()) {
            $userId = Auth::id();
            $bookmarkedProducts = Bookmark::where('user_id', $userId)->pluck('deal_id');
        } else {
            $ipAddress = $request->ip();
            $bookmarkedProducts = Bookmark::where('ip_address', $ipAddress)->pluck('deal_id');
        }

        $homePageData = [
            'categoryGroups' => $categoryGroups,
            'sliders' => $sliders,
            'cashBackDeals' => $cashBackDeals,
            'products' => $products,
            'bookmarkedProducts' => $bookmarkedProducts,
            'treandingdeals' => $treandingdeals,
            'populardeals' => $populardeals,
            'earlybirddeals' => $earlybirddeals,
            'lastchancedeals' => $lastchancedeals,
            'limitedtimedeals' => $limitedtimedeals
        ];

        return $this->success('HomePage Retrieved Successfully!', $homePageData);
    }

    public function categories($id)
    {
        $categories = Category::where('active', 1)
        ->where('category_group_id', $id)
        ->withCount(['products' => function ($query) {
            $query->where('active', 1);
        }])
            ->get();

        return $this->success('Categories Retrieved Successfully!', $categories);
    }

    public function getDeals($category_id, Request $request)
    {
        $deals = Product::with('shop')->where('category_id', $category_id)->where('active', 1)->get();
        $brands = Product::where('active', 1)->distinct()->pluck('brand');
        $discounts = Product::where('active', 1)->distinct()->pluck('discount_percentage');
        $rating_items = Shop::where('active', 1)->select('shop_ratings', DB::raw('count(*) as rating_count'))->groupBy('shop_ratings')->get();
        $priceRanges = [];
        $priceStep = 2000;
        $minPrice = Product::min(DB::raw('LEAST(original_price, discounted_price)'));
        $maxPrice = Product::max(DB::raw('GREATEST(original_price, discounted_price)'));

        for ($start = $minPrice; $start <= $maxPrice; $start += $priceStep) {
            $end = $start + $priceStep;

            if ($end > $maxPrice) {
                $priceRanges[] = [
                    'label' => '$' . number_format($start, 2) . ' - $' . number_format($end, 2)
                ];
                break;
            }
            $priceRanges[] = [
                'label' => '$' . number_format($start, 2) . ' - $' . number_format($end, 2)
            ];
        }
        $shortby = DealCategory::where('active', 1)->get();
        $totaldeals = $deals->count();

        $bookmarkedProducts = collect();

        if (Auth::check()) {
            $userId = Auth::id();
            $bookmarkedProducts = Bookmark::where('user_id', $userId)->pluck('deal_id');
        } else {
            $ipAddress = $request->ip();
            $bookmarkedProducts = Bookmark::where('ip_address', $ipAddress)->pluck('deal_id');
        }

        $dealdata = [
            'deals' => $deals,
            'brands' => $brands,
            'discounts' => $discounts,
            'rating_items' => $rating_items,
            'priceRanges' => $priceRanges,
            'shortby' => $shortby,
            'totaldeals' => $totaldeals,
            'bookmarkedProducts' => $bookmarkedProducts,
        ];

        return $this->success('Deals Retrieved Successfully!', $dealdata);
    }

    public function dealDescription($id, Request $request)
    {
        $deal = Product::with(['shop', 'shop.hour', 'shop.policy'])
            ->where('id', $id)
            ->where('active', 1)
            ->first();

        if (!$deal) {
            return $this->error('Deal not found!', 404);
        }

        $isBookmarked = false;

        if (Auth::check()) {
            $userId = Auth::id();
            $isBookmarked = Bookmark::where('user_id', $userId)->where('deal_id', $id)->exists();
        } else {
            $ipAddress = $request->ip();
            $isBookmarked = Bookmark::where('ip_address', $ipAddress)->where('deal_id', $id)->exists();
        }

        $dealData = $deal->toArray();
        $dealData['is_bookmarked'] = $isBookmarked;

        return $this->success('Deal Retrieved Successfully!', $dealData);
    }

    public function search(Request $request)
    {
        $term = $request->input('q');
        $perPage = $request->input('per_page', 10);

        $query = Product::with('shop', 'bookmark')->where('active', 1);

        if (!empty($term)) {
            $query->where(function ($subQuery) use ($term) {
                $subQuery->where('name', 'LIKE', '%' . $term . '%')
                    ->orWhereHas('shop', function ($shopQuery) use ($term) {
                        $shopQuery->where('name', 'LIKE', '%' . $term . '%')
                            ->orWhere('country', 'LIKE', '%' . $term . '%')
                            ->orWhere('state', 'LIKE', '%' . $term . '%')
                            ->orWhere('city', 'LIKE', '%' . $term . '%')
                            ->orWhere('street', 'LIKE', '%' . $term . '%')
                            ->orWhere('street2', 'LIKE', '%' . $term . '%');
                    });
            });
        }

        if ($request->has('brand')) {
            $brandTerms = $request->input('brand');

            if (!is_array($brandTerms)) {
                $brandTerms = [$brandTerms];
            }

            if (count($brandTerms) > 0) {
                $query->whereIn('brand', $brandTerms);
            }
        }

        if ($request->has('category')) {
            $categoryId = $request->input('category');
            $query->where('category_id', $categoryId);
            
            $brands = Product::where('active', 1)->where('category_id',$categoryId)->distinct()->pluck('brand');
            $discounts = Product::where('active', 1)->where('category_id',$categoryId)->distinct()->pluck('discount_percentage');
            $minPrice = Product::where('category_id',$categoryId)->min(DB::raw('LEAST(original_price, discounted_price)'));
            $maxPrice = Product::where('category_id',$categoryId)->max(DB::raw('GREATEST(original_price, discounted_price)'));
        }else{
            $brands = Product::where('active', 1)->distinct()->pluck('brand');
            $discounts = Product::where('active', 1)->distinct()->pluck('discount_percentage');
            $minPrice = Product::min(DB::raw('LEAST(original_price, discounted_price)'));
            $maxPrice = Product::max(DB::raw('GREATEST(original_price, discounted_price)'));
        }

        if ($request->has('discount')) {
            $discountTerm = $request->input('discount');

            if (is_array($discountTerm) && count($discountTerm) > 0) {
                $query->whereIn('discount_percentage', $discountTerm);
            }
        }

        if ($request->has('rating_item') && is_array($request->rating_item)) {
            $ratings = $request->rating_item;
            if (!empty($ratings)) {
                $query->whereHas('shop', function ($q) use ($ratings) {
                    $q->whereIn('shop_ratings', $ratings);
                });
            }
        }

        if ($request->has('price_range')) {

            $priceRange = $request->input('price_range');

            $priceRange = str_replace(['$', ',', ' '], '', $priceRange[0]);
            $priceRange = explode('-', $priceRange);

            $minPrice = isset($priceRange[0]) ? (float)$priceRange[0] : null;
            $maxPrice = isset($priceRange[1]) ? (float)$priceRange[1] : null;

            $query->where(function ($priceQuery) use ($minPrice, $maxPrice) {
                if ($maxPrice !== null) {

                    $priceQuery->whereBetween('original_price', [$minPrice, $maxPrice])
                        ->orWhereBetween('discounted_price', [$minPrice, $maxPrice]);
                } else {

                    $priceQuery->where('original_price', '>=', $minPrice)
                        ->orWhere('discounted_price', '>=', $minPrice);
                }
            });
        }

        if ($request->has('short_by')) {
            $shortby = $request->input('short_by');
        
            if ($shortby == 'trending') {
                $query->withCount(['views' => function ($viewQuery) {
                        $viewQuery->whereDate('viewed_at', now()->toDateString());
                    }])
                    ->with(['shop:id,country,state,city,street,street2,zip_code,shop_ratings'])
                    ->orderBy('views_count', 'desc')
                    ->addSelect(DB::raw("'TRENDING' as label"));
            } elseif ($shortby == 'popular') {
                $query->withCount('views')
                    ->with(['shop:id,country,state,city,street,street2,zip_code,shop_ratings'])
                    ->orderBy('views_count', 'desc')
                    ->addSelect(DB::raw("'POPULAR' as label"));
            } elseif ($shortby == 'early_bird') {
                $query->with(['shop:id,country,state,city,street,street2,zip_code,shop_ratings'])
                    ->whereDate('start_date', now())
                    ->addSelect(DB::raw("'EARLY BIRD' as label"));
            } elseif ($shortby == 'last_chance') {
                $query->with(['shop:id,country,state,city,street,street2,zip_code,shop_ratings'])
                    ->whereDate('end_date', now())
                    ->addSelect(DB::raw("'LAST CHANCE' as label"));
            } elseif ($shortby == 'limited_time') {
                $query->with(['shop:id,country,state,city,street,street2,zip_code,shop_ratings'])
                    ->whereRaw('DATEDIFF(end_date, start_date) <= ?', [2])
                    ->addSelect(DB::raw("'LIMITED TIME' as label"));
            }
        }

        $deals = $query->paginate($perPage);

        $rating_items = Shop::where('active', 1)
            ->select('shop_ratings', DB::raw('count(*) as rating_count'))
            ->groupBy('shop_ratings')
            ->get();

        $priceRanges = [];
        $priceStep = 2000;
        
        for ($start = $minPrice; $start <= $maxPrice; $start += $priceStep) {
            $end = $start + $priceStep;

            if ($end > $maxPrice) {
                $priceRanges[] = [
                    'label' => '$' . number_format($start, 2) . ' - $' . number_format($end, 2)
                ];
                break;
            }
            $priceRanges[] = [
                'label' => '$' . number_format($start, 2) . ' - $' . number_format($end, 2)
            ];
        }

        $shortby = DealCategory::where('active', 1)->get();
        $totaldeals = $deals->total();

        $bookmarkedProducts = collect();

        if (Auth::check()) {
            $userId = Auth::id();
            $bookmarkedProducts = Bookmark::where('user_id', $userId)->pluck('deal_id');
        } else {
            $ipAddress = $request->ip();
            $bookmarkedProducts = Bookmark::where('ip_address', $ipAddress)->pluck('deal_id');
        }

        $dealdata = [
            'deals' => $deals,
            'brands' => $brands,
            'discounts' => $discounts,
            'rating_items' => $rating_items,
            'priceRanges' => $priceRanges,
            'shortby' => $shortby,
            'totaldeals' => $totaldeals,
            'bookmarkedProducts' => $bookmarkedProducts
        ];

        return $this->success('Deals Retrieved Successfully!', $dealdata);
    }

    public function dealcategorybasedproductsformobile($slug, Request $request)
    {
        $perPage = 10;
        $today = now()->toDateString();
        $deals = collect();

        if ($slug == 'trending') {
            $deals = Product::where('active', 1)
                ->withCount(['views' => function ($query) use ($today) {
                    $query->whereDate('viewed_at', $today);
                }])->with(['shop:id,country,state,city,street,street2,zip_code,shop_ratings'])
                ->orderBy('views_count', 'desc')
                ->paginate($perPage);
        } elseif ($slug == 'popular') {
            $deals = Product::where('active', 1)
                ->withCount('views')->with(['shop:id,country,state,city,street,street2,zip_code,shop_ratings'])
                ->orderBy('views_count', 'desc')
                ->paginate($perPage);
        } elseif ($slug == 'early_bird') {
            $deals = Product::where('active', 1)
                ->with(['shop:id,country,state,city,street,street2,zip_code,shop_ratings'])
                ->whereDate('start_date', now())
                ->paginate($perPage);
        } elseif ($slug == 'last_chance') {
            $deals = Product::where('active', 1)
                ->with(['shop:id,country,state,city,street,street2,zip_code,shop_ratings'])
                ->whereDate('end_date', now())
                ->paginate($perPage);
        } elseif ($slug == 'limited_time') {
            $deals = Product::where('active', 1)
                ->with(['shop:id,country,state,city,street,street2,zip_code,shop_ratings'])
                ->whereRaw('DATEDIFF(end_date, start_date) <= ?', [2])
                ->paginate($perPage);
        }elseif($slug == 'nearby')
        {
            $user_latitude = $request->input('latitude');
            $user_longitude = $request->input('longitude');

            if (!isset($user_latitude) || !isset($user_longitude)) {
                return response()->json(['error' => "user's location is empty"]);
            }

            $shops = Shop::select("shops.id", "shops.name",
                        DB::raw("6371 * acos(cos(radians(" . $user_latitude . "))
                        * cos(radians(shops.shop_lattitude))
                        * cos(radians(shops.shop_longtitude) - radians(" . $user_longitude . "))
                        + sin(radians(" . $user_latitude . "))
                        * sin(radians(shops.shop_lattitude))) AS distance"))
                        ->having('distance', '<', 10)
                        ->orderBy('distance', 'asc')
                        ->get();

            $shopIds = $shops->pluck('id');

            $deals = Product::whereIn('shop_id', $shopIds)->where('active',1)
                    ->with(['shop:id,country,state,city,street,street2,zip_code,shop_ratings'])
                    ->paginate($perPage);
        }

        $brands = Product::where('active', 1)->distinct()->pluck('brand');
        $discounts = Product::where('active', 1)->distinct()->pluck('discount_percentage');
        $rating_items = Shop::where('active', 1)
            ->select('shop_ratings', DB::raw('count(*) as rating_count'))
            ->groupBy('shop_ratings')
            ->get();

        $priceRanges = [];
        $priceStep = 2000;
        $minPrice = Product::min(DB::raw('LEAST(original_price, discounted_price)'));
        $maxPrice = Product::max(DB::raw('GREATEST(original_price, discounted_price)'));

        for ($start = $minPrice; $start <= $maxPrice; $start += $priceStep) {
            $end = $start + $priceStep;

            if ($end > $maxPrice) {
                $priceRanges[] = [
                    'label' => '$' . number_format($start, 2) . ' - $' . number_format($end, 2)
                ];
                break;
            }
            $priceRanges[] = [
                'label' => '$' . number_format($start, 2) . ' - $' . number_format($end, 2)
            ];
        }

        $shortby = DealCategory::where('active', 1)->get();
        $totaldeals = $deals->total();

        $bookmarkedProducts = collect();

        if (Auth::check()) {
            $userId = Auth::id();
            $bookmarkedProducts = Bookmark::where('user_id', $userId)->pluck('deal_id');
        } else {
            $ipAddress = $request->ip();
            $bookmarkedProducts = Bookmark::where('ip_address', $ipAddress)->pluck('deal_id');
        }

        $dealdata = [
            'deals' => $deals,
            'brands' => $brands,
            'discounts' => $discounts,
            'rating_items' => $rating_items,
            'priceRanges' => $priceRanges,
            'shortby' => $shortby,
            'totaldeals' => $totaldeals,
            'bookmarkedProducts' => $bookmarkedProducts
        ];

        return $this->success('Deals Retrieved Successfully!', $dealdata);
    }

    public function addBookmark(Request $request, $deal_id)
    {
        $deal = Product::findOrFail($deal_id);

        $user_id = Auth::check() ? Auth::id() : null;

        if ($user_id) {
            $existing_bookmark = Bookmark::where('deal_id', $deal->id)->where('user_id', $user_id)->first();
        } else {
            $existing_bookmark = Bookmark::where('deal_id', $deal->id)->whereNull('user_id')->where('ip_address', $request->ip())->first();
        }

        if ($existing_bookmark) {
            return response()->json(['message' => 'Deal already bookmarked'], 409);
        }

        Bookmark::updateOrCreate(
            [
                'deal_id' => $deal->id,
                'user_id' => $user_id,
                'ip_address' => $request->ip(),
            ]
        );

        return $this->ok('Item Added SuccessFully!');
    }

    public function removeBookmark(Request $request, $deal_id)
    {
        $user_id = Auth::check() ? Auth::id() : null;

        if ($user_id) {
            $bookmark = Bookmark::where('deal_id', $deal_id)->where('user_id', $user_id)->first();
        } else {
            $bookmark = Bookmark::where('deal_id', $deal_id)->whereNull('user_id')->where('ip_address', $request->ip())->first();
        }

        if ($bookmark) {
            $bookmark->delete();
            return $this->ok('Item Removed from Bookmark!');
        } else {
            return $this->error('Bookmark Not Found.', ['error' => 'Bookmark Not Found']);
        }
    }

    public function totalItems(Request $request)
    {
        $user_id = Auth::check() ? Auth::id() : null;

        $bookmarkCount = Bookmark::where(function ($query) use ($user_id, $request) {
            if ($user_id) {
                $query->where('user_id', $user_id);
            } else {
                $query->whereNull('user_id')->where('ip_address', $request->ip());
            }
        })->count();

        return response()->json(['total_items' => $bookmarkCount]);
    }

    public function getBookmarks(Request $request)
    {
        $user_id = Auth::check() ? Auth::id() : null;

        $bookmarks = Bookmark::where(function ($query) use ($user_id, $request) {
            if ($user_id) {
                $query->where('user_id', $user_id);
            } else {
                $query->whereNull('user_id')->where('ip_address', $request->ip());
            }
        })->with('deal')->paginate(10);

        return $this->success('Item Added SuccessFully!', $bookmarks);
    }

    public function clickcounts(Request $request)
    {
        $dealId = $request->id;
        $userId = Auth::check() ? Auth::id() : null;

        DealClick::create([
            'deal_id' => $dealId, 
            'user_id' => $userId, 
            'ip_address' => request()->ip(),
            'clicked_at' => Carbon::now(), 
        ]);

        return $this->ok('DealClicks Added SuccessFully!');
    }

    public function viewcounts(Request $request)
    {
        $dealId = $request->id;
        $userId = Auth::check() ? Auth::id() : null;
        $ipAddress = $request->ip();

        DealViews::create([
            'deal_id' => $dealId,
            'user_id' => $userId,
            'ip_address' => $ipAddress,
            'viewed_at' => Carbon::now(),
        ]);

        return $this->ok('DealViews Added Successfully!');
    }

    public function couponCopied(Request $request)
    {
        $dealId = $request->id;
            $userId = Auth::check() ? Auth::id() : null;
            $ipAddress = $request->ip();

            CouponCodeUsed::create([
                'deal_id' => $dealId,
                'coupon_code' => $request->coupon_code,
                'user_id' => $userId,
                'ip_address' => $ipAddress,
                'copied_at' => Carbon::now(),
            ]);

            return $this->ok('CouponCode Copied Successfully!');
    }

    public function dealshare(Request $request)
    {
        $dealId = $request->id;
        $userId = Auth::check() ? Auth::id() : null;
        $ipAddress = $request->ip();

        DealShare::create([
            'deal_id' => $dealId,
            'user_id' => $userId,
            'ip_address' => $ipAddress,
            'share_at' => Carbon::now(),
        ]);

        return $this->ok('DealShare Added Successfully!');      
    }

    public function dealenquire(Request $request)
    {
        $dealId = $request->id;
        $userId = Auth::check() ? Auth::id() : null;
        $ipAddress = $request->ip();

        Dealenquire::create([
            'deal_id' => $dealId,
            'user_id' => $userId,
            'ip_address' => $ipAddress,
            'enquire_at' => Carbon::now(),
        ]);

        return $this->ok('Dealenquire Added Successfully!');       
    }

    public function directCheckout($id, Request $request)
    {
        if (!Auth::check()) {
            return $this->error('User is not authenticated. Redirecting to login.', null, 401);
        }

        $user = Auth::user();
        $product = Product::with(['shop'])->where('id', $id)->where('active', 1)->first();

        if (!$product) {
            return $this->error('Product not found or inactive.', null, 404);
        }

        return $this->success('Direct checkout data retrieved successfully.', [
            'product' => $product,
            'user' => $user
        ]);
    }

    public function checkout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'        => 'required|string|max:200',
            'email'             => 'required|email|max:200',
            'mobile'            => 'required|string|max:15',
            'order_type'        => 'required|string|max:50',
            'payment_type'      => 'required|string|max:50',
            'street'            => 'required|string',
            'city'              => 'required|string',
            'state'             => 'required|string',
            'country'           => 'required|string',
            'zipCode'           => 'required|string',
            'product_id'        => 'required|integer'
        ]);

        if ($validator->fails()) {
            return $this->error('Validation failed.', $validator->errors(), 422);
        }

        $validatedData = $validator->validated();

        $address = [
            'street' => $request->input('street'),
            'city' => $request->input('city'),
            'country' => $request->input('country'),
            'state' => $request->input('state'),
            'zipCode' => $request->input('zipCode'),
        ];
        $user_id = Auth::check() ? Auth::id() : null;
        $product = Product::with(['shop'])->where('id', $request->input('product_id'))->where('active', 1)->first();
        $latestOrder = Order::orderBy('id', 'desc')->first();
        $customOrderId = $latestOrder ? intval(Str::after($latestOrder->order_id, '-')) + 1 : 1;
        $orderNumber = 'DEALSMACHI_O' . $customOrderId;
        
        $order = Order::create([
            'order_number'     => $orderNumber,
            'customer_id'      => $user_id,
            'shop_id'          => $product->shop_id,
            'first_name'       => $request->input('first_name'),
            'last_name'        => $request->input('last_name'),
            'email'            => $request->input('email'),
            'mobile'           => $request->input('mobile'),
            'order_type'       => $request->input('order_type'),
            'status'           => 1, 
            'notes'            => $request->input('notes') ?? null,
            'payment_type'     => $request->input('payment_type'),
            'payment_status'   => $request->input('payment_status') ?? "1",
            'total'            => $request->input('total'),
            'service_date'     => $request->input('service_date') ?? null,
            'service_time'     => $request->input('service_time') ?? null,
            'quantity'         => $request->input('quantity') ?? 1,
            'delivery_address' => json_encode($address),
            'coupon_applied'   => $request->input('coupon_applied') ?? false,
            'coupon_code'      => $request->input('coupon_code'),
            
        ]);

        if ($order) {
            OrderItems::create([
                'order_id'         => $order->id,
                'deal_id'       => $product->id,
                'deal_name'         => $product->name,
                'deal_originalprice' => $product->original_price,
                'deal_description' => $product->description ?? null,
                'quantity'         => $request->input('quantity') ?? 1,
                'deal_price'       => $product['discounted_price'],
                'discount_percentage' => $product->discount_percentage,
                'coupon_code' => $product->coupon_code
            ]);
        }

        $statusMessage = $request->input('order_type') == 'Product'
            ? 'Order Created Successfully!'
            : 'Service Booked Successfully!';

        return $this->success($statusMessage, $order);
    }

    public function getAllOrdersByCustomer()
    {
        $customerId = Auth::check() ? Auth::id() : null;

        if (!$customerId) {
            return $this->error('User is not authenticated.', null, 401);
        }

        $orders = Order::where('customer_id', $customerId)
        ->with([
            'items.product' => function ($query) {
                $query->select('id', 'name', 'image_url1', 'description', 'original_price', 'discounted_price', 'discount_percentage');
            },
            'shop' => function ($query) {
                $query->select('id', 'name');
            },
            'customer' => function ($query) {
                $query->select('id', 'name');
            }
        ])->orderBy('created_at', 'desc')->get();

        return $this->success('Orders retrieved successfully.', $orders);
    }

    public function showOrderByCustomerId($id)
    {
        $order = Order::with(['items.product', 'shop', 'customer'])->find($id);

        if (!$order) {
            return $this->error('Order not found.', null, 404);
        }

        return $this->success('Order details retrieved successfully.', $order);
    }

    public function forgetpassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists'   => 'The email does not exist.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->first();
        $username = $user->name;

        $otp = mt_rand(100000, 999999);

        DB::table('password_reset_otps')->updateOrInsert(
            ['email' => $request->email],
            [
                'otp' => $otp,
                'created_at' => Carbon::now(),
            ]
        );

        Mail::send('email.forgotPassword', ['name' => $username, 'otp' => $otp], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });
    }
}