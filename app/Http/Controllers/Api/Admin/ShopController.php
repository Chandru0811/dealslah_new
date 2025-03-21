<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Traits\ApiResponses;
use App\Models\ShopPolicy;
use App\Models\ShopHour;
use App\Models\SubCategory;
use App\Models\User;

class ShopController extends Controller
{
    use ApiResponses;

    public function index()
    {
        $shops = Shop::orderBy('id', 'desc')
            ->with(['owner' => function ($query) {
                $query->select('id', 'type');
            }])
            ->get();
        return $this->success('Shops retrieved successfully.', $shops);
    }

    public function getshopbasics($id)
    {
        $shop = Shop::select('name', 'legal_name', 'slug', 'email', 'mobile', 'external_url', 'shop_type', 'logo', 'banner', 'shop_ratings', 'description', 'active')->where('id', $id)->first();
        return $this->success('Shop retrieved successfully.', $shop);
    }

    public function getshoplocation($id)
    {
        $shop = Shop::select('street', 'street2', 'city', 'zip_code', 'state', 'country')->where('id', $id)->first();
        return $this->success('Shop retrieved successfully.', $shop);
    }

    public function getshoppayment($id)
    {
        $shop = Shop::select('payment_id', 'account_holder', 'account_type', 'account_number', 'bank_name', 'bank_address', 'bank_code')->where('id', $id)->first();
        return $this->success('Shop retrieved successfully.', $shop);
    }

    public function getshophours($id)
    {
        $shophours = ShopHour::where('shop_id', $id)->first();
        return $this->success('Shop retrieved successfully.', $shophours);
    }

    public function getshoppolicy($id)
    {
        $shoppolicy = ShopPolicy::where('shop_id', $id)->first();
        return $this->success('Shop retrieved successfully.', $shoppolicy);
    }

    public function activateshop($id)
    {
        Shop::where('id', $id)->update(['active' => '1']);
        return $this->ok('Shop Activated Successfully.');
    }

    public function deactivateshop($id)
    {
        Shop::where('id', $id)->update(['active' => '0']);
        return $this->ok('Shop Deactivated Successfully.');
    }

    public function directshop($id)
    {
        Shop::where('id', $id)->update(['is_direct' => '1']);
        return $this->ok('Shop has been successfully set as a direct shop.');
    }

    public function indirectshop($id)
    {
        Shop::where('id', $id)->update(['is_direct' => '0']);
        return $this->ok('Shop has been successfully set as an indirect shop.');
    }

    public function indexproduct()
    {
        $products = Product::orderBy('id', 'desc')->with(['shop:id,legal_name,is_direct'])->get();
        return $this->success('Products Retrieved Successfully!', $products);
    }

    public function showproduct(string $id)
    {
        $product = Product::with([
            'category',
            'category.categoryGroup',
            'productMedia:id,resize_path,order,type,imageable_id'
        ])->find($id);

        if (!$product) {
            return $this->error('Product Not Found.', ['error' => 'Product Not Found']);
        }

        $subCategoryIds = json_decode($product->sub_category_id, true) ?? [];

        $subCategoryNames = !empty($subCategoryIds)
            ? SubCategory::whereIn('id', $subCategoryIds)
            ->select('name', 'id')
            ->get()
            ->map(fn($subCategory) => [
                'label' => $subCategory->name,
                'value' => (string) $subCategory->id
            ])
            ->toArray()
            : [];

        $product->subCategoryNames = $subCategoryNames;
        $product->categoryName = $product->category?->name;
        $product->categoryGroupName = $product->category?->categoryGroup?->name;
        $product->categoryGroupId = $product->category?->categoryGroup?->id;

        unset($product->category);

        return $this->success('Product Retrieved Successfully!', $product);
    }


    public function getshopproducts($id)
    {
        $products = Product::with('shop')->where('shop_id', $id)->get();
        return $this->success('Product Retrieved Successfully!', $products);
    }

    public function getlogindetails($id)
    {
        $shop = Shop::where('id', $id)->first();
        $login_details = User::where('id', $shop->owner_id)->select('id', 'name', 'email', 'type', 'created_at')->first();
        return $this->success('Shop retrieved successfully.', $login_details);
    }
}
