$(document).ready(function () {
  let availableStock = 0;

  // Handle category clicks
  $(".category-card").click(function () {
    let categoryId = $(this).data("category");
    $(".category-card").removeClass("active");
    $(this).addClass("active");
    fetchProducts(categoryId);
  });

  // Fetch products based on category
  function fetchProducts(categoryId) {
    $.ajax({
      url: "/home/category/" + categoryId,
      type: "GET",
      success: function (products) {
        $("#product-list").empty();
        products.forEach((product) => {
          $("#product-list").append(`
                <div class="col-md-4 mb-4 product-card" data-category="${product.category_id}">
                    <div class="card">
                        <img src="${product.image}" class="card-img-top" alt="${product.name}">
                        <div class="card-body">
                            <h5 class="card-title px-2">${product.name}</h5>
                            <p class="card-text px-2">${product.description}</p>
                            <p class="card-text px-2">${formatPrice(product.price)}</p>
                            <div class="d-flex justify-content-around">
                                <button class="btn btn-primary btn-min-width view-btn" data-id="${product.id}">View</button>
                                <button class="btn btn-success btn-min-width">Buy</button>
                            </div>
                        </div>
                    </div>
                </div>
            `);
        });
      },
    });
  }

  // Handle view button clicks
  $(document).on("click", ".view-btn", function () {
    let productId = $(this).data("id");
    fetchProductDetails(productId);
  });

  // Fetch product details
  function fetchProductDetails(productId) {
    $.ajax({
      url: "/product/" + productId,
      type: "GET",
      success: function (product) {
        $("#modalProductImage").attr("src", product.image);
        $("#modalProductName").text("Name: " + product.name);
        $("#modalProductDescription").text(
          "Description: " + product.description,
        );
        $("#modalProductPrice").text("Price: " + formatPrice(product.price));
        $("#modalProductStock").text("Stock: " + product.stock);
        $("#quantity").val(1); // Reset quantity to 1
        $("#product_id").val(product.id); // Set product_id for form
        availableStock = product.stock; // Set available stock
        updateButtons();
        var productModal = new bootstrap.Modal(
          document.getElementById("productModal"),
        );
        productModal.show();
      },
    });
  }

  // Increment and decrement quantity
  $("#increment").click(function () {
    let quantity = parseInt($("#quantity").val());
    if (quantity < availableStock) {
      $("#quantity").val(quantity + 1);
      $("#product_quantity").val(quantity + 1);
    }
    updateButtons();
  });

  $("#decrement").click(function () {
    let quantity = parseInt($("#quantity").val());
    if (quantity > 1) {
      $("#quantity").val(quantity - 1);
      $("#product_quantity").val(quantity - 1);
    }
    updateButtons();
  });

  // Update the state of increment, decrement, and buy buttons
  function updateButtons() {
    let quantity = parseInt($("#quantity").val());
    $("#increment").prop("disabled", quantity >= availableStock);
    $("#decrement").prop("disabled", quantity <= 1);
    $("button.btn-primary").prop("disabled", quantity <= 0);
  }

  // Format price
  function formatPrice(price) {
    return "Rp " + parseInt(price).toLocaleString("id-ID");
  }
});
