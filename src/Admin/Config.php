<?php
    if(isset($_POST['api_namespace'])) {
        // Sauvegarde dans les options
        update_option(\Hyperion\RestAPI\Plugin::API_NAMESPACE_OPTION, $_POST['api_namespace']);
    }
?>

<div class="wrap">
    <form action="">
        <label for="api_namespace">API Namespace : </label>
        <input type="text" id="api_namespace">
        <input type="submit" value="Sauvegarder">
    </form>
</div>
