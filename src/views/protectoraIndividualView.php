<h1>Protectoras</h1>
<script>
    session_start();
    if (!isset($_SESSION['protectora_id'])) {
        header('Location: /Protectoras/public_html/index.php?case=login');
        exit;
    }
</script>
