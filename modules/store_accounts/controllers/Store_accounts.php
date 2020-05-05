<?php
class Store_accounts extends Trongate {

    function manage() {
        $this->module('security');
        $data['token'] = $this->security->_make_sure_allowed();
        $data['order_by'] = 'id';

        //format the pagination
        $data['total_rows'] = $this->model->count('store_accounts');
        $data['record_name_plural'] = 'store accounts';

        $data['headline'] = 'Manage Store Accounts';
        $data['view_module'] = 'store_accounts';
        $data['view_file'] = 'manage';

        $this->template('admin', $data);
    }

    function show() {
        $this->module('security');
        $token = $this->security->_make_sure_allowed();

        $update_id = $this->url->segment(3);

        if ((!is_numeric($update_id)) && ($update_id != '')) {
            redirect('store_accounts/manage');
        }

        $data = $this->_get_data_from_db($update_id);
        $data['token'] = $token;

        if ($data == false) {
            redirect('store_accounts/manage');
        } else {
            $data['form_location'] = BASE_URL.'store_accounts/submit/'.$update_id;
            $data['update_id'] = $update_id;
            $data['headline'] = 'Store Account Information';
            $data['view_file'] = 'show';
            $this->template('admin', $data);
        }
    }

    function create() {
        $this->module('security');
        $this->security->_make_sure_allowed();

        $update_id = $this->url->segment(3);
        $submit = $this->input('submit', true);

        if ((!is_numeric($update_id)) && ($update_id != '')) {
            redirect('store_accounts/manage');
        }

        //fetch the form data
        if (($submit == '') && ($update_id > 0)) {
            $data = $this->_get_data_from_db($update_id);
        } else {
            $data = $this->_get_data_from_post();
        }

        $data['headline'] = $this->_get_page_headline($update_id);

        if ($update_id > 0) {
            $data['cancel_url'] = BASE_URL.'store_accounts/show/'.$update_id;
            $data['btn_text'] = 'UPDATE STORE ACCOUNT DETAILS';
        } else {
            $data['cancel_url'] = BASE_URL.'store_accounts/manage';
            $data['btn_text'] = 'CREATE STORE ACCOUNT RECORD';
        }

        $additional_includes_top[] = 'https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css';
        $additional_includes_top[] = 'https://trentrichardson.com/examples/timepicker/jquery-ui-timepicker-addon.css';
        $additional_includes_top[] = 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"';
        $additional_includes_top[] = 'https://trentrichardson.com/examples/timepicker/jquery-ui-timepicker-addon.js';
        $additional_includes_top[] = BASE_URL.'admin_files/js/i18n/jquery-ui-timepicker-addon-i18n.min.js';
        $additional_includes_top[] = BASE_URL.'admin_files/js/jquery-ui-sliderAccess.js';
        $data['additional_includes_top'] = $additional_includes_top;

        $data['form_location'] = BASE_URL.'store_accounts/submit/'.$update_id;
        $data['update_id'] = $update_id;
        $data['view_file'] = 'create';
        $this->template('admin', $data);
    }

    function _get_page_headline($update_id) {
        //figure out what the page headline should be (on the store_accounts/create page)
        if (!is_numeric($update_id)) {
            $headline = 'Create New Store Account Record';
        } else {
            $headline = 'Update Store Account Details';
        }

        return $headline;
    }

