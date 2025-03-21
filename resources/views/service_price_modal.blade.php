{{-- Service Price  --}}
<div class="modal fade servicePriceModal" tabindex="-1" aria-labelledby="servicePriceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="d-flex justify-content-between p-3">
                <h1 class="modal-title fs-5" id="servicePriceModalLabel">Special Price</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Discount Price</th>
                            <th scope="col">Expiry Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td id="productDiscount">{{ $product->discounted_price ?? '--' }}</td>
                            <td id="productExpiry">{{ $product->end_date ?? '--' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- Service Price  --}}
