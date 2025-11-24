<div class="bg-blue-200 shadow-sm">
    <div class="navbar w-full md:w-11/12 mx-auto">
        <div class="navbar-start">
            <div class="dropdown">
                <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                </div>
                <ul
                    tabindex="-1"
                    class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                    <li><a href="{{ route('product.index') }}" class="text-gray-700 text-lg font-bold hover:bg-slate-400">Products</a></li>
                </ul>
            </div>
            <a href="/" class="text-2xl text-gray-700 font-extrabold cursor-pointer">Next Ecom</a>
        </div>
        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1">
                <li><a href="{{ route('product.index') }}" class="text-gray-700 text-lg font-bold hover:bg-slate-400">Products</a></li>
            </ul>
        </div>
        <div class="navbar-end">
            @auth
            <a href="{{ route(auth()->user()->getDashboardRoute()) }}" class="btn bg-blue-700 hover:bg-slate-400 text-white text-lg mr-2">
                Dashboard
            </a>
            <a href="{{ route('profile.edit') }}" class="btn bg-blue-700 hover:bg-slate-400 text-white text-lg mr-2">
                Profile
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn bg-blue-700 hover:bg-slate-400 text-white text-lg font-bold px-4">Logout</button>
            </form>
            @else
            <a href="{{ route('login') }}" class="btn bg-blue-700 hover:bg-slate-400 text-white text-lg mr-2">Login</a>
            <a href="{{ route('register') }}" class="btn bg-blue-700 hover:bg-slate-400 text-white text-lg mr-2">Register</a>
            @endauth
        </div>
    </div>
</div>