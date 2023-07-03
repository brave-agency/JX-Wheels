<?php
/**
 * Title: WooCommerce 1:1 Image 4-Column Products Row
 * Slug: woocommerce-blocks/product-query-1-1-image-4-column-products-row
 * Categories: WooCommerce
 * Block Types: core/query/woocommerce/product-query
 */
?>
<!-- wp:query {"queryId":1,"query":{"perPage":"4","pages":0,"offset":0,"postType":"product","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"__woocommerceStockStatus":["instock","outofstock","onbackorder"]},"displayLayout":{"type":"flex","columns":4},"namespace":"woocommerce/product-query"} -->
<div class="wp-block-query"><!-- wp:post-template -->
<!-- wp:woocommerce/product-image {"isDescendentOfQueryLoop":true} /-->

<!-- wp:post-title {"textAlign":"center","level":3,"isLink":true,"fontSize":"medium"} /-->

<!-- wp:woocommerce/product-price {"isDescendentOfQueryLoop":true,"textAlign":"center","fontSize":"small"} /-->

<!-- wp:woocommerce/product-button {"isDescendentOfQueryLoop":true,"textAlign":"center","fontSize":"small"} /-->
<!-- /wp:post-template -->

<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
<!-- wp:query-pagination-previous /-->

<!-- wp:query-pagination-numbers /-->

<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"placeholder":"Add text or blocks that will display when a query returns no results."} -->
<p></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query -->
