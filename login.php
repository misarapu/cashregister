<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="login.css">
    </head>
    <body background="login_back.png">
        <div id="header">
            <a href="login.php"><span id="header-title"># LADU</span></a>
        </div>
        <div id="outer-container">
            <div id="inner-container">
                <div id="center-container">
                    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                        <input type="hidden" name="action" value="reg-user">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                        <table>
                            <caption id="table-title">Sisselogimine</caption>
                            <tbody>
                                <tr>
                                    <th class="row-title">Kasutaja:</th>
                                    <td><input type="text" name="log-username"></td>
                                </tr>
                                <tr>
                                    <th class="row-title">Parool:</th>
                                    <td><input type="password" name="log-password"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center" height="50px">
                                        <button type="submit" name="login-button" id="action-button">Logi sisse
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td id="forgot-pass">
                                            <br>
                                        <span><a href="#">Unustasid parooli</a></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td id="forgot-pass">
                                        <span><a href="registration.php">Registreeri kasutajaks</a></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                </form>
                </div>
            </div>
        </div>
    </body>
</html>
