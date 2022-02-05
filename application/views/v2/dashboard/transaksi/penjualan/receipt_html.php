<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" type="image/x-icon" href="https://static.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" />
        <link rel="mask-icon" type="" href="https://static.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <title>Receipt</title>
        <style>
            @media print {
                .page-break {
                    display: block;
                    page-break-before: always;
                }
                body, html {
                    margin-top:0px;
                    padding-top:0px;
                }
            }

            @page { size: auto;  margin: 0mm; }

            #invoice-POS {
                padding: 2mm;
                margin: 0 auto;
                width: 58mm;
                padding-right: 50px;
                font-family: 'Roboto', sans-serif;
            }

            #invoice-POS ::selection {
                background: #f31544;
                color: #000;
            }

            #invoice-POS ::moz-selection {
                background: #f31544;
                color: #000;
            }

            #invoice-POS h1 {
                font-size: 1.5em;
                color: #000;
            }

            #invoice-POS h2 {
                font-size: .9em;
            }

            #invoice-POS h3 {
                font-size: 1.2em;
                font-weight: 300;
                line-height: 2em;
            }

            #invoice-POS p {
                font-size: .7em;
                color: #000;
                line-height: 1.2em;
            }

            #invoice-POS #top,
            #invoice-POS #mid,
            #invoice-POS #bot {
                /* Targets all id with 'col-' */
                border-bottom: 1px solid #000;
            }

            #invoice-POS #top {
                min-height: 100px;
            }

            #invoice-POS #mid {
                margin-top: 5px;
                min-height: 45px;
            }

            #invoice-POS #bot {
                min-height: 50px;
            }

            #invoice-POS #top .logo {
                height: 60px;
                width: 60px;
                background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
                background-size: 60px 60px;
            }

            #invoice-POS .clientlogo {
                float: left;
                height: 60px;
                width: 60px;
                background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
                background-size: 60px 60px;
                border-radius: 50px;
            }

            #invoice-POS .info {
                display: block;
                margin-left: 0;
                line-height: 30px;
                font-weight: bold;
                font-size: 20px;
            }

            #invoice-POS .info p, #invoice-POS .info h5 {
                margin: 0px;
            }

            #invoice-POS .title {
                float: right;
            }

            #invoice-POS .title p {
                text-align: right;
            }

            #invoice-POS table {
                width: 100%;
                border-collapse: collapse;
                line-height: 0px;
            }

            #invoice-POS .tabletitle {
                font-size: 14px;
                background: #EEE;
            }

            #invoice-POS .amounttitle {
                font-size: 12px;
                background: #EEE;
            }

            #invoice-POS .service {
                border-bottom: 1px solid #EEE;
            }

            #invoice-POS .item {
                width: 24mm;
            }

            #invoice-POS #table {
                width: 230px;
            }

            #invoice-POS .label-amount {
                text-align: right;
                padding-right: 10px;
            }

            #invoice-POS .itemtext {
                font-size: 12px;
                font-weight: bold;
            }

            #invoice-POS #legalcopy {
                margin-top: 5mm;
                margin-bottom: 5mm;
                font-weight: bold;
            }

            #invoice-POS .legal {
                font-size: 12px;
            }
        </style>
        <script>
            window.console = window.console || function(t) {};
        </script>
        <script>
            if (document.location.search.match(/type=embed/gi)) {
                window.parent.postMessage("resize", "*");
            }
        </script>
    </head>
    <body translate="no">
        <div id="invoice-POS">
            <center id="top">
                <!-- <div class="logo"></div> -->
                <div class="info">
                    <h1>TOKO LUSINAN</h1>
                    <p>Desa Santing Blok Portal Muntur</p>
                    <p>Kecamatan Losarang - 45253</p>
                    <p>Kabupaten Indramayu</p>
                </div>
                <!--End Info-->
            </center>
            <!--End InvoiceTop-->
            <div id="mid">
                <div class="info">
                    <p> No Nota : <?php echo $no_nota; ?> </br> Tanggal : <?php echo date('d-M-Y H:i:s',strtotime($tanggal)); ?> </br> Kasir : <?php echo $kasir; ?> </br>
                    </p>
                </div>
            </div>
            <!--End Invoice Mid-->
            <div id="bot">
                <div id="table">
                    <table>
                        <tr class="tabletitle">
                            <td class="item">
                                <h2>Item</h2>
                            </td>
                            <td class="Hours">
                                <h2>Qty</h2>
                            </td>
                            <td class="Rate">
                                <h2>Harga</h2>
                            </td>
                            <td class="Rate">
                                <h2>Sub Total</h2>
                            </td>
                        </tr>
                        <?php foreach($orders as $order) { ?>
                        <tr class="service">
                            <td class="tableitem">
                                <p class="itemtext"><?php echo $order->nama_brg; ?></p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext"><?php echo $order->qty; ?></p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext"><?php echo nominal_format($order->harga); ?></p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext"><?php echo nominal_format($order->sub_total); ?></p>
                            </td>
                        </tr>
                        <?php } ?>
                        <tr class="amounttitle">
                            <td class="Rate label-amount" colspan="2">
                                <h2>Sub Total</h2>
                            </td>
                            <td class="payment" colspan="3">
                                <h2><?php echo $sub_total; ?></h2>
                            </td>
                        </tr>
                        <tr class="amounttitle">
                            <td class="Rate label-amount" colspan="2">
                                <h2>Disc</h2>
                            </td>
                            <td class="payment" colspan="3">
                                <h2><?php echo $discount; ?></h2>
                            </td>
                        </tr>
                        <tr class="amounttitle">
                            <td class="Rate label-amount" colspan="2">
                                <h2>Total</h2>
                            </td>
                            <td class="payment" colspan="3">
                                <h2><?php echo $total; ?></h2>
                            </td>
                        </tr>
                        <tr class="amounttitle">
                            <td class="Rate label-amount" colspan="2">
                                <h2>Bayar</h2>
                            </td>
                            <td class="payment" colspan="3">
                                <h2><?php echo $bayar; ?></h2>
                            </td>
                        </tr>
                        <tr class="amounttitle">
                            <td class="Rate label-amount" colspan="2">
                                <h2>Kembali</h2>
                            </td>
                            <td class="payment" colspan="3">
                                <h2><?php echo $kembali; ?></h2>
                            </td>
                        </tr>
                    </table>
                </div>
                <!--End Table-->
                <div id="legalcopy">
                    <strong>* Barang yang sudah dibeli tidak dapat ditukar.</strong>
                    <center>
                        <strong>** Terimakasih **</strong>
                        <p class="legal">
                            Sudah berbelanja
                            <br>
                            Di Toko Lusinan
                            <br>
                            <b>** Contact Person **</b>
                            <br>
                            WA: +6281808992614
                            <br>
                            FB: Grosir Lusinan (Toko Lusinan)
                            <br>
                        </p>
                    </center>
                    <br>
                </div>
            </div>
            <!--End InvoiceBot-->
        </div>
        <!--End Invoice-->
    </body>
</html>