<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quantity Counter</title>
</head>
<body>
    <div>
        <button class="btn btn-primary px-3 me-2 decrease-quantity">
            <i class="fas fa-minus"></i>
        </button>

        <div class="form-outline">
            <input id="quantityInput" min="0" name="quantity" value="0" type="number" class="form-control" />
            <label class="form-label" for="quantityInput">Quantity</label>
        </div>

        <button class="btn btn-primary px-3 ms-2 increase-quantity">
            <i class="fas fa-plus"></i>
        </button> 
    </div>

    <div>
        <p>Total: <span id="total">0</span></p>
    </div>

    <script>
        // Lấy tham chiếu đến các phần tử HTML
        const decreaseButton = document.querySelector(".decrease-quantity");
        const increaseButton = document.querySelector(".increase-quantity");
        const quantityInput = document.getElementById("quantityInput");
        const totalElement = document.getElementById("total");

        // Giá của mỗi sản phẩm
        const productPrice = 5;

        // Thiết lập giá trị ban đầu của total
        let total = parseInt(quantityInput.value) * productPrice;

        // Cập nhật giá trị total
        function updateTotal() {
            total = parseInt(quantityInput.value) * productPrice;
            totalElement.textContent = total;
        }

        // Gắn sự kiện click cho nút giảm
        decreaseButton.addEventListener("click", () => {
            if (total > 0) {
                quantityInput.stepDown(1);
                updateTotal();
            }
        });

        // Gắn sự kiện click cho nút tăng
        increaseButton.addEventListener("click", () => {
            quantityInput.stepUp(1);
            updateTotal();
        });

        // Cập nhật total khi trang web được tải lần đầu
        updateTotal();
    </script>
</body>
</html>
