<?php 
$this->load->view('admin/head');
?>
<!--tambahkan custom css disini-->

<?php
$this->load->view('admin/topbar');
$this->load->view('admin/sidebar');
?>

<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- Tampilan untuk alert -->
            

            <?php foreach($soal as $s)  { ?>
            <!-- TUTUP Tampilan untuk alert -->
            <div class="box box-success" style="overflow-x: scroll;">
                <form action="<?=base_url('soal_ujian/update');?>" method="post" enctype="multipart/form-data">
                <div class="box-header">
                   <center><h4 class="box-title">Edit Data</h4></center><p>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div  class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Materi</label>
                            <input type="hidden" name="id" value="<?=$s->id_soal_ujian?>">
                            <div class="col-sm-10">
                                <select class="select2 form-control" name="nama_materi" required="">
                                    <option selected="selected" disabled="">- Pilih Materi -</option>
                                    <?php foreach($kelas as $a) { ?>
                                      <option value="<?=$a->id_materi?>" <?php if($s->nama_materi==$a->nama_materi){echo "selected='selected'";} ?>><?= $a->kode_materi;?> | <?= $a->nama_materi;?></option>
                                  <?php } ?>
                                </select>
                                
                            </div>
                        </div>
                       <div class="form-group">
                            <label class="col-sm-2 control-label">Tulis Soal Ujian</label>
                            <div class="col-sm-10">
                                <textarea name="pertanyaan" class="soal" required><?= $s->pertanyaan;?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                                <label class="col-sm-2 control-label" for="image">Upload Image</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="image">
                                </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tulis Soal Ujian</label>
                            <div class="col-sm-10">
                                <textarea name="pertanyaan_2" class="soal"><?= $s->pertanyaan_2;?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                                <label class="col-sm-2 control-label">Indikator Pencapaian Kompetensi</label>
                                <div class="col-sm-10">
                                    <textarea  class="pertanyaan" name="IPK" rows="10" cols="80" required><?= $s->IPK; ?></textarea>
                                </div>
                            </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jawaban A</label>
                            <div class="col-sm-10">
                                <textarea class="soal" rows="2" style="width: 100%" name="a" required><?= $s->a;?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                                <label class="col-sm-2 control-label" for="image_a">Upload Image A</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="image_a">
                                </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jawaban B</label>
                            <div class="col-sm-10">
                                <textarea class="soal" rows="2" style="width: 100%" name="b" required><?= $s->b;?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                                <label class="col-sm-2 control-label" for="image_b">Upload Image B</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="image_b">
                                </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jawaban C</label>
                            <div class="col-sm-10">
                                <textarea class="soal" rows="2" style="width: 100%" name="c" required><?= $s->c;?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                                <label class="col-sm-2 control-label" for="image_c">Upload Image C</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="image_c">
                                </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jawaban D</label>
                            <div class="col-sm-10">
                                <textarea class="soal" rows="2" style="width: 100%" name="d" required><?= $s->d;?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                                <label class="col-sm-2 control-label" for="image_d">Upload Image D</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="image_d">
                                </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jawaban E</label>
                            <div class="col-sm-10">
                                <textarea class="soal" rows="2" style="width: 100%" name="e" required><?= $s->e;?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                                <label class="col-sm-2 control-label" for="image_e">Upload Image E</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="image_e">
                                </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kunci Jawaban</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="kunci_jawaban">
                                    <option <?php if($s->kunci_jawaban=='A'){echo "selected='selected'";} ?>>A</option>
                                    <option <?php if($s->kunci_jawaban=='B'){echo "selected='selected'";} ?>>B</option>
                                    <option <?php if($s->kunci_jawaban=='C'){echo "selected='selected'";} ?>>C</option>
                                    <option <?php if($s->kunci_jawaban=='D'){echo "selected='selected'";} ?>>D</option>
                                    <option <?php if($s->kunci_jawaban=='E'){echo "selected='selected'";} ?>>E</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Alasan 1</label>
                            <div class="col-sm-10">
                                <textarea class="soal" rows="2" style="width: 100%" name="alasan_1" required><?= $s->alasan_1;?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Alasan 2</label>
                            <div class="col-sm-10">
                                <textarea class="soal" rows="2" style="width: 100%" name="alasan_2" required><?= $s->alasan_2;?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Alasan 3</label>
                            <div class="col-sm-10">
                                <textarea class="soal" rows="2" style="width: 100%" name="alasan_3" required><?= $s->alasan_3;?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Alasan 4</label>
                            <div class="col-sm-10">
                                <textarea class="soal" rows="2" style="width: 100%" name="alasan_4" required><?= $s->alasan_4;?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Alasan 5</label>
                            <div class="col-sm-10">
                                <textarea class="soal" rows="2" style="width: 100%" name="alasan_5" required><?= $s->alasan_5;?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Kunci Alasan</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="kunci_alasan">
                                    <option <?php if($s->kunci_alasan=='alasan_1'){echo "selected='selected'";} ?>>alasan_1</option>
                                    <option <?php if($s->kunci_alasan=='alasan_2'){echo "selected='selected'";} ?>>alasan_2</option>
                                    <option <?php if($s->kunci_alasan=='alasan_3'){echo "selected='selected'";} ?>>alasan_3</option>
                                    <option <?php if($s->kunci_alasan=='alasan_4'){echo "selected='selected'";} ?>>alasan_4</option>
                                    <option <?php if($s->kunci_alasan=='alasan_5'){echo "selected='selected'";} ?>>alasan_5</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tulis Pembahasan</label>
                            <div class="col-sm-10">
                                <textarea name="pembahasan" class="soal" required><?= $s->pembahasan;?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                                <label class="col-sm-2 control-label" for="image">Upload Image</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="image_pembahasan">
                                </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tulis Pembahasan</label>
                            <div class="col-sm-10">
                                <textarea name="pembahasan_2" class="soal" required><?= $s->pembahasan_2;?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <button type="button" class="btn btn-default btn-flat" onclick="return history.go(-1)" title="Kembali ke halaman sebelumnya"><span class="fa fa-arrow-left"></span> Kembali</button>
                                <button type="submit" class="btn btn-primary btn-flat" title="Tambah Data Soal Ujian"><span class="fa fa-save"></span> Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-footer -->
                <div class="box-footer">
                    
                </div>
                </form>
            </div>
            <?php } ?>
        </div>
        <!-- /.col-->
    </div>
    <!-- ./row -->
</section><!-- /.content -->
  
<?php 
$this->load->view('admin/js');
?>

<!--tambahkan custom js disini-->

<script type="text/javascript">

	$(function(){
		$('#data-tables').dataTable();
	});
    $('.select2').select2();
	$('.alert-message').alert().delay(3000).slideUp('slow');

</script>


<?php
$this->load->view('admin/foot');
?>

