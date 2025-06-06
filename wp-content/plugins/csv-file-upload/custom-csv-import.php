<?php
/*
Plugin Name: CSV Uploader with Dynamic Pagination
Description: Upload a CSV file and dynamically paginate data based on admin input.
Version: 1.1
Author: Vishva Tatamiya
*/

// Add CSS via wp_head
add_action('wp_head', 'csvuploader_add_styles');
function csvuploader_add_styles() {
    ?>
    <style>
    .csv-pagination ul {
        display: flex;
        list-style: none;
        padding-left: 0;
        margin-top: 15px;
    }
    .csv-pagination li {
        margin: 0 5px;
    }
    .csv-pagination a, .csv-pagination span {
        display: inline-block;
        padding: 6px 12px;
        border: 1px solid rgb(0, 0, 0); 
        text-decoration: none;
        border-radius: 3px;
        background-color: rgb(0, 0, 0); 
        transition: background-color 0.3s;
        color: #fff;
    }
    </style>
    <?php
}

add_action('admin_menu', 'csvuploader_admin_menu');
function csvuploader_admin_menu() {
    add_menu_page('CSV Uploader', 'CSV Uploader', 'manage_options', 'csv-uploader', 'csvuploader_page');
}

register_activation_hook(__FILE__, 'csvuploader_plugin_activate');
function csvuploader_plugin_activate() {
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();

    // Create csv_data table
    $table1 = $wpdb->prefix . 'csv_data';
    $sql1 = "CREATE TABLE IF NOT EXISTS $table1 (
        id INT AUTO_INCREMENT PRIMARY KEY,
        State_code VARCHAR(10),
        Zip_code INT,
        Agent_id INT
    ) $charset_collate;";

    // Create bauber_data table
    $table2 = $wpdb->prefix . 'bauber_data';
    $sql2 = "CREATE TABLE IF NOT EXISTS $table2 (
        id INT AUTO_INCREMENT PRIMARY KEY,
        Agent_id INT,
        salutation VARCHAR(20),
        first_name VARCHAR(100),
        last_name VARCHAR(100),
        State_code VARCHAR(10),
        zip_code VARCHAR(20),
        city VARCHAR(100),
        phone_1 VARCHAR(30),
        phone_2 VARCHAR(30),
        phone_3 VARCHAR(30),
        email VARCHAR(150),
        address TEXT,
        office_hours TEXT
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql1);
    dbDelta($sql2);

    // Create frontend page if not exists
    $title = 'CSV Data Viewer';
    $shortcode = 'show_csv_data';
    $page_check = get_page_by_title($title);

    if (!$page_check) {
        $new_page = array(
            'post_title'   => $title,
            'post_content' => '[' . $shortcode . ']',
            'post_status'  => 'publish',
            'post_type'    => 'page'
        );
        $post_id = wp_insert_post($new_page);

        if ($post_id && !is_wp_error($post_id)) {
            update_option('csvuploader_page_id', $post_id);
        }
    }

    // Set default pagination count
    if (!get_option('csvuploader_per_page')) {
        update_option('csvuploader_per_page', 20);
    }


        // Create second frontend page if not exists
    $agent_page_title = 'Agent Details Viewer';
    $agent_shortcode = 'show_agent_data';
    $agent_page_check = get_page_by_title($agent_page_title);

    if (!$agent_page_check) {
        $new_agent_page = array(
            'post_title'   => $agent_page_title,
            'post_content' => '[' . $agent_shortcode . ']',
            'post_status'  => 'publish',
            'post_type'    => 'page'
        );
        $agent_post_id = wp_insert_post($new_agent_page);

        if ($agent_post_id && !is_wp_error($agent_post_id)) {
            update_option('csvuploader_agent_page_id', $agent_post_id);
        }
    }
    if ($agent_page_id = get_option('csvuploader_agent_page_id')) {
    wp_delete_post($agent_page_id, true);
    delete_option('csvuploader_agent_page_id');
}



}

register_deactivation_hook(__FILE__, 'csvuploader_plugin_deactivation');
function csvuploader_plugin_deactivation() {
    global $wpdb;

    $table1 = $wpdb->prefix . 'csv_data';
    $wpdb->query("DELETE FROM $table1");

    $table2 = $wpdb->prefix . 'bauber_data';
    $wpdb->query("DELETE FROM $table2");

    if ($page_id = get_option('csvuploader_page_id')) {
        wp_delete_post($page_id, true);
        delete_option('csvuploader_page_id');
    }

    delete_option('csvuploader_per_page');
}



