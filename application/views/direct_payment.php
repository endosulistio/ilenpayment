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

        <?php
            $pesanan = $this->session->userdata['order_sess'];
        ?>

        <div class="p-5">
            <form method="POST">
            <?php echo validation_errors()?>
            <?php if($this->session->flashdata('error_message') !=''){
                echo'<div class="alert alert-danger" role="alert">'.$this->session->flashdata('error_message').'</div>';
            }?>
                <div id="cek_update"></div>
                <div class="mb-3">
                    <label for="aidi" class="form-label">Pengirim Pulsa</label>
                    <input name="sender" type="text" class="form-control" placeholder="081298xxxxxx">
                </div>
                <div class="mb-3">
                    <p><?=$pesanan['tutor'] ?? ''?></p>
                </div>
                <button type="submit" class="btn btn-primary">Cek Pembayaran</button>
            </form>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            refreshHistory();
            function refreshHistory() {
                $.get("<?=base_url('pesanan/cek_update/'.$this->uri->segment(3))?>", function(data) {
                    $("#cek_update").html(data);
                });
              }
            setInterval(refreshHistory, 5000);
        </script>
    
    </body>
</html>