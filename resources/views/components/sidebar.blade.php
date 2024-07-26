<div class="bg-green-600 text-white w-64 h-full flex flex-col">

    <div class="flex items-center justify-center py-6">
        <div class="bg-white rounded-full h-20 w-20 flex items-center justify-center">
            <img src="path/to/logo.png" alt="Logo" class="h-12 w-12">
        </div>
    </div>

    <nav class="flex flex-col mt-4 space-y-2">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 hover:bg-green-700">
            <i class="fas fa-home mr-2"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-2 hover:bg-green-700">
            <i class="fas fa-box mr-2"></i>
            <span>Manage Products</span>
        </a>
        <a href="{{ route('admin.brands.index') }}" class="flex items-center px-4 py-2 hover:bg-green-700">
            <i class="fas fa-tag mr-2"></i>
            <span>Manage Brands</span>
        </a>
        <a href="{{ route('admin.categories.index') }}" class="flex items-center px-4 py-2 hover:bg-green-700">
            <i class="fas fa-list-alt mr-2"></i>
            <span>Manage Categories</span>
        </a>
        <a href="{{ route('admin.users.create') }}" class="flex items-center px-4 py-2 hover:bg-green-700">
            <i class="fas fa-user-plus mr-2"></i>
            <span>Create User</span>
        </a>
        <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-2 hover:bg-green-700">
            <i class="fas fa-shopping-cart mr-2"></i>
            <span>View Orders</span>
        </a>
    </nav>

</div>
