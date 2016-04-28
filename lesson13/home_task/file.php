<div id="file">
<?php
    if (isset($_FILES))
        if((is_uploaded_file($_FILES['name_file']['tmp_name']))
            && ($_FILES['name_file']['error'] != UPLOAD_ERR_FORM_SIZE))
        {
            echo 'Файл "' . $_FILES['name_file']['name'] . '" успішно завантажено. <br />';
            echo 'Розмір даного файлу - ' . $_FILES['name_file']['size'] . ' байт. <br/>';
            echo 'Час завантаження файлу ' . date("H:i:s ",$_POST['time']);
        }
    else {
        ?>
        <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] . '?page=file'; ?>" method="POST">
            <input type="hidden" name="MAX_FILE_SIZE" value="30000">
            <input type="hidden" name="time" value="<?php echo time(); ?>">
            <label for="file">Файл:</label>
            <input type="file" name="name_file" id="file"> <br/>
            <input type="submit" value="Відправити">
        </form>
        <?php
    }
?>
</div>
