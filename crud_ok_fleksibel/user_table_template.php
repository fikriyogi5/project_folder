<!-- user_table_template.php -->

<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Action</th>
    </tr>

    <?php foreach ($users as $user) : ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['username']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo $user['password']; ?></td>
            <td>
                <button class="editUser" data-id="<?php echo $user['id']; ?>">Edit</button>
                <button class="deleteUser" data-id="<?php echo $user['id']; ?>">Delete</button>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
