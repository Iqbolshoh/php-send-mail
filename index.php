<?php
session_start();
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email</title>
    <link rel="icon" href="https://iqbolshoh.uz/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow p-4">
                    <div class="text-center">
                        <a href="https://iqbolshoh.uz" target="_blank">
                            <img src="./src/images/logo.svg" alt="Logo" style="width: 120px;">
                        </a>
                    </div>
                    <h3 class="text-center">📧 Send Email</h3>
                    <form id="emailForm">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                        <div class="mb-3">
                            <label class="form-label">Mail to</label>
                            <input type="email" name="mail_to" class="form-control" required maxlength="100">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Subject</label>
                            <input type="text" name="subject" class="form-control" required maxlength="150">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea name="message" class="form-control" rows="4" required maxlength="500"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Send Email</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("emailForm").addEventListener("submit", function (event) {
            event.preventDefault();

            fetch('send-mail.php', {
                method: 'POST',
                body: new FormData(this),
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        icon: data.status === 'success' ? 'success' : 'error',
                        title: data.title,
                        text: data.message,
                        position: 'top',
                        backdrop: false
                    });
                })
                .catch(error => console.error('Error:', error));
        });
    </script>

</body>

</html>