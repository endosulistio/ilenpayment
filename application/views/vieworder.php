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
            <div class="pb-3">
                <dt>Harga DM ML</dt>
                Rp.<?=$hargadm?>
            </div>
            <div class="pb-3">
                <dt>Total Transfer Pulsa</dt>
                <?=$ilenpay->total_tf?> (<?=$ilenpay->operator?>)
            </div>
            <div class="pb-3 border-bottom">
                <dt>Reff ID</dt>
                <?=$refid?>
            </div>
            <div class="pt-2">
                <div class="row justify-content-start">
                    <div class="col-4">
                        <form action="<?=base_url('pesanan/payment/redirect')?>" method="POST"><input type="hidden" name="payment" value="<?=$ilenpay->operator?>"><input type="hidden" name="nominal" value="<?=$hargadm?>"><input type="hidden" name="ref_id" value="<?=$refid?>"><button type="submit" class="btn btn-primary">Payment Redirect</button></form>
                    </div>
                    <div class="col-4">
                        <form action="<?=base_url('pesanan/payment/direct')?>" method="POST"><input type="hidden" name="payment" value="<?=$ilenpay->operator?>"><input type="hidden" name="nominal" value="<?=$hargadm?>"><input type="hidden" name="ref_id" value="<?=$refid?>"><button type="submit" class="btn btn-primary">Payment Direct</button></form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>