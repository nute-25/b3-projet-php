
<h1>formulaire de la win</h1>
<a href="?"> appeller le controller courant sans action dans la Query String</a>

<form method="post" action="" id="contact_form">


    <fieldset>
        <label for="name">name</label>
        <input type="text" id="name" name="name" value="<?php echo !empty($postdata['name']) ? ($postdata['name']) : '' ?>">
    </fieldset>

    <fieldset>
        <label for="email">email</label>
        <input type="text" id="email" name="email" value="<?= !empty($postdata['email']) ? ($postdata['email']) : '' ?>">
    </fieldset>

    <fieldset>
        <label for="message">message</label>
                <textarea id="message" name="message">
                    <?= !empty($postdata['message']) ? ($postdata['message']) : '' ?>
                </textarea>
    </fieldset>


    <input type="submit" id="ajax_form_check" value="click click">

</form>

