<!doctype html>
<html lang="id">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>html { background: #e9e9e9 repeat 0 0; }body { max-width: 750px; position: relative; background: white center center fixed; margin: auto; margin-top: 10px; cursor: auto;font-size: 16px; }</style>
        <title>Hello, world!</title>
    </head>
    <body>
        <div class="p-5">
            <form action="<?=base_url('pesanan/vieworder')?>" method="POST">
            <?php if($this->session->flashdata('error_message') !=''){
                echo'<div class="alert alert-danger" role="alert">'.$this->session->flashdata('error_message').'</div>';
            }?>
                <div class="mb-3">
                    <label for="produk" class="form-label">Produk</label>
                    <select name="produk" class="form-select" aria-label="Default select example">
                        <option selected>Pilih</option>
                        <option value="LM86">MOBILELEGEND - 86 Diamond (Rp.24.500)</option>
                        <option value="ML112">MOBILELEGEND - 112 Diamond (Rp.31.100)</option>
                        <option value="ML85">MOBILELEGEND - 85 Diamond (Rp.24.780)</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="aidi" class="form-label">ID Game</label>
                    <input name="userid" type="text" class="form-control" placeholder="01201222121">
                    <div id="emailHelp" class="form-text"> gabungan antara user_id dan zone_id. </div>
                    
                </div>
                <div class="mb-3">
                    <label for="pay" class="form-label">Pembayaran</label>
                    <select name="payment" class="form-select" aria-label="Default select example">
                        <option selected>Pilih</option>
                        <option value="telkomsel">Pulsa Telkomsel</option>
                        <option value="xl">Pulsa Xl/Axis</option>
                        <option value="tri">Pulsa TRI</option>
                        <option value="smartfren">Pulsa Smartfren</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Payment</button>
            </form>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>