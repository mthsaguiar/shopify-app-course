<?php
include_once("includes/mysql_connect.php");
include_once("includes/shopify.php");

/**
*===========================================
*        CREATE THE VARIABLES:
*            - $shopify
*            - $parameters
*===========================================
*/

$shopify = new Shopify();
$parameters = $_GET;

/**
*===========================================
*        CHECKING THE SHOPIFY STORE
*===========================================
*/

include_once("includes/check_token.php");

/**
*===========================================
*   HERE DISPLAY ANYTHING ABOUT THE STORE
*===========================================
*/

// $access_scopes = $shopify->rest_api('/admin/oauth/access_scopes.json', array(), 'GET');
// $response_access_scope = json_decode($access_scopes['body'], true);

?>

<?php include_once("header.php"); ?>

    <section>
        <div class="alert columns twelve">
            <dl>
                <dt>
                    <p>Welcome to our app.</p>
                </dt>
            </dl> 
        </div>
    </section>
    <footer>

    </footer>



<?php include_once("footer.php"); ?>
