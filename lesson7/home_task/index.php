<?php
// login = 'veriga2021'
// password = 'veriga'
header('content-type: text/html; charset=utf-8');
if (isset($_POST['submit'])) {
    $login = htmlentities($_POST['login']);
    $password = htmlentities($_POST['password']);

    if ($ch = curl_init()) {
        $url = 'http://passport.meta.ua/';
        // файл куків
        $cookiefile = dirname('_FILE_') . '/cookie.txt';
        // масив котрий передається методом POST
        // дані взяв з Firebug
        $post = array();
        $post['from'] = 'passport';
        $post['lifetime'] = 'alltime';
        $post['login'] = $login;
        $post['mode'] = 'login';
        $post['oauthsid'] = '';
        $post['password'] = $password;
        $post['redirect'] = 'http://passport.meta.ua/account/';
        $post['subm'] = 'Âîéòè';

        curl_setopt($ch, CURLOPT_URL, $url);
        // розпочинає нову сесію, якщо стара була закриває її
        curl_setopt($ch, CURLOPT_COOKIESESSION, true);

        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_REFERER, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        // використовується функція котра формує стрічку з post данними з масиву
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        $out = curl_exec($ch);
        // якщо авторизація пройшла успішно
        // тоді у вмісті буде відсутня форма авторизації з відповідним id

        if (!preg_match('#<form[^>]+id="loginform"#Usi', $out)) {
            header('content-type: text/html; charset=windows-1251');
            echo $out;
        } else {
            echo 'Авторизація не пройдена, спробуйте ще раз. <br/>';
            unset($_POST['submit']);
        }
        curl_close($ch);

    }
}
if (!isset($_POST['submit'])) {
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="login">Логін</label> <br/>
        <input type="text" id="login" name="login"> <br/>
        <label for="password">Пароль</label><br/>
        <input type="password" id="password" name="password"><br/>
        <input type="submit" name="submit" value="Увійти">
    </form>
    <?php
}
