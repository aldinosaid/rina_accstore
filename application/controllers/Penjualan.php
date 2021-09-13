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
        $data['tanggal'] =  date('Y-m-d');
        $data['username'] = $this->session->userdata('username');
        $data['no_nota'] = (string)$this->no_nota();
        $data['sub_total'] = idr_format(0);
        $data['total'] = idr_format(0);
        $count = $this->penjualan_model->count();
        if (!is_null($count[0]->sub_total)) {
            $data['sub_total'] = idr_format($count[0]->sub_total);
            $data['total'] = idr_format($count[0]->sub_total);
        }
        $data['required_style'] = [
            'plugins/daterangepicker/daterangepicker.css',
            'plugins/datatables-responsive/css/responsive.bootstrap4.min.css',
            'plugins/datatables-buttons/css/buttons.bootstrap4.min.css',
            'plugins/fontawesome-free/css/all.min.css',
            'dist/css/adminlte.min.css',
            'plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
            'plugins/toastr/toastr.min.css'
        ];
        $data['required_js'] = [
                'plugins/jquery/jquery.min.js',
                'plugins/bootstrap/js/bootstrap.bundle.min.js',
                'plugins/datatables/jquery.dataTables.min.js',
                'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables-responsive/js/dataTables.responsive.min.js',
                'plugins/datatables-responsive/js/responsive.bootstrap4.min.js',
                'plugins/datatables-buttons/js/dataTables.buttons.min.js',
                'plugins/datatables-buttons/js/buttons.bootstrap4.min.js',
                'plugins/jszip/jszip.min.js',
                'plugins/pdfmake/pdfmake.min.js',
                'plugins/pdfmake/vfs_fonts.js',
                'plugins/datatables-buttons/js/buttons.html5.min.js',
                'plugins/datatables-buttons/js/buttons.print.min.js',
                'plugins/datatables-buttons/js/buttons.colVis.min.js',
                'dist/js/adminlte.min.js',
                'dist/js/demo.js',
                'plugins/inputmask/jquery.inputmask.min.js',
                'plugins/moment/moment.min.js',
                'plugins/daterangepicker/daterangepicker.js',
                'plugins/sweetalert2/sweetalert2.min.js',
                'plugins/toastr/toastr.min.js'
           ];
        $this->load->view('v2/dashboard/transaksi/penjualan/header', $data);
        $this->load->view('v2/dashboard/transaksi/penjualan/content', $data);
        $this->load->view('v2/dashboard/transaksi/penjualan/footer', $data);
    }

    public function count()
    {
        $count = $this->penjualan_model->count();
        $amount = $count[0]->sub_total;
        $data = [
            'total_original' => $amount,
            'sub_total' => idr_format($amount),
            'total' => idr_format($amount)
        ];

        echo json_encode($data);
    }

    private function checkItem($kode_brg)
    {
        $data = [
            'kode_brg'  => $kode_brg,
            'user_id'   => $this->session->userdata('user_id')
        ];

        $brg = $this->penjualan_model->getItemByKodeBrg($data);

        return $brg;
    }

    public function add()
    {
        $input = $this->input->post();
        $kode_brg = $input['kode_brg'];
        $qty = $input['qty'];
        $barang = $this->penjualan_model->getBarangByKodeBrg($kode_brg);
        $harga_jual = $this->get_grosir_amount($barang, $qty);

        $data = [
            'kode_brg'      => $kode_brg,
            'qty'           => $qty,
            'harga_jual'    => $harga_jual,
            'harga_beli'    => $barang[0]->harga_beli,
            'user_id'       => $this->session->userdata('user_id')
        ];

        $isAlreadyItem = $this->checkItem($kode_brg);
        if ($isAlreadyItem) {
            $data['qty'] = (int)$input['qty']+(int)$isAlreadyItem[0]->qty;
            $where['kode_brg'] = $input['kode_brg'];
            $where['user_id'] = $this->session->userdata('user_id');
            $data['harga_jual'] = $this->get_grosir_amount($barang, $data['qty']);
            if ($barang[0]->stok_toko >= $data['qty']) {
                $query = $this->penjualan_model->updateKeranjang($data, $where);
            } else {
                $result['error_message'] = 'Data Qty transaksi melebihi Qty stok yang tersedia.';
                $query = false;
            }
        } else {
            $data['kode_brg'] = $input['kode_brg'];
            if ($barang[0]->stok_toko < $data['qty'] && $barang[0]->stok_toko <> 0) {
                $query = false;
                $result['error_message'] = 'Data Qty transaksi melebihi Qty stok yang tersedia.';
            } elseif ($barang[0]->stok_toko > 0) {
                $query = $this->penjualan_model->addKeranjang($data);
            } else {
                $result['error_message'] = 'Data stok toko 0 silahkan hubungi owner untuk menambahkan stok baru.';
                $query = false;
            }
        }

        if ($query) {
            $keranjang = [
                'keranjang' => $this->penjualan_model->getAll()
            ];
            $count = $this->penjualan_model->count();
            $result = [
                'is_error' => false,
                'total_original' => $count[0]->sub_total,
                'sub_total' => idr_format($count[0]->sub_total),
                'total' => idr_format($count[0]->sub_total),
                'html' => $this->load->view('v2/dashboard/transaksi/penjualan/ajax_table_keranjang', $keranjang, true)
            ];
        } else {
            $result['is_error'] = true;
        }

        echo json_encode($result);
    }

    protected function get_grosir_amount($barang, int $qty) {
        $barang = $barang[0];
        $grosir_data = json_decode($barang->grosir);
        $harga = 0;
        if (is_array($grosir_data->min)) {
            if(sizeof($grosir_data->min)) {
                for ($i=sizeof($grosir_data->min); $i > 0 ; $i--) { 
                    $index = $i-1;
                    $min_qty = (int)$grosir_data->min[$index];
                    if ($qty >= $min_qty) {
                        $harga = $grosir_data->harga_jual_grosir[$index];
                        break;
                    } else {
                        $harga = $barang->harga_jual;
                    }
                }
            }
        }

        return $harga;
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
        $kembali = $jumlah;

        echo json_encode(['kembali' => $kembali]);
    }

    private function no_nota()
    {
        $user_id = $this->session->userdata('user_id');
        $data = [
            'no_nota' => $user_id . str_ireplace('-', '', date('d-m-y'))
        ];

        $maxId = $this->penjualan_model->getMaxNota($data);

        if (isset($maxId[0]->no_nota)) {
            $maxId = (int)$maxId[0]->no_nota;
            $maxId++;
            $kodeBaru = $user_id . str_ireplace('-', '', date('d-m-y')) . sprintf("%04s", $maxId);

            $result =  $kodeBaru;
        } else {
            $result = $user_id . str_ireplace('-', '', date('d-m-y')) . '0001';
        }

        return $result;
    }

    public function bersihkan()
    {
        $this->penjualan_model->clearKeranjang();
        redirect(base_url('penjualan'));
    }

    public function generate_receipt_html()
    {
        $total = $this->input->post('total');
        $bayar = $this->input->post('bayar');
        $kembali = $this->input->post('kembali');
        $date   = date('Y-m-d H:i:s');
        $no_nota = $this->input->post('no_nota');
        $sub_total = $this->input->post('sub_total');
        $discount = $this->input->post('discount');

        $dataNota = [
            'no_nota'   => $no_nota,
            'tanggal'   => $date,
            'total'     => $total,
            'bayar'     => $bayar,
            'kembali'   => $kembali,
            'sub_total' => $sub_total,
            'discount'  => $discount
        ];

        $dataQuery = [
            'no_nota'   => $no_nota,
            'tanggal'   => $date,
            'total'     => idrToString($total),
            'bayar'     => idrToString($bayar),
            'kembali'   => idrToString($kembali),
            'sub_total' => idrToString($sub_total),
            'discount'  => idrToString($discount)
        ];

        $save_nota = $this->penjualan_model->createNota($dataQuery);
        if ($save_nota) {
            $this->penjualan_model->saveDet((string)$no_nota);
        }

        $dataNota['orders'] = $this->penjualan_model->getAll();
        $dataNota['kasir']  = $this->session->userdata('username');

        $this->penjualan_model->clearKeranjang();

        $data = [
            'receipt_html' => $this->load->view('v2/dashboard/transaksi/penjualan/receipt_html', $dataNota, true)
        ];

        echo json_encode($data);
    }
}
