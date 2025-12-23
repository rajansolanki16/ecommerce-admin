document.addEventListener('DOMContentLoaded', fetchProducts);

function fetchProducts() {
    const grid = document.getElementById('vec_product-grid');

    if (!grid) return;

    const url = grid.dataset.fetchUrl;

    fetch(url)
        .then(res => res.json())
        .then(products => {
             console.log(products);

            if (!products.length) {
                grid.innerHTML = `<div class="ko-col-12">No products found</div>`;
                return;
            }

            let html = '';

            products.forEach(product => {

                const image = product.product_image
                    ? `/storage/${product.product_image}`
                    : `/assets/images/no-image.png`;

                const category = product.categories && product.categories.length
                    ? product.categories.map(c => c.name).join(', ')
                    : 'Uncategorized';

                html += `
                    <div class="ko-col-4">
                        <div class="ko-roomitem-inner">
                            <img src="${image}" class="thumbnail" alt="${product.product_title}">
                            <div class="ko-roompricing-info">
                                <div class="ko-roompricing-infoinner">
                                    <div class="label">${category}</div>
                                    <h3 class="price">₹${product.price}</h3>
                                </div>
                            </div>
                            <div class="ko-roomdetails-info">
                                <div class="ko-roomdetails-infoinner">
                                    <h3 class="title">${product.product_title}</h3>
                                    <p class="ko-room-desc">${product.short_description ?? ''}</p>
                                    <div class="label">${category}</div>
                                    <h3 class="price">₹${product.price}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });

            grid.innerHTML = html;
        })
        .catch(error => {
            console.error(error);
            grid.innerHTML = `<div class="ko-col-12 text-danger">Error loading products</div>`;
        });
}
