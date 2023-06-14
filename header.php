<nav class="navbar">
    <header id="header">
        <nav>
            <a href="./index.php"><img src="./img/logo.png" /></a>
            <div class="navivation">
                <?php
                if (isset($_SESSION['user_auth'])) {
                    echo '
                    <form action="deconnecter.php">
                        <input class="nav-links" type="submit" value="Déconnexion">
                    </form>
                    <a href="./Modification.php"><img src="./img/account.png" /></a>
                ';
                }

                if (!isset($_SESSION['user_auth'])) {
                    echo '
                    <form action="login.php">
                        <input class="nav-links" type="submit" value="Connection">
                    </form>
                ';
                }
                ?>

            </div>
        </nav>
    </header>

</nav>