<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <form id="emailForm">
        <input type="hidden" name="csrf_token"
            value="<?php echo $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); ?>">
        <button type="submit">Send Email</button>
    </form>

    <script>
        document.getElementById("emailForm").addEventListener("submit", function (event) {
            event.preventDefault();

            fetch("send-mail.php", {
                method: "POST",
                body: new FormData(this),
                headers: { "X-Requested-With": "XMLHttpRequest" }
            })
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        icon: data.status === "success" ? "success" : "error",
                        title: data.title,
                        text: data.message
                    });
                })
                .catch(error => console.error("Error:", error));
        });
    </script>

</body>

</html>