function csvuploader_page() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_FILES['csv_file'])) {
            csvuploader_handle_csv();
        } elseif (isset($_FILES['dat_file'])) {
            csvuploader_handle_dat();
        } elseif (isset($_POST['records_per_page'])) {
            $per_page = max(1, intval($_POST['records_per_page']));
            update_option('csvuploader_per_page', $per_page);
            echo '<div class="updated"><p>Pagination setting updated.</p></div>';
        }
    }

    ?>
    <div class="wrap">
        <h1>Upload CSV File</h1>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="csv_file" accept=".csv" required />
            <?php submit_button('Upload CSV'); ?>
        </form>

        <h1>Upload .DAT File</h1>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="dat_file" accept=".dat" required />
            <?php submit_button('Upload DAT'); ?>
        </form>

        <h2>Set Records Per Page (Frontend Pagination)</h2>
        <form method="post">
            <input type="number" name="records_per_page" value="<?= esc_attr(get_option('csvuploader_per_page', 20)); ?>" min="1" required />
            <?php submit_button('Save Setting'); ?>
        </form>
    </div>
    <?php
}

function csvuploader_handle_csv() {
    if (empty($_FILES['csv_file']['tmp_name'])) return;

    $file_name = $_FILES['csv_file']['name'];
    if (strtolower(pathinfo($file_name, PATHINFO_EXTENSION)) !== 'csv') {
        echo '<div class="error"><p>Only CSV files allowed.</p></div>';
        return;
    }

    csvuploader_process_file($_FILES['csv_file']['tmp_name']);
}

function csvuploader_handle_dat() {
    if (empty($_FILES['dat_file']['tmp_name'])) return;

    $file_name = $_FILES['dat_file']['name'];
    if (strtolower(pathinfo($file_name, PATHINFO_EXTENSION)) !== 'dat') {
        echo '<div class="error"><p>Only .dat files allowed.</p></div>';
        return;
    }

    if (strtolower($file_name) !== 'bauber_internet.dat') {
        echo '<div class="error"><p>Only "bauber_internet.dat" accepted.</p></div>';
        return;
    }

    csvuploader_process_dat_file($_FILES['dat_file']['tmp_name']);
}

function csvuploader_process_file($file_path) {
    global $wpdb;
    $table = $wpdb->prefix . 'csv_data';

    $handle = fopen($file_path, 'r');
    if (!$handle) {
        echo '<div class="error"><p>Failed to open CSV.</p></div>';
        return;
    }

    $success = 0; $fail = 0; $line_number = 1;
    while (($line = fgets($handle)) !== false) {
        $line = trim($line);
        if (!$line) continue;

        $parts = explode(';', $line);
        if (count($parts) !== 3) {
            echo "<div class='error'><p>Error on line $line_number: invalid format.</p></div>";
            $fail++; $line_number++;
            continue;
        }

        $inserted = $wpdb->insert($table, [
            'State_code' => sanitize_text_field($parts[0]),
            'Zip_code'   => intval($parts[1]),
            'Agent_id'   => intval($parts[2])
        ]);

        $inserted ? $success++ : $fail++;
        $line_number++;
    }

    fclose($handle);

    echo "<strong>CSV Upload Summary:</strong><br>✅ Inserted: $success<br>❌ Failed: $fail";
}
function csvuploader_process_dat_file($file_path) {
    global $wpdb;
    $table = $wpdb->prefix . 'bauber_data';

    $handle = fopen($file_path, 'r');
    if (!$handle) {
        echo '<div class="error"><p>Failed to open DAT file.</p></div>';
        return;
    }

    $success = 0;
    $fail = 0;

    while (($line = fgets($handle)) !== false) {
        $line = trim($line);
        if (empty($line)) continue;

        $fields = array_map('trim', explode('^', $line));
        $agent_id = is_numeric($fields[0]) ? intval($fields[0]) : 0;


        $email_index = array_search(true, array_map('is_email', $fields));
        $email = $email_index !== false ? sanitize_email($fields[$email_index]) : '';

        $phones = array_filter($fields, function ($v) {
            return preg_match('/\+[\d\s]+/', $v);
        });
        $phones = array_values($phones);
        $phone_1 = $phones[0] ?? '';
        $phone_2 = $phones[1] ?? '';
        $phone_3 = $phones[2] ?? '';

        $office_hours = '';
        for ($i = count($fields) - 1; $i > $email_index; $i--) {
            if (!empty($fields[$i])) {
                $office_hours = sanitize_text_field($fields[$i]);
                break;
            }
        }

        $known_values = [
            $fields[0] ?? '',
            $fields[1] ?? '',
            $fields[2] ?? '',
            $fields[3] ?? '',
            $fields[4] ?? '',
            $fields[5] ?? '',
            $fields[6] ?? '',

            $email,
            $phone_1,
            $phone_2,
            $phone_3,
            $office_hours,
        ];

        $address_parts = array_filter($fields, function ($v) use ($known_values) {
            return !in_array($v, $known_values) && !is_email($v) && !preg_match('/\+[\d\s]+/', $v);
        });

        $address = sanitize_text_field(implode(', ', $address_parts));

        $inserted = $wpdb->insert($table, [
            'Agent_id'     => $agent_id,
            'salutation'    => sanitize_text_field($fields[1] ?? ''),
            'first_name'    => sanitize_text_field($fields[2] ?? ''),
            'last_name'     => sanitize_text_field($fields[3] ?? ''),
            'State_code'  => sanitize_text_field($fields[4] ?? ''),
            'zip_code'      => sanitize_text_field($fields[5] ?? ''),
            'city'          => sanitize_text_field($fields[6] ?? ''),
            'phone_1'       => $phone_1,
            'phone_2'       => $phone_2,
            'phone_3'       => $phone_3,
            'email'         => $email,
            'address'       => $address,
            'office_hours'  => $office_hours,
        ]);

        $inserted ? $success++ : $fail++;
    }

    fclose($handle);

    echo "<strong>Upload Summary:</strong><br>✅ Success: $success<br>❌ Failed: $fail";
}

