<?php
class Checkout extends Trongate {

    function go_to_checkout() {
        $data['item_obj'] = $item_obj;
        $data['item_sizes'] = $this->_fetch_item_sizes($item_obj);
        $data['item_colors'] = $this->_fetch_item_colors($item_obj);
        $this->view('add_to_cart', $data);
    }

    function _fetch_item_colors($item_obj) {
        $params['store_item_id'] = $item_obj->id;
        $sql = '
                SELECT
                    store_item_colors.id ,
                    store_item_colors.item_color
                FROM
                    store_items
                JOIN associated_store_items_and_store_item_colors ON store_items.id = associated_store_items_and_store_item_colors.store_items_id
                JOIN store_item_colors ON associated_store_items_and_store_item_colors.store_item_colors_id = store_item_colors.id
                WHERE store_items.id = :store_item_id
                ORDER BY store_item_colors.item_color';

        $rows = $this->model->query_bind($sql, $params, 'object');
        return $rows;
    }

    function _fetch_item_sizes($item_obj) {
        $params['store_item_id'] = $item_obj->id;
        $sql = '
                SELECT
                    store_item_sizes.id ,
                    store_item_sizes.item_size
                FROM
                    store_items
                JOIN associated_store_items_and_store_item_sizes ON store_items.id = associated_store_items_and_store_item_sizes.store_items_id
                JOIN store_item_sizes ON associated_store_items_and_store_item_sizes.store_item_sizes_id = store_item_sizes.id
                WHERE store_items.id = :store_item_id
                ORDER BY store_item_sizes.item_size';

        $rows = $this->model->query_bind($sql, $params, 'object');
        return $rows;
    }

}
