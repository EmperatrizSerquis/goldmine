<?php
class Store_basket extends Trongate {

	function display() {

		$this->module('store_items');
		$picture_settings = $this->store_items

		$sql = 'SELECT
							store_items.item_title,
							store_items.item_code,
							store_items.item_price,
							store_items.picture,
							store_items.id as item_id,
							store_basket.`code`,
							store_basket.item_qty,
							store_item_colors.item_color,
							item_sizes.type_size
					 FROM
					 store_basket
					 JOIN store_items
					 ON store_basket.item_id 0 store_items.id
					 JOIN store_items_colors
					 ON store_basket.item_color_id = storte_item_colors.id
					 JOIN item_sizes
					 ON store_basket.item_size_id = item_sizes.id
					 WHERE store_basket.session_id = :session_id
							';
							$params['session_id'] = session_id();
							$data['rows'] = $this->model->query_bind($sql, $params, 'object');

		$data['view_module'] = 'store_basket';
		$data['view_file'] = 'display';
		$this->template('public_defiant', $data);

	}

	function add_to_basket($data) {
		var_dump($_POST);
		// echo '<br>';
		// echo $data['item_color_id'];
		$errors = [];
		if (isset($_POST['item_color_id'])) {
			$data['item_color_id'] = $this->input('item_color_id');
			if($data['item_color_id'] == 0) {
				$errors[] = 'You did not select an item color.';
			}
		}

		if (isset($_POST['item_size_id'])) {
			$data['item_size_id'] = $this->input('item_size_id');
			if($data['item_size_id'] == 0) {
				$errors[] = 'You did not select an item size.';
			}
		}
		$data['item_qty'] = $this->input('item_qty');
		if($data['item_qty'] == 0) {
			$errors[] = 'You did not select a quantity.';
		}

		if (count($errors)>0) {
			$error_msg = '';
			foreach ($errors as $error) {
				$error_msg.= '<p style="margin: 0.2em; color: red;">'.$error.'</p>';
			}
			set_flashdata($error_msg);
			//send the user to previous url
			redirect(previous_url());
		} else {
			//insert into store_basket
			$data['code'] = make_rand_str(32);
			$data['session_id'] = session_id();
			$data['ip_address'] = $_SERVER['REMOTE_ADDR'];
			$data['item_id'] = $this->input('item_id', true);
			$data['item_color_id'] = $this->input('item_color_id', true);
			$data['item_size_id'] = $this->input('item_size_id', true);
			$data['item_qty'] = $this->input('item_qty', true);
			$data['date_added'] = time();
			$data['shopper_id'] = 0;
			foreach ($data as $key => $value) {
			echo $key." is ".$value."<br>";
			} die();

			$this->model->insert($data, 'store_basket');
			redirect('store_basket/display');

		}

	}


}
