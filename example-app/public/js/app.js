
const decreaseButton = document.querySelector(".decrease-quantity");
        const increaseButton = document.querySelector(".increase-quantity");
        const quantityInput = document.getElementById("quantityInput");
        const totalElement = document.getElementById("total");

        // Giá của mỗi sản phẩm
        const productPrice = {{$cartItem['price']}};

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
                quantityInput.stepDown(0.5);
                updateTotal();
            }
        });

        // Gắn sự kiện click cho nút tăng
        increaseButton.addEventListener("click", () => {
            quantityInput.stepUp(0.5);
            updateTotal();
        });

        // Cập nhật total khi trang web được tải lần đầu
        updateTotal();