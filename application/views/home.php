<html>
<head>
<meta charset ="utf-8">
<title><?= $title; ?></title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script type="text/javascript" src="<?= base_url().'assets/js/jquery.min.js' ?>"></script>
</head>
<body>

<div class="container">
    <h1>Data Barang</h1>
</div>
<a href="#form" data-toggle="modal" class="btn btn-primary" onclick="submit('tambah')">Tambah Data</a>
<table class="table">
    <thead class="text-align:center">
        <tr>
            <th>No </th>
            <th>Kode Barang </th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody id="targetData">
       
    </tbody>
</table>
    <div class="modal fade" id="form" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>data barang</h1>
                </div>
               <center style="color:red"> <p id="pesan"></p></center>
                <table class="table">
                    <tr>
                        <td>kode barang</td>
                        <td><input type="text" name="kode_barang" placeholder="Isikan Kode barang" class="form-control"></td>
                        <input type="hidden" name="id" value="">
                    </tr>
                    <tr>
                        <td>Nama barang</td>
                        <td><input type="text" name="nama_barang" placeholder="Isikan Nama barang" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Harga barang</td>
                        <td><input type="number" name="harga" placeholder="Isikan Harga barang" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Stok barang</td>
                        <td><input type="number" name="stok" placeholder="Isikan Stok barang" class="form-control"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button id="btn-tambah" onclick="tambahData()" class="btn btn-primary"  >Tambah</button>
                            <button id="btn-ubah" onclick="ubahData()" class="btn btn-primary"  >Ubah</button>
                            <button data-dismiss="modal" class="btn btn-warning">Cancel</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
<script>
    ambilData();
    function ambilData(){
        $.ajax({
            type:'post',
            url:'<?= base_url()."page/ambildata"?>',
            dataType:'json',
            success:function(data){
               var baris = '';
                    for (var i = 0; i < data.length; i++) {
                        baris += '<tr>'+
                                        '<td>' + data[i].id + '</td>'+
                                        '<td>' + data[i].kode_barang + '</td>'+
                                        '<td>' + data[i].nama_barang + '</td>'+
                                        '<td>' + data[i].harga + '</td>'+
                                        '<td>' + data[i].stok + '</td>'+
                                        '<td> <a href="#form" data-toggle="modal" class="btn btn-primary" onclick="submit('+data[i].id+')">Ubah </a> </td>'+
                                        '<td> <a class="btn btn-danger" onclick="hapusdata('+data[i].id+')">Hapus </a> </td>'+
                                    '</tr>';  
                        
                    }
                    $('#targetData').html(baris);
            }
        });
    }
    function tambahData(){
        clearform();
        var kodeBarang = $("[name='kode_barang']").val();
        var namaBarang = $("[name='nama_barang']").val();
        var harga = $("[name='harga']").val();
        var stok = $("[name='stok']").val();

        $.ajax({
            type:'post',
            data: 'kode_barang='+kodeBarang+'&nama_barang='+namaBarang+'&harga='+harga+'&stok='+stok,
            url:'<?= base_url().'page/tambahdata' ?>',
            dataType: 'json',
            success:function(hasil){
                $('#pesan').html(hasil.pesan);

                if (hasil.pesan=='') {
                    $('#form').modal('hide');
                    ambilData();
                    clearform();
                }
            }
        });
    }

    function submit(x) {
        if (x=="tambah") {
            $("#btn-tambah").show();
            $("#btn-ubah").hide();
            
        }else{
            $("#btn-tambah").hide();
            $("#btn-ubah").show();

            $.ajax({
                type:"post",
                data: 'id='+x,
                url: "<?= base_url().'page/ambilId' ?>",
                dataType: 'json',
                success:function(hasil){
                    $("[name='id']").val(hasil[0].id);
                    $("[name='kode_barang']").val(hasil[0].kode_barang);
                    $("[name='nama_barang']").val(hasil[0].nama_barang);
                    $("[name='harga']").val(hasil[0].harga);
                    $("[name='stok']").val(hasil[0].stok);
                }

            });
        }
    }

    function ubahData() {
        var id = $("[name='id']").val();
        var kodeBarang = $("[name='kode_barang']").val();
        var namaBarang = $("[name='nama_barang']").val();
        var harga = $("[name='harga']").val();
        var stok = $("[name='stok']").val();

        $.ajax({
            type:'post',
            data: 'id='+id+'&kode_barang='+kodeBarang+'&nama_barang='+namaBarang+'&harga='+harga+'&stok='+stok,
            url:'<?= base_url()."page/ubahdata"?>',
            dataType: 'json',
            success:function(hasil){
                $('#pesan').html(hasil.pesan);
                $('#form').modal('hide');
                ambilData();
            }
        });
    }
    
    function hapusdata(x) {
        var tanya = confirm('Apakah anda yakin hapus data?');
        if (tanya) {
            $.ajax({
                type:"post",
                data: 'id='+x,
                url: "<?= base_url().'page/hapusdata' ?>",
                success:function(){
                    ambilData();
                }
            });
        }
       
    }

    function clearform() {
        $("[name='kode_barang']").val('');
                    $("[name='nama_barang']").val('');
                    $("[name='harga']").val('');
                    $("[name='stok']").val('');
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>