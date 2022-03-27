<?php
include_once("includes/mysql_connect.php");
include_once("includes/shopify.php");

$shopify = new Shopify();
$parameters = $_GET;

include_once("includes/check_token.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['product_title']) && isset($_POST['product_body_html']) && $_POST['action_type'] == 'create_product'){
        $product_data = array(
            "product" => array(
                "title" => $_POST['product_title'],
                "body_html" => $_POST['product_body_html']
            )
        );

        $create_product = $shopify->rest_api('/admin/api/2022-01/products.json', $product_data, 'POST');
        $create_product = json_decode($create_product['body'], true);

        echo print_r($create_product);


    }

    if(isset($_POST['delete_id']) && $_POST['action_type'] == 'delete'){
        $delete = $shopify->rest_api('/admin/api/2022-01/products/' . $_POST['delete_id'] . '.json', array(), 'DELETE');
        $delete = json_decode($delete['body'], true);
    }
    if(isset($_POST['update_id']) && $_POST['action_type'] == 'update'){
        $update_data = [
            "products" => [
                "id"=> $_POST['update_id'],
                "title"=> $_POST['update_name']
            ]
        ];
        echo print_r($update_data);
        $update = $shopify->rest_api('/admin/api/2022-01/products/' . $_POST['update_id'] . '.json', $update_data, 'PUT');
        $update = json_decode($update['body'], true);

        echo print_r($update);

    }
    
};


$products = $shopify->rest_api('/admin/api/2022-01/products.json', array(), 'GET');
$products = json_decode($products['body'], true);


?>

<?php include_once("header.php"); ?>

<section>
    <aside>
        <h2>Create new product</h2>
        <p>Fill out the following form and click the submit button to create a new product.</p>
        </aside>
    <article>
        <div class="card">
            <form action="" method="POST">
                <input type="hidden" name="action_type" value="create_product">
                <div class="row">
                    <label for="productTitle">Title</label>
                    <input type="text" name="product_title" id="productTitle">
                </div>
                <div class="row">
                    <label for="productDesc">Description</label>
                    <textarea type="text" name="product_body_html" id="productDesc"></textarea>
                </div>
                <div class="row">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </article>
</section>

<section>
    <table>
        <thead>
            <tr>
                <th colspan="2">Product</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($products as $product){
                    foreach($product as $key=> $value){
                        $image = count($value['images']) > 0 ? $value['images'][0]['src'] : "";
                        ?>
                            <tr>
                                <td>
                                    <img width="36" height="36" src="<?php echo $image; ?>">
                                </td>
                                <td>
                                    <form action="" method="POST" class="row side-elements">
                                        <input type="hidden" name="update_id" value="<?php echo $value['id']; ?>">
                                        <input type="text" name="update_name" value="<?php echo $value['title']; ?>">
                                        <input type="hidden" name="action_type" value="update">
                                        <button class="secondary icon-checkmark"></button>
                                    </form></td>
                                    <td><?php echo $value['status']; ?></td>
                                <td>
                                    <form action="" method="POST">
                                        <input type="hidden" name="delete_id" value="<?php echo $value['id']; ?>">
                                        <input type="hidden" name="action_type" value="delete">
                                        <button class="secondary icon-trash"></button>
                                    </form>    
                                </td>
                                    
                            </tr>
                        <?php
                    }
                }
            ?>
        </tbody>
    </table>
</section>

<?php include_once("footer.php"); ?>
