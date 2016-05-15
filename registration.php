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
                    <form class="" action="index.html" method="post">
                        <table>
                            <caption id="table-title">Registreeri kasutajaks</caption>
                            <tbody>
                                <tr>
                                    <th class="row-title">Sisesta kasutajanimi:</th>
                                    <td><input type="text" name="username"></td>
                                </tr>
                                <tr>
                                    <th class="row-title">Sisesta parool:</th>
                                    <td><input type="password" name="password"></td>
                                </tr>
                                <tr>
                                    <th class="row-title">Korda parooli:</th>
                                    <td><input type="password" name="password"></td>
                                </tr>
                                <tr>
                                    <th class="row-title">E-mail:</th>
                                    <td><input type="email" name="email"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center" height="50px">
                                        <button type="submit" name="reg-button" id="action-button">Registreeri
                                        </button>
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
