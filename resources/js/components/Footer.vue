<template>
    <div>
       <div class="footer">Copyrights Reserved <span id="year"></span> &copy;</div>
    </div>

</template>

<script>
  $(document).ready(function(){
    document.getElementById("year").innerHTML = new Date().getFullYear();
    
  });
</script>
