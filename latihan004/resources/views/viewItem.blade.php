<!DOCTYPE html>
<html lang="id">
    <body>
      hello <br>  
      {{ $kategori }}  <br>
      {{ $name }}  <br>
      {{ $x[0] }}  <br>
      {{ $x[1] }}  <br>
      {{ $x[2] }}  <br>
      {{ $x[3] }}  <br>
      

      @foreach ($items as $item)
      {{ $item['nama'] }} <br>  
      @endforeach

      
    </body>
</html>