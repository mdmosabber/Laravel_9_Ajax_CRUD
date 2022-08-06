

<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <form method="post" id="updateProductForm">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="errMassesContainer"> </div>
                    <div class="form-group mb-3">
                        <input type="hidden" id="product_id">
                        <label for="name">Product Name</label>
                        <input type="text" name="name" id="up_name" class="form-control" placeholder="Enter Product Name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="price">Product Price</label>
                        <input type="text" name="price" id="up_price" class="form-control" placeholder="Enter Product Price">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update_product">Update Product</button>
                </div>
            </div>
        </div>
    </form>
</div>

