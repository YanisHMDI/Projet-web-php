<?php
// Vérifiez si l'utilisateur est connecté en vérifiant la présence de la session 'username'
$user_logged_in = $this->session->userdata('username');

if ($user_logged_in) {
    include 'sidebar_logged.php';
} else {
    include 'sidebar_not_logged.php';
}
?>
<script>
    function performSearch() {
        var query = document.getElementById('search-input').value;
        window.location.href = "<?php echo site_url('search'); ?>?query=" + query;
    }
</script>
