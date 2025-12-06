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

    echo "Welcome&nbsp;" . htmlspecialchars($_SESSION['email']);
    echo "&nbsp;- Client ";
?>

<br>
<br>

<h3>Order Now:</h3>

<input type="text" id="address" placeholder="Address"><br>
<input type="text" id="contact" placeholder="Contact"><br>
<input type="number" id="amount" value="1000"><br>

<button class="btn-add"
    data-user-id=" <?php echo htmlspecialchars($_SESSION['id'])   ?>"
    data-room-id="8">Add Order
</button>
<br>
<br>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ORDER ID</th>
            <th>CUSTOMER</th>
            <th>CONTACT</th>
            <th>ADDRESS</th>
            <th>AMOUNT</th>
            <th>STATUS</th>
            <th>ACTION</th>
        </tr>
    </thead>

    <tbody id="orders-table">
        <?php foreach ($row as $items): ?>
            <tr id="row-<?= $items['item_id'] ?>">
                <td><?= $items['item_id'] ?></td>
                <td><?= $items['email'] ?></td>
                <td><?= $items['contact'] ?></td>
                <td><?= $items['address'] ?></td>
                <td><?= $items['total_amount'] ?></td>
                <td style="color:<?= $items['status']=='approved'?'green':'red' ?>">
                    <?= $items['status'] ?>
                </td>
                <td>
                    <button class="edit-btn" 
                            data-id="<?= $items['item_id'] ?>"
                            data-address="<?= $items['address'] ?>"
                            data-contact="<?= $items['contact'] ?>"
                            data-amount="<?= $items['total_amount'] ?>">
                        Edit
                    </button>

                    <button class="delete-btn" data-id="<?= $items['item_id'] ?>">
                        Delete 
                    </button>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<div id="edit-modal" 
    style="display:none; position:fixed; top:30%; left:40%; background:#fff; padding:20px; border:1px solid #aaa;">

    <h3>Edit Order</h3>

    <input type="hidden" id="edit-id">
    <input type="text" id="edit-address" placeholder="Address"><br>
    <input type="text" id="edit-contact" placeholder="Contact"><br>
    <input type="number" id="edit-amount" placeholder="Amount"><br>

    <button id="update-btn">Update</button>
    <button onclick="$('#edit-modal').hide()">Cancel</button>
</div>

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
            $('#edit-modal').show();
        });

        // =========== UPDATE ORDER ===========
        $('#update-btn').click(function () {

            $.post('../../handlers/updateOrder.php', {
                id: $('#edit-id').val(),
                address: $('#edit-address').val(),
                contact: $('#edit-contact').val(),
                amount: $('#edit-amount').val()
            }, function (res) {

                if (res.success) {
                    alert("Order Updated!");
                    location.reload();
                } else {
                    alert(res.error);
                }

            }, 'json');

        });

        // =========== DELETE ORDER ===========
        $('.delete-btn').click(function () {

            if (!confirm("Are you sure you want to delete this order?")) return;

            const id = $(this).data('id');

            $.post('../../handlers/deleteOrder.php', {
                id: id
            }, function (res) {
                if (res.success) {
                    $("#row-" + id).remove();
                } else {
                    alert(res.error);
                }
            }, 'json');

        });

    });
</script>