<!DOCTYPE HTML>  
 <html>  
 <head>  
      <title>Buku Tamu Dengan Mencatat IP Pengguna</title>  
 </head>  
 <body>  
 <h2>Form Pengisian Buku Tamu</h2>  
 <hr>  
 <form action="index.php" method="GET">  
 <table width="100%" border="0">  
 <tr>  
      <td width="120">Nama Lengkap</td>  
      <td width="5">:</td>  
      <td>  
           <input type="text" name="nama" size="30">  
      </td>  
 </tr>  
 <tr>  
      <td width="120">Pekerjaan</td>  
      <td width="5">:</td>  
      <td>  
           <select name="pekerjaan">  
           <option value="Pelajar"> Pelajar </option>  
           <option value="Mahasiswa"> Mahasiswa </option>  
           <option value="Guru/Dosen"> Guru/Dosen </option>  
           <option value="PNS"> PNS </option>  
           <option value="Karyawan Swasta"> Karyawan Swasta </option>  
           <option value="Lain-lain"> Lain-lain </option>  
           </select>  
      </td>  
 </tr>  
 <tr>  
      <td width="120">Usia</td>  
      <td width="5">:</td>  
      <td>  
           <select name="usia">  
           <option value="u1"> < 20 Tahun </option>  
           <option value="u2"> 20 s/d 30 Tahun </option>  
           <option value="u3"> > 30 Tahun </option>  
           </select>  
      </td>  
 </tr>  
 <tr>  
      <td width="120">Komentar</td>  
      <td width="5">:</td>  
      <td>  
           <textarea name="komentar" cols="50" rows="4"></textarea>  
      </td>  
 </tr>  
 <tr>  
      <td width="120"></td>  
      <td width="5"></td>  
      <td>  
           <input type="submit" value="Kirim Komentar">  
      </td>  
 </tr>  
 </table>  
 </form>  
 <hr>  
 <!-- Kode php untuk inisiasi dibawah baris ini -->  
 <!-- Kode php untuk pemrosesan dan output dibawah baris ini -->  
 </body>  
 </html>  