    function submit() {
        $this->module('security');
        $this->security->_make_sure_allowed();

        $submit = $this->input('submit', true);

        if ($submit == 'Submit') {

            $this->validation_helper->set_rules('first_name', 'First Name', 'required|min_length[2]|max_length[120]');
            $this->validation_helper->set_rules('last_name', 'Last Name', 'required|min_length[2]|max_length[100]');
            $this->validation_helper->set_rules('company', 'Company', 'min_length[2]|max_length[150]');
            $this->validation_helper->set_rules('street_address', 'Street Address', 'required|max_length[255]');
            $this->validation_helper->set_rules('address_line_2', 'Address Line 2', 'max_length[255]');
            $this->validation_helper->set_rules('city', 'City', 'min_length[4]|max_length[45]');
            $this->validation_helper->set_rules('state', 'State', 'min_length[4]|max_length[48]');
            $this->validation_helper->set_rules('zip_code', 'Zip Code', 'min_length[2]|max_length[10]|required');
            $this->validation_helper->set_rules('telephone_number', 'Telephone Number', 'min_length[2]|max_length[70]');
            $this->validation_helper->set_rules('email', 'Email', 'required|min_length[7]|max_length[255]|valid email address|valid_email');

            $result = $this->validation_helper->run();

            if ($result == true) {

                $update_id = $this->url->segment(3);
                $data = $this->_get_data_from_post();
                if (is_numeric($update_id)) {
                    //update an existing record
                    $this->model->update($update_id, $data, 'store_accounts');
                    $flash_msg = 'The record was successfully updated';
                } else {
                    //insert the new record
                    $data['date_created'] = time();
                    $data['pword'] = '';
                    //insert a new trongate_user record
                    $trongate_user_data['code'] = make_rand_str(32);
                    $trongate_user_data['user_level_id'] = 2;
                    $data['trongate_user_id'] = $this->model->insert($trongate_user_data, 'trongate_users');

                    $update_id = $this->model->insert($data, 'store_accounts');
                    $flash_msg = 'The record was successfully created';
                }

                set_flashdata($flash_msg);
                redirect('store_accounts/show/'.$update_id);

            } else {
                //form submission error
                $this->create();
            }

        }

    }

    function submit_delete() {
        $this->module('security');
        $this->security->_make_sure_allowed();

        $submit = $this->input('submit', true);

        if ($submit == 'Submit') {
            $update_id = $this->url->segment(3);

            if (!is_numeric($update_id)) {
                die();
            } else {
                $data['update_id'] = $update_id;

                //delete all of the comments associated with this record
                $sql = 'delete from comments where target_table = :module and update_id = :update_id';
                $data['module'] = $this->module;
                $this->model->query_bind($sql, $data);

                //delete the record
                $this->model->delete($update_id, $this->module);

                //set the flashdata
                $flash_msg = 'The record was successfully deleted';
                set_flashdata($flash_msg);

                //redirect to the manage page
                redirect('store_accounts/manage');
            }
        }
    }

    function _get_data_from_db($update_id) {
        $store_accounts = $this->model->get_where($update_id, 'store_accounts');

        if ($store_accounts == false) {
            $this->template('error_404');
            die();
        } else {
            $data['first_name'] = $store_accounts->first_name;
            $data['last_name'] = $store_accounts->last_name;
            $data['company'] = $store_accounts->company;
            $data['street_address'] = $store_accounts->street_address;
            $data['address_line_2'] = $store_accounts->address_line_2;
            $data['city'] = $store_accounts->city;
            $data['state'] = $store_accounts->state;
            $data['zip_code'] = $store_accounts->zip_code;
            $data['telephone_number'] = $store_accounts->telephone_number;
            $data['email'] = $store_accounts->email;
            $data['date_created'] = date('l jS \of F Y \a\t h:i:s A', $store_accounts->date_created);

            return $data;
        }
    }

    function _get_data_from_post() {
        $data['first_name'] = $this->input('first_name', true);
        $data['last_name'] = $this->input('last_name', true);
        $data['company'] = $this->input('company', true);
        $data['street_address'] = $this->input('street_address', true);
        $data['address_line_2'] = $this->input('address_line_2', true);
        $data['city'] = $this->input('city', true);
        $data['state'] = $this->input('state', true);
        $data['zip_code'] = $this->input('zip_code', true);
        $data['telephone_number'] = $this->input('telephone_number', true);
        $data['email'] = $this->input('email', true);
        return $data;
    }

}
