<select class="form-control select2" name="kode_jenis" id="select-jenis">
     <option>- PILIH JENIS -</option>
     <?php foreach ($all_jenis as $jenis) : ?>
         <option value="<?php echo $jenis->kode_jenis; ?>"><?php echo $jenis->jenis; ?></option>
     <?php endforeach; ?>
 </select>