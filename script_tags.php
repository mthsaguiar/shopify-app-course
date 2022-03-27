<?php
include_once("includes/mysql_connect.php");
include_once("includes/shopify.php");

$shopify = new Shopify();
$parameters = $_GET;

include_once("includes/check_token.php");

$script_url = 'https://f734-167-249-188-18.ngrok.io/pegasusv1/scripts/script_custom.js';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['action_type'] == 'create_script'){
        $scriptTag_data = array(
            "script_tag"=> array(
                "event" => "onload",
                "src" => $script_url
            )
        );

        $create_script = $shopify->rest_api('/admin/api/2022-01/script_tags.json', $scriptTag_data, 'POST');
        $create_script = json_decode($create_script['body'], true);

        echo print_r($create_script);
    }
    if($_POST['action_type'] == 'delete_script'){
        echo 'we are deleting';
        $script_tag = array('src'=>$script_url);
        $get_script = $shopify->rest_api('/admin/api/2022-01/script_tags.json', $script_tag, 'GET');
        $get_script = json_decode($get_script['body'], true);

        foreach($get_script as $script){
            echo print_r($script);
            $delete_script = $shopify->rest_api('/admin/api/2022-01/script_tags/'. $script[0]['id'] .'.json', array(), 'DELETE');
        }
    }
}


$scriptTags = $shopify->rest_api('/admin/api/2022-01/script_tags.json', array(), 'GET');

$scriptTags = json_decode($scriptTags['body'], true);

// echo print_r($scriptTags);

?>
<?php include_once("header.php"); ?>
<section>
    <aside>
        <h2>Install Script Tags</h2>
        <p>Click the install button to apply our script to your Shopify Store</p>
    </aside>
    <article>
        <form action="" method="post">
            <input type="hidden" name="action_type" value="create_script">
            <button type="submit">Create Script Tag</button>
        </form>
    </article>
</section>
<section>
    <aside>
        <h2>Delete Script Tags</h2>
        <p>Click the delete button to delete our script to your Shopify Store</p>
    </aside>
    <article>
        <form action="" method="post">
            <input type="hidden" name="action_type" value="delete_script">
            <button type="submit">Delete Script Tag</button>
        </form>
    </article>
</section>
<?php include_once("footer.php"); ?>
