<!-- user_modal_template.php -->

<form id="userForm">
    <input type="hidden" name="userId" value="<?php echo isset($userData['id']) ? $userData['id'] : ''; ?>">

    <label for="name">Name:</label>
    <input type="text" id="name" name="username" value="<?php echo isset($userData['username']) ? $userData['username'] : ''; ?>" required>
    <br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo isset($userData['email']) ? $userData['email'] : ''; ?>" required>
    <br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" value="<?php echo isset($userData['password']) ? $userData['password'] : ''; ?>" required>
    <br>

    <button type="submit">Save User</button>
</form>

