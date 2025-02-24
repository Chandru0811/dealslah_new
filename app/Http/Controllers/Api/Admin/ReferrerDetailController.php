<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReferrerDetail;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ReferrerDetailController extends Controller
{
    use ApiResponses;
    public function index()
    {
        $ReferrerDetails = ReferrerDetail::orderBy('id', 'desc')->get();

        return $this->success('Referrer Details Retrieved successfully.', $ReferrerDetails);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'referrer_id'    => 'required|integer|exists:users,id',
            'referrer_name'  => 'required|string|max:255',
            'referrer_number' => 'required|string|max:20',
            'vendor_id'      => 'required|integer|exists:users,id',
            'vendor_name'    => 'required|string|max:255',
            'date'          => 'required|string',
            'amount'        => 'required|numeric|min:0',
            'commission_rate' => 'required|numeric|min:0',
        ], [
            'referrer_id.required'   => 'Referrer ID is required.',
            'referrer_id.integer'    => 'Referrer ID must be a valid number.',
            'referrer_id.exists'     => 'Referrer ID must exist in users table.',
            'vendor_id.exists'       => 'Vendor ID must exist in vendors table.',
            'amount.numeric'         => 'Amount must be a valid number.',
            'commission_rate.numeric'=> 'Commission Rate must be a valid number.',
            'date.date'              => 'Please enter a valid date format.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        $ReferrerDetails = ReferrerDetail::create($validatedData);

        return $this->success('Referral Amount Created Successfully!', $ReferrerDetails);
    }


    public function show(string $id)
    {
        $ReferrerDetails = ReferrerDetail::find($id);


        if (!$ReferrerDetails) {
            return $this->error('Referrer Details Not Found.', ['error' => 'Referrer Details Not Found']);
        }

        return $this->success('Referrer Details Retrived Succesfully!', $ReferrerDetails);
    }

    public function update(Request $request, string $id)
    {
        $ReferrerDetails = ReferrerDetail::find($id);

        if (!$ReferrerDetails) {
            return $this->error('Referral Amount Not Found.', ['error' => 'Referral Amount Not Found']);
        }

        $validator = Validator::make($request->all(), [
            'referrer_id'    => 'sometimes|integer|exists:users,id',
            'referrer_name'  => 'sometimes|string|max:255',
            'referrer_number' => 'sometimes|string|max:20',
            'vendor_id'      => 'sometimes|integer|exists:users,id',
            'vendor_name'    => 'sometimes|string|max:255',
            'date'          => 'sometimes|string',
            'amount'        => 'sometimes|numeric|min:0',
            'commission_rate' => 'sometimes|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();
        $ReferrerDetails->update($validatedData);

        return $this->success('Referral Amount Updated Successfully!', $ReferrerDetails);
    }

    public function delete(string $id)
    {
        $ReferrerDetails = ReferrerDetail::find($id);

        if (!$ReferrerDetails) {
            return $this->error('Referrer Details Not Found.', ['error' => 'Referrer Details Not Found']);
        }

        $ReferrerDetails->delete();

        return $this->success('Referrer Details Deleted Successfully!', $ReferrerDetails);
    }

    public function getAllReferrersAndReferrerVendors()
    {
        $users = User::whereIn('type', ['referrer', 'referrer-vendor'])
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->success('Referrers and Referrer Vendors retrieved successfully.', $users);
    }

}
