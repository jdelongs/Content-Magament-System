<?php
$page_title = 'Login';
require_once('header.php');
?>
    <main class="container">
        <h1>Login</h1>

        <form method="post" action="validate.php">
            <fieldset class="form-group">
                <label for="username">Email:</label>
                <input class="u-full-width" name="username" required type="email" placeholder="example@gmail.com"/>
            </fieldset>
            <fieldset class="form-group">
                <label for="password">Password:</label>
                <input class="u-full-width" name="password" required type="password" />
            </fieldset>
            <button type="submit" class="button-primary">Login</button>
        </form>
    </main>

<?php
require_once('footer.php');
?>