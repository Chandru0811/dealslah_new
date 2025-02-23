<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\OrderItems;
use App\Models\DealClick;
use App\Models\DealViews;
use App\Models\Shop;
use App\Models\Dealenquire;
use App\Models\DealShare;
use App\Models\CouponCodeUsed;
use Carbon\Carbon;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\Auth;
use App\Models\ReferrerDetail;
use App\Models\User;

class DashboardController extends Controller
{
    use ApiResponses;

    public function index()
    {
        $userId = Auth::id();
        $shop = Shop::where('owner_id', $userId)->first();
        $shopId = $shop->id;
        $products = Product::where('shop_id', $shopId)->where('active', 1)->get();
        $productscount = Product::where('shop_id', $shopId)->where('active', 1)->count();
        $dealcount = Product::where('shop_id', $shopId)->count();
        $dealactivecount = Product::where('shop_id', $shopId)->where('active', 1)->count();
        $productIds = Product::where('shop_id', $shopId)->where('active', 1)->pluck('id');
        $dealclicks = DealClick::whereIn('deal_id', $productIds)->Count();
        $dealviews = DealViews::whereIn('deal_id', $productIds)->Count();
        $discountcopied = CouponCodeUsed::whereIn('deal_id', $productIds)->Count();
        $dealshares = DealShare::whereIn('deal_id', $productIds)->Count();
        $dealenquires = Dealenquire::whereIn('deal_id', $productIds)->Count();
        $orderscount = OrderItems::where('seller_id', $shopId)->count();



        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $dealClicksData = [];
        $dealViewsData = [];
        $discountCopiedData = [];
        $dealSharesData = [];
        $dealEnquiresData = [];


        foreach (range(0, 6) as $day) {
            $currentDay = $startOfWeek->copy()->addDays($day);

            // Get the counts for each day
            $dealClicksData[] = DealClick::whereIn('deal_id', $productIds)
                ->whereDate('clicked_at', $currentDay)
                ->count();

            $dealViewsData[] = DealViews::whereIn('deal_id', $productIds)
                ->whereDate('viewed_at', $currentDay)
                ->count();

            $discountCopiedData[] = CouponCodeUsed::whereIn('deal_id', $productIds)
                ->whereDate('copied_at', $currentDay)
                ->count();

            $dealSharesData[] = DealShare::whereIn('deal_id', $productIds)
                ->whereDate('share_at', $currentDay)
                ->count();

            $dealEnquiresData[] = Dealenquire::whereIn('deal_id', $productIds)
                ->whereDate('enquire_at', $currentDay)
                ->count();
        }

        $chartdata = [
            'series' => [
                [
                    'name' => 'Deal Clicks',
                    'data' => $dealClicksData
                ],
                [
                    'name' => 'Deal Views',
                    'data' => $dealViewsData
                ],
                [
                    'name' => 'Discount Copied',
                    'data' => $discountCopiedData
                ],
                [
                    'name' => 'Deal Shares',
                    'data' => $dealSharesData
                ],
                [
                    'name' => 'Deal Enquiries',
                    'data' => $dealEnquiresData
                ]
            ]
        ];


        $dashboardData = [
            'totaldealclicks' => $dealclicks,
            'totaldealviews' => $dealviews,
            'totaldiscountcopied' => $discountcopied,
            'totaldealshared' => $dealshares,
            'totaldealenquired' => $dealenquires,
            'totalproductscount' => $productscount,
            'totalorderscount' => $orderscount,
            'products' => $products,
            'chatdata' => $chartdata
        ];

        return $this->success('Dashboard Retrieved Successfully!', $dashboardData);
    }

