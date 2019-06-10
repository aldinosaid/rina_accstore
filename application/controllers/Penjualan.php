<?php


/**
*
*/
class Penjualan extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model(['kategori_model', 'barang_model', 'penjualan_model']);
        if (!is_logged_in()) {
            redirect('login/admin');
        }
    }


    public function index()
    {
        $data['barang'] = $this->barang_model->getAll();
        $data['keranjang'] = $this->penjualan_model->getAll();
        $data['total']  = $this->penjualan_model->count();
        $this->load->view('dashboard/penjualan/header');
        $this->load->view('dashboard/penjualan/view', $data);
        $this->load->view('dashboard/penjualan/footer');
    }

    public function count()
    {
        $count = $this->penjualan_model->count();
        $data = [
            'total_original' => $count[0]->total,
            'total' => idr_format($count[0]->total)
        ];

        echo json_encode($data);
    }

    private function checkItem($barcode)
    {
        $data = [
            'barcode' => $barcode
        ];

        $brg = $this->penjualan_model->getItemByBarcode($data);

        return $brg;
    }

    public function add()
    {
        $input = $this->input->post();
        $html = '';
        $barang = $this->penjualan_model->getBarangByBarcode($input['barcode']);
        $data = [
            'kode_brg'      => $barang[0]->kode_brg,
            'qty'           => $input['qty'],
            'harga_jual'    => idrToString($input['harga']),
            'harga_beli'    => $barang[0]->harga_beli
        ];

        $isAlreadyItem = $this->checkItem($input['barcode']);
        if ($isAlreadyItem) {
            $data['qty'] = (int)$input['qty']+(int)$isAlreadyItem[0]->qty;
            $where['barcode'] = $input['barcode'];
            if ($barang[0]->qty >= $data['qty']) {
                $query = $this->penjualan_model->updateKeranjang($data, $where);
            } else {
                $query = true;
            }
        } else {
            $data['barcode'] = $input['barcode'];
            $query = $this->penjualan_model->addKeranjang($data);
        }

        if ($query) {
            $keranjang = $this->penjualan_model->getAll();
            $i = 1;
            foreach ($keranjang as $value) {
                $html .= '<tr>'
                        . '<td>' . $i . '</td>'
                        . '<td>' . $value->kode_brg . '</td>'
                        . '<td>' . $value->nama_brg . '</td>'
                        . '<td>' . $value->qty . '</td>'
                        . '<td>' . idr_format($value->harga) . '</td>'
                        . '<td>
							<a href="' . base_url('penjualan/hapus/' . $value->kode_brg) .'" class="remove" kode_brg="' . $value->kode_brg . '"><i class="fa fa-remove"></i></a>'
                        . '</tr>';
                $i++;
            }
        }

        echo $html;
    }

    public function hapus($kode_brg)
    {
        $delete = $this->penjualan_model->hapusBrg($kode_brg);
        if ($delete) {
            $this->session->set_flashdata('notification', 'Hapus barang success');
        } else {
            $this->session->set_flashdata('error_notification', 'Hapus barang gagal');
        }

        redirect(base_url('penjualan'));
    }

    public function jumlah()
    {
        $input = $this->input->post();
        $total = idrToString($input['total']);
        $bayar = idrToString($input['bayar']);
        $jumlah = (int)$bayar-(int)$total;
        $kembali = idr_format($jumlah);

        echo $kembali;
    }

    private function no_nota()
    {
        $data = [
            'no_nota' => str_ireplace('-', '', date('d-m-y'))
        ];

        $maxId = $this->penjualan_model->getMaxNota($data);

        if (isset($maxId[0]->no_nota)) {
            $maxId = (int)$maxId[0]->no_nota;
            $maxId++;
            $kodeBaru = str_ireplace('-', '', date('d-m-y')) . sprintf("%04s", $maxId);

            $result =  $kodeBaru;
        } else {
            $result = str_ireplace('-', '', date('d-m-y')) . '0001';
        }

        return $result;
    }

    public function bersihkan()
    {
        $this->penjualan_model->clearKeranjang();
        redirect(base_url('penjualan'));
    }

    public function cetak()
    {
        $total = $this->input->post('total');
        $bayar = $this->input->post('bayar');
        $kembali = $this->input->post('kembali');
        $date   = date('Y-m-d H:i:s');
        $no_nota = (string)$this->no_nota();

        $dataNota = [
            'no_nota'   => $no_nota,
            'tanggal'   => $date,
            'total'     => idrToString($total),
            'bayar'     => idrToString($bayar),
            'kembali'   => idrToString($kembali)
        ];

        $save_nota = $this->penjualan_model->createNota($dataNota);
        if ($save_nota) {
            $this->penjualan_model->saveDet((string)$no_nota);
        }

        $dataNota['orders'] = $this->penjualan_model->getDetOrders($no_nota);
        $dataNota['kasir']  = $this->session->userdata('username');

        if (do_print($dataNota)) {
            $this->penjualan_model->clearKeranjang();
            echo "success";
        } else {
            echo "error";
        }
    }
}
