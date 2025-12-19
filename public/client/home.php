<?php
    session_start();

    include('../../Classes/Client.php');

    if (!isset($_SESSION['id'])) {
        echo "You must login first.";
        exit;
    }

    $id = $_SESSION['id'];

    $data = new Users();
    $row = $data->viewOrders($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop - Client Dashboard</title>
    <link href="../assets/css/output.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-base-200 to-base-300 min-h-screen">

<nav class="navbar bg-base-100 shadow-lg mb-6 sticky top-0 z-10">
    <div class="navbar-start">
        <a class="btn btn-ghost normal-case text-xl">
            <i class="fas fa-coffee text-primary"></i> Coffee Shop
        </a>
    </div>
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            <li><a href="#order">Order</a></li>
            <li><a href="#orders">My Orders</a></li>
        </ul>
    </div>
    <div class="navbar-end">
        <span class="text-sm mr-4">Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?> (Client)</span>
        <a href="../../handlers/logout.php" class="btn btn-outline btn-error">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</nav>

<div class="hero bg-gradient-to-r from-primary to-secondary text-primary-content mb-8 rounded-box shadow-xl">
    <div class="hero-content text-center py-12">
        <div class="max-w-lg">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Welcome to Coffee Shop</h1>
            <div class="mt-6">
                <i class="fas fa-mug-hot text-6xl opacity-75"></i>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 pb-8">

    <div id="order" class="card bg-base-100 shadow-2xl mb-8 transition-all duration-300 hover:shadow-3xl">
        <div class="card-body">
            <h2 class="card-title text-2xl mb-6 text-primary">
                <i class="fas fa-shopping-cart"></i> Place Your Order
            </h2>

            <div class="mb-6">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-semibold">Select Coffee</span>
                    </label>
                    <select id="product" class="select select-bordered select-primary">
                        <option value="" disabled selected>Choose a coffee</option>
                        <option value="80">Cappuccino - ₱80</option>
                        <option value="85">Iced Latte - ₱85</option>
                        <option value="95">Caramel Macchiato - ₱95</option>
                        <option value="90">Mocha - ₱90</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-semibold">Quantity</span>
                    </label>
                    <input type="number" id="quantity" min="1" value="1" class="input input-bordered input-primary focus:input-primary">
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-semibold">Total Amount</span>
                    </label>
                    <input type="number" id="amount" readonly class="input input-bordered input-primary">
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-semibold">Delivery Address</span>
                    </label>
                    <input type="text" id="address" placeholder="Enter your address" class="input input-bordered input-primary focus:input-primary" required>
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-semibold">Contact Number</span>
                    </label>
                    <input type="tel" id="contact" placeholder="Enter your contact" class="input input-bordered input-primary focus:input-primary" required>
                </div>
            </div>
            <div class="card-actions justify-end mt-6">
                <button class="btn btn-primary btn-lg" id="addOrderBtn"
                    data-user-id="<?php echo htmlspecialchars($_SESSION['id']) ?>"
                    data-room-id="8">
                    <i class="fas fa-plus"></i> Add to Order
                </button>
            </div>
        </div>
    </div>

    <div id="orders" class="card bg-base-100 shadow-2xl transition-all duration-300 hover:shadow-3xl">
        <div class="card-body">
            <h2 class="card-title text-2xl mb-6 text-primary">
                <i class="fas fa-list"></i> Your Orders
            </h2>
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr class="bg-base-300">
                            <th class="font-semibold">Order ID</th>
                            <th class="font-semibold">Customer</th>
                            <th class="font-semibold">Contact</th>
                            <th class="font-semibold">Address</th>
                            <th class="font-semibold">Amount</th>
                            <th class="font-semibold">Status</th>
                            <th class="font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="orders-table">
                        <?php foreach ($row as $items): ?>
                            <tr id="row-<?= $items['item_id'] ?>" class="hover transition-all duration-200">
                                <td class="font-semibold">#<?= $items['item_id'] ?></td>
                                <td><?= $items['email'] ?></td>
                                <td><?= $items['contact'] ?></td>
                                <td><?= $items['address'] ?></td>
                                <td class="font-bold text-success">₱<?= $items['total_amount'] ?></td>
                                <td>
                                    <span class="badge <?= $items['status']=='approved'?'badge-success':'badge-warning' ?> badge-lg">
                                        <?= ucfirst($items['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-info edit-btn"
                                                data-id="<?= $items['item_id'] ?>"
                                                data-address="<?= $items['address'] ?>"
                                                data-contact="<?= $items['contact'] ?>"
                                                data-amount="<?= $items['total_amount'] ?>">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-sm btn-error delete-btn"
                                                data-id="<?= $items['item_id'] ?>">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<div id="edit-modal" class="modal">
    <div class="modal-box">
        <div class="modal-header flex justify-between items-center mb-4">
            <h3 class="font-bold text-lg text-primary">
                <i class="fas fa-edit"></i> Edit Order
            </h3>
            <button class="btn btn-sm btn-circle btn-ghost" onclick="$('#edit-modal').removeClass('modal-open')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="py-4">
            <input type="hidden" id="edit-id">
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text font-semibold">Address</span>
                </label>
                <input type="text" id="edit-address" placeholder="Address" class="input input-bordered input-primary focus:input-primary" required>
            </div>
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text font-semibold">Contact</span>
                </label>
                <input type="text" id="edit-contact" placeholder="Contact" class="input input-bordered input-primary focus:input-primary" required>
            </div>
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text font-semibold">Amount</span>
                </label>
                <input type="number" id="edit-amount" placeholder="Amount" class="input input-bordered input-primary focus:input-primary" required>
            </div>
        </div>
        <div class="modal-action">
            <button id="update-btn" class="btn btn-primary">
                <i class="fas fa-save"></i> Update
            </button>
            <button onclick="$('#edit-modal').removeClass('modal-open')" class="btn btn-ghost">
                <i class="fas fa-times"></i> Cancel
            </button>
        </div>
    </div>
</div>



<footer class="footer footer-center p-6 bg-base-300 text-base-content mt-8">
    <div>
        <p class="font-semibold">© 2025 Coffee Shop. All rights reserved.</p>
        <p class="text-sm opacity-75">Brewing happiness one cup at a time.</p>
        <div class="mt-2">
            <a href="#" class="link link-primary">Privacy Policy</a> |
            <a href="#" class="link link-primary">Terms of Service</a> |
            <a href="#" class="link link-primary">Contact Us</a>
        </div>
    </div>
</footer>

<script src="../../assets/js/jquery.js"></script>
<script>
    $(document).ready(function () {

        // =========== ADD ORDER ===========
        $('.btn-add').click(function () {
            const add = $('#address').val();
            const contact = $('#contact').val();
            const amount = $('#amount').val();
            const userId = $(this).data('user-id');
            const roomId = $(this).data('room-id');

            console.log(roomId, userId, contact, amount, add)

            $.post('../../handlers/book.php', {
                book_now: true,
                add, contact, amount, userId, roomId
            }, function (res) {
                if (res.success) {
                    alert("Order Added!");
                    location.reload();
                } else {
                    alert(res.error);
                }
            }, 'json');
        });

        // =========== SHOW EDIT MODAL ===========
        $('.edit-btn').click(function () {
            $('#edit-id').val($(this).data('id'));
            $('#edit-address').val($(this).data('address'));
            $('#edit-contact').val($(this).data('contact'));
            $('#edit-amount').val($(this).data('amount'));
            $('#edit-modal').addClass('modal-open');
        });

        $('#update-btn').click(function () {
            const btn = $(this);
            btn.addClass('loading').prop('disabled', true);

            $.post('../../handlers/updateOrder.php', {
                id: $('#edit-id').val(),
                address: $('#edit-address').val(),
                contact: $('#edit-contact').val(),
                amount: $('#edit-amount').val()
            }, function (res) {
                if (res.success) {
                    alert("Order Updated Successfully!");
                    $('#edit-modal').removeClass('modal-open');
                    location.reload();
                } else {
                    alert(res.error || "An error occurred.");
                }

            }, 'json');

        });

        // =========== DELETE ORDER ===========
        $('.delete-btn').click(function () {

            if (!confirm("Are you sure you want to delete this order?")) return;

            const id = $(this).data('id');
            const btn = $(this);
            btn.addClass('loading').prop('disabled', true);

            $.post('../../handlers/deleteOrder.php', {
                id: id
            }, function (res) {
                if (res.success) {
                    alert("Order Deleted Successfully!");
                    location.reload();
                } else {
                    alert(res.error || "An error occurred.");
                }
            }, 'json').always(function() {
                btn.removeClass('loading').prop('disabled', false);
            });
        });

    });
</script>