    public function graphdata(Request $request)
    {
        $userId = Auth::id();
        $shop = Shop::where('owner_id', $userId)->first();
        $shopId = $shop->id;

        $productIds = $request->input('product_id');
        if (empty($productIds)) {
            return response()->json(['error' => 'Product IDs are required'], 400);
        }

        $week = $request->input('week');
        $year = substr($week, 0, 4);
        $weekNumber = substr($week, 6);

        $startOfWeek = Carbon::now()->setISODate($year, $weekNumber)->startOfWeek();
        $endOfWeek = Carbon::now()->setISODate($year, $weekNumber)->endOfWeek();

        $dealClicksData = [];
        $dealViewsData = [];
        $discountCopiedData = [];
        $dealSharesData = [];
        $dealEnquiresData = [];

        foreach (range(0, 6) as $day) {
            $currentDay = $startOfWeek->copy()->addDays($day);

            $dealClicksData[] = DealClick::whereIn('deal_id', $productIds)
                ->whereDate('clicked_at', $currentDay)
                ->count();

            $dealViewsData[] = DealViews::whereIn('deal_id', $productIds)
                ->whereDate('viewed_at', $currentDay)
                ->count();

            $discountCopiedData[] = CouponCodeUsed::whereIn('deal_id', $productIds)
                ->whereDate('copied_at', $currentDay)
                ->count();

            $dealSharesData[] = DealShare::whereIn('deal_id', $productIds)
                ->whereDate('share_at', $currentDay)
                ->count();

            $dealEnquiresData[] = Dealenquire::whereIn('deal_id', $productIds)
                ->whereDate('enquire_at', $currentDay)
                ->count();
        }

        return response()->json([
            'series' => [
                [
                    'name' => 'Deal Clicks',
                    'data' => $dealClicksData
                ],
                [
                    'name' => 'Deal Views',
                    'data' => $dealViewsData
                ],
                [
                    'name' => 'Discount Copied',
                    'data' => $discountCopiedData
                ],
                [
                    'name' => 'Deal Shares',
                    'data' => $dealSharesData
                ],
                [
                    'name' => 'Deal Enquires',
                    'data' => $dealEnquiresData
                ]
            ]
        ]);
    }

    public function referrerDashboard(Request $request)
    {
        // dd($request->all());
        $user = Auth::id();
        $month = $request->input('month');

        $monthReport = ReferrerDetail::where('referrer_id', $user)
            ->where('date', $month)
            ->get();

        $formattedData = $monthReport->groupBy('vendor_name')->map(function ($items, $vendor) {
            return [
                'vendor' => $vendor,
                'total_amount' => $items->sum('amount'),
            ];
        })->values();

        $monthReport = [
            'vendors' => $formattedData->pluck('vendor'),
            'amounts' => $formattedData->pluck('total_amount'),
        ];

        // $lastSixMonths = [
        //     "2024-08",
        //     "2024-09",
        //     "2024-10",
        //     "2024-11",
        //     "2024-12",
        //     "2025-01"
        // ];

        $lastSixMonths = collect();
        $currentMonth = now()->startOfMonth();
        // dd($currentMonth);

        for ($i = 5; $i >= 0; $i--) {
            $lastSixMonths->push($currentMonth->copy()->subMonths($i)->format('Y-m'));
        }

        $rawData = ReferrerDetail::where('referrer_id', $user)
            ->whereIn('date', $lastSixMonths)
            ->get();

        $groupedData = $rawData->groupBy('date')->map(function ($items) {
            return [
                'vendor_count' => $items->unique('vendor_name')->count(),
                'total_revenue' => $items->sum('amount'),
            ];
        });

        $finalSixMonthData = collect($lastSixMonths)->mapWithKeys(function ($month) use ($groupedData) {
            return [
                $month => [
                    'month' => $month,
                    'vendor_count' => $groupedData->has($month) ? $groupedData[$month]['vendor_count'] : 0,
                    'total_revenue' => $groupedData->has($month) ? $groupedData[$month]['total_revenue'] : 0,
                ]
            ];
        });

        $lastSixMonthsReport = [
            'months' => $finalSixMonthData->pluck('month'),
            'vendor_counts' => $finalSixMonthData->pluck('vendor_count'),
            'revenues' => $finalSixMonthData->pluck('total_revenue'),
        ];

        $thisMonthEarnings = $monthReport['amounts']->sum();

        $totalEarnings = ReferrerDetail::where('referrer_id', $user)->sum('amount');

        $thisMonthReferrals = User::where('referral_code', 'DMR500' . $user)
        ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
        ->count();

        $totalReferrals = User::where('referral_code', 'DMR500' . $user)->count();

        $totalReferralsbyMonth = User::where('referral_code', 'DMR500' . $user)
        ->whereBetween('created_at', [now()->subMonths(5)->startOfMonth(), now()->endOfMonth()])
        ->get()
        ->groupBy(function ($user) {
            return \Carbon\Carbon::parse($user->created_at)->format('Y-m');
        });

        $referralsByMonth = collect($lastSixMonths)->mapWithKeys(function ($month) use ($totalReferralsbyMonth) {
            return [
                $month => [
                    'month' => $month,
                    'count' => $totalReferralsbyMonth->has($month) ? $totalReferralsbyMonth[$month]->count() : 0
                ]
            ];
        })->values();


        return $this->success('Referrer Dashboard data retrieved successfully.', [
            'current_month_report' => $monthReport,
            'last_six_months_report' => $lastSixMonthsReport,
            'total_data' => [
                'this_month_earnings' => $thisMonthEarnings,
                'total_earnings' => $totalEarnings,
                'this_month_referrals' => $thisMonthReferrals,
                'total_referrals' => $totalReferrals,
                'total_count_month' => $referralsByMonth
            ]
        ]);
    }
}
