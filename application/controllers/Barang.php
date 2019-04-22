<?php


/**
*
*/
class Barang extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model(['kategori_model', 'barang_model']);
        if (!is_logged_in()) {
            redirect('login/admin');
        }
    }


    public function index()
    {
        $data['barang'] = $this->barang_model->getAll();
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/barang/view', $data);
        $this->load->view('dashboard/footer');
    }

    public function add()
    {
        $data['kategories'] = $this->kategori_model->getAll();
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/barang/add', $data);
        $this->load->view('dashboard/footer');
    }

    public function edit($id)
    {
        $data['kategories'] = $this->kategori_model->getAll();
        $data['barang'] = $this->barang_model->getBarangById($id);
        $data['barang'][0]->grosir = json_decode($data['barang'][0]->grosir);
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/barang/edit', $data);
        $this->load->view('dashboard/footer');
    }

    public function autocomplete()
    {
        $result = [];
        if ($_GET['term']) {
            $data = [
                "kode_brg" => $_GET['term']
            ];
            $barang = $this->barang_model->getByTerm($data);
        } else {
            $barang = $this->barang_model->getAll();
        }
        foreach ($barang as $keyBarang => $dataBarang) {
            $result[] = [
                'id' => $dataBarang->kode_brg,
                'value' => $dataBarang->kode_brg
            ];
        }

        if (!empty($result)) {
            echo json_encode($result);
        }
    }

    public function findMaxId($kodeKat)
    {
        $data = [
            'kode_brg' => $kodeKat
        ];

        $maxId = $this->barang_model->getMaxId($data);

        if (isset($maxId[0]->kode_brg)) {
            $maxId = (int)$maxId[0]->kode_brg;
            $maxId++;
            $kodeBaru = $kodeKat . sprintf("%06s", $maxId);

            $res = [
                'kode_brg' => $kodeBaru
            ];
        } else {
            $res = [
                'kode_brg' => $kodeKat . '000001'
            ];
        }
        echo json_encode($res);
    }

    public function ajaxCariId($id)
    {
        $data = [
            'kode_brg' => $id
        ];

        $brg = $this->barang_model->getById($data);

        $brg = $brg[0];

        $barang = [
            'kode_brg'  => $brg->kode_brg,
            'harga'         => idr_format($brg->harga_jual),
            'nama_brg'  => $brg->nama_brg
        ];
        
        echo json_encode($barang);
    }

    public function update($id)
    {
        $input = $this->input->post();

        $args = [
            'kode_brg'      => strtoupper($input['kode_brg']),
            'nama_brg'      => $input['nama_brg'],
            'qty'           => $input['qty'],
            'harga_jual'    => idrToString($input['harga_jual']),
            'harga_beli'    => idrToString($input['harga_beli'])
        ];
        if (sizeof($input['grosir']) > 0) {
            $i = 0;
            foreach ($input['grosir']['harga_jual_grosir'] as $harga_grosir) {
                $input['grosir']['harga_jual_grosir'][$i] = idrToString($harga_grosir);
                $i++;
            }
            $args['grosir'] = json_encode($input['grosir']);
        }

        $update = $this->barang_model->update($args, $id);
        if ($update) {
            $this->session->set_flashdata('notification', 'Data Barang berhasil diubah');
            redirect('barang');
        } else {
            $this->session->set_flashdata('error_notification', 'Data Barang gagal diubah');
            redirect('barang');
        }
    }

    public function save()
    {
        $input = $this->input->post();

        $args = [
            'kode_brg'      => strtoupper($input['kode_brg']),
            'nama_brg'      => $input['nama_brg'],
            'qty'           => $input['qty'],
            'harga_jual'    => idrToString($input['harga_jual']),
            'harga_beli'    => idrToString($input['harga_beli'])
        ];

        if (sizeof($input['grosir']) > 0) {
            $i = 0;
            foreach ($input['grosir']['harga_jual_grosir'] as $harga_grosir) {
                $input['grosir']['harga_jual_grosir'][$i] = idrToString($harga_grosir);
                $i++;
            }
            $args['grosir'] = json_encode($input['grosir']);
        }

        $save = $this->barang_model->insert($args);
        if ($save) {
            $this->session->set_flashdata('notification', 'Data Barang berhasil disimpan');
            redirect('barang');
        } else {
            $this->session->set_flashdata('error_notification', 'Data Barang gagal disimpan');
            redirect('barang');
        }
    }
}
