<style rel="stylesheet">
    .response {
        width: 80%;
        padding: 15px;
        text-align: center;
        justify-content: center;
        vertical-align: middle;
        margin: 0 auto 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .response.success {
        color: #3c763d;
        background-color: #dff0d8;
        border-color: #d6e9c6;
    }

    .response.danger {
        color: #a94442;
        background-color: #f2dede;
        border-color: #ebccd1;
    }

    ul.cleanup li {
        padding-bottom: 15px;
    }
</style>
<h1>Cleanup</h1>
<div>
    <ul class="cleanup">
        <li>
            <form method="post" action="admin.php?action=Cleanup">
                <input type="hidden" name="do" value="deleteReportsXDays">
                Remove reports old than <input type="number" min="1" style="width: 75px;" name="days"> days
                <button type="submit">Delete</button>
            </form>
        </li>
        <li>
            <form method="post" action="admin.php?action=Cleanup">
                <input type="hidden" name="do" value="deleteGreenReportsXDays">
                Remove green reports old than <input type="number" min="1" style="width: 75px;" name="days"> days
                <button type="submit">Delete</button>
            </form>
        </li>
    </ul>
</div>
<?php if (isset($vars['success'])): ?>
    <div class="response success"><?= $vars['success']; ?></div>
<?php elseif (isset($vars['error'])): ?>
    <div class="response danger"><?= $vars['error']; ?></div>
<?php endif; ?>