// Shortcode display
add_shortcode('show_csv_data', 'csvuploader_show_csv_data');
function csvuploader_show_csv_data() {
    global $wpdb;
    $table = $wpdb->prefix . 'csv_data';

    $per_page = (int) get_option('csvuploader_per_page', 20);
    $paged = isset($_GET['csvpage']) ? max(1, intval($_GET['csvpage'])) : 1;
    $offset = ($paged - 1) * $per_page;

    $total = $wpdb->get_var("SELECT COUNT(*) FROM $table");
    $rows = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table LIMIT %d OFFSET %d", $per_page, $offset));

    if (!$rows) return '<p>No records found.</p>';

    ob_start();
    echo '<table border="1" cellpadding="5"><tr><th>ID</th><th>State</th><th>Zip</th><th>Agent</th></tr>';
    foreach ($rows as $r) {
        echo "<tr><td>$r->id</td><td>$r->State_code</td><td>$r->Zip_code</td><td>$r->Agent_id</td></tr>";
    }
    echo '</table>';

    $total_pages = ceil($total / $per_page);
    if ($total_pages > 1) {
        echo '<div class="csv-pagination">';
        echo paginate_links([
            'base' => add_query_arg('csvpage', '%#%'),
            'format' => '',
            'current' => $paged,
            'total' => $total_pages,
            'type' => 'list',
            'prev_text' => '« Prev',
            'next_text' => 'Next »',
        ]);
        echo '</div>';
    }
    return ob_get_clean();
}
add_shortcode('show_agent_data', 'csvuploader_show_agent_data');
function csvuploader_show_agent_data() {
    global $wpdb;
    $table = $wpdb->prefix . 'bauber_data';

    $state_code = isset($_GET['state_code']) ? sanitize_text_field($_GET['state_code']) : '';
    $zip_code = isset($_GET['zip_code']) ? sanitize_text_field($_GET['zip_code']) : '';

    ob_start();
    ?>
    <form method="get">
        <input type="hidden" name="page_id" value="<?= get_the_ID(); ?>" />
        <label for="state_code">State Code:</label>
        <input type="text" name="state_code" value="<?= esc_attr($state_code); ?>" required />
        <label for="zip_code">Zip Code:</label>
        <input type="text" name="zip_code" value="<?= esc_attr($zip_code); ?>" required />
        <button type="submit">Search</button>
        <button ><a href="<?= get_permalink(); ?>">Clear</a></button>

    </form>
    <br>
    <?php

    if ($state_code && $zip_code) {
        $per_page = (int) get_option('csvuploader_per_page', 20);
        $paged = isset($_GET['csvpage']) ? max(1, intval($_GET['csvpage'])) : 1;
        $offset = ($paged - 1) * $per_page;

        $total = $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM $table WHERE State_code = %s AND zip_code = %s",
            $state_code, $zip_code
        ));

        $results = $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM $table WHERE State_code = %s AND zip_code = %s LIMIT %d OFFSET %d",
            $state_code, $zip_code, $per_page, $offset
        ));

        if (!$results) {
            echo '<p>No agent data found for this combination.</p>';
        } else {
            echo '<table border="1" cellpadding="5"><tr><th>Agent ID</th><th>Name</th><th>State Code</th><th>Zip Code</th><th>Email</th><th>Phone</th><th>City</th></tr>';
            foreach ($results as $r) {
                echo "<tr>
                    <td>{$r->Agent_id}</td>
                    <td>{$r->salutation} {$r->first_name} {$r->last_name}</td>
                    <td>{$r->State_code}</td>
                    <td>{$r->zip_code}</td>
                    <td>{$r->email}</td>
                    <td>{$r->phone_1}</td>
                    <td>{$r->city}</td>
                </tr>";
            }
            echo '</table>';

            // Pagination
            $total_pages = ceil($total / $per_page);
            if ($total_pages > 1) {
                echo '<div class="csv-pagination">';
                echo paginate_links([
                    'base' => add_query_arg(['csvpage' => '%#%', 'state_code' => $state_code, 'zip_code' => $zip_code]),
                    'format' => '',
                    'current' => $paged,
                    'total' => $total_pages,
                    'type' => 'list',
                    'prev_text' => '« Prev',
                    'next_text' => 'Next »',
                ]);
                echo '</div>';
            }
        }
    }

    return ob_get_clean();
}
