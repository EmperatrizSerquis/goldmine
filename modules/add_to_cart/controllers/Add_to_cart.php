<?php
class Add_to_cart extends Trongate {

	function _draw_add_to_cart($data) {

		$update_id = $data['item_obj']->id;

		$sql = '
				SELECT
					store_item_colors.id ,
					store_item_colors.item_color
				FROM
					associated_store_items_and_store_item_colors
				JOIN store_item_colors ON associated_store_items_and_store_item_colors.store_item_colors_id = store_item_colors.id
				WHERE associated_store_items_and_store_item_colors.store_items_id = :store_items_id
				ORDER BY store_item_colors.item_color';

		$query_data['store_items_id'] = $update_id;
		$data['item_colors'] = $this->model->query_bind($sql, $query_data, 'array');


		$sql2 = '
				SELECT
					item_sizes.id ,
					item_sizes.type_size
				FROM
					associated_store_items_and_item_sizes
				JOIN item_sizes ON associated_store_items_and_item_sizes.item_sizes_id = item_sizes.id
				WHERE associated_store_items_and_item_sizes.store_items_id = :store_items_id
				ORDER BY item_sizes.type_size';

		$data['item_sizes'] = $this->model->query_bind($sql2, $query_data, 'array');
    $data['form_location'] = BASE_URL.'store_basket/add_to_basket';

		$data['view_module'] = 'add_to_cart';
		$this->view('add_to_cart', $data);
	}

}
