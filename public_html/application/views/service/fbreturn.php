<script>
hashes = window.location.hash;

window.location.href = '<?php echo site_url("service/fbaccess/2")?>' + hashes.replace('#','?');

</script>