<?php

namespace App\Controllers;

use App\Models\PostsModel;

class About extends BaseController
{
	function __construct()
    {
        $this->m_posts = new PostsModel();
        helper("global_fungsi_helper");
        $this->validation = \Config\Services::validation();
    }

	public function index()
    {
    	/** dapatkan page_id dari konfigurasi untuk halaman depan */
        $konfigurasi_name = "set_halaman_kontak";
        $konfigurasi = konfigurasi_get($konfigurasi_name);
        $page_id = $konfigurasi['konfigurasi_value'];

        /** dapatkan data dari modelPosts untuk id page_id */
        $dataHalaman = $this->m_posts->getPost($page_id);
        $data['type'] = $dataHalaman['post_type'];
        $data['judul'] = $dataHalaman['post_title'];
        $data['deskripsi'] = $dataHalaman['post_description'];
        $data['thumbnail'] = $dataHalaman['post_thumbnail'];
        $data['konten'] = $dataHalaman['post_content'];

        echo view("depan/v_template_header", $data);
        echo view("depan/v_about", $data);
        echo view("depan/v_template_footer", $data);
    }

}