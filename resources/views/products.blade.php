<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Products</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="p-10 bg-gray-100">

<!-- Header with Logout Button -->
<header class="flex justify-between items-center bg-white p-4 shadow-md mb-6 rounded-lg">
    <h1 class="text-xl font-bold">Product List</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg">Logout</button>
    </form>
</header>

<div class="max-w-4xl mx-auto">
    <div id="product-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"></div>

    <!-- Pagination Controls -->
    <div class="flex justify-center mt-4">
        <button id="prevPage" class="px-4 py-2 bg-gray-300 rounded-lg mx-2">Previous</button>
        <span id="currentPage" class="text-lg font-bold"></span>
        <button id="nextPage" class="px-4 py-2 bg-gray-300 rounded-lg mx-2">Next</button>
    </div>
</div>

<script>
    let currentPage = 1;

    function fetchProducts(page) {
        fetch(`/api/products?page=${page}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error("Unauthorized! Redirecting to login...");
                }
                return response.json();
            })
            .then(data => {
                const productList = document.getElementById('product-list');
                productList.innerHTML = data.data.map(product => `
                    <div class="p-4 border rounded-lg shadow-md bg-white">
                        <h2 class="text-lg font-bold">${product.name}</h2>
                        <p class="text-sm text-gray-600">${product.description}</p>
                        <p class="text-green-600 font-bold">$${product.price}</p>
                    </div>
                `).join('');

                document.getElementById('currentPage').textContent = `Page ${data.current_page}`;
                currentPage = data.current_page;
            })
            .catch(error => {
                console.error(error);
                window.location.href = '/login';
            });
    }

    document.getElementById('prevPage').addEventListener('click', () => {
        if (currentPage > 1) fetchProducts(currentPage - 1);
    });

    document.getElementById('nextPage').addEventListener('click', () => {
        fetchProducts(currentPage + 1);
    });

    // Initial load
    fetchProducts(1);
</script>

</body>
</html>
