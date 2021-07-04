<?php


/**
*
*/
class Kategori extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model(['kategori_model']);
        if (!is_logged_in()) {
            redirect('login/admin');
        }
    }


    public function index()
    {
        $data['kategories'] = $this->kategori_model->getAll();
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/kategori/view', $data);
        $this->load->view('dashboard/footer');
    }

    public function add()
    {
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/kategori/add');
        $this->load->view('dashboard/footer');
    }

    public function edit($id)
    {
        $data['kategories'] = $this->kategori_model->getKategoriById($id);
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/kategori/edit', $data);
        $this->load->view('dashboard/footer');
    }

    public function update($id)
    {
        $input = $this->input->post();

        $args = [
            'kode_kat' => strtoupper($input['kode_kat']),
            'kategori' => $input['kategori']
        ];

        $update = $this->kategori_model->update($args, $id);
        if ($update) {
            $this->session->set_flashdata('notification', 'Kategori berhasil diubah');
            redirect('kategori');
        } else {
            $this->session->set_flashdata('error_notification', 'Kategori gagal diubah');
            redirect('kategori');
        }
    }

    public function save()
    {
        $input = $this->input->post();

        $args = [
            'kode_kat' => strtoupper($input['kode_kat']),
            'kategori' => $input['kategori']
        ];

        $save = $this->kategori_model->insert($args);
        if ($save) {
            $this->session->set_flashdata('notification', 'Kategori berhasil disimpan');
            redirect('kategori');
        } else {
            $this->session->set_flashdata('error_notification', 'Kategori gagal disimpan');
            redirect('kategori');
        }
    }
}
