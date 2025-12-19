<?php include('../includes/header.php') ?>



<dialog id="my_modal_1" class="modal">
    <div class="modal-box bg-[#f3e7d8]">
        <h3 class="text-lg font-bold text-[#5c3d2e]">Create a Coffee Shop Account</h3>

        <div class="modal-action">
            <form method="dialog" class="flex flex-col gap-3">
                <input type="text" placeholder="Your Email" id="email"
                       class="input input-bordered bg-white" />
                <input type="password" placeholder="Your Password" id="password"
                       class="input input-bordered bg-white" />

                <a href="#" class="text-sm text-[#6d4c3d]">Already have an account?</a>

                <button class="btn bg-[#6b4f3a] text-white border-none --btn-signup">Sign Up</button>
                <button class="btn">Close</button>
            </form>
        </div>
    </div>
</dialog>

<dialog id="my_modal_2" class="modal">
    <div class="modal-box bg-[#f3e7d8]">
        <h3 class="text-lg font-bold text-[#5c3d2e]">Login</h3>

        <div class="modal-action">
            <form method="dialog" class="flex flex-col gap-3">
                <input type="text" placeholder="Your Email" id="login_email"
                       class="input input-bordered bg-white" />
                <input type="password" placeholder="Your Password" id="login_password"
                       class="input input-bordered bg-white" />

                <button class="btn bg-[#6b4f3a] text-white border-none" id="--login-form">Login</button>
                <button class="btn">Close</button>
            </form>
        </div>
    </div>
</dialog>




<div class="navbar bg-[#6b4f3a] text-white px-5 shadow-md">
    <div class="navbar-start">
        <a class="text-2xl font-bold tracking-wide">Ordinary Coffee Shop</a>
    </div>

    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1 text-white">
            <li><a>Menu</a></li>
            <li><a>Locations</a></li>
            <li><a>Reviews</a></li>
            <li><a>About</a></li>
        </ul>
    </div>

    <div class="navbar-end">
        <a class="btn bg-[#c9a67a] border-none text-white" onclick="my_modal_1.showModal()">Sign Up</a>
        <p>&nbsp</p>
        <a class="btn bg-[#c9a67a] border-none text-white" onclick="my_modal_2.showModal()">Login</a>
        
    </div>
</div>


<div class="carousel w-full">
    <div id="item1" class="carousel-item w-full">
        <img src="https://images.unsplash.com/photo-1504754524776-8f4f37790ca0"
             class="w-full object-cover" />
    </div>

    <div id="item2" class="carousel-item w-full">
        <img src="https://images.unsplash.com/photo-1512568400610-62da28bc8a13"
             class="w-full object-cover" />
    </div>

    <div id="item3" class="carousel-item w-full">
        <img src="https://images.unsplash.com/photo-1512568400610-62da28bc8a13"
             class="w-full object-cover" />
    </div>

 
    <div id="item4" class="carousel-item w-full">
        <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93"
             class="w-full object-cover" />
    </div>
</div>


<div class="flex w-full justify-center gap-2 py-3">
    <a href="#item1" class="btn btn-xs">1</a>
    <a href="#item2" class="btn btn-xs">2</a>
    <a href="#item3" class="btn btn-xs">3</a>
    <a href="#item4" class="btn btn-xs">4</a>
</div>


<center>
    <h1 class="text-4xl font-bold my-6 text-[#5a3d2b]">Our Coffee Menu</h1>
</center>

<div class="flex flex-wrap justify-center gap-6 px-5 pb-10">

    
    <div class="card bg-[#f7efe3] w-80 shadow-lg">
        <figure>
            <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93" class="h-56 w-full object-cover"/>
        </figure>
        <div class="card-body">
            <h2 class="card-title">Cappuccino</h2>
            <p>Rich espresso with steamed milk and foam.</p>
            <div class="card-actions justify-between items-center">
                <span class="text-lg font-bold text-[#6b4f3a]">₱80</span>
            </div>
        </div>
    </div>

    
    <div class="card bg-[#f7efe3] w-80 shadow-lg">
        <figure>
            <img src="https://images.unsplash.com/photo-1511920170033-f8396924c348" class="h-56 w-full object-cover"/>
        </figure>
        <div class="card-body">
            <h2 class="card-title">Iced Latte</h2>
            <p>Cold milk, ice, and smooth espresso.</p>
            <div class="card-actions justify-between items-center">
                <span class="text-lg font-bold text-[#6b4f3a]">₱85</span>
            </div>
        </div>
    </div>

    
    <div class="card bg-[#f7efe3] w-80 shadow-lg">
        <figure>
            <img src="https://images.unsplash.com/photo-1511920170033-f8396924c348" class="h-56 w-full object-cover"/>
        </figure>
        <div class="card-body">
            <h2 class="card-title">Caramel Macchiato</h2>
            <p>Layered espresso with vanilla and caramel.</p>
            <div class="card-actions justify-between items-center">
                <span class="text-lg font-bold text-[#6b4f3a]">₱95</span>
            </div>
        </div>
    </div>

    
    <div class="card bg-[#f7efe3] w-80 shadow-lg">
        <figure>
            <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93" class="h-56 w-full object-cover"/>
        </figure>
        <div class="card-body">
            <h2 class="card-title">Mocha</h2>
            <p>A delicious mix of chocolate and espresso.</p>
            <div class="card-actions justify-between items-center">
                <span class="text-lg font-bold text-[#6b4f3a]">₱90</span>
            </div>
        </div>
    </div>

</div>


<footer class="footer bg-[#6b4f3a] text-white p-10">
    <nav>
        <h6 class="footer-title">Coffee Shop</h6>
        <a class="link link-hover">Our Menu</a>
        <a class="link link-hover">Branches</a>
        <a class="link link-hover">Gift Cards</a>
    </nav>

    <nav>
        <h6 class="footer-title">Support</h6>
        <a class="link link-hover">Contact Us</a>
        <a class="link link-hover">Help Center</a>
        <a class="link link-hover">Terms & Conditions</a>
    </nav>

    <nav>
        <h6 class="footer-title">Follow Us</h6>
        <a class="link link-hover">Facebook</a>
        <a class="link link-hover">Instagram</a>
        <a class="link link-hover">Tiktok</a>
    </nav>
</footer>

<?php include('../includes/footer.php') ?>
