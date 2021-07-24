<html><head>
    <title>Report Table</title>
    <style type="text/css">
        @page {
            margin: 0px;
            padding: 0px;
        }
        body  {
            margin: 0;
            padding: 0;
        }
        .container {
            font-family: monospace;
            color: black;
            font-weight: bold;
            max-width: 203px;
            word-wrap: break-word;
            text-transform: uppercase;
            line-height: 0.9em;
        }
        .text-center {
            text-align: center;
        }
        .small  {
            font-size: 10px;
        }

        .big {
            font-size: large;
        }

        .medium {
            font-size: 12px;
        }
        .pull-left {
            text-align: left;
            float: left !important;
        }
        .pull-right {
            text-align: right;
            float: right !important;
        }
        .item {
            display: block;
        }
    </style>
</head><body>
    <div class="container">
        <div class="header text-center">
            <label class="medium"><b>Rina Accessories Store</b></label>
            <br>
            <label class="small">Ds. Puntang Blok sarban Rt 11 / Rw 03 Kec. Losarang Kab. Indramayu</label>
            <br>
            <label class="small pull-left">No Nota : <?php echo $no_nota; ?></label>
            <br>
            <label class="small pull-left">tgl : <?php echo $tanggal; ?></label>
            <br>
            <label class="small pull-left">Kasir : <?php echo $kasir; ?></label>
            <br>
            <label class="medium">=========================</label>
        </div>
        <div class="content">
            <?php
            foreach ($orders as $order) :
            ?>
            <div class="item">
            <label class="small"><?php echo $order->nama_brg; ?></label>
                <br>
            <label class="small pull-left"><?php echo idr_format($order->harga); ?> </label><label class="small pull-right"> <?php echo $order->qty; ?> x = <?php echo idr_format($order->sub_total); ?></label>
                <br>
            </div>
            <br>
            <?php                                                                                                                                                                                                                                                                                                                             endforeach; ?>
            <label class="medium">=========================</label>
        </div>
        <div class="total">
            <label class="small pull-right"> Total <?php echo idr_format((int)$total); ?></label>
            <br>
            <label class="small pull-right"> Disc 0%</label>
            <br>
            <label class="small pull-right"> Bayar <?php echo idr_format((int)$bayar); ?></label>
            <br>
            <label class="small pull-right"> Kembali <?php echo idr_format((int)$kembali); ?></label>
            <br>
        </div>
        <div class="footer text-center">
            <label class="small">** Terimakasih ** </label>
            <br>
            <label>Sudah Berbelanja</label>
            <br>
            <label class="small"> di Rina AccStore</label>
            <br>
            <label class="small">WA : 08972162264</label>
            <br>
            <label class="small">Fb : Rina AccStore</label>
            <br>
            <label class="small">*******</label>
            <br>
        </div>
    </div>
</body></html>
