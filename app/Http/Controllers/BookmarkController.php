<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class BookmarkController extends Controller
{
    public function add(Request $request, $deal_id)
    {
        $deal = Product::findOrFail($deal_id);
        $user_id = Auth::check() ? Auth::id() : null;
        $bookmarknumber = $request->input("bookmarknumber") ?? session('bookmarknumber') ?? $request->cookie('bookmarknumber') ?? null;

        if ($user_id == null) {
            if ($bookmarknumber == null) {

                $bookmarknumber = Str::uuid();
                session(['bookmarknumber' => $bookmarknumber]);
                Cookie::queue('bookmarknumber', $bookmarknumber, 43200); // 43200 minutes = 30 days
                //create bookmark
                Bookmark::create([
                    'bookmark_number' => $bookmarknumber,
                    'user_id' => null, // Guest user
                    'ip_address' => $request->ip(),
                    'deal_id' => $deal->id,
                ]);

                if ($request->ajax()) {
                    $bookmarkCount = $this->getBookmarkCount($request);
                    return response()->json(['message' => 'Deal added to bookmarks successfully!', 'total_items' => $bookmarkCount, 'bookmarknumber' => $bookmarknumber]);
                }

                return redirect()->back()->with('message', 'Deal added to bookmarks successfully!');
            } else {
                $existing_bookmark = Bookmark::where('deal_id', $deal->id)->where('bookmark_number', $bookmarknumber)->first();
                if ($existing_bookmark) {
                    if ($request->ajax()) {
                        return response()->json(['message' => 'Deal already bookmarked']);
                    }
                    return redirect()->back()->with('message', 'Deal already bookmarked');
                } else {
                    Bookmark::create(
                        [
                            'deal_id' => $deal->id,
                            'user_id' => $user_id,
                            'ip_address' => $request->ip(),
                            'bookmark_number' => $bookmarknumber,
                        ]
                    );

                    if ($request->ajax()) {
                        $bookmarkCount = $this->getBookmarkCount($request);
                        return response()->json(['message' => 'Deal added to bookmarks successfully!', 'total_items' => $bookmarkCount, 'bookmarknumber' => $bookmarknumber]);
                    }

                    return redirect()->back()->with('message', 'Deal added to bookmarks successfully!');
                }
            }
        } else {
            $existing_bookmark = Bookmark::where('deal_id', $deal->id)->where('user_id', $user_id)->first();
            if ($existing_bookmark) {
                if ($request->ajax()) {
                    return response()->json(['message' => 'Deal already bookmarked']);
                }
                return redirect()->back()->with('message', 'Deal already bookmarked');
            } else {
                if ($bookmarknumber == null) {
                    $bookmarknumber = Str::uuid();
                    session(['bookmarknumber' => $bookmarknumber]);
                    Cookie::queue('bookmarknumber', $bookmarknumber, 43200); // 43200 minutes = 30 days

                }
                Bookmark::create([
                    'bookmark_number' => $bookmarknumber,
                    'user_id' => $user_id, // Guest user
                    'ip_address' => $request->ip(),
                    'deal_id' => $deal->id,
                ]);

                if ($request->ajax()) {
                    $bookmarkCount = $this->getBookmarkCount($request);
                    return response()->json([
                        'message' => 'Deal added to bookmarks successfully!',
                        'total_items' => $bookmarkCount,
                        'bookmarknumber' => $bookmarknumber
                    ]);
                }

                return redirect()->back()->with('message', 'Deal added to bookmarks successfully!');
            }
        }
    }

    public function remove(Request $request, $deal_id)
    {

        $bookmarknumber = $request->input("bookmarknumber");
        if ($bookmarknumber == null) {
            $bookmarknumber = session()->get('bookmarknumber');
        }

        $user_id = Auth::check() ? Auth::id() : null;

        if ($user_id) {
            $bookmark = Bookmark::where('deal_id', $deal_id)->where('user_id', $user_id)->first();
        } else {
            $bookmark = Bookmark::where('deal_id', $deal_id)->where('bookmark_number', $bookmarknumber)->first();
        }

        if ($bookmark) {
            $bookmark->delete();

            if ($request->ajax()) {
                $bookmarkCount = $this->getBookmarkCount($request);
                return response()->json(['message' => 'Item removed from bookmarks!', 'total_items' => $bookmarkCount]);
            }

            return redirect()->back()->with('message', 'Item removed from bookmarks!');
        }

        if ($request->ajax()) {
            return response()->json(['message' => 'Bookmark not found'], 404);
        }

        return redirect()->back()->with('message', 'Bookmark not found');
    }

    private function getBookmarkCount(Request $request)
    {

        $bookmarknumber = $request->input("bookmarknumber");

        if ($bookmarknumber == null) {
            $bookmarknumber = session()->get('bookmarknumber');
        }


        $user_id = Auth::check() ? Auth::id() : null;

        $bookmarkCount = Bookmark::where(function ($query) use ($user_id, $bookmarknumber) {
            if ($user_id) {
                $query->where('user_id', $user_id);
            } else {
                $query->whereNull('user_id')->where('bookmark_number', $bookmarknumber);
            }
        })
            ->whereHas('deal', function ($query) {
                $query->where('active', 1)
                    ->whereNull('deleted_at');
            })->count();

        // dd($bookmarkCount);

        return $bookmarkCount;
    }

    public function totalItems(Request $request)
    {
        $bookmarknumber = $request->input("bookmarknumber") ?? session()->get('bookmarknumber');
        $user = Auth::user();

        if ($user) {
            Bookmark::whereNull('user_id')
                ->where('bookmark_number', $bookmarknumber)
                ->update(['user_id' => $user->id]);

            $bookmarkCount = Bookmark::where('user_id', $user->id)
                ->orWhere('bookmark_number', $bookmarknumber)
                ->whereHas('deal', function ($query) {
                    $query->where('active', 1)
                        ->whereNull('deleted_at');
                })
                ->count();
        } else {
            $bookmarkCount = Bookmark::where('bookmark_number', $bookmarknumber)
                ->whereHas('deal', function ($query) {
                    $query->where('active', 1)
                        ->whereNull('deleted_at');
                })
                ->count();
        }

        return response()->json(['total_items' => $bookmarkCount]);
    }


    public function index(Request $request)
    {
        $bookmarknumber = $request->input('dmbk');
        //dd($bookmarknumber);
        if ($bookmarknumber == null) {
            $bookmarknumber = session()->get('bookmark');
        }

        if (Auth::check()) {
            $user_id = Auth::id();
            $ip_address = $request->ip();

            Bookmark::whereNull('user_id')
                ->where('bookmark_number', $bookmarknumber)
                ->update(['user_id' => $user_id]);
        }

        $user_id = Auth::check() ? Auth::id() : null;

        $bookmarks = Bookmark::where(function ($query) use ($user_id, $bookmarknumber) {
            if ($user_id) {
                $query->where('user_id', $user_id);
            } else {
                $query->where('bookmark_number', $bookmarknumber);
            }
        })
            ->whereHas('deal', function ($query) {
                $query->where('active', 1)
                    ->whereNull('deleted_at');
            })
            ->with(['deal' => function ($query) {
                $query->where('active', 1)
                    ->whereNull('deleted_at')
                    ->with(['productMedia:id,resize_path,order,type,imageable_id']);
            }, 'deal.shop'])
            ->paginate(10);


        return view('bookmark', compact('bookmarks'));
    }
}
