<?php

class Modelcatalogmmosshortdescr extends Model {

    public function install() {
        $sql = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "product_mmos_shortdescr` (
                    `mmos_shortdescr_id` int(11) NOT NULL auto_increment,
                    `product_id` int(11) NOT NULL,
                    `language_id` int(4) default NULL,
                    `description` text collate utf8_bin  default NULL,
                    PRIMARY KEY  (`mmos_shortdescr_id`)
                    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";
        $this->db->query($sql);
    }

    public function uninstall() {

        $sql = "DROP TABLE IF EXISTS `" . DB_PREFIX . "product_mmos_shortdescr`";
        $this->db->query($sql);
    }

    public function get_desrc_product($product_id) {
        $query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "product_mmos_shortdescr WHERE product_id ='" . (int) $product_id . "'");
        $product_mmos_shortdescr_data = array();
        if ($query->rows) {
            foreach ($query->rows as $result) {
                $product_mmos_shortdescr_data[$result['language_id']] = array(
                    'mmos_shortdescr_id' => $result['mmos_shortdescr_id'],
                    'product_id' => $result['product_id'],
                    'description' => $result['description']
                );
            }
        }
        return $product_mmos_shortdescr_data;
    }

    public function get_desrc_product_copy($product_id) {
        $query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "product_mmos_shortdescr WHERE product_id ='" . (int) $product_id . "'");
        $product_mmos_shortdescr_data = array();
        if ($query->rows) {
            foreach ($query->rows as $result) {
                $product_mmos_shortdescr_data[$result['language_id']] = array(
                    'product_id' => $result['product_id'],
                    'description' => $result['description']
                );
            }
        }
        return $product_mmos_shortdescr_data;
    }

    public function insert($product_id, $data) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_mmos_shortdescr WHERE product_id = '" . (int) $product_id . "'");

        foreach ($data['product_mmos_shortdescr'] as $language_id => $product_desrc) {
            $product_desrc = array_map("trim", $product_desrc);
            $product_desrc['mmos_shortdescr_id'] = isset($product_desrc['mmos_shortdescr_id']) ? (int) $product_desrc['mmos_shortdescr_id'] : '';
            if (isset($language_id) && $product_desrc['description']) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_mmos_shortdescr SET mmos_shortdescr_id = '" . $product_desrc['mmos_shortdescr_id'] . "', product_id = '" . (int) $product_id . "', language_id = '" . (int) $language_id . "', description = '" . $this->db->escape($product_desrc['description']) . "'");
            }
        }
    }

}

?>